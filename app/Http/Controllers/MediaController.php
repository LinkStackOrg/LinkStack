<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    private const CACHE_CONTROL = 'public, max-age=3600, s-maxage=86400';
    private const OG_WIDTH = 1200;
    private const OG_HEIGHT = 630;

    public function profile($userId)
    {
        $user = User::find($userId);
        $image = profileImageValue($user);

        Log::info('Profile media route hit', [
            'user_id' => $userId,
            'stored_image' => $image,
        ]);

        if (!$user || empty($image)) {
            return $this->redirectToDefault($userId, $image, 'default');
        }

        if (Str::startsWith($image, ['http://', 'https://'])) {
            Log::info('Profile media resolved as full URL', [
                'user_id' => $userId,
                'stored_image' => $image,
            ]);

            return redirect()->away($image, 302, $this->cacheHeaders());
        }

        if (!Str::startsWith($image, 'users/')) {
            if (Str::startsWith($image, 'assets/img/')) {
                if (!$this->isSafeAssetPath($image)) {
                    Log::warning('Profile media rejected unsafe asset image path', [
                        'user_id' => $userId,
                        'stored_image' => $image,
                    ]);

                    return $this->redirectToDefault($userId, $image, 'invalid-asset');
                }

                Log::info('Profile media resolved as legacy asset image', [
                    'user_id' => $userId,
                    'stored_image' => $image,
                ]);

                return redirect(asset($image), 302, $this->cacheHeaders());
            }

            if (!$this->isSafeLocalFilename($image)) {
                Log::warning('Profile media rejected unsafe local image path', [
                    'user_id' => $userId,
                    'stored_image' => $image,
                ]);

                return $this->redirectToDefault($userId, $image, 'invalid-local');
            }

            Log::info('Profile media resolved as legacy local image', [
                'user_id' => $userId,
                'stored_image' => $image,
            ]);

            return redirect(asset('assets/img/' . ltrim($image, '/')), 302, $this->cacheHeaders());
        }

        if (!$this->isAllowedProfilePath($image, $user->id)) {
            Log::warning('Profile media rejected unsafe S3 profile path', [
                'user_id' => $userId,
                'stored_image' => $image,
            ]);

            abort(404);
        }

        try {
            if (!Storage::disk('s3')->exists($image)) {
                Log::warning('Profile media S3 object missing', [
                    'user_id' => $userId,
                    'stored_image' => $image,
                ]);

                return $this->redirectToDefault($userId, $image, 'missing-s3');
            }

            $contents = Storage::disk('s3')->get($image);
            $mimeType = Storage::disk('s3')->mimeType($image) ?: $this->fallbackMimeType($image);

            Log::info('Profile media resolved as S3 image', [
                'user_id' => $userId,
                'stored_image' => $image,
                'mime_type' => $mimeType,
            ]);

            return response($contents, 200)
                ->header('Content-Type', $mimeType)
                ->header('Cache-Control', self::CACHE_CONTROL);
        } catch (\Throwable $e) {
            Log::warning('Profile media S3 read failed', [
                'user_id' => $userId,
                'stored_image' => $image,
                'message' => $e->getMessage(),
            ]);

            return $this->redirectToDefault($userId, $image, 's3-error');
        }
    }

    public function openGraphProfile($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            abort(404);
        }

        $username = $user->littlelink_name ?: (string) $user->id;
        $displayName = trim($user->name ?? '') !== ''
            ? $user->name
            : $username . ' on Livelatch';
        $bio = trim(strip_tags(html_entity_decode($user->littlelink_description ?? '', ENT_QUOTES, 'UTF-8')));
        $bio = $bio !== ''
            ? $bio
            : "View {$username}'s Livelatch profile.";
        $profileUrl = url('/@' . $username);
        $avatarDataUri = $this->profileAvatarDataUri($user);

        Log::info('Open Graph profile image route hit', [
            'user_id' => $userId,
            'stored_image' => profileImageValue($user),
        ]);

        if (function_exists('imagecreatetruecolor')) {
            $png = $this->profileOpenGraphPng([
                'username' => $username,
                'display_name' => $displayName,
                'bio' => $bio,
                'url' => $profileUrl,
                'avatar' => $avatarDataUri,
                'brand' => 'Livelatch',
            ]);

            if ($png !== null) {
                return response($png, 200)
                    ->header('Content-Type', 'image/png')
                    ->header('Cache-Control', self::CACHE_CONTROL)
                    ->header('X-Content-Type-Options', 'nosniff');
            }
        }

        Log::warning('Open Graph PNG generation unavailable; returning default PNG', [
            'user_id' => $userId,
            'gd_loaded' => extension_loaded('gd'),
        ]);

        return response($this->defaultPngBytes(), 200)
            ->header('Content-Type', 'image/png')
            ->header('Cache-Control', self::CACHE_CONTROL)
            ->header('X-Content-Type-Options', 'nosniff');
    }

    private function redirectToDefault($userId, $image, $reason)
    {
        Log::info('Profile media resolved as default image', [
            'user_id' => $userId,
            'stored_image' => $image,
            'reason' => $reason,
        ]);

        return redirect(asset('assets/img/user.png'), 302, $this->cacheHeaders());
    }

    private function cacheHeaders()
    {
        return ['Cache-Control' => self::CACHE_CONTROL];
    }

    private function isAllowedProfilePath($path, $userId)
    {
        return !Str::contains($path, ['..', '\\'])
            && preg_match('/^users\/' . preg_quote((string) $userId, '/') . '\/profile\/[^\/]+\.(jpe?g|png|webp|gif)$/i', $path) === 1;
    }

    private function isSafeLocalFilename($path)
    {
        $path = ltrim($path, '/');

        return !Str::contains($path, ['..', '/', '\\'])
            && preg_match('/^[A-Za-z0-9._-]+\.(jpe?g|png|webp|gif)$/i', $path) === 1;
    }

    private function isSafeAssetPath($path)
    {
        return !Str::contains($path, ['..', '\\'])
            && preg_match('/^assets\/img\/[A-Za-z0-9._-]+\.(jpe?g|png|webp|gif)$/i', $path) === 1;
    }

    private function fallbackMimeType($path)
    {
        return match (Str::lower(pathinfo($path, PATHINFO_EXTENSION))) {
            'jpg', 'jpeg' => 'image/jpeg',
            'webp' => 'image/webp',
            'gif' => 'image/gif',
            default => 'image/png',
        };
    }

    private function profileAvatarDataUri($user)
    {
        $image = profileImageValue($user);
        $contents = null;
        $mimeType = 'image/png';

        try {
            if (!empty($image) && Str::startsWith($image, 'users/') && $this->isAllowedProfilePath($image, $user->id)) {
                if (Storage::disk('s3')->exists($image)) {
                    $contents = Storage::disk('s3')->get($image);
                    $mimeType = Storage::disk('s3')->mimeType($image) ?: $this->fallbackMimeType($image);
                }
            } elseif (!empty($image) && Str::startsWith($image, ['http://', 'https://'])) {
                $contents = @file_get_contents($image);
                $mimeType = $this->fallbackMimeType(parse_url($image, PHP_URL_PATH) ?: 'avatar.png');
            } elseif (!empty($image)) {
                $path = Str::startsWith($image, 'assets/img/')
                    ? base_path($image)
                    : base_path('assets/img/' . ltrim($image, '/'));

                if (is_file($path) && $this->isSafeAssetReadPath($path)) {
                    $contents = file_get_contents($path);
                    $mimeType = $this->fallbackMimeType($path);
                }
            }
        } catch (\Throwable $e) {
            Log::warning('Open Graph profile avatar read failed', [
                'user_id' => optional($user)->id,
                'stored_image' => $image,
                'message' => $e->getMessage(),
            ]);
        }

        if ($contents === null) {
            $default = base_path('assets/img/user.png');
            if (is_file($default)) {
                $contents = file_get_contents($default);
            } else {
                $contents = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII=');
            }
        }

        return 'data:' . $mimeType . ';base64,' . base64_encode($contents);
    }

    private function defaultPngBytes()
    {
        $default = base_path('assets/img/user.png');
        if (is_file($default)) {
            return file_get_contents($default);
        }

        return base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII=');
    }

    private function profileOpenGraphSvg($data)
    {
        $title = $this->escapeSvg($data['display_name']);
        $bio = $this->wrapSvgText($data['bio'], 42, 3);
        $url = $this->escapeSvg($data['url']);
        $avatar = $this->escapeSvg($data['avatar']);
        $brand = $this->escapeSvg($data['brand']);

        $bioTspans = '';
        foreach ($bio as $index => $line) {
            $dy = $index === 0 ? 0 : 38;
            $bioTspans .= '<tspan x="344" dy="' . $dy . '">' . $this->escapeSvg($line) . '</tspan>';
        }

        $dotGrid = '';
        for ($x = 0; $x < 6; $x++) {
            for ($y = 0; $y < 3; $y++) {
                $cx = 850 + $x * 38;
                $cy = 390 + $y * 35;
                $opacity = 0.28 + (($x + $y) / 12);
                $dotGrid .= '<circle cx="' . $cx . '" cy="' . $cy . '" r="5" opacity="' . round($opacity, 2) . '"/>';
            }
        }

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="630" viewBox="0 0 1200 630">
  <defs>
    <linearGradient id="bg" x1="0" x2="1" y1="0" y2="1">
      <stop offset="0" stop-color="#ff0000"/>
      <stop offset="1" stop-color="#001eff"/>
    </linearGradient>
    <filter id="noise">
      <feTurbulence type="fractalNoise" baseFrequency=".9" numOctaves="2" stitchTiles="stitch"/>
      <feColorMatrix type="saturate" values="0"/>
      <feComponentTransfer>
        <feFuncA type="table" tableValues="0 .4"/>
      </feComponentTransfer>
    </filter>
    <radialGradient id="vig" cx="50%" cy="50%" r="75%">
      <stop offset="45%" stop-color="#000" stop-opacity="0"/>
      <stop offset="100%" stop-color="#000" stop-opacity="1"/>
    </radialGradient>
    <clipPath id="avatarClip">
      <rect x="78" y="150" width="220" height="220" rx="110"/>
    </clipPath>
  </defs>
  <rect width="1200" height="630" fill="url(#bg)"/>
  <rect width="1200" height="630" filter="url(#noise)" opacity=".65"/>
  <rect width="1200" height="630" fill="url(#vig)"/>
  <rect x="70" y="80" width="1060" height="470" rx="34" fill="#151b26" opacity=".72"/>
  <image href="{$avatar}" x="78" y="150" width="220" height="220" preserveAspectRatio="xMidYMid slice" clip-path="url(#avatarClip)"/>
  <circle cx="188" cy="260" r="112" fill="none" stroke="#edf7f7" stroke-opacity=".28" stroke-width="5"/>
  <text x="340" y="205" fill="#f7fbff" font-size="68" font-weight="800" font-family="Inter, Arial, sans-serif">{$title}</text>
  <text x="344" y="305" fill="#c8d2df" font-size="32" font-weight="500" font-family="Inter, Arial, sans-serif">{$bioTspans}</text>
  <text x="344" y="420" fill="#21c7a8" font-size="24" font-weight="700" font-family="Inter, Arial, sans-serif">{$url}</text>
  <g fill="#edf7f7" opacity=".9">{$dotGrid}</g>
  <text x="70" y="590" fill="#ffffff" fill-opacity=".64" font-size="22" font-weight="700" font-family="Inter, Arial, sans-serif">{$brand}</text>
</svg>
SVG;
    }

    private function profileOpenGraphPng($data)
    {
        try {
            $width = self::OG_WIDTH;
            $height = self::OG_HEIGHT;
            $image = imagecreatetruecolor($width, $height);
            imagealphablending($image, true);
            imagesavealpha($image, true);

            $red = [255, 0, 0];
            $blue = [0, 30, 255];
            for ($y = 0; $y < $height; $y++) {
                for ($x = 0; $x < $width; $x++) {
                    $t = ($x / $width + $y / $height) / 2;
                    $r = (int) ($red[0] * (1 - $t) + $blue[0] * $t);
                    $g = (int) ($red[1] * (1 - $t) + $blue[1] * $t);
                    $b = (int) ($red[2] * (1 - $t) + $blue[2] * $t);
                    if ((($x * 13 + $y * 17) % 23) < 9) {
                        $r = max(0, min(255, $r + (($x + $y) % 17) - 8));
                        $g = max(0, min(255, $g + (($x * 2 + $y) % 17) - 8));
                        $b = max(0, min(255, $b + (($x + $y * 2) % 17) - 8));
                    }
                    $v = max(abs($x - $width / 2) / ($width / 2), abs($y - $height / 2) / ($height / 2));
                    $darken = min(1, max(0, ($v - 0.2) / 0.8));
                    $r = (int) ($r * (1 - $darken * 0.78));
                    $g = (int) ($g * (1 - $darken * 0.78));
                    $b = (int) ($b * (1 - $darken * 0.78));
                    imagesetpixel($image, $x, $y, imagecolorallocate($image, $r, $g, $b));
                }
            }

            $this->filledRoundedRectangle($image, 70, 80, 1130, 550, 34, [21, 27, 38], 28);
            $this->drawAvatar($image, $data['avatar'], 78, 150, 220);
            $this->drawCircleOutline($image, 188, 260, 112, [237, 247, 247], 92, 5);

            $fontRegular = $this->findFont(false);
            $fontBold = $this->findFont(true);
            $this->drawText($image, $data['display_name'], 340, 205, 68, [247, 251, 255], $fontBold, 800);
            $this->drawWrappedText($image, $data['bio'], 344, 305, 32, [200, 210, 223], $fontRegular, 42, 3, 38);
            $this->drawText($image, $data['url'], 344, 420, 24, [33, 199, 168], $fontBold, 700);
            $this->drawText($image, $data['brand'], 70, 590, 22, [190, 196, 205], $fontBold, 700);

            for ($x = 0; $x < 6; $x++) {
                for ($y = 0; $y < 3; $y++) {
                    $cx = 850 + $x * 38;
                    $cy = 390 + $y * 35;
                    $alpha = (int) max(0, min(127, 127 - (0.28 + (($x + $y) / 12)) * 90));
                    imagefilledellipse($image, $cx, $cy, 10, 10, imagecolorallocatealpha($image, 237, 247, 247, $alpha));
                }
            }

            ob_start();
            imagepng($image, null, 7);
            $png = ob_get_clean();
            imagedestroy($image);

            return $png;
        } catch (\Throwable $e) {
            Log::warning('Open Graph PNG generation failed', [
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }

    private function drawText($image, $text, $x, $y, $size, $rgb, $font, $weight = 700)
    {
        $color = imagecolorallocate($image, $rgb[0], $rgb[1], $rgb[2]);
        $text = html_entity_decode(strip_tags((string) $text), ENT_QUOTES, 'UTF-8');

        if ($font && function_exists('imagettftext')) {
            imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
            return;
        }

        imagestring($image, 5, $x, $y - 16, $text, $color);
    }

    private function drawWrappedText($image, $text, $x, $y, $size, $rgb, $font, $maxChars, $maxLines, $lineHeight)
    {
        foreach ($this->wrapSvgText($text, $maxChars, $maxLines) as $index => $line) {
            $this->drawText($image, $line, $x, $y + ($index * $lineHeight), $size, $rgb, $font, 500);
        }
    }

    private function filledRoundedRectangle($image, $x1, $y1, $x2, $y2, $radius, $rgb, $alpha)
    {
        $color = imagecolorallocatealpha($image, $rgb[0], $rgb[1], $rgb[2], $alpha);
        imagefilledrectangle($image, $x1 + $radius, $y1, $x2 - $radius, $y2, $color);
        imagefilledrectangle($image, $x1, $y1 + $radius, $x2, $y2 - $radius, $color);
        imagefilledellipse($image, $x1 + $radius, $y1 + $radius, $radius * 2, $radius * 2, $color);
        imagefilledellipse($image, $x2 - $radius, $y1 + $radius, $radius * 2, $radius * 2, $color);
        imagefilledellipse($image, $x1 + $radius, $y2 - $radius, $radius * 2, $radius * 2, $color);
        imagefilledellipse($image, $x2 - $radius, $y2 - $radius, $radius * 2, $radius * 2, $color);
    }

    private function drawCircleOutline($image, $cx, $cy, $radius, $rgb, $alpha, $thickness)
    {
        $color = imagecolorallocatealpha($image, $rgb[0], $rgb[1], $rgb[2], $alpha);
        imagesetthickness($image, $thickness);
        imageellipse($image, $cx, $cy, $radius * 2, $radius * 2, $color);
        imagesetthickness($image, 1);
    }

    private function drawAvatar($image, $dataUri, $x, $y, $size)
    {
        $avatar = $this->imageFromDataUri($dataUri);
        if (!$avatar) {
            return;
        }

        $srcW = imagesx($avatar);
        $srcH = imagesy($avatar);
        $srcSize = min($srcW, $srcH);
        $srcX = (int) (($srcW - $srcSize) / 2);
        $srcY = (int) (($srcH - $srcSize) / 2);
        $dest = imagecreatetruecolor($size, $size);
        imagesavealpha($dest, true);
        imagealphablending($dest, false);
        imagefilledrectangle($dest, 0, 0, $size, $size, imagecolorallocatealpha($dest, 0, 0, 0, 127));
        imagecopyresampled($dest, $avatar, 0, 0, $srcX, $srcY, $size, $size, $srcSize, $srcSize);

        $mask = imagecreatetruecolor($size, $size);
        imagefilledrectangle($mask, 0, 0, $size, $size, imagecolorallocate($mask, 0, 0, 0));
        imagefilledellipse($mask, $size / 2, $size / 2, $size, $size, imagecolorallocate($mask, 255, 255, 255));

        for ($px = 0; $px < $size; $px++) {
            for ($py = 0; $py < $size; $py++) {
                if ((imagecolorat($mask, $px, $py) & 0xFF) === 0) {
                    imagesetpixel($dest, $px, $py, imagecolorallocatealpha($dest, 0, 0, 0, 127));
                }
            }
        }

        imagecopy($image, $dest, $x, $y, 0, 0, $size, $size);
        imagedestroy($avatar);
        imagedestroy($dest);
        imagedestroy($mask);
    }

    private function imageFromDataUri($dataUri)
    {
        if (!preg_match('/^data:image\/[a-zA-Z0-9.+-]+;base64,(.+)$/', $dataUri, $matches)) {
            return null;
        }

        $bytes = base64_decode($matches[1], true);
        if ($bytes === false) {
            return null;
        }

        return @imagecreatefromstring($bytes) ?: null;
    }

    private function findFont($bold)
    {
        $paths = $bold
            ? [
                '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf',
                '/usr/share/fonts/truetype/liberation2/LiberationSans-Bold.ttf',
                'C:\\Windows\\Fonts\\arialbd.ttf',
            ]
            : [
                '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf',
                '/usr/share/fonts/truetype/liberation2/LiberationSans-Regular.ttf',
                'C:\\Windows\\Fonts\\arial.ttf',
            ];

        foreach ($paths as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
    }

    private function wrapSvgText($text, $maxChars, $maxLines)
    {
        $words = preg_split('/\s+/', trim($text));
        $lines = [];
        $line = '';

        foreach ($words as $word) {
            $next = $line === '' ? $word : $line . ' ' . $word;
            if (mb_strlen($next) > $maxChars && $line !== '') {
                $lines[] = $line;
                $line = $word;
            } else {
                $line = $next;
            }

            if (count($lines) >= $maxLines) {
                break;
            }
        }

        if ($line !== '' && count($lines) < $maxLines) {
            $lines[] = $line;
        }

        if (empty($lines)) {
            $lines[] = '';
        }

        return $lines;
    }

    private function escapeSvg($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    private function isSafeAssetReadPath($path)
    {
        $realPath = realpath($path);
        $assetRoot = realpath(base_path('assets/img'));

        return $realPath && $assetRoot && Str::startsWith($realPath, $assetRoot);
    }
}

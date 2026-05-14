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

        $svg = $this->profileOpenGraphSvg([
            'username' => $username,
            'display_name' => $displayName,
            'bio' => $bio,
            'url' => $profileUrl,
            'avatar' => $avatarDataUri,
            'brand' => 'Livelatch',
        ]);

        return response($svg, 200)
            ->header('Content-Type', 'image/svg+xml; charset=UTF-8')
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

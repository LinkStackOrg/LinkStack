<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    private const CACHE_CONTROL = 'public, max-age=3600, s-maxage=86400';

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
}

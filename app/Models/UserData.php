<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class UserData extends Model
{
    protected $table = 'users';
    protected $fillable = ['image'];

    public static function saveData($userId, $key, $value)
    {
        $userData = self::getCachedUserData($userId);

        if (!$userData) {
            return "null";
        }

        $data = json_decode($userData->image, true) ?? [];
        $data[$key] = $value;

        $userData->image = json_encode($data);
        $userData->save();

        self::cacheUserData($userId, $userData);
    }

    public static function getData($userId, $key)
    {
        $userData = self::getCachedUserData($userId);

        if (!$userData || !$userData->image) {
            return "null";
        }

        $data = json_decode($userData->image, true) ?? [];

        return isset($data[$key]) ? $data[$key] : null;
    }

    public static function removeData($userId, $key)
    {
        $userData = self::getCachedUserData($userId);

        if (!$userData || !$userData->image) {
            return "null";
        }

        $data = json_decode($userData->image, true) ?? [];

        if (isset($data[$key])) {
            unset($data[$key]);
            $userData->image = json_encode($data);
            $userData->save();

            self::cacheUserData($userId, $userData);
        }
    }

    private static function getCachedUserData($userId)
    {
        return Cache::remember('user_data_' . $userId, now()->addMinutes(10), function () use ($userId) {
            return self::where('id', $userId)->first();
        });
    }

    private static function cacheUserData($userId, $userData)
    {
        Cache::put('user_data_' . $userId, $userData, now()->addMinutes(10));
    }
}

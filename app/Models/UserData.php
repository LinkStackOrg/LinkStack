<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'users';
    protected $fillable = ['image'];

    public static function saveData($userId, $key, $value)
    {
        $userData = self::where('id', $userId)->first();

        if (!$userData) {
            return "null";
        }

        $data = json_decode($userData->image, true) ?? [];
        $data[$key] = $value;

        $userData->image = json_encode($data);
        $userData->save();
    }

    public static function getData($userId, $key)
    {
        $userData = self::where('id', $userId)->first();
    
        if (!$userData || !$userData->image) {
            return "null";
        }
    
        $data = json_decode($userData->image, true) ?? [];
    
        return isset($data[$key]) ? $data[$key] : null;
    }

    public static function removeData($userId, $key)
    {
        $userData = self::where('id', $userId)->first();
    
        if (!$userData || !$userData->image) {
            return "null";
        }
    
        $data = json_decode($userData->image, true) ?? [];
    
        if (isset($data[$key])) {
            unset($data[$key]);
            $userData->image = json_encode($data);
            $userData->save();
        }
    }
}

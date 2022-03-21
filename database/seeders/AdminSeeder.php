<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => '0000-00-00 00:00:00',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'littlelink_name' => 'admin',
                'littlelink_description' => 'admin page',
            ]
        ];

        User::insert($admin);
    }
}

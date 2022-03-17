<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = [
            [
                'terms' => '
                 Users who submit racist, violent and phishing links will be blocked and their links will be removed.
                ',

                'privacy' => '
                 The code is open source and you can see it in GitHub, we do not collect any other information such as IP and location except email and links.
                ',

                'contact' => '
                 Send your suggestions and criticisms to info@littlelink-custom.com
                ',

                'home_message' => '
                LittleLink Custom is a fork of LittleLink admin
                with a set goal of making the admin panel easier to use and setup,
                for inexperienced and first-time users, with the addition of many custom features
                themed around customization for the individual users, LittleLink pages.
                ',

                'register' => 'true',
            ]
         ];

         Page::insert($page);
    }
}

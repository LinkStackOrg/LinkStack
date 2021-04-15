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
                 Send your suggestions and criticisms to khashayar.zavosh@gmail.com
                ',

                'home_message' => '
                 Admin littlelink is an admin panel for littlelink that provides you a website similar linktree.
                 Some features of the program: creating a link page with more than 20 buttons, counting clicks, 
                 raising important links on the page and managing users and pages and ...
                ',

            ]
         ];

         Page::insert($page);
    }
}

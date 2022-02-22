<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Button;

class ButtonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buttons = [
        	[
                'name' => 'custom'
            ],
            
            [
                'name' => 'github'
            ],

            [
                'name' => 'twitter'
            ],

            [
                'name' => 'instagram'
            ],

            [
                'name' => 'facebook'
            ],

            [
                'name' => 'messenger'
            ],

            [
                'name' => 'linkedin'
            ],

            [
                'name' => 'youtube'
            ],

            [
                'name' => 'discord'
            ],

            [
                'name' => 'twitch'
            ],

            [
                'name' => 'snapchat'
            ],

            [
                'name' => 'spotify'
            ],

            [
                'name' => 'reddit'
            ],

            [
                'name' => 'medium'
            ],

            [
                'name' => 'pinterest'
            ],

            [
                'name' => 'soundcloud'
            ],

            [
                'name' => 'figma'
            ],

            [
                'name' => 'kit'
            ],

            [
                'name' => 'telegram'
            ],

            [
                'name' => 'tumblr'
            ],

            [
                'name' => 'steam'
            ],

            [
                'name' => 'vimeo'
            ],

            [
                'name' => 'wordpress'
            ],

            [
                'name' => 'goodreads'
            ],

            [
                'name' => 'skoob'
            ],

            [
                'name' => 'tiktok'
            ],

            [
                'name' => 'default email'
            ],

            [
                'name' => 'default email_alt'
            ],

        	[
                'name' => 'bandcamp'
            ],
            
            [
                'name' => 'patreon'
            ],

            [
                'name' => 'signal'
            ],

            [
                'name' => 'venmo'
            ],

            [
                'name' => 'cashapp'
            ],

            [
                'name' => 'gitlab'
            ],

            [
                'name' => 'mastodon'
            ],

            [
                'name' => 'paypal'
            ],

            [
                'name' => 'whatsapp'
            ],

            [
                'name' => 'xing'
            ],
        ];

         Button::insert($buttons);
    }
}

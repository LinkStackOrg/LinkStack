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
			'name' => 'custom_website'
            ],
			
            [
			'name' => 'bandcamp'
            ],
			
            [
			'name' => 'buy me a coffee'
            ],
			
            [
			'name' => 'cashapp'
            ],
			

            [
			'name' => 'default email'
            ],
			
            [
			'name' => 'default email_alt'
            ],
			
            [
			'name' => 'discord'
            ],
			
            [
			'name' => 'facebook'
            ],
			
            [
			'name' => 'figma'
            ],
			
            [
			'name' => 'github'
            ],
			
            [
			'name' => 'gitlab'
            ],
			
            [
			'name' => 'goodreads'
            ],
			

            [
			'name' => 'instagram'
            ],
			
            [
			'name' => 'kit'
            ],
			
            [
			'name' => 'linkedin'
            ],
			
            [
			'name' => 'mastodon'
            ],
			
            [
			'name' => 'medium'
            ],
			
            [
			'name' => 'messenger'
            ],
			
            [
			'name' => 'patreon'
            ],
			
            [
			'name' => 'paypal'
            ],
                
            [
			'name' => 'pinterest'
            ],
			
            [
			'name' => 'reddit'
            ],
			
            [
			'name' => 'signal'
            ],
			
            [
			'name' => 'skoob'
            ],
			
            [
			'name' => 'snapchat'
            ],
			
            [
			'name' => 'soundcloud'
            ],
			
            [
			'name' => 'spotify'
            ],
			
            [
			'name' => 'steam'
            ],
			
            [
			'name' => 'telegram'
            ],
			
            [
			'name' => 'tiktok'
            ],
			
            [
			'name' => 'tumblr'
            ],
            
            [
			'name' => 'twitch'
            ],
			
            [
			'name' => 'twitter'
            ],
			
            [
			'name' => 'venmo'
            ],
			
            [
			'name' => 'vimeo'
            ],
			
            [
			'name' => 'website'
            ],
			
            [
			'name' => 'whatsapp'
            ],
			
            [
			'name' => 'wordpress'
            ],
			
            [
			'name' => 'xing'
            ],
			
            [
			'name' => 'youtube'
            ],
			
            [
			'name' => 'heading'
            ],
			
            [
			'name' => 'space'
            ],
			
            [
            'name' => 'phone'
            ],

            [
            'name' => 'trello'
            ],
            [
            'name' => 'colorstreet'
            ],

        ];

         Button::insert($buttons);
    }
}

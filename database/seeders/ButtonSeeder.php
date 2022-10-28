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
            'name' => 'website'
            ],

            [
            'name' => 'phone'
            ],

            [
            'name' => 'littlelink-custom'
            ],

            [
            'name' => 'heading'
            ],
                
            [
            'name' => 'space'
            ],

            [
            'name' => 'amazon'
            ],

            [
            'name' => 'appstore'
            ],

            [
            'name' => 'apple-music'
            ],
    
            [
            'name' => 'apple-podcasts'
            ],

            [
			'name' => 'bandcamp'
            ],
			
            [
            'name' => 'briar'
            ],
            
            [
			'name' => 'buy me a coffee'
            ],
			
            [
			'name' => 'cashapp'
            ],

            [
            'name' => 'castopod'
            ],

            [
            'name' => 'codepen'
            ],
    
            [
            'name' => 'codeberg'
            ],

            [
            'name' => 'cryptpad'
            ],

            [
			'name' => 'default email'
            ],
			
            [
			'name' => 'default email_alt'
            ],

            [
            'name' => 'dev-to'
            ],
            
            [
            'name' => 'deezer'
            ],
			
            [
			'name' => 'discord'
            ],
            
            [
            'name' => 'epic-games'
            ],
            
            [
            'name' => 'etsy'
            ],
			
            [
			'name' => 'facebook'
            ],
            			
            [
            'name' => 'messenger'
            ],
			
            [
			'name' => 'figma'
            ],
            
            [
            'name' => 'firefox'
            ],
            
            [
            'name' => 'flickr'
            ],
            
            [
            'name' => 'funkwhale'
            ],
            
            [
            'name' => 'f-droid'
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
            'name' => 'itchio'
            ],

            [
            'name' => 'humble-bundle'
            ],
			
            [
            'name' => 'kickstarter'
            ],

            [
			'name' => 'kit'
            ],

            [
            'name' => 'ko-fi'
            ],

            [
            'name' => 'lemmy'
            ],
            
            [
            'name' => 'letterboxd'
            ],
            
            [
            'name' => 'liberapay'
            ],
			
            [
			'name' => 'linkedin'
            ],

            [
            'name' => 'matrix'
            ],
			
            [
			'name' => 'mastodon'
            ],
			
            [
			'name' => 'medium'
            ],

            [
            'name' => 'misskey'
            ],
            
            [
            'name' => 'notion'
            ],

            [
            'name' => 'odysee'
            ],

            [
            'name' => 'openstreetmap'
            ],

            [
            'name' => 'owncast'
            ],
			
            [
			'name' => 'patreon'
            ],
			
            [
			'name' => 'paypal'
            ],

            [
            'name' => 'peertube'
            ],

            [
            'name' => 'pinterest'
            ],

            [
            'name' => 'pixelfed'
            ],

            [
            'name' => 'piwigo'
            ],
                        
            [
            'name' => 'playstore'
            ],

            [
            'name' => 'plemora'
            ],

            [
            'name' => 'producthunt'
            ],
			
            [
			'name' => 'reddit'
            ],
            
            [
            'name' => 'session'
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
            'name' => 'strava'
            ],
			
            [
			'name' => 'telegram'
            ],

            [
            'name' => 'threema'
            ],
			
            [
			'name' => 'tiktok'
            ],

            [
            'name' => 'trello'
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
            'name' => 'unity'
            ],
            
            [
            'name' => 'unraid'
            ],

            [
            'name' => 'untappd'
            ],
            
            [
            'name' => 'upptime'
            ],
			
            [
			'name' => 'venmo'
            ],
			
            [
			'name' => 'vimeo'
            ],

            [
            'name' => 'vrchat'
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
            'name' => 'youtube-music'
            ],
    
        ];

         Button::insert($buttons);
    }
}

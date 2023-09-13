<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Button;

class ButtonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * ALWAYS ADD NEW BUTTONS TO THE END OF THE FILE!
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
            'name' => 'littlelink-custom'
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
            'name' => 'briar'
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
            'name' => 'dev-to'
            ],
            
            [
            'name' => 'deezer'
            ],
        
            [
            'name' => 'epic-games'
            ],
            
            [
            'name' => 'etsy'
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
            'name' => 'itchio'
            ],
            
            [
            'name' => 'humble-bundle'
            ],
                        
            [
            'name' => 'kickstarter'
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
            'name' => 'matrix'
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
            'name' => 'peertube'
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
            'name' => 'session'
            ],
            
            [
            'name' => 'strava'
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
            'name' => 'vrchat'
            ],
            
            [
            'name' => 'youtube-music'
            ],

            [
            'name' => 'all-inkl'
            ],
    
            [
            'name' => 'text'
            ],

            [
            'name' => 'icon'
            ],

            [
            'name' => 'bookwyrm'
            ],

            [
            'name' => 'vcard'
            ],

            [
            'name' => 'apple-books'
            ],

            [
            'name' => 'scribd'
            ],

            [
            'name' => 'linkstack'
            ],

            [
            'name' => 'picarto'
            ],

            [
            'name' => 'trakt'
            ],

            [
            'name' => 'last-fm'
            ],

            [
            'name' => 'itaku'    
            ],

            [
            'name' => 'furaffinity'
            ],
            
            [
            'name' => 'bluesky'
            ],

            [
            'name' => 'firefish'
            ],
        ];

         Button::insert($buttons);
    }
}
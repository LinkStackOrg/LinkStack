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
                "name" => "custom",
                "alt" => "Custom",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "custom_website",
                "alt" => "Custom Website",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "bandcamp",
                "alt" => "Bandcamp",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "coffee",
                "alt" => "Buy Me a Coffee",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "cashapp",
                "alt" => "Cash App",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "default email",
                "alt" => "Default Email",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "default email_alt",
                "alt" => "Default Email Alt",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "discord",
                "alt" => "Discord",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "facebook",
                "alt" => "Facebook",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "figma",
                "alt" => "Figma",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "github",
                "alt" => "GitHub",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "gitlab",
                "alt" => "GitLab",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "goodreads",
                "alt" => "Goodreads",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "instagram",
                "alt" => "Instagram",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "kit",
                "alt" => "Kit",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "linkedin",
                "alt" => "LinkedIn",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "mastodon",
                "alt" => "Mastodon",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "medium",
                "alt" => "Medium",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "messenger",
                "alt" => "Messenger",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "patreon",
                "alt" => "Patreon",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "paypal",
                "alt" => "PayPal",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "pinterest",
                "alt" => "Pinterest",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "reddit",
                "alt" => "Reddit",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "signal",
                "alt" => "Signal",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "skoob",
                "alt" => "Skoob",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "snapchat",
                "alt" => "Snapchat",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "soundcloud",
                "alt" => "SoundCloud",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "spotify",
                "alt" => "Spotify",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "steam",
                "alt" => "Steam",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "telegram",
                "alt" => "Telegram",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "tiktok",
                "alt" => "TikTok",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "tumblr",
                "alt" => "Tumblr",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "twitch",
                "alt" => "Twitch",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "twitter",
                "alt" => "X",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "venmo",
                "alt" => "Venmo",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "vimeo",
                "alt" => "Vimeo",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "website",
                "alt" => "Website",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "whatsapp",
                "alt" => "WhatsApp",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "wordpress",
                "alt" => "WordPress",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "xing",
                "alt" => "Xing",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "youtube",
                "alt" => "YouTube",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "heading",
                "alt" => "Heading",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "space",
                "alt" => "Space",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "phone",
                "alt" => "Phone",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "trello",
                "alt" => "Trello",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "littlelink-custom",
                "alt" => "LittleLink Custom",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "space",
                "alt" => "Space",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "amazon",
                "alt" => "Amazon",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "appstore",
                "alt" => "App Store",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "apple-music",
                "alt" => "Apple Music",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "apple-podcasts",
                "alt" => "Apple Podcasts",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "briar",
                "alt" => "Briar",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "castopod",
                "alt" => "Castopod",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "codepen",
                "alt" => "CodePen",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "codeberg",
                "alt" => "Codeberg",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "cryptpad",
                "alt" => "CryptPad",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "dev-to",
                "alt" => "Dev.to",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "deezer",
                "alt" => "Deezer",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "epic-games",
                "alt" => "Epic Games",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "etsy",
                "alt" => "Etsy",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "firefox",
                "alt" => "Firefox",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "flickr",
                "alt" => "Flickr",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "funkwhale",
                "alt" => "Funkwhale",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "f-droid",
                "alt" => "F-Droid",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "itchio",
                "alt" => "Itch.io",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "humble-bundle",
                "alt" => "Humble Bundle",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "kickstarter",
                "alt" => "Kickstarter",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "ko-fi",
                "alt" => "Ko-fi",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "lemmy",
                "alt" => "Lemmy",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "letterboxd",
                "alt" => "Letterboxd",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "liberapay",
                "alt" => "Liberapay",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "matrix",
                "alt" => "Matrix",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "misskey",
                "alt" => "Misskey",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "notion",
                "alt" => "Notion",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "odysee",
                "alt" => "Odysee",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "openstreetmap",
                "alt" => "OpenStreetMap",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "owncast",
                "alt" => "Owncast",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "peertube",
                "alt" => "PeerTube",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "pixelfed",
                "alt" => "Pixelfed",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "piwigo",
                "alt" => "Piwigo",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "playstore",
                "alt" => "Play Store",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "pleroma",
                "alt" => "Pleroma",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "producthunt",
                "alt" => "Product Hunt",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "session",
                "alt" => "Session",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "strava",
                "alt" => "Strava",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "unity",
                "alt" => "Unity",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "unraid",
                "alt" => "Unraid",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "untappd",
                "alt" => "Untappd",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "upptime",
                "alt" => "Upptime",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "vrchat",
                "alt" => "VRChat",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "youtube-music",
                "alt" => "YouTube Music",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "all-inkl",
                "alt" => "All-Inkl",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "text",
                "alt" => "Text",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "icon",
                "alt" => "Icon",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "bookwyrm",
                "alt" => "Bookwyrm",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "vcard",
                "alt" => "vCard",
                "exclude" => true,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "apple-books",
                "alt" => "Apple Books",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "scribd",
                "alt" => "Scribd",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "linkstack",
                "alt" => "LinkStack",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "picarto",
                "alt" => "Picarto",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "trakt",
                "alt" => "Trakt",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "last-fm",
                "alt" => "Last.fm",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "itaku",
                "alt" => "Itaku",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "furaffinity",
                "alt" => "Furaffinity",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "bluesky",
                "alt" => "Bluesky",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "firefish",
                "alt" => "Firefish",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "streams",
                "alt" => "Streams",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "pronounspage",
                "alt" => "Pronouns.page",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "booth",
                "alt" => "BOOTH",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "hearthisat",
                "alt" => "HearThis.at",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "throne",
                "alt" => "Throne",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "behance",
                "alt" => "Behance",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "gdrive",
                "alt" => "Google Drive",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "friendica",
                "alt" => "Friendi.ca",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "simplex",
                "alt" => "Simplex",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "xbox",
                "alt" => "Xbox",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],

            [
                "name" => "threads",
                "alt" => "Threads",
                "exclude" => false,
                "group" => "default",
                "mb" => false,
            ],
        ];

        Button::insert($buttons);
    }
}

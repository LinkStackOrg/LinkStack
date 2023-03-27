<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LinkType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    var $TableName = 'link_types';
    public function up()
    {
        Schema::create($this->TableName, function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('typename', 100);
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('icon');
            $table->string('params', 65535)->nullable();
            $table->boolean('active')->default(true);
        });
        $this->SeedLinkTypes();

        Schema::table('links', function (Blueprint $table) {
            $table->string('link')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->unsignedBigInteger('button_id')->nullable()->constrained()->change();

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_types');

        Schema::table('links', function (Blueprint $table) {
            $table->string('link')->nullable(false)->change();
            $table->unsignedBigInteger('button_id')->nullable(false)->change();
            $table->string('title')->nullable(false)->change();

        });
    }


    public function SeedLinkTypes() {

        DB::table($this->TableName)->updateOrInsert([
            'typename' => 'predefined',
            'title' => 'Predefined Site',
            'icon' => 'bi bi-boxes',
            'description' => 'Select from a list of predefined websites and have your link automatically styled using that sites brand colors and icon.'
        ]);

        DB::table($this->TableName)->updateOrInsert([
            'typename' => 'link',
            'title' => 'Custom Link',
            'icon' => 'bi bi-link',
            'description' => 'Create a Custom Link that goes to any website. Customize the button styling and icon, or use the favicon from the website as the button icon.',
            'params' => '[{
                "tag": "input",
                "id": "link_title",
                "for": "link_title",
                "label": "Link Title *",
                "type": "text",
                "name": "link_title",
                "class": "form-control",
                "tip": "Enter a title for this link",
                "required": "required"
            },
            {
                "tag": "input",
                "id": "link_url",
                "for": "link_url",
                "label": "Link Address *",
                "type": "text",
                "name": "link_url",
                "class": "form-control",
                "tip": "Enter the website address",
                "required": "required"
            }
            ]'
        ]);

        DB::table($this->TableName)->updateOrInsert([
            'typename' => 'heading',
            'title' => 'Heading',
            'icon' => 'bi bi-card-heading',
            'description' => 'Use headings to organize your links and separate them into groups.',
            'params' => '[{
                "tag": "input",
                "id": "heading-text",
                "for": "link_title",
                "label": "Heading Text",
                "type": "text",
                "name": "link_title",
                "class": "form-control"
            }]'
        ]);

        DB::table($this->TableName)->updateOrInsert([
            'typename' => 'spacer',
            'title' => 'Spacer',
            'icon' => 'bi bi-distribute-vertical',
            'description' => 'Add blank space to your list of links. You can choose how tall.',
            'params' => '[
    {
        "tag": "input",
        "type": "number",
        "min": "1","max":"10",
        "name": "spacer_size",
        "id": "spacer_size",
        "value": 3
    }
]'
        ]);

//         DB::table($this->TableName)->updateOrInsert([
//             'typename' => 'video',
//             'title' => 'Video',
//             'icon' => 'bi bi-play-btn',
//             'description' => 'Embed or link to a video on another website, such as TikTok, YouTube etc.',
//             'params' => '[
//                 {
//                 "tag": "input",
//                 "id": "link_url",
//                 "for": "link_url",
//                 "label": "URL of video",
//                 "type": "text",
//                 "name": "link_url",
//                 "class": "form-control",
//                 "tip": "Enter the website address",
//                 "required": "required"
//             }
//     {
//         "tag": "select",
//         "name": "video-option",
//         "id": "video-option",

//         "value": [
//             {
//                 "tag": "option",
//                 "label": "Link to video ",
//                 "value": "link"
//             },
//             {
//                 "tag": "option",
//                 "label": "Embed Video",
//                 "value": "embed"
//             },

//         ]
//     }
// ]'
//         ]);

        DB::table($this->TableName)->updateOrInsert([
            'typename' => 'text',
            'title' => 'Text',
            'icon' => 'bi bi-fonts',
            'description' => 'Add static text to your page that is not clickable.',
            'params' => '[{
                "tag": "textarea",
                "id": "static-text",
                "for": "static_text",
                "label": "Text",
                "name": "static_text",
                "class": "form-control"
            }
            ]'

        ]);

        DB::table($this->TableName)->updateOrInsert([
            'typename' => 'email',
            'title' => 'E-Mail address',
            'icon' => 'bi bi-envelope-fill',
            'description' => 'Add an email that opens a system dialog to compose a new email.'
        ]);

        DB::table($this->TableName)->updateOrInsert([
            'typename' => 'telephone',
            'title' => 'Telephone number',
            'icon' => 'bi bi-telephone-fill',
            'description' => 'Add a telephone number that opens a system dialog to initiate a phone call.'
        ]);

        DB::table($this->TableName)->updateOrInsert([
            'typename' => 'vcard',
            'title' => 'Vcard',
            'icon' => 'bi bi-person-square',
            'description' => 'Create or upload an electronic business card.'
        ]);

    }

}

        <?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

         //run before finishing:
            if(EnvEditor::keyExists('JOIN_BETA')){ /* Do nothing if key already exists */ 
            } else { EnvEditor::addKey('JOIN_BETA', 'false');} // Adds key to .env file 

            if(EnvEditor::keyExists('SKIP_UPDATE_BACKUP')){ /* Do nothing if key already exists */ 
            } else { EnvEditor::addKey('SKIP_UPDATE_BACKUP', 'false');} // Adds key to .env file 

            if(EnvEditor::keyExists('CUSTOM_META_TAGS')){ /* Do nothing if key already exists */ 
            } else {EnvEditor::addKey('CUSTOM_META_TAGS', 'false');}

            if(EnvEditor::keyExists('MAINTENANCE_MODE')){ /* Do nothing if key already exists */ 
            } else {EnvEditor::addKey('MAINTENANCE_MODE', 'false');}

            if(EnvEditor::keyExists('ALLOW_CUSTOM_CODE_IN_THEMES')){ /* Do nothing if key already exists */ 
            } else {EnvEditor::addKey('ALLOW_CUSTOM_CODE_IN_THEMES', 'true');}

            if(EnvEditor::keyExists('ENABLE_THEME_UPDATER')){ /* Do nothing if key already exists */ 
            } else {EnvEditor::addKey('ENABLE_THEME_UPDATER', 'true');}

            if(EnvEditor::keyExists('ENABLE_SOCIAL_LOGIN')){ /* Do nothing if key already exists */ 
            } else {EnvEditor::addKey('ENABLE_SOCIAL_LOGIN', 'false');}

            if(EnvEditor::keyExists('USE_THEME_PREVIEW_IFRAME')){ /* Do nothing if key already exists */ 
            } else {EnvEditor::addKey('USE_THEME_PREVIEW_IFRAME', 'true');}

            if(EnvEditor::keyExists('FORCE_ROUTE_HTTPS')){ /* Do nothing if key already exists */ 
            } else {EnvEditor::addKey('FORCE_ROUTE_HTTPS', 'false');}


            // Footer page customization
            if(EnvEditor::keyExists('DISPLAY_FOOTER_HOME')){} else {EnvEditor::addKey('DISPLAY_FOOTER_HOME', 'true');}
            if(EnvEditor::keyExists('DISPLAY_FOOTER_TERMS')){} else {EnvEditor::addKey('DISPLAY_FOOTER_TERMS', 'true');}
            if(EnvEditor::keyExists('DISPLAY_FOOTER_PRIVACY')){} else {EnvEditor::addKey('DISPLAY_FOOTER_PRIVACY', 'true');}
            if(EnvEditor::keyExists('DISPLAY_FOOTER_CONTACT')){} else {EnvEditor::addKey('DISPLAY_FOOTER_CONTACT', 'true');}
            if(EnvEditor::keyExists('TITLE_FOOTER_HOME')){} else {EnvEditor::addKey('TITLE_FOOTER_HOME', 'Home');}
            if(EnvEditor::keyExists('TITLE_FOOTER_TERMS')){} else {EnvEditor::addKey('TITLE_FOOTER_TERMS', 'Terms');}
            if(EnvEditor::keyExists('TITLE_FOOTER_PRIVACY')){} else {EnvEditor::addKey('TITLE_FOOTER_PRIVACY', 'Privacy');}
            if(EnvEditor::keyExists('TITLE_FOOTER_CONTACT')){} else {EnvEditor::addKey('TITLE_FOOTER_CONTACT', 'Contact');}
            if(EnvEditor::keyExists('HOME_FOOTER_LINK')){} else {EnvEditor::addKey('HOME_FOOTER_LINK', '');}


            if (!config()->has('advanced-config.expand_panel_admin_menu_permanently') and !config()->has('disable_default_password_notice')) {
            
            function getStringBetween($string, $start, $end) {
                $lastStartIndex = strrpos($string, $start);
                $lastEndIndex = strrpos($string, $end);
            
                $substringStartIndex = $lastStartIndex + strlen($start);
                $substringSize = $lastStartIndex - $lastEndIndex - 1;
            
                return substr($string, $substringStartIndex, $substringSize);
            }
            
            $subject = file_get_contents('config/advanced-config.php');
            $search = ")";
            $replace = "),";
            
            file_put_contents('config/advanced-config.php', str_replace('),,', '),', strrev(implode(strrev($replace), explode(strrev($search), strrev($subject), 2)))));
            
            $replace = "];";
                file_put_contents('config/advanced-config.php', str_replace($replace, file_get_contents('storage/templates/advanced-config-update-1.php'), file_get_contents('config/advanced-config.php')));
            }

            if(EnvEditor::keyExists('FORCE_HTTPS')){ /* Do nothing if key already exists */ 
            } else {EnvEditor::addKey('FORCE_HTTPS', 'false');}

            use App\Models\Page;
            $data['page'] = Page::select('contact')->first();
            if (strpos($data['page']->contact, 'info@littlelink-custom.com') !== false) {
            $contact = '
            <p><strong><a href="https://littlelink-custom.com/">LittleLink Custom</a></strong> is a free, open source&nbsp;link&nbsp;sharing platform. We depend on community feedback to steadily improve this project.</p>
            
            <p><strong>Feel free to send us your feedback!</strong></p>
            
            <ul>
            	<li>Join our <a href="https://discord.littlelink-custom.com/">community Discord</a></li>
            	<li>Join the <a href="https://github.com/JulianPrieber/littlelink-custom/discussions">discussion forum</a></li>
            	<li>Request a feature and add it to the <a href="https://github.com/JulianPrieber/littlelink-custom/discussions/49">to-do list</a></li>
            	<li>Write us an <a href="mailto:info@littlelink-custom.com?subject=Inquiry%20about%20LittleLink%20Custom">email</a></li>
            </ul>
            
            <p>If you&#39;re having any trouble or encountered a bug, feel free to <a href="https://github.com/JulianPrieber/littlelink-custom/issues">open an issue on GitHub</a>.</p>
            
            <p>&nbsp;</p>
            ';
            Page::first()->update(['contact' => $contact]);
            }

            /* Updates button database entries */ 
            Schema::disableForeignKeyConstraints();
            try {Artisan::call('migrate');} catch (exception $e) {}
            try {DB::table('buttons')->delete();} catch (exception $e) {}
            try {DB::table('buttons')->truncate();} catch (exception $e) {}
            try {Artisan::call('db:seed --class="ButtonSeeder" --force');} catch (exception $e) {}
            Schema::enableForeignKeyConstraints();

    try {
        DB::table('link_types')->updateOrInsert([
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
    } catch (exception $e) {}

        echo "<meta http-equiv=\"refresh\" content=\"0; " . url()->current() . "?success\" />"; 
        ?>
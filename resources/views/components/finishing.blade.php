        <?php 

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
            } else {EnvEditor::addKey('USE_THEME_PREVIEW_IFRAME', 'false');}

            if(trim(file_get_contents(base_path("version.json"))) >= '2.9.1' and trim(file_get_contents(base_path("version.json"))) <= '3.0.0'){
                Schema::disableForeignKeyConstraints();
                Artisan::call('migrate');
                Schema::enableForeignKeyConstraints();
            }

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
            DB::table('buttons')->delete();
            DB::table('buttons')->truncate();
            try {Artisan::call('db:seed --class="ButtonSeeder" --force');} catch (exception $e) {}
            Schema::enableForeignKeyConstraints();

        echo "<meta http-equiv=\"refresh\" content=\"0; " . url()->current() . "?success\" />"; 
        ?>
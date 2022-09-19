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

            /* Updates button database entries */ 
            Schema::disableForeignKeyConstraints();
            DB::table('buttons')->delete();
            DB::table('buttons')->truncate();
            try {Artisan::call('db:seed --class="ButtonSeeder" --force');} catch (exception $e) {}
            Schema::enableForeignKeyConstraints();

        echo "<meta http-equiv=\"refresh\" content=\"0; " . url()->current() . "?success\" />"; 
        ?>
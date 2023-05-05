<?php
// Runs before updating

if(trim(file_get_contents(base_path("version.json"))) < '4.0.0')file_put_contents(base_path('config/advanced-config.php'), file_get_contents(base_path('storage/templates/advanced-config.php')));
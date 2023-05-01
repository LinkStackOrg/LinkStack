<?php
// Runs before updating

if(file_get_contents(base_path("version.json")) < '4.0.0')copy(base_path('storage/templates/advanced-config.php'), base_path('config/advanced-config.php')); 
<?php // Runs before updating
if(trim(file_get_contents(base_path("version.json"))) < '4.0.0'){
  try {
    $file = base_path('storage/RSTAC');
    if (!file_exists($file)) {
        $handleFile = fopen($file, 'w');
        fclose($handleFile);
    }
} catch (Exception $e) {}
}
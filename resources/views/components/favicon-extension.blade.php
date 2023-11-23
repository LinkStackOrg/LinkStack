<?php

if (!function_exists('localIcon')) {
    function localIcon($id)
    {
        $directory = base_path("assets/favicon/icons");
        $files = scandir($directory);
        $pathinfo = "error.error";
        foreach ($files as $file) {
            if (strpos($file, $id . '.') !== false) {
                $pathinfo = $id . "." . pathinfo($file, PATHINFO_EXTENSION);
            }
        }
        return $pathinfo;
    }
}
  
?>

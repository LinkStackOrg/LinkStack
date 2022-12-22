<?php

function findFile($name){
    $directory = base_path('/littlelink/images/');
    $files = scandir($directory);
    $pathinfo = "error.error";
    foreach($files as $file) {
    if (strpos($file, $name.'.') !== false) {
    $pathinfo = $name. "." . pathinfo($file, PATHINFO_EXTENSION);
    }}
    return $pathinfo;
}
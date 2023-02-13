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

function findBackground($name){
    $directory = base_path('/img/background-img/');
    $files = scandir($directory);
    $pathinfo = "error.error";
    foreach($files as $file) {
    if (strpos($file, $name.'.') !== false) {
    $pathinfo = $name. "." . pathinfo($file, PATHINFO_EXTENSION);
    }}
    return $pathinfo;
}

function analyzeImageBrightness($file) {

    $file = base_path('/img/background-img/'.$file);
  
    // Get image information using getimagesize
    $imageInfo = getimagesize($file);
    if (!$imageInfo) {
      echo "Error: Unable to get image information.\n";
      exit();
    }
  
    // Get the image type
    $type = $imageInfo[2];
  
    // Load the image based on its type
    switch ($type) {
      case IMAGETYPE_JPEG:
      case IMAGETYPE_JPEG2000:
        $img = imagecreatefromjpeg($file);
        break;
      case IMAGETYPE_PNG:
        $img = imagecreatefrompng($file);
        break;
      default:
        echo "Error: Unsupported image type.\n";
        exit();
    }
  
    // Get image dimensions
    $width = imagesx($img);
    $height = imagesy($img);
  
    // Calculate the average brightness of the image
    $total_brightness = 0;
    for ($x=0; $x<$width; $x++) {
      for ($y=0; $y<$height; $y++) {
        $rgb = imagecolorat($img, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        $brightness = (int)(($r + $g + $b) / 3);
        $total_brightness += $brightness;
      }
    }
    $avg_brightness = $total_brightness / ($width * $height);
  
    // Determine if the image is more dark or light
    if ($avg_brightness < 128) {
      return 'dark';
    } else {
      return 'light';
    }
  }
  

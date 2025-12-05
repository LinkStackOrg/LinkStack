<?php

function findFile($name)
{
    $directory = base_path("/assets/linkstack/images/");
    $files = scandir($directory);
    $pathinfo = "error.error";
    $pattern = '/^' . preg_quote($name, '/') . '(_\w+)?\.\w+$/i';
    foreach ($files as $file) {
        if (preg_match($pattern, $file)) {
            $pathinfo = $file;
            break;
        }
    }
    return $pathinfo;
}

function findAvatar($name)
{
    $directory = base_path("assets/img");
    $files = scandir($directory);
    $pathinfo = "error.error";
    $pattern = '/^' . preg_quote($name, '/') . '(_\w+)?\.\w+$/i';
    foreach ($files as $file) {
        if (preg_match($pattern, $file)) {
            $pathinfo = "assets/img/" . $file;
            break;
        }
    }
    return $pathinfo;
}

function findBackground($name)
{
    $directory = base_path("assets/img/background-img/");
    $files = scandir($directory);
    $pathinfo = "error.error";
    $pattern = '/^' . preg_quote($name, '/') . '(_\w+)?\.\w+$/i';
    foreach ($files as $file) {
        if (preg_match($pattern, $file)) {
            $pathinfo = $file;
            break;
        }
    }
    return $pathinfo;
}

function analyzeImageBrightness($file) {
    try {
    $file = base_path('assets/img/background-img/'.$file);
  
    // Get image information using getimagesize
    $imageInfo = getimagesize($file);
    if (!$imageInfo) {
      return 'dark';
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
        return 'dark';
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
      } catch (\Throwable $th) {
          return null;
      }
  }
  
  function infoIcon($tip) {
    echo '
      <div class="d-flex justify-content-center align-items-center">
        <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="' . $tip . '">
          <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.67 1.99927H16.34C19.73 1.99927 22 4.37927 22 7.91927V16.0903C22 19.6203 19.73 21.9993 16.34 21.9993H7.67C4.28 21.9993 2 19.6203 2 16.0903V7.91927C2 4.37927 4.28 1.99927 7.67 1.99927ZM11.99 9.06027C11.52 9.06027 11.13 8.66927 11.13 8.19027C11.13 7.70027 11.52 7.31027 12.01 7.31027C12.49 7.31027 12.88 7.70027 12.88 8.19027C12.88 8.66927 12.49 9.06027 11.99 9.06027ZM12.87 15.7803C12.87 16.2603 12.48 16.6503 11.99 16.6503C11.51 16.6503 11.12 16.2603 11.12 15.7803V11.3603C11.12 10.8793 11.51 10.4803 11.99 10.4803C12.48 10.4803 12.87 10.8793 12.87 11.3603V15.7803Z" fill="currentColor"></path>
          </svg>
        </a>
      </div>
    ';
  }

function external_file_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:80.0) Gecko/20100101 Firefox/80.0');
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function app_uri($path) {
    $url = str_replace(['http://', 'https://'], '', url(''));
    return "//" . $url . "/" . $path;
}

function footer($key)
{
    $upperStr = strtoupper($key);
    if (env('TITLE_FOOTER_'.$upperStr) == "") {
        $title = __('messages.footer.'.$key);
    } else {
        $title = env('TITLE_FOOTER_'.$upperStr);
    }
    return $title;
}

function strip_tags_except_allowed_protocols($str) {
    preg_match_all('/<a[^>]+>(.*?)<\/a>/i', $str, $matches, PREG_SET_ORDER);

    foreach ($matches as $val) {
        if (!preg_match('/href=["\'](http:|https:|mailto:|tel:)[^"\']*["\']/', $val[0])) {
            $str = str_replace($val[0], $val[1], $str);
        }
    }

    return $str;
}

if(!function_exists('setBlockAssetContext')) {
  function setBlockAssetContext($type = null) {
      static $currentType = null;
      if ($type !== null) {
          $currentType = $type;
      }
      return $currentType;
  }
}

// Get custom block assets
if(!function_exists('block_asset')) {
  function block_asset($file) {
      $type = setBlockAssetContext(); // Retrieve the current type context
      return url("block-asset/$type?asset=$file");
  }
}

if(!function_exists('get_block_file_contents')) {
  function get_block_file_contents($file) {
      $type = setBlockAssetContext(); // Retrieve the current type context
      return file_get_contents(base_path("blocks/$type/$file"));
  }
}

function block_text_translation_check($text) {
  if (empty($text)) {
    return false;
  }
  $translate = __("messages.$text");
  return $translate === "messages.$text" ? true : false;
}

function block_text($text) {
  $translate = __("messages.$text");
  return $translate === "messages.$text" ? $text : $translate;
}

function bt($text) {
  return block_text($text);
}
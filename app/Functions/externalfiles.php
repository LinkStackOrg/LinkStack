<?php

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

function uri($path) {
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
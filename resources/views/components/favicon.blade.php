<?php use App\Models\Link; ?>

<?php
function getFavIcon($id) {
    $link = Link::find($id);
    $url = $link->link;

    $html = false;
    $context = stream_context_create();

    // Set timeout to 3 seconds
    stream_context_set_option($context, 'http', 'timeout', 3);

    // Set custom User-Agent header
    $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36';
    stream_context_set_option($context, 'http', 'header', "User-Agent: $userAgent\r\n");

    // Attempt to fetch HTML content with timeout
    if (function_exists('curl_version')) {
        $curlHandle = curl_init($url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 3);
        curl_setopt($curlHandle, CURLOPT_USERAGENT, $userAgent);
        $html = curl_exec($curlHandle);
        curl_close($curlHandle);
    } else {
        $html = @file_get_contents($url, false, $context);
    }

    
$dom = new DOMDocument();
if ($html !== false) {
    try {
        @$dom->loadHTML($html);
    } catch (Throwable $e) {}
}


    $xpath = new DOMXPath($dom);

    $faviconUrl = '';

    // Search for <link> tags with rel="icon" or rel="shortcut icon"
    $linkTags = $xpath->query("//link[contains(@rel, 'icon') or contains(@rel, 'shortcut icon')]");
    foreach ($linkTags as $tag) {
        $faviconUrl = $tag->getAttribute('href');
        if (strpos($faviconUrl, 'http') !== 0) {
            $faviconUrl = $url . '/' . ltrim($faviconUrl, '/');
        }
        break; // Stop after the first matching <link> tag
    }

    $fallbackFavicon = 'assets/linkstack/icons/website.svg';

    if (empty($faviconUrl)) {
        $faviconUrl = $fallbackFavicon;
    }

    $extension = pathinfo($faviconUrl, PATHINFO_EXTENSION);
    $filename = $id . "." . $extension;
    $filepath = base_path("assets/favicon/icons") . "/" . $filename;

    if (!file_exists($filepath)) {
        if ($faviconUrl !== $fallbackFavicon) {
            if (function_exists('curl_version')) {
                $curlHandle = curl_init($faviconUrl);
                curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curlHandle, CURLOPT_TIMEOUT, 3);
                curl_setopt($curlHandle, CURLOPT_USERAGENT, $userAgent);
                $faviconData = curl_exec($curlHandle);
                curl_close($curlHandle);

                if ($faviconData !== false) {
                    file_put_contents($filepath, $faviconData);
                }
            } else {
                file_put_contents($filepath, file_get_contents($faviconUrl, false, $context));
            }
        } else {
            copy($fallbackFavicon, $filepath);
        }
    }

    return $filename;
}
?>


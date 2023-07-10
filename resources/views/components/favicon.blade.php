<?php
use App\Models\Link;

function getFaviconURL($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36');
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    $response = curl_exec($ch);

    // Check if cURL request was successful
    if ($response === false) {
        return null;
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Check if the URL is redirected
    if ($httpCode == 301 || $httpCode == 302) {
        $redirectUrl = getRedirectUrlFromHeaders($response);
        if ($redirectUrl) {
            return getFaviconURL($redirectUrl); // Recursively call getFavicon with the redirected URL
        }
    }

    // Try extracting favicon using DOMDocument
    try {
        $dom = new DOMDocument();
        $dom->strictErrorChecking = false;
        @$dom->loadHTMLFile($url);
        if ($dom) {
            $domxml = simplexml_import_dom($dom);
            // Check for the historical rel="shortcut icon"
            if ($domxml->xpath('//link[@rel="shortcut icon"]')) {
                $path = $domxml->xpath('//link[@rel="shortcut icon"]');
                $faviconURL = getAbsoluteUrl($url, $path[0]['href']);
                return $faviconURL;
            }
            // Check for the HTML5 rel="icon"
            elseif ($domxml->xpath('//link[@rel="icon"]')) {
                $path = $domxml->xpath('//link[@rel="icon"]');
                $faviconURL = getAbsoluteUrl($url, $path[0]['href']);
                return $faviconURL;
            }
        }
    } catch (Exception $e) {
        // Silently fail and continue to the next method
    }

    // Check directly for favicon.ico or favicon.png
    $parse = parse_url($url);
    $favicon_headers = @get_headers("http://" . $parse['host'] . "/favicon.ico");
    if ($favicon_headers && $favicon_headers[0] != 'HTTP/1.1 404 Not Found') {
        $faviconURL = "http://" . $parse['host'] . "/favicon.ico";
        return $faviconURL;
    }

    $favicon_headers = @get_headers("http://" . $parse['host'] . "/favicon.png");
    if ($favicon_headers && $favicon_headers[0] != 'HTTP/1.1 404 Not Found') {
        $faviconURL = "http://" . $parse['host'] . "/favicon.png";
        return $faviconURL;
    }

    // Fallback to regex extraction
    $faviconURL = extractFaviconUrlWithRegex($response);
    if ($faviconURL) {
        $faviconURL = getAbsoluteUrl($url, $faviconURL);
    }
    return $faviconURL;
}

function getRedirectUrlFromHeaders($headers)
{
    if (preg_match('/^Location:\s+(.*)$/mi', $headers, $matches)) {
        return trim($matches[1]);
    }
    return null;
}

function extractFaviconUrlWithRegex($html)
{
    // Check for the historical rel="shortcut icon"
    if (preg_match('/<link[^>]+rel=["\']shortcut icon["\'][^>]+href=["\']([^"\']+)["\']/', $html, $matches)) {
        $faviconURL = $matches[1];
        return $faviconURL;
    }

    // Check for the HTML5 rel="icon"
    if (preg_match('/<link[^>]+rel=["\']icon["\'][^>]+href=["\']([^"\']+)["\']/', $html, $matches)) {
        $faviconURL = $matches[1];
        return $faviconURL;
    }

    return null;
}

function getAbsoluteUrl($baseUrl, $relativeUrl)
{
    $parsedUrl = parse_url($baseUrl);
    $scheme = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] : 'http';
    $host = isset($parsedUrl['host']) ? $parsedUrl['host'] : '';
    $path = isset($parsedUrl['path']) ? $parsedUrl['path'] : '';
    $basePath = "$scheme://$host$path";

    if (strpos($relativeUrl, 'http') === 0) {
        return $relativeUrl; // Already an absolute URL
    } elseif (strpos($relativeUrl, '/') === 0) {
        return "$scheme://$host$relativeUrl"; // Root-relative URL
    } else {
        return "$basePath/$relativeUrl"; // Path-relative URL
    }
}

function getFavIcon($id)
{
    try{

    $link = Link::find($id);
    $page = $link->link;

    $url = getFaviconURL($page);

    $fileExtension = pathinfo($url, PATHINFO_EXTENSION);
    $filename = $id . '.' . $fileExtension;
    $filepath = base_path('assets/favicon/icons') . '/' . $filename;

    if (!file_exists($filepath)) {
        if (function_exists('curl_version')) {
            $curlHandle = curl_init($url);
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlHandle, CURLOPT_TIMEOUT, 3);
            $faviconData = curl_exec($curlHandle);
            curl_close($curlHandle);

            if ($faviconData !== false) {
                file_put_contents($filepath, $faviconData);
            }
        } else {
            file_put_contents($filepath, file_get_contents($url));
        }
    }

    return url('assets/favicon/icons/' . $id . '.' . $fileExtension);
    
    }catch(Exception $e){
        // Handle the exception by copying the default SVG favicon
        $defaultIcon = base_path('assets/linkstack/icons/website.svg');
        $filename = $id . '.svg';
        $filepath = base_path('assets/favicon/icons') . '/' . $filename;
        copy($defaultIcon, $filepath);

        return url('assets/favicon/icons/' . $filename);
    }
}
?>

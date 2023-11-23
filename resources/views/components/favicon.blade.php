<?php
use App\Models\Link;

if (!function_exists('getFaviconURL')) {
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
                $faviconURL = extractFaviconUrlFromDOM($dom);
                if ($faviconURL) {
                    return getAbsoluteUrl($url, $faviconURL);
                }
            }
        } catch (Exception $e) {
            // Silently fail and continue to the next method
        }

        // Check directly for favicon.ico or favicon.png
        $parse = parse_url($url);
        $faviconURL = getAbsoluteUrl($url, "/favicon.ico");
        if (checkURLExists($faviconURL)) {
            return $faviconURL;
        }

        $faviconURL = getAbsoluteUrl($url, "/favicon.png");
        if (checkURLExists($faviconURL)) {
            return $faviconURL;
        }

        // Fallback to regex extraction
        $faviconURL = extractFaviconUrlWithRegex($response);
        if ($faviconURL) {
            $faviconURL = getAbsoluteUrl($url, $faviconURL);
        }
        return $faviconURL;
    }
}

if (!function_exists('getRedirectUrlFromHeaders')) {
    function getRedirectUrlFromHeaders($headers)
    {
        if (preg_match('/^Location:\s+(.*)$/mi', $headers, $matches)) {
            return trim($matches[1]);
        }
        return null;
    }
}

if (!function_exists('extractFaviconUrlFromDOM')) {
    function extractFaviconUrlFromDOM($dom)
    {
        $xpath = new DOMXPath($dom);

        // Check for the historical rel="shortcut icon"
        $shortcutIcon = $xpath->query('//link[@rel="shortcut icon"]');
        if ($shortcutIcon->length > 0) {
            $path = $shortcutIcon->item(0)->getAttribute('href');
            return $path;
        }

        // Check for the HTML5 rel="icon"
        $icon = $xpath->query('//link[@rel="icon"]');
        if ($icon->length > 0) {
            $path = $icon->item(0)->getAttribute('href');
            return $path;
        }

        return null;
    }
}

if (!function_exists('checkURLExists')) {
    function checkURLExists($url)
    {
        $headers = @get_headers($url);
        return ($headers && strpos($headers[0], '200') !== false);
    }
}

if (!function_exists('extractFaviconUrlWithRegex')) {
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
}

if (!function_exists('getAbsoluteUrl')) {
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
}

if (!function_exists('getFavIcon')) {
    function getFavIcon($id)
    {
        try {
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
        } catch (Exception $e) {
            // Handle the exception by copying the default SVG favicon
            $defaultIcon = base_path('assets/linkstack/icons/website.svg');
            $filename = $id . '.svg';
            $filepath = base_path('assets/favicon/icons') . '/' . $filename;
            copy($defaultIcon, $filepath);

            return url('assets/favicon/icons/' . $filename);
        }
    }
}

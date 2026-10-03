<?php

if (!function_exists('validation_image_extensions')) {
    function validation_image_extensions(): array
    {
        return array_values(array_filter((array) config('validation.image_extensions', ['jpeg', 'jpg', 'png', 'webp', 'gif', 'svg'])));
    }
}

if (!function_exists('validation_image_accept')) {
    function validation_image_accept(): string
    {
        return implode(',', array_map(static fn ($extension) => '.' . $extension, validation_image_extensions()));
    }
}

if (!function_exists('validation_image_label')) {
    function validation_image_label(): string
    {
        return implode(', ', array_map(static fn ($extension) => strtoupper($extension), validation_image_extensions()));
    }
}

if (!function_exists('validation_rich_text_allowed_tags')) {
    function validation_rich_text_allowed_tags(): array
    {
        return array_values(array_filter((array) config('validation.rich_text.allowed_tags', ['a', 'p', 'strong', 'i', 'ul', 'ol', 'li', 'blockquote', 'h2', 'h3', 'h4', 'br'])));
    }
}

if (!function_exists('validation_rich_text_allowed_protocols')) {
    function validation_rich_text_allowed_protocols(): array
    {
        return array_values(array_filter((array) config('validation.rich_text.allowed_protocols', ['http', 'https', 'mailto', 'tel'])));
    }
}

if (!function_exists('sanitize_rich_text')) {
    function sanitize_rich_text($html): string
    {
        $html = (string) $html;

        if ($html === '') {
            return '';
        }

        $allowedTags = validation_rich_text_allowed_tags();
        $allowedProtocols = validation_rich_text_allowed_protocols();

        if (!class_exists('DOMDocument')) {
            return strip_tags($html, '<' . implode('><', $allowedTags) . '>');
        }

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $previousUseErrors = libxml_use_internal_errors(true);
        $wrapperId = 'linkstack-rich-text-root';
        $dom->loadHTML('<?xml encoding="UTF-8"><div id="' . $wrapperId . '">' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        libxml_use_internal_errors($previousUseErrors);

        $wrapper = $dom->getElementById($wrapperId);
        if (!$wrapper) {
            return strip_tags($html, '<' . implode('><', $allowedTags) . '>');
        }

        return sanitize_rich_text_node($wrapper, $allowedTags, $allowedProtocols);
    }
}

if (!function_exists('sanitize_rich_text_node')) {
    function sanitize_rich_text_node(\DOMNode $node, array $allowedTags, array $allowedProtocols): string
    {
        $output = '';

        foreach ($node->childNodes as $childNode) {
            if ($childNode->nodeType === XML_TEXT_NODE) {
                $output .= htmlspecialchars($childNode->nodeValue ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                continue;
            }

            if ($childNode->nodeType !== XML_ELEMENT_NODE) {
                continue;
            }

            $tagName = strtolower($childNode->nodeName);
            if (!in_array($tagName, $allowedTags, true)) {
                if (in_array($tagName, ['script', 'style'], true)) {
                    continue;
                }

                $output .= sanitize_rich_text_node($childNode, $allowedTags, $allowedProtocols);
                continue;
            }

            if ($tagName === 'br') {
                $output .= '<br>';
                continue;
            }

            $attributes = '';

            if ($tagName === 'a') {
                $href = trim((string) $childNode->attributes?->getNamedItem('href')?->nodeValue);
                $isAllowedLink = false;

                if ($href !== '') {
                    $scheme = strtolower((string) parse_url($href, PHP_URL_SCHEME));
                    if (in_array($scheme, $allowedProtocols, true)) {
                        $isAllowedLink = true;
                        $attributes .= ' href="' . htmlspecialchars($href, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '"';
                    }
                }

                if (!$isAllowedLink) {
                    $output .= sanitize_rich_text_node($childNode, $allowedTags, $allowedProtocols);
                    continue;
                }

                $attributes .= ' rel="noopener noreferrer nofollow"';
            }

            $output .= '<' . $tagName . $attributes . '>';
            $output .= sanitize_rich_text_node($childNode, $allowedTags, $allowedProtocols);
            $output .= '</' . $tagName . '>';
        }

        return $output;
    }
}

if (!function_exists('strip_tags_except_allowed_protocols')) {
    function strip_tags_except_allowed_protocols($str)
    {
        return sanitize_rich_text($str);
    }
}
<?php
$colorMode = null;

$script = 

<<<HTML
<script>
        // Function to get the value of a cookie by name
        function getCookie(name) {
            const cookies = document.cookie.split('; ');
            for (const cookie of cookies) {
                const [key, value] = cookie.split('=');
                if (key === name) {
                    return value;
                }
            }
            return null;
        }

        // Function to set a cookie
        function setCookie(name, value, days) {
            let expires = '';
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
                // Corrected this line to properly handle JavaScript template literals
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function setColorMode() {
            // Retrieve the value of the 'color-mode' cookie
            var colorMode = getCookie('color-mode');

            // Check if the value is valid and set it to 'auto' if not
            if (!colorMode || (colorMode !== 'light' && colorMode !== 'dark')) {
                colorMode = 'auto';
                setCookie('color-mode', colorMode, 365); // Set the cookie to expire in 1 year
            }

            if (colorMode === 'auto') {
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    setCookie('prefers-color-mode', 'dark', 365);
                    if (!document.body.classList.contains('dark')) {
                        document.body.classList.add('dark');
                    }
                } else {
                    setCookie('prefers-color-mode', 'light', 365);
                }
            }

            if (colorMode === 'dark') {
                if (!document.body.classList.contains('dark')) {
                    document.body.classList.add('dark');
                }
            }
        };
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof Livewire === 'undefined') {
                setColorMode();
            }
        });
        document.addEventListener('livewire:navigated', () => {
            setColorMode();
        });
</script>
HTML;

echo $script;

if (isset($_COOKIE['color-mode'])) {
    $colorMode = $_COOKIE['color-mode'];
}
if ($colorMode === 'auto' && isset($_COOKIE['prefers-color-mode'])) {
    $colorMode = $_COOKIE['prefers-color-mode'];
}

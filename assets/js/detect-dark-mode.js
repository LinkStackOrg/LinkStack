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
    expires = `; expires=${date.toUTCString()}`;
  }
  document.cookie = `${name}=${value || ''}${expires}; path=/`;
}

// Retrieve the value of the 'color-mode' cookie
var colorMode = getCookie('color-mode');

// Check if the value is valid and set it to 'auto' if not
if (!colorMode || (colorMode !== 'light' && colorMode !== 'dark')) {
  colorMode = 'auto';
  setCookie('color-mode', colorMode, 365); // Set the cookie to expire in 1 year
}

// If color mode is 'auto', detect the user's color scheme
if (colorMode === 'auto') {
  const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)').matches;
  if (prefersDarkScheme) {
    document.body.classList.add('dark');
  }
} else if (colorMode === 'dark') {
  if (!document.body.classList.contains('dark')) {
    document.body.classList.add('dark');
  }
}

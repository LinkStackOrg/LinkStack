// Retrieve the value of the 'color-mode' key from local storage
var colorMode = localStorage.getItem('color-mode');

// Check if the value is valid and set it to 'auto' if not
if (!colorMode || (colorMode !== 'light' && colorMode !== 'dark')) {
  colorMode = 'auto';
  localStorage.setItem('color-mode', colorMode);
}

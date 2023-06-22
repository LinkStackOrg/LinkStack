{{-- 


|--------------------------------------------------------------------------
| Custom assets
|--------------------------------------------------------------------------

Custom assets are stored in the 'custom-assets' directory found inside the 'extra' folder.
Custom assets can be any file you would like to use in your theme.
For example: JS, CSS or image files.

You can load these custom assets with a built-in function, 'themeAsset()'.
Add the file you want to add to your 'custom-assets' folder, and include the name with the file extension in the function.

Down below, you can find a few examples using this function:



--}}

<style> 
/* latin */
@font-face { font-family: 'Karla'; font-style: normal; font-weight: 400;
  font-stretch: 100%; font-display: swap; src: url('{{themeAsset('karla-latin-400-normal.woff2')}}'), url('{{themeAsset('karla-latin-400-normal.woff')}}'); 
  unicode-range: U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;
}

/* latin-ext */
@font-face { font-family: 'Karla'; font-style: normal; font-weight: 400;
  font-stretch: 100%; font-display: swap; src: url('{{themeAsset('karla-latin-ext-400-normal.woff2')}}'), url('{{themeAsset('karla-latin-ext-400-normal.woff')}}'); 
  unicode-range: U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;
}

/* latin */
@font-face { font-family: 'Karla'; font-style: normal; font-weight: 700;
  font-stretch: 100%; font-display: swap; src: url('{{themeAsset('karla-latin-700-normal.woff2')}}'), url('{{themeAsset('karla-latin-700-normal.woff')}}'); 
  unicode-range: U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;
}

/* latin-ext */
@font-face { font-family: 'Karla'; font-style: normal; font-weight: 700;
  font-stretch: 100%; font-display: swap; src: url('{{themeAsset('karla-latin-ext-700-normal.woff2')}}'), url('{{themeAsset('karla-latin-ext-700-normal.woff')}}'); 
  unicode-range: U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;
}

html {
    font-size: 100%; }

  :root {
    --bgColor: #223344;
    --bgColor2: #090a0f;
    --accentColor: #FFF;
    --font: 'Karla', sans-serif;
    --delay: .3s; }

</style>
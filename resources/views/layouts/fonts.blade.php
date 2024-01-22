<style>
  /* cyrillic */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-cyrillic-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-cyrillic-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
  }
  
  /* cyrillic-ext */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-cyrillic-ext-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-cyrillic-ext-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
  }
  
  /* greek */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-greek-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-greek-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0370-03FF;
  }
  
  /* greek-ext */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-greek-ext-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-greek-ext-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+1F00-1FFF;
  }
  
  /* hebrew */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-hebrew-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-hebrew-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0590-05FF, U+200C-2010, U+20AA, U+25CC, U+FB1D-FB4F;
  }
  
  /* latin */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-latin-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-latin-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  }
  
  /* latin-ext */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-latin-ext-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-latin-ext-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
  }
  
  /* vietnamese */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-vietnamese-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-vietnamese-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
  }
  
  /* cyrillic */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-cyrillic-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-cyrillic-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
  }
  
  /* cyrillic-ext */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-cyrillic-ext-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-cyrillic-ext-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
  }
  
  /* greek */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-greek-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-greek-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0370-03FF;
  }
  
  /* greek-ext */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-greek-ext-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-greek-ext-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+1F00-1FFF;
  }
  
  /* hebrew */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-hebrew-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-hebrew-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0590-05FF, U+200C-2010, U+20AA, U+25CC, U+FB1D-FB4F;
  }
  
  /* latin */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-latin-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-latin-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  }
  
  /* latin-ext */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-latin-ext-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-latin-ext-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
  }
  
  /* vietnamese */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-vietnamese-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-vietnamese-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
  }
  
  /* cyrillic */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 800;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-cyrillic-800-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-cyrillic-800-normal.woff')}} ) format('woff'); 
    unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
  }
  
  /* cyrillic-ext */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 800;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-cyrillic-ext-800-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-cyrillic-ext-800-normal.woff')}} ) format('woff'); 
    unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
  }
  
  /* greek */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 800;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-greek-800-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-greek-800-normal.woff')}} ) format('woff'); 
    unicode-range: U+0370-03FF;
  }
  
  /* greek-ext */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 800;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-greek-ext-800-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-greek-ext-800-normal.woff')}} ) format('woff'); 
    unicode-range: U+1F00-1FFF;
  }
  
  /* hebrew */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 800;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-hebrew-800-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-hebrew-800-normal.woff')}} ) format('woff'); 
    unicode-range: U+0590-05FF, U+200C-2010, U+20AA, U+25CC, U+FB1D-FB4F;
  }
  
  /* latin */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 800;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-latin-800-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-latin-800-normal.woff')}} ) format('woff'); 
    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  }
  
  /* latin-ext */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 800;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-latin-ext-800-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-latin-ext-800-normal.woff')}} ) format('woff'); 
    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
  }
  
  /* vietnamese */
  @font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 800;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/OpenSans/open-sans-vietnamese-800-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/OpenSans/open-sans-vietnamese-800-normal.woff')}} ) format('woff'); 
    unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
  }
  </style>
  <style>
  /* cyrillic */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-cyrillic-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-cyrillic-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
  }
  
  /* cyrillic-ext */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-cyrillic-ext-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-cyrillic-ext-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
  }
  
  /* greek */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-greek-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-greek-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0370-03FF;
  }
  
  /* greek-ext */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-greek-ext-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-greek-ext-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+1F00-1FFF;
  }
  
  /* hebrew */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-hebrew-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-hebrew-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0590-05FF, U+200C-2010, U+20AA, U+25CC, U+FB1D-FB4F;
  }
  
  /* latin */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-latin-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-latin-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  }
  
  /* latin-ext */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-latin-ext-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-latin-ext-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
  }
  
  /* vietnamese */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-vietnamese-400-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-vietnamese-400-normal.woff')}} ) format('woff'); 
    unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
  }
  
  /* cyrillic */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-cyrillic-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-cyrillic-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
  }
  
  /* cyrillic-ext */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-cyrillic-ext-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-cyrillic-ext-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
  }
  
  /* greek */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-greek-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-greek-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0370-03FF;
  }
  
  /* greek-ext */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-greek-ext-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-greek-ext-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+1F00-1FFF;
  }
  
  /* hebrew */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-hebrew-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-hebrew-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0590-05FF, U+200C-2010, U+20AA, U+25CC, U+FB1D-FB4F;
  }
  
  /* latin */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-latin-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-latin-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  }
  
  /* latin-ext */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-latin-ext-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-latin-ext-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
  }
  
  /* vietnamese */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-vietnamese-600-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-vietnamese-600-normal.woff')}} ) format('woff'); 
    unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
  }
  
  /* cyrillic */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 700;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-cyrillic-700-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-cyrillic-700-normal.woff')}} ) format('woff'); 
    unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
  }
  
  /* cyrillic-ext */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 700;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-cyrillic-ext-700-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-cyrillic-ext-700-normal.woff')}} ) format('woff'); 
    unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
  }
  
  /* greek */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 700;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-greek-700-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-greek-700-normal.woff')}} ) format('woff'); 
    unicode-range: U+0370-03FF;
  }
  
  /* greek-ext */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 700;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-greek-ext-700-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-greek-ext-700-normal.woff')}} ) format('woff'); 
    unicode-range: U+1F00-1FFF;
  }
  
  /* hebrew */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 700;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-hebrew-700-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-hebrew-700-normal.woff')}} ) format('woff'); 
    unicode-range: U+0590-05FF, U+200C-2010, U+20AA, U+25CC, U+FB1D-FB4F;
  }
  
  /* latin */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 700;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-latin-700-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-latin-700-normal.woff')}} ) format('woff'); 
    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  }
  
  /* latin-ext */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 700;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-latin-ext-700-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-latin-ext-700-normal.woff')}} ) format('woff'); 
    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
  }
  
  /* vietnamese */
  @font-face {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 700;
    font-stretch: 100%;
    font-display: swap;
    src: url({{ asset('assets/fonts/Inter/inter-vietnamese-700-normal.woff2')}} ) format('woff2'), url({{ asset('assets/fonts/Inter/inter-vietnamese-700-normal.woff')}} ) format('woff'); 
    unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
  }
  </style>
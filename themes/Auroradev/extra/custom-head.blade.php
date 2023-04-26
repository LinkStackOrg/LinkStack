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
	html{
		font-size: 100%;
	}
	body{
		font-size: 18px;
		line-height: 24px;
      	font-weight: 400;
	  	color: white;
      	font-family: "Open Sans", "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif;
		background-image:
		url({{themeAsset('../../aurora.jpg')}});
		no-repeat center center fixed; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		background-size: cover;
	}
</style>
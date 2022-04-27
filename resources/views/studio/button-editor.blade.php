<!doctype html>
<html lang="en">
  <head>
  	<title>Studio ⚙️ {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('littlelink/css/hover-min.css') }}">
    <link rel="stylesheet" href="{{ asset('littlelink/css/animate.css') }}">

    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
  <!-- begin dark mode detection -->
	<script src="{{ asset('littlelink/js/js.cookie.min.js') }}"></script>
	<script>
		// code to set the `color_scheme` cookie
		var $color_scheme = Cookies.get("color_scheme");
		function get_color_scheme() {
		return (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) ? "dark" : "light";
		}
		function update_color_scheme() {
		Cookies.set("color_scheme", get_color_scheme());
		}
		// read & compare cookie `color-scheme`
		if ((typeof $color_scheme === "undefined") || (get_color_scheme() != $color_scheme))
		update_color_scheme();
		// detect changes and change the cookie
		if (window.matchMedia)
		window.matchMedia("(prefers-color-scheme: dark)").addListener( update_color_scheme );
		// reloads page to apply the dark mode cookie
		window.onload = function() {
		    if(!window.location.hash && get_color_scheme() == "dark" && (get_color_scheme() != $color_scheme)) {
		        window.location = window.location + '#dark';
		        window.location.reload();
		    }
		}
	</script>
		<?php // loads dark mode CSS if dark mode detected
		     $color_scheme = isset($_COOKIE["color_scheme"]) ? $_COOKIE["color_scheme"] : false; ?>
		@if ($color_scheme == 'dark')
					<!-- switch the two <link> Tags below to default to dark mode if cookie detection fails -->
					<link rel="stylesheet" href="{{ asset('/studio/css/bootstrap.min-dark.css') }}">
					<link rel="stylesheet" href="{{ asset('/studio/css/style-dashboard-dark.css') }}">
				@else
					<link rel="stylesheet" href="{{ asset('/studio/css/bootstrap.min.css') }}">
					<link rel="stylesheet" href="{{ asset('/studio/css/style-dashboard.css') }}">
					@endif
  <!-- end dark mode detection -->

    @if(file_exists(base_path("littlelink/images/avatar.png" )))
    <link rel="icon" type="image/png" href="{{ asset('littlelink/images/avatar.png') }}">
    @else
    <link rel="icon" type="image/svg+xml" href="{{ asset('littlelink/images/logo.svg') }}">
    @endif


  <!-- start button editor -->

	<style type="text/css">
	#inside{
background:white;

height:600px;
padding-top:50px;
padding-right:30px;
padding-left:30px;

}
	
</style>
	


<title> MELANGE button generator </title>
<link rel="stylesheet" type="text/css" href="./styles/button-gen.css">
<link rel="stylesheet" href="./styles/jquery.gradientPicker.css" type="text/css" />
<!--<link rel="stylesheet" href="./vendor/jqPlugins/colorpicker/css/colorpicker.css" type="text/css" /> -->
<link rel="stylesheet" href="./styles/colorpicker_1.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="./themes/blackboard.css">

	

	<script src="./js/rainbow.js"></script>
	<script src="./js/css.js"></script>

	<script src="./js/jquery-1.7.js"></script> 
	<script src="./js/jqueryUI-custom.js"></script>
	<script src="./js/colorpicker.js"></script>
	<script src="./js/jquery.gradientPicker.js"></script>
	





<script>

$(document).ready(function() {


$('#code').click(function() {

	var css_text = 'padding-top : '+button_css.padding_top+';'+'\npadding-bottom :'+button_css.padding_bottom+';'+'\npadding-left :'+button_css.padding_left+';';
	css_text = css_text+'\npadding-right :'+button_css.padding_right+';'+'\ncolor :'+button_css.color+';'+'\nbackground-image :'+button_css.background_image+';';
	css_text = css_text+'\nborder-radius :'+button_css.border_radius+';'+'\nfont-size :'+button_css.font_size+';'+'\nfont-family :'+button_css.font_family+';';
	css_text = css_text+'\nborder-color :'+button_css.border_color+';'+'\nborder-style :'+button_css.border_style+';'+'\nborder-width :'+button_css.border_width+';';

	$('#sCode').html(css_text);
	
 	Rainbow.color(div, function() {
 	document.getElementById('output').appendChild(div);
});


	
	$('.modal-profile').fadeIn("slow");
	$('.modal-lightsout').fadeTo("slow", .9);
});

$('a.modal-close-profile, .modal-lightsout').click(function() {
	$('.modal-profile').fadeOut("slow");
	$('.modal-lightsout').fadeOut("slow");
});






var $button = $("#sample");

$("#ex1").gradientPicker({
			change: function(points, styles) {
				for (i = 1; i < styles.length; ++i) {
					$button.css("background-image", styles[i]);
					button_css.background_image = styles[i];
					
				}
			},
			fillDirection: "45deg",
			controlPoints: ["white 0%",  "#888888 100%"]
		});
		
		
		
		
		$('#color').ColorPicker({
		color: '#000000',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#color').css('background-color', '#' + hex);
			document.getElementById("sample").style.color='#'+hex;
			button_css.color = '#'+hex;	        
		
		
		}
	});

	$('#border-color').ColorPicker({
		color: '#000000',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#border-color').css('background-color', '#' + hex);
			document.getElementById("sample").style.borderColor='#'+hex;
			button_css.border_color = '#'+hex;
						
		
		
		}
	});

	
	

	
	document.getElementById("pdtb").onchange = $.proxy(function(){ 
		
		
		var val = document.getElementById('pdtb').value;
	 
		$('#sample').css("padding-top",val+'px');
		$('#sample').css("padding-bottom",val+'px');
		
		button_css.padding_top = val+'px';
		button_css.padding_bottom = val+'px';
					
		
		
	},document);

		
   document.getElementById("pdlr").onchange = $.proxy(function(){ 
		
		var val = document.getElementById('pdlr').value;
		$('#sample').css("padding-left",val+'px');
		$('#sample').css("padding-right",val+'px');
		
		button_css.padding_left = val+'px';
		button_css.padding_right = val+'px';
		
		
		
	},document);	
	
	
	 document.getElementById("ftb").onchange = $.proxy(function(){ 
		
		var val = document.getElementById('ftb').value;
		$('#sample').css("font-size",val+'px');
		
		
		button_css.font_size = val+'px';
	
		
		
		
	},document);	
	
	document.getElementById("br").onchange = $.proxy(function(){ 
		
		var val = document.getElementById('br').value;
		$('#sample').css("border-radius",val+'px');
		
		
		button_css.border_radius = val+'px';
	
		
		
		
	},document);	
		
		

	 document.getElementById("tsub").onclick = $.proxy(function(){ 
		
		var val = document.getElementById('text').value;
		$('#sample').text(val);
		
		
				
		
		
		
	},document);	
	
	
	
	document.getElementById("ffsub").onclick = $.proxy(function(){ 
		
		var font1 = document.getElementById("font-face"); // or in jQuery use: select = this;
	var FontFace = font1.options[font1.selectedIndex].text;
	document.getElementById('sample').style.fontFamily=FontFace;
	button_css.font_family = FontFace;
		// $('#sample').text(val);
		// button_css.font_family = FontFace;
		
				
		
		
		
	},document);	
	
	
	document.getElementById("bssub").onclick = $.proxy(function(){ 
		
		var bor = document.getElementById("border-style"); // or in jQuery use: select = this;
	var borstyle = bor.options[bor.selectedIndex].text;
	document.getElementById('sample').style.borderStyle=borstyle;
		
		$('#sample').text(val);
		button_css.border_style = borstyle;
		
				
		
		
		
	},document);	
	
	
	
	
	document.getElementById("bw").onchange = $.proxy(function(){ 
		
		
		var val = document.getElementById('bw').value;
	 
		$('#sample').css("border-width",val+'px');
		
		
		button_css.border_width = val+'px';
	  
		
		
	},document);
	
	
   
	




});



var button_css = {

		padding_top:'0px',
		padding_bottom:'0px',
		color:'black',
		background_image : 'none',
		padding_left: '0px',
		padding_right : '0px',
		border_radius : '8px',
		font_family : 'Open Sans',
		font_size : '18px',
		border_color : 'black',
		border_style : 'none',
		border_width : '0px'
		



};

</script>

  <!-- end button editor -->



	
    <style type="text/css">
	#inside{
background:white;

height:600px;
padding-top:50px;
padding-right:30px;
padding-left:30px;

}
	
</style>
	


<title> MELANGE button generator </title>
<link rel="stylesheet" type="text/css" href="./styles/button-gen.css">
<link rel="stylesheet" href="./styles/jquery.gradientPicker.css" type="text/css" />
<!--<link rel="stylesheet" href="./vendor/jqPlugins/colorpicker/css/colorpicker.css" type="text/css" /> -->
<link rel="stylesheet" href="./styles/colorpicker_1.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="./themes/blackboard.css">

	

	<script src="./js/rainbow.js"></script>
	<script src="./js/css.js"></script>

	<script src="./js/jquery-1.7.js"></script> 
	<script src="./js/jqueryUI-custom.js"></script>
	<script src="./js/colorpicker.js"></script>
	<script src="./js/jquery.gradientPicker.js"></script>
	
  </head>


<body>

<style>
.button-demo,
button-demo {
  display: inline-block;
  text-decoration: none;
  height: 48px;
  text-align: center;
  vertical-align: middle;
  font-size: 18px;
  width: 300px;
  font-weight: 700;
  line-height: 48px;
  letter-spacing: 0.1px;
  white-space: wrap;
  border-radius: 8px;
  cursor: pointer;
 }
 button-demo:hover,
.button-demo:focus {
  color: #333;
  border-color: #888;
  outline: 0; }
.button-demo.button-primary {
  color: #FFF;
  filter: brightness(90%) }
.button-demo.button-primary:hover,
.button-demo.button-primary:focus {
  color: #FFF;
  filter: brightness(90%) }
.icon {
  padding: 0px 8px 3.5px 0px;
  vertical-align: middle;
  width: 20px;
  height: 20px;
}
.button.button-custom {
  color: #FFFFFF;
  background-color: #FFFFFF;
  background-image: linear-gradient(-135deg,#0f0c29,#302b63,#24243e) }
.button.button-custom:hover,
.button.button-custom:focus {
  filter: brightness(90%) }

  details {
  width: 64.7%;
  background: #282828;
    color: #ffffff;
    cursor: pointer;
    padding: 12px;
    margin-bottom: 0;
    box-sizing: border-box;
    border-radius: 4px;
    transition: border-radius 100ms cubic-bezier(0.66, 0.01, 0.35, 0.99);
  overflow: hidden;
  position:relative; 
  left:1%;
}

summary {
  padding: 1rem;
  display: block;
  background: #333;
  padding-left: 1rem;
  cursor: pointer;
}

summary:before {
  content: '';
  border-width: .4rem;
  border-style: solid;
  border-color: transparent transparent transparent #fff;
  position: absolute;
  top: 1.3rem;
  left: 1rem;
  transform: rotate(0);
  transform-origin: .2rem 50%;
  transition: .25s transform ease;
}

details[open] > summary:before {
  transform: rotate(90deg);
}

details summary::-webkit-details-marker {
  display:none;
}

details > ul {
  padding-bottom: 1rem;
  margin-bottom: 0;

.body-container { 
  position: absolute;
  height: 80%; 
  width: 80%; 
  top: 10%; 
  left: 10%; 
}
</style>
<script src="https://kit.fontawesome.com/c4a5e06183.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('littlelink/css/hover-min.css') }}">
<link rel="stylesheet" href="{{ asset('littlelink/css/animate.css') }}">


<div style="position: relative; top: 50px; z-index: 2;"><a href="{{ url('/studio/links') }}" style="font-size: 40px;" >&nbsp; &nbsp; &nbsp; Back</a></div>

<a style="position:relative;float:right;z-index:10;right:25px;" href="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>" target="_blank">Watch Page</a>

<div style="position: absolute;height: 80%; width: 80%; top: 15%; left: 10%;">
<h2 class="mb-4"><i class="bi bi-pen"> Button Editor</i><p style="color: tomato;">B E T A</p></h2><br><br>

        <h2>Custom Button</h2><br>

        <!-- start button editor -->
<div style="left: 10px;">
  <div class="modal-profile">
<h2>CSS</h2>
    <a class="modal-close-profile" title="Close profile window" href="#"><img src="./images/close.png" alt="Close profile window" /></a>
     <div id="output">
     </div>
 </div>
    
    
    <div class="modal-lightsout"></div>





<aside id="panel-right">



</br>


<div class="tool">
<heading>Color &nbsp;<span>Text</span></heading>
</br>
<input type="button" id="color" style="background-color:#FFFFFF; border:thin solid white;height:50px;width:50px;margin-left:5px;">


</div>


</br>


<div class="tool">
<heading>background &nbsp;<span>gradient</span></heading>
</br>
<div class="grad_ex" id="ex1"></div>
</div>


</br>




</aside>

<section id="preview">
<center><div id="sample" style="--delay: 1s; border-radius:8px !important; width: 400px; class="button-entrance"><div class="button-demo button hvr-grow hvr-icon-wobble-vertical"><img class="icon hvr-icon" src="{{ asset('\/littlelink/icons\/') . 'custom' }}.svg">Example</div></div></center>

</section>
</div>
<!-- end button editor -->

<br>
<details>
<summary>Show CSS</summary>
<div style="padding-left: 15px;">
<form action="{{ route('editCSS', $id) }}" method="post">
        @csrf
        <div class="form-group col-lg-8"><br>
          <p>Custom CSS</p>

          <textarea name="custom_css" rows="9" id="sCode" type="text" value="{{ $custom_css }}" class="form-control">{{ $custom_css }}</textarea>
        </div>
</div>
</details>
<br><button id="code" class="mt-3 ml-3 btn btn-info">Submit</button><br>
      </form>

      <form action="{{ route('editCSS', $id) }}" method="post">
        @csrf
        <div class="form-group col-lg-8">
<textarea style="display: none;" rows="9" type="text" name="custom_css" value="" class="form-control">
color: #FFFFFF; 
background-color: #FFFFFF; 
background-image: linear-gradient(-135deg,#0f0c29,#302b63,#24243e)
</textarea>
        </div>
        <button type="submit" class="mt-3 ml-3 btn btn-info">Reset to default</button>
      </form>

<br><br><div style="left: 1%; position: relative; background-color:#2c2d3a; border-radius: 25px; width:65%; height:300px; box-shadow: 0 10px 20px -10px rgba(0,0,0, 0.6);">
  <div style="position: relative; top: 50%; transform: translateY(-50%);">
    <h2 align="center" style="color:white">Result:</h2>
      @if($custom_css === "")
        <center><div style="--delay: 1s" class="button-entrance"><div class="button-demo button-custom button hvr-grow hvr-icon-wobble-vertical" href=""><img class="icon hvr-icon fa {{$custom_icon}}">Example</div></div></center>
      @elseif($custom_css != "")
        <center><div style="--delay: 1s" class="button-entrance"><div style="{{ $custom_css }}" class="button-demo hvr-grow hvr-icon-wobble-vertical" href=""><i style="color: {{$custom_icon}}" class="icon hvr-icon fa {{$custom_icon}}"></i>Example</div></div></center>
      @endif
      </div>
</div>
        <br><br>
        <form action="{{ route('editCSS', $id) }}" method="post">
        @csrf
        <div class="form-group col-lg-8">
          <h2>Custom Icon</h2>
          <textarea id="textareabox" type="text" name="custom_icon" value="{{ $custom_icon }}" class="form-control">{{ $custom_icon }}</textarea>
        </div>
        <script type="text/javascript">
        // Displays alert if custom icon doesn't contain string "fa-"
        var textarea = document.getElementById('textareabox');
        var word = 'fa-';
        var textValue=textarea.value;
        if (textValue.indexOf(word)==-1)
          {
           alert('Your custom icon\'s short code does not contain the string "fa-" always use icons in the format: fa-ghost, for example.')
          } 
          </script>

        <details>
        <p>Custom icons can be added to buttons via Font Awesome. You can use any icon from the list below, you can access this list by clicking the 'See all icons' button. Each icon on that list has a short code, which you can copy and enter in the custom icon field.</p>
        <p>Every icon short code consists of a prefix and main part. If the short code is not a brand icon, you can simply enter the code in the format: fa-icon-name. The 'fa-...' formatting is important here. For example 'fa-code'.</p>
        <p>If the short code is a brand icon, it is important to include a 'fab' before the short code part. Again, The 'fa-...' formatting still applies here. For example, 'fab fa-github'</p>
        <p>To apply color to your icons, you can simply write out the color name or just write the HEX value before the icon, followed by a ';'. Here it is important to put the color before the icon short code and the color code must be ended with a semicolon.<br>
        You can find a list of available colors <a href="https://www.w3schools.com/cssref/css_colors.asp" target="_blank">here</a>.</p>
        <br><table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Style</th>
            <th scope="col">Prefix</th>
            <th scope="col" style="width: 1%">Icon</th>
            <th scope="col">Short Code</th>
          </tr>
        </thead>
        <tbody>
        <tr>
            <td>Regular</td>
            <td></td>
            <td><i class="fa fa-user"></i></td>
            <td><p>fa-user</p></td>
          </tr>
          <tr>
            <td>Brands</td>
            <td>fab</td>
            <td><i class="fab fa-github"></i></td>
            <td><p>fab fa-github</p></td>
          </tr>
          <tr>
            <td>Color</td>
            <td>color_name;</td>
            <td><i style="color: red;" class="fa fa-ghost"></i></td>
            <td><p style="color: red;">red; fa-ghost</p></td>
          </tr>
          <tr>
            <td>Color HEX</td>
            <td>color_HEX;</td>
            <td><i style="color: #1DA1F2;" class="fab fa-twitter"></i></td>
            <td><p style="color: #1DA1F2;">#1DA1F2; fab fa-twitter</p></td>
          </tr>
        </tbody>
        </table>
        </details>

        <div class="row">
        <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
        <button class="mt-3 ml-3 btn btn-info"><a href="https://fontawesome.com/search?m=free" target="_blank">See all icons</a></button>
        </div>
      </form><br><br><br><br>

</div>
      </body>
</html>
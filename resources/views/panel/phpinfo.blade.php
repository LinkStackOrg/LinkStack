<!DOCTYPE html>
@include('layouts.lang')
@if(auth()->user()->role == 'admin')
<head>
  <!-- begin dark mode detection -->
	<script src="{{ asset('assets/linkstack/js/js.cookie.min.js') }}"></script>
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
		     $color_scheme = isset($_COOKIE["color_scheme"]) ? $_COOKIE["color_scheme"] : false; 
			 $color_scheme_override = isset($_COOKIE["color_scheme_override"]) ? $_COOKIE["color_scheme_override"] : false; ?>
		@if ($color_scheme == 'dark' and $color_scheme_override != 'light' or $color_scheme_override == 'dark')
					<!-- switch the two <link> Tags below to default to dark mode if cookie detection fails -->
					<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min-dark.css') }}">
					<link rel="stylesheet" href="{{ asset('assets/css/style-dashboard-dark.css') }}">
				@else
					<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
					<link rel="stylesheet" href="{{ asset('assets/css/style-dashboard.css') }}">
					@endif
					
    <style>
@if($color_scheme == 'dark') 
        body { background-color: #31363b; margin: 0 0 0 0;}

        #zPHP { background-color: #31363b; }

        #presentation
        {
            width:500px;
            height: 140px;
            text-align: center;
            color: lightGray;
            margin: auto;
            margin-top: -20px;
            padding-top: 40px;
        }
@else
        body { background-color: #fafafa; margin: 0 0 0 0;}

        #zPHP { background-color: #fafafa; }

        #presentation
        {
            width:500px;
            height: 140px;
            text-align: center;
            color: lightGray;
            margin: auto;
            margin-top: -20px;
            padding-top: 40px;
        }
@endif
    </style>
  <!-- end dark mode detection -->

    <title>Info PHP</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="https://www.php.net/favicon.ico">

</head>
<body>
    <div id='zPHP'>
<div style="position: relative; top: 50px; z-index: 2;"><a href="{{ url('admin/config') }}" style="font-size: 40px;" >&nbsp; &nbsp; &nbsp; Back</a></div>
<div style="position: relative; bottom: 60px; right: 15px; z-index: 1;" align="right"><a onclick="this.href='data:text/html;charset=UTF-8,'+encodeURIComponent(document.documentElement.outerHTML)" href="#" download="phpinfo.html"><button class="btn btn-primary">Download</button></a></div>
        <div id='presentation'>
            <h1>{{__('messages.Information about PHP’s configuration')}}</h1>
            <h2>{{__('messages.Outputs information about the current state of PHP')}}</h2>
        </div>
        
<?php
phpinfo();
phpinfo(INFO_MODULES);

?>
    </div>  
</body>
@endif
</html>
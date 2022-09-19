<!doctype html>
@include('layouts.lang')
  <head>
  	<title>Studio ⚙️ {{ config('app.name') }}</title>
    <meta charset="utf-8">

@include('layouts.analytics')

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('content/css/hover-min.css') }}">
    <link rel="stylesheet" href="{{ asset('content/css/animate.css') }}">

    <link href="//fonts.bunny.net/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <!-- begin dark mode detection -->
	<script src="{{ asset('content/js/js.cookie.min.js') }}"></script>
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
		@if ($color_scheme == 'dark' and config('advanced-config.theme') != 'light' and $color_scheme_override != 'light' or $color_scheme_override == 'dark')
					<!-- switch the two <link> Tags below to default to dark mode if cookie detection fails -->
					<link rel="stylesheet" href="{{ asset('/studio/css/bootstrap.min-dark.css') }}">
					<link rel="stylesheet" href="{{ asset('/studio/css/style-dashboard-dark.css') }}">
				@elseif(config('advanced-config.theme') == 'dark')
					<link rel="stylesheet" href="{{ asset('/studio/css/bootstrap.min-dark.css') }}">
					<link rel="stylesheet" href="{{ asset('/studio/css/style-dashboard-dark.css') }}">
				@else
					<link rel="stylesheet" href="{{ asset('/studio/css/bootstrap.min.css') }}">
					<link rel="stylesheet" href="{{ asset('/studio/css/style-dashboard.css') }}">
					@endif
  <!-- end dark mode detection -->

<?php //security check, checks if config files got compromised
if(auth()->user()->role == 'admin'){

$serversb = $_SERVER['SERVER_NAME'];
$urisb = $_SERVER['REQUEST_URI'];

// Tests if a URL has a valid SSL certificate
function has_sslsb( $domain ) {
	$ssl_check = @fsockopen( 'ssl://' . $domain, 443, $errno, $errstr, 30 );
	$res = !! $ssl_check;
	if ( $ssl_check ) { fclose( $ssl_check ); }
	return $res;
  }
  
  // Changes probed URL to HTTP if no valid SSL certificate is present, otherwise an error would be thrown
  if (has_sslsb($serversb)) {
	$actual_linksb = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  } else {
	$actual_linksb = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  }

function getUrlSatusCodesb($urlsb, $timeoutsb = 3)
 {
 $chsb = curl_init();
 $optssb = array(CURLOPT_RETURNTRANSFER => true, // do not output to browser
 CURLOPT_URL => $urlsb, 
 CURLOPT_NOBODY => true, // do a HEAD request only
 CURLOPT_TIMEOUT => $timeoutsb); 
 curl_setopt_array($chsb, $optssb);
 curl_exec($chsb);
 $status = curl_getinfo($chsb, CURLINFO_HTTP_CODE);
 curl_close($chsb);
 return $status;
 }

// Files or directories to test if accessible externally
$url1sb = getUrlSatusCodesb($actual_linksb . '/../../.env');
$url2sb = getUrlSatusCodesb($actual_linksb . '/../../database/database.sqlite');

// sets compromised to true if config files got compromised
if($url1sb == '200'  or $url2sb == '200') {
	$compromised = "true";
} else {
	$compromised = "false";
}
}
 // end security check ?>

    @if(file_exists(base_path("arcanelink/images/avatar.png" )))
    <link rel="icon" type="image/png" href="{{ asset('content/images/avatar.png') }}">
    @else
    <link rel="icon" type="image/png" href="{{ asset('content/images/arcanelink-logo.png') }}">
    @endif

	@stack('sidebar-stylesheets')
  </head>
  <body>

		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
        @if(auth()->user()->role == 'user' || auth()->user()->role == 'vip')
        <a href="{{ url('/studio/index') }}">
        @elseif(auth()->user()->role == 'admin')
        <a href="{{ url('/panel/index') }}">
        @endif

        @if(file_exists(base_path("arcanelink/images/avatar.png" )))
          <img class="img logo" src="{{ asset('content/images/avatar.png') }}" srcset="{{ asset('content/images/avatar@2x.png 2x') }}" style="width: 150px;>
          @else
          <img class="img logo" type="image/png" src="{{ asset('content/images/arcanelink-logo.png') }}" style="width:100px;">
          @endif
          </a>
          <ul class="list-unstyled components mb-5">

            @if(auth()->user()->role == 'admin')
            <ul class="list-unstyled components mb-5">
            <li class="active">
	            <a @if(config('advanced-config.expand_panel_admin_menu_permanently') != 'true') href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" @endif>Admin</a>
	            <ul class="@if(config('advanced-config.expand_panel_admin_menu_permanently') != 'true') collapse @endif list-unstyled" id="adminSubmenu">
                <li>
                    <a href="{{ url('env-editor') }}">Config</a>
                </li>
                <li>
                    <a href="{{ url('panel/users/all') }}">Users</a>
                </li>
                <li>
                    <a href="{{ url('panel/pages') }}">Pages</a>
                </li>
                <li>
                    <a href="{{ url('panel/site') }}">Site</a>
                </li>
	            </ul>
	          </li>           
             @endif
             
	          <li>
				 <li class="active">
				     <a href="{{ url('/panel/index') }}">Dashboard</a>
				 </li>
				 <li>

            <li class="">
              <a href="{{ url('/studio/add-link') }}">Add a Link</a>
	          </li>
            <li>
              <a href="{{ url('/studio/links') }}">My Links</a>
	          </li>
            <li>
              <a href="{{ url('/studio/page') }}">Edit Page</a>
	          </li>
			  <li>
              <a href="{{ url('/studio/theme') }}">Themes</a>
	          </li>
            <li>
              <a href="{{ url('/studio/profile') }}">Profile</a>
	          </li>
            <form action="{{ route('logout') }}" method="post">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <button type="submit" class="buttonLogout">Logout</button>
            </form>
	        </ul>
	        <div class="footer">
		@if(env('DISPLAY_FOOTER') === true)
	        	<p>
			    Copyright &copy; @php echo date('Y'); @endphp {{ config('app.name') }}<i class="icon-heart" aria-hidden="true"></i> </br>
	@php if(config('advanced-config.display_link_home') != 'false' and config('advanced-config.display_link_terms') != 'false' and config('advanced-config.display_link_privacy') != 'false' and config('advanced-config.display_link_contact') != 'false'){$dot=" . "; } else {$dot="&ensp;";} @endphp
    @if(config('advanced-config.display_link_home') != 'false')<a class="footer-hover spacing" @if(config('advanced-config.custom_link_home') != '')href="{{ config('advanced-config.custom_link_home') }}"@else href="{{ url('') }}/"@endif> @if(config('advanced-config.custom_text_home') != ''){{config('advanced-config.custom_text_home')}}@else Home @endif</a>{!!$dot!!}@endif
    @if(config('advanced-config.display_link_terms') != 'false')<a class="footer-hover spacing" href="{{ url('') }}/pages/terms">Terms</a>{!!$dot!!}@endif
    @if(config('advanced-config.display_link_privacy') != 'false')<a class="footer-hover spacing" href="{{ url('') }}/pages/privacy">Privacy</a>{!!$dot!!}@endif
    @if(config('advanced-config.display_link_contact') != 'false')<a class="footer-hover spacing" href="{{ url('') }}/pages/contact">Contact</a>@endif
            </p>
			@endif
@if(env('DISPLAY_CREDIT') === true)
<a href="https://arcanetechsolutions.com" target="_blank" title="Learn more">
	<section class="hvr-grow fadein sections">
		<div class="parent-footers" >
			<img id="footer_spin" class="footer_spin image-footers1" src="{{ asset('content/images/arcanetech-logo-star.png') }}" alt="Arcane Technology Solutions, LLC"></img>
			<a href="https://www.arcanetechsolutions.com?utm_source=arcanelink&utm_medium=website&utm_content=footer" class="text-footers" style="color: #FFFFFF; font-weight: 700; font-size: 15px;">Arcane Technology Solutions, LLC</a>
		</div>
	</section>
</a>
@endif
	        </div>
	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="bi bi-list"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            {{-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button> --}}
            <div class="" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                  <div class="row">

            <! –– #### begin update detection #### ––>
	@if(env('NOTIFY_UPDATES') === 'old')
                <! –– Checks if file version.json exists to continue (without this PHP will throw ErrorException ) ––>
                @if(file_exists(base_path("version.json")))

                  <?php // Requests newest version from server and sets it as variable
					ini_set('user_agent', 'Mozilla/4.0 (compatible; MSIE 6.0)');
					$json = file_get_contents("https://api.github.com/repos/arcane-technology/arcane-link/releases/latest");
					$myObj = json_decode($json);
				  $Vgit = $myObj->tag_name;

				       // Requests current version from the local version file and sets it as variable
                  $Vlocal = 'v' . file_get_contents(base_path("version.json"));
					?>

					<! –– If user has role admin AND newest GitHub release version is higher than the local one an update notice will be displayed ––>
					@if(auth()->user()->role == 'admin' and $Vgit > $Vlocal)
					<a style="color:#007bff" class="nav-link" href="{{ url('update') }}" title="Click here to learn more about how to update">An update is available</a>
					@endif
				@endif
	@elseif(env('NOTIFY_UPDATES') == 'true' or env('NOTIFY_UPDATES') === 'major' or env('NOTIFY_UPDATES') === 'all')
	<?php // Checks if URL exists
					try {
					function URL_exists(string $urlsb): bool
					{
						return str_contains(get_headers($urlsb)[0], "200 OK");
					}
					         // Sets $ServerExists to true if URL exists
						if (URL_exists("https://julianprieber.github.io/littlelink-custom/version.json")){
							$ServerExists = "true";
						}
						} catch (exception $e) {
							$ServerExists = "false";
						}
						?>

                <! –– Checks if file version.json exists AND if version.json exists on server to continue (without this PHP will throw ErrorException ) ––>
                @if(file_exists(base_path("version.json")) and $ServerExists == 'true')

                  <?php // Requests newest version from server and sets it as variable
                  $Vgit = file_get_contents("https://julianprieber.github.io/littlelink-custom/version.json"); 

				       // Requests current version from the local version file and sets it as variable
                  $Vlocal = file_get_contents(base_path("version.json")); 
					?>

					<! –– If user has role admin AND newest GitHub release version is higher than the local one an update notice will be displayed ––>
					@if(auth()->user()->role == 'admin' and $Vgit > $Vlocal)
					<a style="color:#007bff" class="nav-link" href="{{ url('update') }}" title="Click here to learn more about how to update">An update is available</a>
					@endif
				@endif
	@endif
            <! –– #### end update detection #### ––>

					@if(auth()->user()->role == 'admin' and $compromised === "true")
					<a style="color:tomato;" class="nav-link" href="{{ url('panel/diagnose') }}" title="Your security is at risk. Some files can be accessed by everyone. Immediate action is required! Click this message to learn more.">Your security is at risk!</a>
					@endif

					@if(env('JOIN_BETA') === true)
					<a style="color:tomato;" class="nav-link" href="{{ url('update') }}">You are in BETA mode! <img src="https://img.shields.io/static/v1?label=installed:&message=<?php  if(file_exists(base_path("vbeta.json"))) {echo file_get_contents(base_path("vbeta.json"));} else {echo "none";}  ?>&color=FFFFFF"> <img src="https://img.shields.io/static/v1?label=server:&message=<?php echo file_get_contents("https://update.arcanelink-custom.com/beta/vbeta.json"); ?>&color=FFFFFF"></a>
					@endif

					@if (config('advanced-config.theme') == 'light' and $color_scheme_override != 'dark')
					<div id="myBtn" class="toggle"><span>🌙</span><input type="checkbox" id="toggle-switch" checked/><label for="toggle-switch"></label><span>☀️</span></div>
					<script>function ColorOverrride(){document.cookie="color_scheme_override=dark; path=/",location.reload()}var btn=document.getElementById("myBtn");btn.addEventListener("click",ColorOverrride);</script>
					@elseif ($color_scheme_override == 'dark' or ($color_scheme == 'dark' and $color_scheme_override != 'dark' and $color_scheme_override != 'light'))
					<div id="myBtn" class="toggle"><span>🌙</span><input type="checkbox" id="toggle-switch" /><label for="toggle-switch"></label><span>☀️</span></div>
					<script>function ColorOverrride(){document.cookie="color_scheme_override=light; path=/",location.reload()}var btn=document.getElementById("myBtn");btn.addEventListener("click",ColorOverrride);</script>
					@elseif ($color_scheme_override == 'light' or ($color_scheme == 'light' and $color_scheme_override != 'dark' and $color_scheme_override != 'light'))
					<div id="myBtn" class="toggle"><span>🌙</span><input type="checkbox" id="toggle-switch" checked/><label for="toggle-switch"></label><span>☀️</span></div>
					<script>function ColorOverrride(){document.cookie="color_scheme_override=dark; path=/",location.reload()}var btn=document.getElementById("myBtn");btn.addEventListener("click",ColorOverrride);</script>
					@endif

                    <a class="nav-link" href="{{ url('') }}/@<?= Auth::user()->arcanelink_name ?>" target="_blank">View Page</a>
                  </div>
                </li>
              </ul>
            </div
          </div>
        </nav>

@if(config('advanced-config.disable_default_password_notice') != 'true')
{{-- Displays a warning message if default password is still set --}}
@php 
$arcanelink_current = Auth::user()->id;
$userdbs = DB::table('users')->where('id', $arcanelink_current)->get();
@endphp

@foreach($userdbs as $userdb)

	@if(Hash::check('12345678', $userdb->password))
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
<a style="background-color:tomato;color:#fff;border-radius:5px;" class="nav-link" href="{{ url('/studio/profile') }}" target=""><i class="bi bi-exclamation-circle-fill"></i> <strong>You are still using the default password! Click here to change this.</strong></a>
            </div>
        </nav>
	@endif
	
@endforeach
@endif

      <! –– #### begin event detection #### ––>
		<?php
			try {
				function URL_event_exists(string $urlsb): bool
				{
				return str_contains(get_headers($urlsb)[0], "200 OK");
					}
						if (URL_event_exists("https://julianprieber.github.io/littlelink-custom-events/event.json")){
							$EventServerExists = "true";
						}
							} catch (exception $e) {
								$EventServerExists = "false";
							}
						?>
	@if(env('NOTIFY_EVENTS') === true and $EventServerExists == 'true')
        <?php
        $GetEventJson = file_get_contents("https://julianprieber.github.io/littlelink-custom-events/event.json");
		$EventJson = json_decode($GetEventJson, true);
		if(isset($_COOKIE['HideEvent']) == NULL) {
			setcookie("HideEvent",$_COOKIE['ID'] = "0", time()+60*60*24*5, "/");
			    header('Location: ' . url('/panel/index'));
					exit();
					} 
		?>
		@if(auth()->user()->role == 'admin' and strtotime(date("d-m-Y")) < strtotime($EventJson['enddate']))
			@if(isset($_COOKIE['HideEvent']) and $_COOKIE['HideEvent'] != $EventJson['id'])
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">


					<a class="nav-link" href="{{ $EventJson['link'] }}" target="{{ $EventJson['target'] }}"><mark onMouseOver="{{ $EventJson['hoveron'] }}" onMouseOut="{{ $EventJson['hoveroff'] }}" style="{{ $EventJson['style'] }}" title="{{ $EventJson['hover'] }}">{{ $EventJson['title'] }}</mark></a> <a href="?hide_event" title="Click to hide this message">❌</a>
    <?php
        if (strpos($_SERVER['REQUEST_URI'], "hide_event") !== false){
        setcookie("HideEvent",$_COOKIE['ID'] = $EventJson['id'], time()+60*60*24*5, "/");
        header('Location: ' . url('/panel/index'));
          exit();
            } 
            ?>
            </div>
		</nav>
		@endif
	@endif
	@if(env('NOTIFY_EVENTS') === false and auth()->user()->role == 'admin')
		<a href="{{ url('env-editor') }}" id="notify" style="color:#F75D59; font-weight:600; font-size:120%; background-color:#F5FFFA;"></a>
<script>
if(localStorage.getItem("firstTime")==null){
   document.getElementById("notify").innerHTML = "➡️ Click here to get notified about important events or security vulnerabilities";
   localStorage.setItem("firstTime","done");
}
</script>
			@endif
@endif
      <! –– #### end event detection #### ––>
              @yield('content')

             </div>
	    	</div>

    <script src="{{ asset('/studio/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/studio/js/popper.js') }}"></script>
    <script src="{{ asset('/studio/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/studio/js/Sortable.min.js') }}"></script>
	<script src="{{ asset('/studio/js/jquery-block-ui.js') }}"></script>
    <script src="{{ asset('/studio/js/main-dashboard.js') }}"></script>

	@stack('sidebar-scripts')
  </body>
</html>

<!doctype html>
@include('layouts.lang')
  <head>
  	<title>Studio ⚙️ {{ config('app.name') }}</title>
    <meta charset="utf-8">

@include('layouts.analytics')

<base href="{{url()->current()}}" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('littlelink/css/hover-min.css') }}">
    <link rel="stylesheet" href="{{ asset('littlelink/css/animate.css') }}">

    <link href="//fonts.bunny.net/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('studio/external-dependencies/bootstrap-icons.css') }}">
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

    @if(file_exists(base_path("littlelink/images/").findFile('favicon')))
    <link rel="icon" type="image/png" href="{{ asset('littlelink/images/'.findFile('favicon')) }}">
    @else
    <link rel="icon" type="image/svg+xml" href="{{ asset('littlelink/images/logo.svg') }}">
    @endif

	@stack('sidebar-stylesheets')

<style>
.segmented-button {
  display: flex;
  margin-right: 0.75rem;
  margin-top: 0.1rem;
}

.segmented-button .dropdown-button {
  padding: 0 1rem;
  margin-left: 1px;
}

.btn-seg, .btn-seg-large {
    text-decoration: none;
    color: #fff;
    background-color: #f8b739;
    text-align: center;
    letter-spacing: .5px;
    transition: .2s ease-out;
    cursor: pointer;
}

.btn-seg:hover {
    color: #fff;
}

.btn-seg, .btn-seg-large, .btn-seg-floating, .btn-seg-large, .btn-seg-flat {
    outline: 0;
}

.btn-seg, .btn-seg-large, .btn-seg-flat {
    border: none;
    border-radius: 0.25rem;
    display: inline-block;
    height: 36px;
    line-height: 36px;
    padding: 0 2rem;
    text-transform: uppercase;
    vertical-align: middle;
    -webkit-tap-highlight-color: transparent;
}

.z-depth-1, nav, .card-panel, .card, .toast, .btn-seg, .btn-seg-large, .btn-seg-floating, .dropdown-content, .collapsible, .side-nav {
    box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 1px 5px 0 rgb(0 0 0 / 12%), 0 3px 1px -2px rgb(0 0 0 / 20%);
}
</style>

{{-- Couldn't get this fixed so I did this: --}}
@if (request()->route()->getName() == 'env-editor.index')
<style>
.btn-seg-ico {
  position: relative;
  top: 10px;
  left: 1px;
}
</style>
@endif

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

        @if(file_exists(base_path("littlelink/images/").findFile('avatar')))
          <img class="img logo" src="{{ asset('littlelink/images/'.findFile('avatar')) }}" style="width:150px;height:auto;">
          @else
          <img class="img logo" type="image/svg+xml" src="{{ asset('littlelink/images/logo.svg') }}" style="width:100px;">
          @endif
          </a>
          <ul class="list-unstyled">
            @if(auth()->user()->role == 'admin')
            <li class="active">
	          <a href="#adminSubmenu" data-toggle="collapse" @if(Request::segment(1) == 'panel' ) class="dropdown-toggle" aria-expanded="true" @else class="dropdown-toggle collapsed" aria-expanded="false"  @endif>Admin</a>
	          <ul class="collapse list-unstyled @if(Request::segment(1) == 'panel' ) show @endif " id="adminSubmenu">
                <li class="{{ Request::segment(2) == 'config' ? 'active' : ''}}">
                  <a href="{{ url('panel/config') }}">Config</a>
                </li>
                <li class="{{ Request::segment(2) == 'users' ? 'active' : ''}}">
                  <a href="{{ url('panel/users/all') }}">Manage Users</a>
                </li>
                <li class="{{ Request::segment(2) == 'pages' ? 'active' : ''}}">
                  <a href="{{ url('panel/pages') }}">Footer Pages</a>
                </li>
                <li class="{{ Request::segment(2) == 'site' ? 'active' : ''}}">
                  <a href="{{ url('panel/site') }}">Home Page</a>
                </li>
              </ul>
            </li>
            @endif

            <li class="{{ Request::segment(2) == 'add-link' ? 'active' : ''}}">
              <a href="{{ url('/studio/add-link') }}">Add Page Item</a>
	        </li>
            <li class="{{ Request::segment(2) == 'links' ? 'active' : ''}}">
              <a href="{{ url('/studio/links') }}">Your Links</a>
	        </li>
            <li class="{{ Request::segment(2) == 'page' ? 'active' : ''}}">
              <a href="{{ url('/studio/page') }}">Your Page</a>
	        </li>
            <li class="{{ Request::segment(2) == 'theme' ? 'active' : ''}}">
              <a href="{{ url('/studio/theme') }}">Your Themes</a>
	        </li>
            <li class="{{ Request::segment(2) == 'profile' ? 'active' : ''}}">
              <a href="{{ url('/studio/profile') }}">Account Settings</a>
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
	@php if(env('DISPLAY_FOOTER_HOME') != false and env('DISPLAY_FOOTER_TERMS') != false and env('DISPLAY_FOOTER_PRIVACY') != false and env('DISPLAY_FOOTER_CONTACT') != false){$dot=" . "; } else {$dot="&ensp;";} @endphp
    @if(env('DISPLAY_FOOTER_HOME') === true)<a class="footer-hover spacing" href="@if(str_replace('"', "", EnvEditor::getKey('HOME_FOOTER_LINK')) === "" ){{ url('') }}@else{{ str_replace('"', "", EnvEditor::getKey('HOME_FOOTER_LINK')) }}@endif">{{str_replace('"', "", EnvEditor::getKey('TITLE_FOOTER_HOME'))}}</a>{!!$dot!!}@endif
    @if(env('DISPLAY_FOOTER_TERMS') === true)<a class="footer-hover spacing" href="{{ url('') }}/pages/terms">{{str_replace('"', "", EnvEditor::getKey('TITLE_FOOTER_TERMS'))}}</a>{!!$dot!!}@endif
    @if(env('DISPLAY_FOOTER_PRIVACY') === true)<a class="footer-hover spacing" href="{{ url('') }}/pages/privacy">{{str_replace('"', "", EnvEditor::getKey('TITLE_FOOTER_PRIVACY'))}}</a>{!!$dot!!}@endif
    @if(env('DISPLAY_FOOTER_CONTACT') === true)<a class="footer-hover spacing" href="{{ url('') }}/pages/contact">{{str_replace('"', "", EnvEditor::getKey('TITLE_FOOTER_CONTACT'))}}</a>@endif
            </p>
			@endif
@if(env('DISPLAY_CREDIT') === true)
<a href="https://littlelink-custom.com" target="_blank" title="Learn more">
	<section class="hvr-grow fadein sections">
		<div class="parent-footers" >
			<img id="footer_spin" class="footer_spin image-footers1" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="LittleLink Custom"></img>
			<img class="image-footers2" src="{{ asset('littlelink/images/just-ll.svg') }}" alt="LittleLink Custom"></img>
		</div>

		<a href="https://littlelink-custom.com" class="text-footers" style="color: #FFFFFF; font-weight: 700; font-size: 15px;">&nbsp;&nbsp;Powered by</a><br>
		<a href="https://littlelink-custom.com" class="text-footers" style="color: #FFFFFF; font-weight: 700; font-size: 15px;">LittleLink Custom</a>
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
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                  <div class="row">

            <! –– #### begin update detection #### ––>
	@if(env('NOTIFY_UPDATES') === 'old')
                <! –– Checks if file version.json exists to continue (without this PHP will throw ErrorException ) ––>
                @if(file_exists(base_path("version.json")))

                  <?php // Requests newest version from server and sets it as variable
					ini_set('user_agent', 'Mozilla/4.0 (compatible; MSIE 6.0)');
					$json = file_get_contents("https://api.github.com/repos/julianprieber/littlelink-custom/releases/latest");
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

                <! –– Checks if file version.json exists AND if version.json exists on server to continue (without this PHP will throw ErrorException ) ––>
                @if(file_exists(base_path("version.json")))

                  <?php // Requests newest version from server and sets it as variable

                  try{
                  $Vgit = file_get_contents("https://version.littlelink-custom.com/"); 

				       // Requests current version from the local version file and sets it as variable
                  $Vlocal = file_get_contents(base_path("version.json"));
                  }

                  catch (Exception $e){
                  $Vgit = "0"; 
                  $Vlocal = "0"; 
				  }
					?>

					<! –– If user has role admin AND newest GitHub release version is higher than the local one an update notice will be displayed ––>
					@if(auth()->user()->role == 'admin' and $Vgit > $Vlocal)
					<button style="margin-left:5px;" class="update-notification"><a class="update-link nav-link" href="{{ url('update') }}" title="Click here to learn more about how to update">Update</a></button>
					<?php
					$version1 = $Vlocal;
					$version2 = $Vgit;
					
					$version1_steps = explode(".", $version1);
					$version2_steps = explode(".", $version2);
					$count = 0;
					
					// first digit
					if ($version2_steps[0] - $version1_steps[0] == 1) {
					  $count += 10;
					}
					
					// second digit
					if ($version2_steps[1] - $version1_steps[1] == 1) {
					  $count += 10;
					}
					
					for ($i = 2; $i < count($version1_steps); $i++) {
					  $count += $version2_steps[$i] - $version1_steps[$i];
					}
					
					$count = abs($count);
					?>
					<style>
					:root {
						@if($count < 4)
						  --bg-color: rgba(63, 144, 90, 0.2);
						  --bo-color: rgb(63, 144, 90);
						@elseif($count > 3 and $count < 6)
						  --bg-color: rgb(213, 184, 95, 0.2);
						  --bo-color: rgba(213, 183, 95);
						@else
						  --bg-color: rgb(255, 99, 71, 0.2);
						  --bo-color: rgb(255, 99, 71);
						@endif
						}
					.update-link{
					  color: var(--bo-color) !important;
					}
					.update-notification{
					  display: inline-block;
					  margin-bottom: 0;
					  font-size: 14px;
					  height: 2.5rem;
					  line-height: 1rem;
					  width: auto;
					  font-weight: 500;
					  text-align: center;
					  white-space: nowrap;
					  vertical-align: middle;
					  cursor: pointer;
					  -webkit-user-select: none;
					  -moz-user-select: none;
					  -ms-user-select: none;
					  user-select: none;
					  background-color: var(--bg-color);
					  border: 1px solid var(--bo-color);
					  border-radius: 25px;
					}
					</style>
					@endif
				@endif
	@endif
            <! –– #### end update detection #### ––>

					@if(auth()->user()->role == 'admin' and $compromised === "true")
					<a style="color:tomato;" class="nav-link" href="{{ url('panel/config#5') }}" title="Your security is at risk. Some files can be accessed by everyone. Immediate action is required! Click this message to learn more.">Your security is at risk!</a>
					@endif

					@if(env('JOIN_BETA') === true and auth()->user()->role == 'admin')
					<style>.beta-mobile {display: none;margin: 0 auto;font-size:200%;padding-left: 15px;margin-right: -15px;position: relative;bottom: 3px;}@media only screen and (max-width: 1300px) {.beta {display: none;}.beta-mobile {display: inline-block !important;}}</style>
					<a style="color:tomato;" class="nav-link beta" href="{{ url('update') }}">You are in BETA mode! <img src="https://img.llc.ovh/static/v1?label=installed:&message=<?php  if(file_exists(base_path("vbeta.json"))) {echo file_get_contents(base_path("vbeta.json"));} else {echo "none";}  ?>&color=FFFFFF"> <img src="https://img.llc.ovh/static/v1?label=server:&message=<?php echo file_get_contents("https://update.littlelink-custom.com/beta/vbeta.json"); ?>&color=FFFFFF"></a>
					<a style="color:tomato;" class="beta-mobile" href="{{ url('update') }}"><i class="bi bi-file-code-fill"></i></a>
					@endif

					@if(Route::currentRouteName() === "showConfig")<style>#toggle-switch{margin-left: -24px !important;}</style>@endif
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

					<div class="segmented-button">
						<a style="font-weight: 130%" href="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>" target="_blank" class="btn-seg">View Page</a>
						<a onclick="copyText('{{ url('') }}/@<?= Auth::user()->littlelink_name ?>')" style="color:#fff" class="btn-seg dropdown-button"><i class="btn-seg-ico bi bi-share-fill"></i></a>
					</div>
					<div id='dropdown1' class='dropdown-content'>
					</div>				
					<script>
					function copyText(text) {
					var dummy = document.createElement("textarea");
 					 document.body.appendChild(dummy);
 					 dummy.value = text;
 					 dummy.select();
 					 document.execCommand("copy");
 					 document.body.removeChild(dummy);
					 alert('URL has been copied to your clipboard!')
					}
					</script>
                  </div>
                </li>
              </ul>
            </div
          </div>
        </nav>

@if(config('advanced-config.disable_default_password_notice') != 'true')
{{-- Displays a warning message if default password is still set --}}
@php 
$littlelink_current = Auth::user()->id;
$userdbs = DB::table('users')->where('id', $littlelink_current)->get();
@endphp

@foreach($userdbs as $userdb)

	@if(Hash::check('12345678', $userdb->password))
        <nav class="shadow navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
<a style="background-color:tomato;color:#fff;border-radius:5px;" class="nav-link" href="{{ url('/studio/profile') }}" target=""><i class="bi bi-exclamation-circle-fill"></i> <strong>You are still using the default password! Click here to change this.</strong></a>
            </div>
        </nav>
	@endif
	
@endforeach
@endif

      <! –– #### begin event detection #### ––>
	@if(env('NOTIFY_EVENTS') === true)
        <?php
        try{
        $GetEventJson = file_get_contents("https://event.littlelink-custom.com/");
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
<?php } catch (Exception $e){} ?>
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

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

        @if(file_exists(base_path("littlelink/images/avatar.png" )))
          <img class="img logo" src="{{ asset('littlelink/images/avatar.png') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" style="width: 150px;>
          @else
          <img class="img logo" type="image/svg+xml" src="{{ asset('littlelink/images/logo.svg') }}" style="width:100px;">
          @endif
          </a>
          <ul class="list-unstyled components mb-5">

            @if(auth()->user()->role == 'admin')
            <ul class="list-unstyled components mb-5">
            <li class="active">
	            <a href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Admin</a>
	            <ul class="collapse list-unstyled" id="adminSubmenu">
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
              <a href="{{ url('/studio/add-link') }}">Add Link</a>
	          </li>
            <li>
              <a href="{{ url('/studio/links') }}">Links</a>
	          </li>
            <li>
              <a href="{{ url('/studio/page') }}">Page</a>
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
               <a href="{{ url('') }}/">Home</a> .
               <a href="{{ url('') }}/pages/terms" target="_blank">Terms</a> .
               <a href="{{ url('') }}/pages/privacy" target="_blank">Privacy</a> .
               <a href="{{ url('') }}/pages/contact" target="_blank">Contact</a>
            </p>
			@endif
@if(env('DISPLAY_CREDIT') === true)
<a href="https://littlelink-custom.com" target="_blank" title="Learn more">
	<section class="hvr-grow fadein sections">
		<div class="parent-footers" >
			<img id="footer_spin" class="footer_spin image-footers1" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="LittleLink Custom"></img>
			<img class="image-footers2" src="{{ asset('littlelink/images/just-ll.svg') }}" alt="LittleLink Custom"></img>
		</div>

		<a href="" class="text-footers" style="color: #FFFFFF; font-weight: 700; font-size: 15px;">&nbsp;&nbsp;Powered by</a><br>
		<a href="" class="text-footers" style="color: #FFFFFF; font-weight: 700; font-size: 15px;">LittleLink Custom</a>
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
	@if(env('NOTIFY_UPDATES') === true)
					<?php // Checks if URL exists
					try {
					function URL_exists(string $url): bool
					{
						return str_contains(get_headers($url)[0], "200 OK");
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
					<a style="color:#007bff" class="nav-link" href="https://littlelink-custom.com/how-to-update.html" target="_blank" title="Click here to learn more about how to update">An update is available</a>
					@endif
				@endif
	@endif
            <! –– #### end update detection #### ––>

                    <a class="nav-link" href="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>" target="_blank">Watch Page</a>
                  </div>
                </li>
              </ul>
            </div
          </div>
        </nav>
      <! –– #### begin event detection #### ––>
		<?php
			try {
				function URL_event_exists(string $url): bool
				{
				return str_contains(get_headers($url)[0], "200 OK");
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
    <script src="{{ asset('/studio/js/main-dashboard.js') }}"></script>
  </body>
</html>

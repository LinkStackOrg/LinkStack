<!doctype html>
<html lang="en">
  <head>
  	<title>Studio ⚙️ {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
					<!-- switch the two <link> Tags below to default to dark mode if cookie detection fails -->
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

	        <div class="footer" style="display:none">
	        	<p>
			    Copyright &copy; @php echo date('Y'); @endphp <i class="icon-heart" aria-hidden="true"></i> </br>
               <a href="/" target="_blank">Home</a> .
               <a href="{{ url('') }}/pages/terms" target="_blank">Terms</a> .
               <a href="{{ url('') }}/pages/privacy" target="_blank">Privacy</a> .
               <a href="{{ url('') }}/pages/contact" target="_blank">Contact</a>
            </p>
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

					<?php // Checks if URL exists
					try {
					function URL_exists(string $url): bool
					{
						return str_contains(get_headers($url)[0], "200 OK");
					}
					         // Sets $ServerExists to true if URL exists
						if (URL_exists("https://littlelink-custom.tru.io/version.json")){
							$ServerExists = "true";
						}
						} catch (exception $e) {
							$ServerExists = "false";
						}
						?>

                <! –– Checks if file version.json exists AND if version.json exists on server to continue (without this PHP will throw ErrorException ) ––>
                @if(file_exists(base_path("version.json")) and $ServerExists == 'true')

                  <?php // Requests newest version from server and sets it as variable
                  $Vgit = file_get_contents("https://littlelink-custom.tru.io/version.json"); 

				       // Requests current version from the local version file and sets it as variable
                  $Vlocal = file_get_contents(base_path("version.json")); 
					?>

					<! –– If user has role admin AND newest GitHub release version is higher than the local one an update notice will be displayed ––>
					@if(auth()->user()->role == 'admin' and $Vgit > $Vlocal)
					<a style="color:#007bff" class="nav-link" href="https://littlelink-custom.tru.io/how-to-update.html" target="_blank" title="Click here to learn more about how to update">An update is available</a>
					@endif
				@endif
            <! –– #### end update detection #### ––>

                    <a class="nav-link" href="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>" target="_blank">Watch Page</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>

              @yield('content')

             </div>
	    	</div>

    <script src="{{ asset('/studio/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/studio/js/popper.js') }}"></script>
    <script src="{{ asset('/studio/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/studio/js/main-dashboard.js') }}"></script>
  </body>
</html>

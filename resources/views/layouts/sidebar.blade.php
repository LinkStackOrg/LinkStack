<!doctype html>
<html lang="en">
  <head>
  	<title>Studio ⚙️ {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
		<link rel="stylesheet" href="{{ asset('/studio/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('/studio/css/style-dashboard.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('littlelink/images/avatar.png') }}">
  </head>
  <body>

		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
        @if(auth()->user()->role == 'user')
        <a href="{{ url('/studio/index') }}">
        @elseif(auth()->user()->role == 'admin')
        <a href="{{ url('/panel/index') }}">
        @endif

          <img class="img logo rounded-circle" src="{{ asset('littlelink/images/avatar.png') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}">
          </a>
          <ul class="list-unstyled components mb-5">

            @if(auth()->user()->role == 'admin')
            <ul class="list-unstyled components mb-5">
            <li class="active">
	            <a href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Admin</a>
	            <ul class="collapse list-unstyled" id="adminSubmenu">
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
             <button type="submit" class="buttonLogout">logout</button>
            </form>
	        </ul>

	        <div class="footer">
	        	<p>
			    Copyright &copy; @php echo date('Y'); @endphp <i class="icon-heart" aria-hidden="true"></i> </br>
               <a href="/" target="_blank">Home</a> .
               <a href="https://github.com/khashayarzavosh/admin-littlelink/#donate" target="_blank">Donate</a> .
               <a href="https://github.com/khashayarzavosh/admin-littlelink" target="_blank">Programmers</a> .
               <a href="/pages/terms" target="_blank">Terms</a> .
               <a href="/pages/privacy" target="_blank">Privacy</a> .
               <a href="/pages/contact" target="_blank">Contact</a>
            </p>
	        </div>
	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/+{{ Auth::user()->name }}" target="_blank">Watch Page</a>
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

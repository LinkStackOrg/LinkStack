@extends('layouts.sidebar')

@section('content')
@if($_SERVER['QUERY_STRING'] == '')

<div><h2>Tabs</h2></div>

<div id="exTab2" class="">
    <ul id="myTab" class="nav nav-tabs">
    	<li class="nav-item"><a class="nav-link active" href="#home1" data-toggle="tab" id="home-tab">Config</a></li>
    	<li class="nav-item"><a class="nav-link" href="#advanced2" data-toggle="tab" id="advanced-tab">Advanced Config</a></li>
    	<li class="nav-item"><a class="nav-link" href="#backup3" data-toggle="tab" id="backup-tab">Take Backup</a></li>
    	<li class="nav-item"><a class="nav-link" href="#backups4" data-toggle="tab" id="backups4-tab">All Backups</a></li>
    	<li class="nav-item"><a class="nav-link" href="#diagnose5" data-toggle="tab" id="diagnose5-tab">Diagnosis</a></li>
    </ul>

<div class="tab-content ">


<div class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab" id="home1">
    <section class="shadow text-gray-400">
    <h2 class="mb-4 card-header"><i class="bi bi-link-45deg"> Config</i></h2>
    <div class="card-body p-0 p-md-3">

<style>
/* Temporary fix for the unintended scrolling bug when applying settings */
html {scroll-behavior: unset !important;}
</style>

    <style>
    .option{
    	background-color: #343a40;
    	color: rgba(255, 255, 255, 0.8) !important;
    	min-height: 100px;
    	overflow: hidden;
    	padding: 20px;
    	border-radius: 5px;
    	-webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
    }
    .option h3{
    	color:white!important;
    }
    .option:hover, .option:focus, .option:active {
      -webkit-transform: scale(1.005);
      transform: scale(1.005);
      box-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
    }
    .opt-img{
    	font-size: 4rem;
    	vertical-align: middle;
    	display: flex;
    	padding-right: 20px;
    	padding-left: 10px;
    	color: white;
    }
    .opt-txt{
    	bottom: 10px;
    	position: relative;
    }

    .legend{
    	background-color: #343a40;
    	color: rgba(255, 255, 255, 0.8) !important;
    	min-height: 65px;
    	overflow: hidden;
    	padding: 10px 10px;
    	padding-left: 30px;
    	padding-right: 30px;
    	border-radius: 5px;
    	-webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
    }
    .legend h3{
    	color:white!important;
    }
    .legend:hover, .legend:focus, .legend:active {
      box-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
    }
    .legendl {
      padding: 10px;
      margin-left: 5px;
      margin-right: 5px;
      min-width: 120px;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #31363b;
      border-radius: 5px;
      position: relative;
      display: flex;
      -webkit-transition-duration: 0.3s;
      transition-duration: 0.3s;
      color: white;
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
    }
    .legendl:hover, .legendl:focus, .legendl:active {
      -webkit-transform: scale(1.1);
      transform: scale(1.1);
    }
    #button-top {
      display: inline-block;
      background-color: #275EFE;
      width: 50px;
      height: 50px;
      text-align: center;
      border-radius: 5px;
      position: fixed;
      bottom: 30px;
      right: 30px;
      transition: background-color .3s,
        opacity .5s, visibility .5s;
      opacity: 0;
      visibility: hidden;
      z-index: 1000;
    }
    #button-top::after {
      content: "\f077";
      font-family: FontAwesome;
      font-weight: normal;
      font-style: normal;
      font-size: 2em;
      line-height: 50px;
      color: #fff;
    }
    #button-top:hover {
      cursor: pointer;
      -webkit-filter: brightness(90%);
    }
    #button-top:active {
      background-color: #555;
    }
    #button-top.show {
      opacity: 1;
      visibility: visible;
    }

    /* Styles for the content section */

    .content {
      width: 77%;
      margin: 50px auto;
      font-family: 'Merriweather', serif;
      font-size: 17px;
      color: #6c767a;
      line-height: 1.9;
    }
    @media (min-width: 500px) {
      .content {
        width: 43%;
      }
      #button-top {
        margin: 30px;
      }
    }
    .content h1 {
      margin-bottom: -10px;
      color: #03a9f4;
      line-height: 1.5;
    }
    .content h3 {
      font-style: italic;
      color: #96a2a7;
    }
    </style>

    <div class="option"><a href="?alternative-config">
    <div class="row"><i class="bi bi-pencil-square opt-img"></i><div>
    <h3 class="">Alternative Config Editor</h3><p class="text-muted opt-txt">Use the Alternative Config Editor to edit the config directly</p>
    </div></div></a></div><br>

    <div class="option"><a href="{{ url('env-editor') }}">
    <div class="row"><i class="bi bi-gear-fill opt-img"></i><div>
    <h3 class="">Config Manager</h3><p class="text-muted opt-txt">Manage, download, upload, backup and restore your config</p>
    </div></div></a></div><br>

    <div class="option"><a href="{{ url('panel/phpinfo') }}">
    <div class="row"><i class="bi bi-filetype-php opt-img"></i><div>
    <h3 class="">PHP info</h3><p class="text-muted opt-txt">Display debuggin infromation about your PHP setup</p>
    </div></div></a></div><br><br>

    <h3>Jump directly to:</h3>
    <div class="legend">
    <div class="row">
    <a href="#Application"><div class="legendl">Application</div></a>
    <a href="#Panel-settings"><div class="legendl">Panel settings</div></a>
    <a href="#Security"><div class="legendl">Security</div></a>
    <a href="#Advanced"><div class="legendl">Advanced</div></a>
    <a href="#SMTP"><div class="legendl">SMTP</div></a>
    <a href="#Footer"><div class="legendl">Footer links</div></a>
    <a href="#Debug"><div class="legendl">Debug</div></a>
    <div>
    </div></div></div>

    @include('components.config.config')

    </div>
    </section>
</div>


<div class="tab-pane" role="tabpanel" aria-labelledby="advanced-tab" id="advanced2">
    <section class="shadow text-gray-400">
    <h2 class="mb-4 card-header"><i class="bi bi-pencil-square"> Advanced config</i></h2>
    <div class="card-body p-0 p-md-3">
    @include('components.config.advanced-config')
    </div>
    </section>
</div>


<div class="tab-pane" role="tabpanel" aria-labelledby="backup-tab" id="backup3">
    <section class="shadow text-gray-400">
    <h2 class="mb-4 card-header"><i class="bi bi-link-45deg"> Backup</i></h2>
    <div class="card-body p-0 p-md-3">
    @include('components.config.backup')
    </div>
    </section>
</div>


<div class="tab-pane" role="tabpanel" aria-labelledby="backups4-tab" id="backups4">
    <section class="shadow text-gray-400">
    <h2 class="mb-4 card-header"><i class="bi bi-link-45deg"> Backups</i></h2>
    <div class="card-body p-0 p-md-3">
    @include('components.config.backups')
    </div>
    </section>
</div>


<div class="tab-pane" role="tabpanel" aria-labelledby="diagnose5-tab" id="diagnose5">
    <section class="shadow text-gray-400">
    <h2 class="mb-4 card-header"><i class="bi bi-braces-asterisk"> Debugging information</i> <span class="text-muted" style="font-size:60%;vertical-align: middle;">v{{file_get_contents(base_path("version.json"))}}</span></h2>
    <div class="card-body p-0 p-md-3">
    @include('components.config.diagnose')
    </div>
    </section>
</div>


</div>
</div>

<!-- Back to top button -->
<a id="button-top"></a>

@elseif($_SERVER['QUERY_STRING'] == 'alternative-config')
@include('components.config.alternative-config')
@include('components.config.back-button')
@endif

@push("sidebar-scripts")
<script src="{{ asset('studio/external-dependencies/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('studio/external-dependencies/bootstrap.min.js') }}"></script>
<script>
//$('#myTab a').click(function(e) {
// e.preventDefault();
// $(this).tab('show');
//});
// store the currently selected tab in the hash value

$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
  var id = $(e.target).attr("href").substr(1);
  window.location.hash = id;
});

// on load of the page: switch to the currently selected tab
var hash = window.location.hash;

$('#myTab a[href="' + hash + '"]').tab('show');

var btn = $('#button-top');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:280}, '300');
});
</script>
<script src="{{ asset('studio/external-dependencies/bootstrap.min.js') }}"></script>
@endpush


@endsection

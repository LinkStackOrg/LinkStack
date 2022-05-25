@extends('layouts.updater')

@Push('updater-body')


<?php // Requests newest version from server and sets it as variable
					ini_set('user_agent', 'Mozilla/4.0 (compatible; MSIE 6.0)');
					$json = file_get_contents("https://api.github.com/repos/julianprieber/littlelink-custom/releases/latest") ;
					$myObj = json_decode($json);
				  $Vgit = $myObj->tag_name; 

				       // Requests current version from the local version file and sets it as variable
                  $Vlocal = 'v' . file_get_contents(base_path("version.json")); 
					?>
@if(auth()->user()->role == 'admin' and $Vgit > $Vlocal)

@if($_SERVER['QUERY_STRING'] === '')
<?php //landing page ?>
        <style>.logo-container{padding-top:23vh;}.logo-centered{top:37vh;}</style>
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo" style="">
           <div class="logo-centered">l</div>
        </div>
        <center><h1>Updater</h1>
        <h4 class="">You can update your installation automatically or download the update and install it manually:</h4>
        <br><div class="row">
        &ensp;<button style=""><i class="fa-solid fa-user-gear btn"></i><a class="btn" href="{{url()->current()}}/?backup"> Update automatically</a></button>&ensp;
        &ensp;<button style=""><i class="fa-solid fa-download btn"></i><a class="btn" href="https://littlelink-custom.com/how-to-update"> Update manually</a></button>&ensp;
        </div>
      </center>
@endif

@if($_SERVER['QUERY_STRING'] === 'backup')
<?php //creating backup... ?>
@Push('updater-head')
<meta http-equiv="refresh" content="2; URL={{url()->current()}}/?backups" />
@endpush
        <div class="logo-container fadein">
           <img class="logo-img loading" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo" style="">
           <div class="logo-centered">l</div>
        </div>
        <center><h1 class="loadingtxt">Creating backup</h1></center>
@endif

@if($_SERVER['QUERY_STRING'] === 'backups')
<?php Artisan::call('backup:run', ['--only-files' => true]);
$tst = base_path('backups/');
file_put_contents($tst.'CANUPDATE', '');
$URL = Route::current()->getName();   
header("Location: ".$URL."?updating");
exit(); ?>
@endif

@if($_SERVER['QUERY_STRING'] === 'updating' and (file_exists(base_path("backups/CANUPDATE"))))
<?php //updating... ?>
        <div class="logo-container fadein">
           <img class="logo-img loading" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo" style="">
           <div class="logo-centered">l</div>
        </div>
        <center><h1 class="loadingtxt">Updating</h1></center>
        @Push('updater-head')
         <meta http-equiv="refresh" content="2; URL={{url()->current()}}/../updating" />
         @endpush
@endif

@endif



@if($_SERVER['QUERY_STRING'] === 'success')
      <?php //success ?>
        <style>.logo-container{padding-top:23vh;}.logo-centered{top:37vh;}</style>
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo" style="">
           <div class="logo-centered">l</div>
        </div>
        <center><h1>Success!</h1>
        <h4 class="">The update was successful, you can now return to the Admin Panel:</h4>
        <br><div class="row">
        &ensp;<button style=""><i class="fa-solid fa-house-laptop btn"></i><a class="btn" href="{{ route('studioIndex') }}"> Admin Panel</a></button>&ensp;
        </div>
      </center>
@endif


@endpush
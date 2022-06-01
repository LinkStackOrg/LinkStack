@extends('layouts.updater')

@Push('updater-body')
<div class="container">

<?php // Requests newest version from server and sets it as variable
			   		$Vgit = file_get_contents("https://julianprieber.github.io/littlelink-custom/version.json");

				       // Requests current version from the local version file and sets it as variable
                  $Vlocal = file_get_contents(base_path("version.json"));
					?>
@if(auth()->user()->role == 'admin' and $Vgit > $Vlocal or env('JOIN_BETA') === true)

@if($_SERVER['QUERY_STRING'] === '')
<?php //landing page ?>
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo">
           <div class="logo-centered">l</div>
        </div>
        <h1>Updater</h1>
        @if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
        <h4 class="">The updater only works on Linux based systems.</h4>
        <a class="btn" href="https://littlelink-custom.com/update"><button><i class="fa-solid fa-download btn"></i> Update manually</button></a>
        @else
        @if(env('JOIN_BETA') === true)
        <p><?php echo "latest beta version= " . file_get_contents("https://update.littlelink-custom.com/beta/vbeta.json"); ?></p>
        <p><?php  if(file_exists(base_path("vbeta.json"))) {echo "Installed beta version= " . file_get_contents(base_path("vbeta.json"));} else {echo "Installed beta version= none";}  ?></p>
        <p><?php  if($Vgit > $Vlocal) {echo "You need to update to the latest mainline release";} else {echo "You're running the latest mainline release";}  ?></p>
        @else
        <h4 class="">You can update your installation automatically or download the update and install it manually:</h4>
        @endif
        <br><div class="row">
            @if(env('SKIP_UPDATE_BACKUP') == true)
            &ensp;<a class="btn" href="{{url()->current()}}/?updating"><button><i class="fa-solid fa-user-gear btn"></i> Update automatically</button></a>&ensp;
            @else
            &ensp;<a class="btn" href="{{url()->current()}}/?backup"><button><i class="fa-solid fa-user-gear btn"></i> Update automatically</button></a>&ensp;
            @endif
        &ensp;<a class="btn" href="https://littlelink-custom.com/update" target="_blank"><button><i class="fa-solid fa-download btn"></i> Update manually</button></a>&ensp;
        </div>
        @endif
      
@endif

@if($_SERVER['QUERY_STRING'] === 'backup')
<?php //creating backup... ?>
@Push('updater-head')
<meta http-equiv="refresh" content="2; URL={{url()->current()}}/?backups" />
@endpush
        <div class="logo-container fadein">
           <img class="logo-img loading" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo">
           <div class="logo-centered">l</div>
        </div>
        <h1 class="loadingtxt">Creating backup</h1>
@endif

@if($_SERVER['QUERY_STRING'] === 'backups')
<?php Artisan::call('backup:clean');
Artisan::call('backup:run', ['--only-files' => true]);
$tst = base_path('backups/');
file_put_contents($tst.'CANUPDATE', '');
$URL = Route::current()->getName();   
header("Location: ".$URL."?updating");
exit(); ?>
@endif

@if($_SERVER['QUERY_STRING'] === 'updating' and (file_exists(base_path("backups/CANUPDATE")) or env('SKIP_UPDATE_BACKUP') == true))
<?php //updating... ?>
        <div class="logo-container fadein">
           <img class="logo-img loading" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo">
           <div class="logo-centered">l</div>
        </div>
        <h1 class="loadingtxt">Updating</h1>
        @Push('updater-head')
         <meta http-equiv="refresh" content="2; URL={{url()->current()}}/../updating" />
         @endpush
@endif

@elseif($_SERVER['QUERY_STRING'] === '')
      <?php //if no new version available ?>
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo">
           <div class="logo-centered">l</div>
        </div>
        <h1>No new version</h1>
        <h4 class="">There is no new version available</h4>
        <br><div class="row">
        &ensp;<a class="btn" href="{{ route('studioIndex') }}"><button><i class="fa-solid fa-house-laptop btn"></i> Admin Panel</button></a>&ensp;
        </div>
      
@endif

@if($_SERVER['QUERY_STRING'] === 'finishing')
<?php //finishing up update ?>
        <div class="logo-container fadein">
           <img class="logo-img loading" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo">
           <div class="logo-centered">l</div>
        </div>
        <h1 class="loadingtxt">Finishing up</h1>
        
        <?php 

         //run before finishing:
            if(EnvEditor::keyExists('JOIN_BETA')){ /* Do nothing if key already exists */ 
            } else { EnvEditor::addKey('JOIN_BETA', 'false');} // Adds key to .env file 

            if(EnvEditor::keyExists('SKIP_UPDATE_BACKUP')){ /* Do nothing if key already exists */ 
            } else { EnvEditor::addKey('SKIP_UPDATE_BACKUP', 'false');} // Adds key to .env file 

        echo "<meta http-equiv=\"refresh\" content=\"0; " . url()->current() . "?success\" />"; 
        ?>
@endif

@if($_SERVER['QUERY_STRING'] === 'success')
      <?php //after successfully updating ?>
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo">
           <div class="logo-centered">l</div>
        </div>
        <h1>Success!</h1>
        @if(env('JOIN_BETA') === true)
        <p><?php echo "latest beta version= " . file_get_contents("https://update.littlelink-custom.com/beta/vbeta.json"); ?></p>
        <p><?php  if(file_exists(base_path("vbeta.json"))) {echo "Installed beta version= " . file_get_contents(base_path("vbeta.json"));} else {echo "Installed beta version= none";}  ?></p>
        <p><?php  if($Vgit > $Vlocal) {echo "You need to update to the latest mainline release";} else {echo "You're running the latest mainline release";}  ?></p>
        @else
        <h4 class="">The update was successful, you can now return to the Admin Panel:</h4>
        @endif
        <br><div class="row">
        &ensp;<a class="btn" href="{{ route('studioIndex') }}"><button><i class="fa-solid fa-house-laptop btn"></i> Admin Panel</button></a>&ensp;

        @if(env('JOIN_BETA') === true)
        &ensp;<a class="btn" href="{{url()->current()}}/"><button><i class="fa-solid fa-arrow-rotate-right btn"></i> Run again</button></a>&ensp;
        @endif
        </div>
      
@endif

@if($_SERVER['QUERY_STRING'] === 'error')
      <?php //on error ?>
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo">
           <div class="logo-centered">l</div>
        </div>
        <h1>Error</h1>
        <h4 class="">Something went wrong with the update :(</h4>
        <br><div class="row">
        &ensp;<a class="btn" href="{{ route('studioIndex') }}"><button><i class="fa-solid fa-house-laptop btn"></i> Admin Panel</button></a>&ensp;
        </div>
      
@endif

</div>
@endpush
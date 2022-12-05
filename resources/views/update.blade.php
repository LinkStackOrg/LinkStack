@extends('layouts.updater')

@Push('updater-body')
<div class="container">

<?php // Requests newest version from server and sets it as variable
			   		$Vgit = file_get_contents("https://version.littlelink-custom.com/");

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
        @if(env('JOIN_BETA') === true)
        <p><?php echo "latest beta version= " . file_get_contents("https://update.littlelink-custom.com/beta/vbeta.json"); ?></p>
        <p><?php  if(file_exists(base_path("vbeta.json"))) {echo "Installed beta version= " . file_get_contents(base_path("vbeta.json"));} else {echo "Installed beta version= none";}  ?></p>
        <p><?php  if($Vgit > $Vlocal) {echo "You need to update to the latest mainline release";} else {echo "You're running the latest mainline release";}  ?></p>
        @else
        <h4 class="">You can update your installation automatically or download the update and install it manually:</h4>
        <h5 class="">Windows users can use the alternative updater. This updater won't create a backup. Use at your own discretion.</h5>
        @endif
        <br><div class="row">
        &ensp;<a class="btn" href="{{url()->current()}}/?updating-windows"><button><i class="fa-solid fa-user-gear btn"></i> Update automatically</button></a>&ensp;
        &ensp;<a class="btn" href="https://littlelink-custom.com/update" target="_blank"><button><i class="fa-solid fa-download btn"></i> Update manually</button></a>&ensp;
        </div>
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
            &ensp;<a class="btn" href="{{url()->current()}}/?preparing"><button><i class="fa-solid fa-user-gear btn"></i> Update automatically</button></a>&ensp;
            @else
            &ensp;<a class="btn" href="{{url()->current()}}/?backup"><button><i class="fa-solid fa-user-gear btn"></i> Update automatically</button></a>&ensp;
            @endif
        &ensp;<a class="btn" href="https://littlelink-custom.com/update" target="_blank"><button><i class="fa-solid fa-download btn"></i> Update manually</button></a>&ensp;
        </div>
        @endif
      
@endif


@if($_SERVER['QUERY_STRING'] === 'updating-windows' and strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
<?php //updating on Windows ?>
        <div class="logo-container fadein">
           <img class="logo-img loading" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo">
           <div class="logo-centered">l</div>
        </div>
        <h1 class="loadingtxt">Updating</h1>
        @Push('updater-head')
         <meta http-equiv="refresh" content="2; URL={{url()->current()}}/?preparing" />
        @endpush
@endif

@if($_SERVER['QUERY_STRING'] === 'updating-windows-bat' and strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
<?php //updating on Windows ?>
<?php


// Download the zip file

$latestversion = trim(file_get_contents("https://version.littlelink-custom.com/"));

if(env('JOIN_BETA') === true){
   $fileUrl = 'https://update.littlelink-custom.com/beta/'. $latestversion . '.zip';
} else {
   $fileUrl = 'https://update.littlelink-custom.com/'. $latestversion . '.zip';
}

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $fileUrl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($curl);
curl_close($curl);

file_put_contents(base_path('storage/update.zip'), $result);


$zip = new ZipArchive;
$zip->open(base_path() . '/storage/update.zip');
$zip->extractTo(base_path());
$zip->close();
unlink(base_path() . '/storage/update.zip');

echo "<meta http-equiv=\"refresh\" content=\"0; " . url()->current() . "/?finishing\" />";

?>


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
header("Location: ".$URL."?preparing");
exit(); ?>
@endif

@if($_SERVER['QUERY_STRING'] === 'preparing')
<?php //preparing update ?>
        <div class="logo-container fadein">
           <img class="logo-img loading" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo">
           <div class="logo-centered">l</div>
        </div>
        <h1 class="loadingtxt">Preparing update</h1>
        
        <?php // Get update preperation script from GitHub
        try {
        $file = file_get_contents('https://pre-update.littlelink-custom.com');
        $newfile = base_path('resources/views/components/pre-update.blade.php');
        file_put_contents($newfile, $file);
        } catch (exception $e) {}
        ?>
        
        @include('components.pre-update')
        
   @if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
        <meta http-equiv="refresh" content="2; URL={{url()->current()}}/?updating-windows-bat" />
   @else
        <?php echo "<meta http-equiv=\"refresh\" content=\"1; " . url()->current() . "?updating\" />" ?>
   @endif
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
<?php 
$debug = NULL;
if(EnvEditor::getKey('APP_DEBUG') == 'false'){
   if(EnvEditor::keyExists('APP_DEBUG')){EnvEditor::editKey('APP_DEBUG', 'true');}
   if(EnvEditor::keyExists('APP_ENV')){EnvEditor::editKey('APP_ENV', 'local');}
   if(EnvEditor::keyExists('LOG_LEVEL')){EnvEditor::editKey('LOG_LEVEL', 'debug');}
   $debug = true;
}
?>
        <div class="logo-container fadein">
           <img class="logo-img loading" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo">
           <div class="logo-centered">l</div>
        </div>
        <h1 class="loadingtxt">Finishing up</h1>
        
        @include('components.finishing')
        
        <?php if(file_exists(base_path("storage/MAINTENANCE"))){unlink(base_path("storage/MAINTENANCE"));} ?>
<?php 
if($debug === true){
   if(EnvEditor::keyExists('APP_DEBUG')){EnvEditor::editKey('APP_DEBUG', 'false');}
   if(EnvEditor::keyExists('APP_ENV')){EnvEditor::editKey('APP_ENV', 'production');}
   if(EnvEditor::keyExists('LOG_LEVEL')){EnvEditor::editKey('LOG_LEVEL', 'error');}
}
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
        <h4 class="">The update was successful, you can now return to the Admin Panel.</h4>
        <style>.noteslink:hover{color:#006fd5;text-shadow:0px 6px 7px rgba(23,10,6,0.66);}</style>
        <a class="noteslink" href="https://github.com/JulianPrieber/littlelink-custom/releases/latest" target="_blank"><i class="fa-solid fa-up-right-from-square"></i> View the release notes</a>
        <br>
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
        
        <?php if(file_exists(base_path("storage/MAINTENANCE"))){unlink(base_path("storage/MAINTENANCE"));} ?>

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

@if("8" > phpversion()) <br><br><a style="background-color:tomato;color:#fff;border-radius:5px;" class="nav-link" href="{{ url('/studio/profile') }}" target=""><i class="bi bi-exclamation-circle-fill"></i> <strong>You are using an outdated version of PHP! Official support for this version will end soon.</strong></a> @endif

</div>
@endpush
@extends('layouts.updater')

@Push('updater-body')
<div class="container">

<?php // Requests newest version from server and sets it as variable
			   		$Vgit = external_file_get_contents("https://version.linkstack.org/");

				       // Requests current version from the local version file and sets it as variable
                  $Vlocal = file_get_contents(base_path("version.json"));
					?>
@if(auth()->user()->role == 'admin' and $Vgit > $Vlocal or env('JOIN_BETA') === true)

@if($_SERVER['QUERY_STRING'] === '')
<?php //landing page ?>
        
        <div class="logo-container fadein">
<img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>{{__('messages.Updater')}}</h1>
        @if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
        @if(env('JOIN_BETA') === true)
        <p><?php echo __('messages.Latest beta version')."= " . external_file_get_contents("https://beta.linkstack.org/vbeta.json"); ?></p>
        <p><?php  if(file_exists(base_path("vbeta.json"))) {echo __('messages.Installed beta version')."= " . file_get_contents(base_path("vbeta.json"));} else {echo __('messages.Installed beta version')."= ".__('messages.none');}  ?></p>
        <p><?php  if($Vgit > $Vlocal) {echo __('messages.You need to update to the latest mainline release');} else {echo __("messages.You’re running the latest mainline release");}  ?></p>
        @else
        <h4>{{__('messages.update.manually')}}</h4>
        <h5>{{__('messages.update.windows')}}</h5>
        @endif
        <br><div class="row">
        &ensp;<a class="btn" href="{{url()->current()}}/?updating-windows"><button><i class="fa-solid fa-user-gear btn"></i> {{__('messages.Update automatically')}}</button></a>&ensp;
        &ensp;<a class="btn" href="https://linkstack.org/update" target="_blank"><button><i class="fa-solid fa-download btn"></i> {{__('messages.Update manually')}}</button></a>&ensp;
        </div>
        @else
        @if(env('JOIN_BETA') === true)
        <p><?php echo __('messages.Latest beta version')."= " . external_file_get_contents("https://beta.linkstack.org/vbeta.json"); ?></p>
        <p><?php  if(file_exists(base_path("vbeta.json"))) {echo __('messages.Installed beta version')."= " . file_get_contents(base_path("vbeta.json"));} else {echo __('messages.Installed beta version')."= ".__('messages.none');}  ?></p>
        <p><?php  if($Vgit > $Vlocal) {echo __('messages.You need to update to the latest mainline release');} else {echo __("messages.You’re running the latest mainline release");}  ?></p>
        @else
        <a target="_blank" href="https://github.com/linkstackorg/linkstack/releases"><code style="color:#222;transform:scale(.9);">{{$Vlocal}} -> {{$Vgit}}</code></a>
        <h4>{{__('messages.update.manually')}}</h4>
        @endif
        <br><div class="row">
            @if(env('SKIP_UPDATE_BACKUP') == true)
            &ensp;<a class="btn" href="{{url()->current()}}/?preparing"><button><i class="fa-solid fa-user-gear btn"></i> {{__('messages.Update automatically')}}</button></a>&ensp;
            @else
            &ensp;<a class="btn" href="{{url()->current()}}/?backup"><button><i class="fa-solid fa-user-gear btn"></i> {{__('messages.Update automatically')}}</button></a>&ensp;
            @endif
        &ensp;<a class="btn" href="https://linkstack.org/update" target="_blank"><button><i class="fa-solid fa-download btn"></i> {{__('messages.Update manually')}}</button></a>&ensp;
        </div>
        @endif
      
@endif


@if($_SERVER['QUERY_STRING'] === 'updating-windows' and strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
<?php //updating on Windows ?>
        <div class="logo-container fadein">
<img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
        </div>
        <h1 class="loadingtxt">{{__('messages.Updating')}}</h1>
        @Push('updater-head')
         <meta http-equiv="refresh" content="2; URL={{url()->current()}}/?preparing" />
        @endpush
@endif

@if($_SERVER['QUERY_STRING'] === 'updating-windows-bat' and strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
<?php //updating on Windows ?>
<?php


// Download the zip file

$latestversion = trim(external_file_get_contents("https://version.linkstack.org/"));

if(env('JOIN_BETA') === true){
   $fileUrl = 'https://beta.linkstack.org/'. $latestversion . '.zip';
} else {
   $fileUrl = 'https://update.linkstack.org/'. $latestversion . '.zip';
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
<img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
        </div>
        <h1 class="loadingtxt">{{__('messages.Creating backup')}}</h1>
@endif

@if($_SERVER['QUERY_STRING'] === 'backups')
<?php
try {Artisan::call('backup:clean');}
catch (exception $e) {}
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
<img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
        </div>
        <h1 class="loadingtxt">{{__('messages.Preparing update')}}</h1>
        
        <?php // Get update preperation script from GitHub
        try {
        $file = external_file_get_contents('https://pre-update.linkstack.org');
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
<img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
        </div>
        <h1 class="loadingtxt">{{__('messages.Updating')}}</h1>
        @Push('updater-head')
         <meta http-equiv="refresh" content="2; URL={{url()->current()}}/../updating" />
         @endpush
@endif

@elseif($_SERVER['QUERY_STRING'] === '')
      <?php //if no new version available ?>
        
        <div class="logo-container fadein">
<img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>{{__('messages.No new version')}}</h1>
        <h4>{{__('messages.There is no new version available')}}</h4>
        <br><div class="row">
        &ensp;<a class="btn" href="{{ url('dashboard') }}"><button><i class="fa-solid fa-house-laptop btn"></i> {{__('messages.Admin Panel')}}</button></a>&ensp;
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
<img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
        </div>
        <h1 class="loadingtxt">{{__('messages.Finishing up')}}</h1>
        
        @include('components.finishing')
        
        <?php EnvEditor::editKey('MAINTENANCE_MODE', false); ?>
<?php 
if($debug === true){
   if(EnvEditor::keyExists('APP_DEBUG')){EnvEditor::editKey('APP_DEBUG', 'false');}
   if(EnvEditor::keyExists('APP_ENV')){EnvEditor::editKey('APP_ENV', 'production');}
   if(EnvEditor::keyExists('LOG_LEVEL')){EnvEditor::editKey('LOG_LEVEL', 'error');}
}
?>

<?php echo "<meta http-equiv=\"refresh\" content=\"0; " . url()->current() . "?success\" />"; ?>
@endif

@if($_SERVER['QUERY_STRING'] === 'success')
      <?php //after successfully updating ?>
        
        <div class="logo-container fadein">
<img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>{{__('messages.Success!')}}</h1>
        @if(env('JOIN_BETA') === true)
        <p><?php echo __('messages.Latest beta version')."= " . external_file_get_contents("https://beta.linkstack.org/vbeta.json"); ?></p>
        <p><?php  if(file_exists(base_path("vbeta.json"))) {echo __('messages.Installed beta version')."= " . file_get_contents(base_path("vbeta.json"));} else {echo __('messages.Installed beta version')."= ".__('messages.none');}  ?></p>
        <p><?php  if($Vgit > $Vlocal) {echo __('messages.You need to update to the latest mainline release');} else {echo __("messages.You’re running the latest mainline release");}  ?></p>
        @else
        <h4>{{__('messages.The update was successful')}}</h4>
        <style>.noteslink:hover{color:#006fd5;text-shadow:0px 6px 7px rgba(23,10,6,0.66);}</style>
        <a class="noteslink" href="https://github.com/linkstackorg/linkstack/releases/latest" target="_blank"><i class="fa-solid fa-up-right-from-square"></i> {{__('messages.View the release notes')}}</a>
        <br>
        @endif
        <br><div class="row">
        &ensp;<a class="btn" href="{{ url('dashboard') }}"><button><i class="fa-solid fa-house-laptop btn"></i> {{__('messages.Admin Panel')}}</button></a>&ensp;

        @if(env('JOIN_BETA') === true)
        &ensp;<a class="btn" href="{{url()->current()}}/"><button><i class="fa-solid fa-arrow-rotate-right btn"></i> {{__('messages.Run again')}}</button></a>&ensp;
        @endif
        </div>
      
@endif

@if($_SERVER['QUERY_STRING'] === 'error')
      <?php //on error ?>
        
        <?php EnvEditor::editKey('MAINTENANCE_MODE', false); ?>

        <div class="logo-container fadein">
<img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>{{__('messages.Error')}}</h1>
        <h4>{{__('messages.Something went wrong with the update')}} :(</h4>
        <br><div class="row">
        &ensp;<a class="btn" href="{{ url('dashboard') }}"><button><i class="fa-solid fa-house-laptop btn"></i> {{__('messages.Admin Panel')}}</button></a>&ensp;
        </div>
      
@endif

</div>
@endpush
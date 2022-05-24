
@extends('layouts.updater')

@Push('updater-body')

@if($_SERVER['QUERY_STRING'] === 'updating')
<?php //updating... ?>
        <div class="logo-container fadein">
           <img class="logo-img loading" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo" style="">
           <div class="logo-centered">l</div>
        </div>
        <center><h1 class="loadingtxt">Updating</h1></center>
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
header("Location: /?backup-created");
exit(); ?>
@endif

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


@if($_SERVER['QUERY_STRING'] === 'backup-created')
      <?php //download backup ?>
        <style>.logo-container{padding-top:23vh;}.logo-centered{top:37vh;}</style>
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo" style="">
           <div class="logo-centered">l</div>
        </div>
        <center><h1>Download backup</h1>
        <h4 class="">You can keep the update stored on the server or download it as a precaution:</h4>
        <br><div class="row">
        &ensp;<button style=""><i class="fa-solid fa-play btn"></i><a class="btn" href="{{url()->current()}}/?updating"> Start anyway</a></button>&ensp;
        &ensp;<button style=""><i class="fa-solid fa-file-export btn"></i><a class="btn" href="{{url()->current()}}/?updating"> Start and download</a></button>&ensp;
        </div>
      </center>
@endif


@if($_SERVER['QUERY_STRING'] === 'success')
      <?php //download backup ?>
        <style>.logo-container{padding-top:23vh;}.logo-centered{top:37vh;}</style>
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo" style="">
           <div class="logo-centered">l</div>
        </div>
        <center><h1>Download backup</h1>
        <h4 class="">The update was successful, you can now return to the Admin Panel:</h4>
        <br><div class="row">
        &ensp;<button style=""><i class="fa-solid fa-house-laptop btn"></i><a class="btn" href="{{url()->current()}}/"> Admin Panel</a></button>&ensp;
        </div>
      </center>
@endif


@if($_SERVER['QUERY_STRING'] === 'error')
      <?php //download backup ?>
        <style>.logo-container{padding-top:23vh;}.logo-centered{top:37vh;}</style>
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo" style="">
           <div class="logo-centered">l</div>
        </div>
        <center><h1>Something went wrong</h1>
        <h4 class="">Something went wrong during the update process, you can try again or update manually:</h4>
        <br><div class="row">
        &ensp;<button style=""><i class="fa-solid fa-user-gear btn"></i><a class="btn" href="{{url()->current()}}/?backup"> Try again</a></button>&ensp;
        &ensp;<button style=""><i class="fa-solid fa-download btn"></i><a class="btn" href="https://littlelink-custom.com/how-to-update"> Update manually</a></button>&ensp;
        </div>
      </center>
@endif


@endpush
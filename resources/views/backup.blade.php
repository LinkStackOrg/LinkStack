<title>{{__('messages.Backup.title')}}</title>
@extends('layouts.updater')

@Push('updater-body')
<div class="container">


@if($_SERVER['QUERY_STRING'] === '')
<?php //landing page ?>
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
           <div class="logo-centered">l</div>
        </div>
        <h1>{{__('messages.Backup')}}</h1>
        <h4 class="">{{__('messages.You can back up your entire instance:')}}</h4>
        <h5 class="">{{__('messages.The backup system won’t save more than two backups at a time')}}</h5>
        <br><div class="row">
        &ensp;<a class="btn" href="{{url()->current()}}/?backup"><button><i class="fa-solid fa-floppy-disk"></i> {{__('messages.Backup Instance')}}</button></a>&ensp;
        &ensp;<a class="btn" href="{{ route('showBackups') }}"><button><i class="fa-solid fa-box-archive"></i> {{__('messages.All Backups')}}</button></a>&ensp;
        </div>
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
Artisan::call('backup:run', ['--only-files' => true, '--disable-notifications' => true]);
$tst = base_path('backups/');
file_put_contents($tst.'CANUPDATE', '');
$URL = Route::current()->getName();   
header("Location: ".$URL."?success");
exit(); ?>
@endif

@if($_SERVER['QUERY_STRING'] === 'success')
      <?php //after successfully updating ?>
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>{{__('messages.Success!')}}</h1>
        <h4 class="">{{__('messages.The backup was successful')}}</h4>
        <br><div class="row">
        &ensp;<a class="btn" href="{{ url('dashboard') }}"><button><i class="fa-solid fa-house-laptop btn"></i> {{__('messages.Admin Panel')}}</button></a>&ensp;
        &ensp;<a class="btn" href="{{ url('admin/config#4') }}"><button><i class="fa-solid fa-box-archive"></i> {{__('messages.All Backups')}}</button></a>&ensp;
        </div>
@endif

</div>
@endpush
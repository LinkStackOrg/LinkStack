<?php
$pages = DB::table('pages')->get();
foreach($pages as $page)
{
	//Gets value from database
}
?>

<x-guest-layout>
@include('layouts.lang')

    <x-auth-card>
        <x-slot name="logo"></x-slot>

        <div class="container mt-5 w-75">
            <div style="max-width:480px" class="container mt-5 w-100">
              <a href="{{ url('') }}" class="d-flex align-items-center mb-3">
                <!--Logo start-->
                <div class="logo-main">
                    @if(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))
                    <div class="logo-normal">
                      <img class="img logo" src="{{ asset('assets/linkstack/images/'.findFile('avatar')) }}" style="width:auto;height:30px;">
                  </div>
                  <div class="logo-mini">
                    <img class="img logo" src="{{ asset('assets/linkstack/images/'.findFile('avatar')) }}" style="width:auto;height:30px;">
                  </div>
                    @else
                    <div class="logo-normal">
                      <img class="img logo" type="image/svg+xml" src="{{ asset('assets/linkstack/images/logo.svg') }}" width="30px" height="30px">
                  </div>
                  <div class="logo-mini">
                    <img class="img logo" type="image/svg+xml" src="{{ asset('assets/linkstack/images/logo.svg') }}" width="30px" height="30px">
                  </div>
                    @endif
                    </div>
                    <!--logo End-->
                <h4 class="logo-title ms-3">{{env('APP_NAME')}}</h4>
              </a>
              <h2 class="mb-2 text-center">{{__('messages.Forgot your password?')}}</h2>
              <p class="text-center">{{__('messages.No problem')}}</p>
              <form method="POST" action="{{ route('password.email') }}" class="row">
                @csrf
            
        <!-- Session Status -->
        <x-auth-session-status class="mb-0 alert alert-warning pb-2" role="success" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-0 alert alert-danger pb-2" role="alert" :errors="$errors" />

                <!-- Email Address -->
                <div class="col-lg-12 form-group pb-2">
                    <label for="email" class="form-label">{{__('messages.Email')}}</label>
            
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder=" " required autofocus />
                </div>
            
                <div class="col-lg-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{__('messages.Email Password Reset Link')}}</button>
                </div>
            </form>
            </div>
          </div>            

    </x-auth-card>
</x-guest-layout>

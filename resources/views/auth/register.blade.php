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

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="container mt-5 w-100">
          <div class="card p-5">
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
              <h2 class="mb-2 text-center">{{__('messages.Sign Up')}}</h2>
              <p class="text-center">{{__('messages.Register to stay connected')}}.</p>
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="name" class="form-label">{{__('messages.Display Name')}}</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder=" " :value="old('name')" required autofocus >
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="littlelink_name" class="form-label">{{__('messages.Page URL')}}</label>
                        <div class="input-group mb-3 has-validation">
                          <span class="input-group-text" id="basic-addon3">{{str_replace(['http://', 'https://'], '', url(''))}}/@</span>
                          <input type="littlelink_name" class="form-control" id="littlelink_name" name="littlelink_name" aria-describedby="littlelink_name" placeholder=" " :value="old('littlelink_name')" required autofocus >
                        </div>
                      </div>
                    </div>
                    @include('auth.url-validation')           
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="email" class="form-label">{{__('messages.Email')}}</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder=" " :value="old('email')" required autofocus >
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="password" class="form-label">{{__('messages.Password')}}</label>
                        <input type="password" class="form-control" id="password" aria-describedby="password" placeholder=" " name="password" required autocomplete="new-password" />
                      </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-between">
                      <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                        <label class="form-check-label" for="remember_me">{{__('messages.Remember Me')}}</label>
                      </div>
                    </div>
                  </div>                  
                <div class="d-flex justify-content-center">
                  <button id="submit-btn" type="submit" class="btn btn-primary">{{__('messages.Sign Up')}}</button>
                </div>
                @if(env('ENABLE_SOCIAL_LOGIN') == 'true')
                <p class="text-center my-3">{{__('messages.or sign in with other accounts?')}}</p>
                <div class="d-flex justify-content-center">
                  <ul class="list-group list-group-horizontal list-group-flush">
                    @if(!empty(env('FACEBOOK_CLIENT_ID')))
                    <li class="list-group-item border-0 pb-0">
                      <a href="{{ route('social.redirect','facebook') }}">
                        <i class="bi bi-facebook"></i>
                      </a>
                    </li>
                    @endif
                    @if(!empty(env('TWITTER_CLIENT_ID')))
                    <li class="list-group-item border-0 pb-0">
                      <a href="{{ route('social.redirect','twitter') }}">
                        <i class="bi bi-twitter"></i>
                      </a>
                    </li>
                    @endif
                    @if(!empty(env('GOOGLE_CLIENT_ID')))
                    <li class="list-group-item border-0 pb-0">
                      <a href="{{ route('social.redirect','google') }}">
                        <i class="bi bi-google"></i>
                      </a>
                    </li>
                    @endif
                    @if(!empty(env('GITHUB_CLIENT_ID')))
                    <li class="list-group-item border-0 pb-0">
                      <a href="{{ route('social.redirect','github') }}">
                        <i class="bi bi-github"></i>
                      </a>
                    </li>
                    @endif
                  </ul>
                </div>
                @else
                <br>
                @endif
                <p class="mt-3 text-center">
                  {{__('messages.Already have an account?')}} <a href="{{ route('login') }}" class="text-underline">{{__('messages.Click here to sign in')}}.</a>
                </p>
              </form>
            </div>
          </div>          

    </x-auth-card>
</x-guest-layout>

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

        <div style="max-width:480px" class="container mt-5 w-100">
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
              <h2 class="mb-2 text-center">{{__('messages.Sign In')}}</h2>
              <p class="text-center">{{__('messages.Login to stay connected')}}.</p>
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="email" class="form-label">{{__('messages.Email')}}</label>
                      <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder=" " :value="old('email')" required autofocus >
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="password" class="form-label">{{__('messages.Password')}}</label>
                      <input type="password" class="form-control" id="password" aria-describedby="password" placeholder=" " name="password" required autocomplete="current-password" />
                    </div>
                  </div>
                  <div class="col-lg-12 d-flex justify-content-between">
                    <div class="form-check mb-3">
                      <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                      <label class="form-check-label" for="remember_me">{{__('messages.Remember Me')}}</label>
                    </div>
                    <a href="{{ route('password.request') }}">{{__('messages.Forgot Password?')}}</a>
                  </div>
                </div>
                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">{{__('messages.Sign In')}}</button>
                </div>
                @if(env('ENABLE_SOCIAL_LOGIN') == 'true')
                @php($oidcName = config('services.openidconnect.display_name'))
                @php($oidcEnabled = !empty(config('services.openidconnect.client_id')))
                @php($oidcIcon = config('services.openidconnect.icon'))
                @php($ssoText = __('messages.Sign in with :provider', ['provider' => $oidcName]))
                @php($otherProviders = !empty(env('FACEBOOK_CLIENT_ID')) || !empty(env('TWITTER_CLIENT_ID'))
                    || !empty(env('GOOGLE_CLIENT_ID')) || !empty(env('GITHUB_CLIENT_ID')))
                {{-- A named provider is a sign-in route in its own right, so it sits with the
                     submit button above and mirrors it exactly — same wrapper, centred and
                     auto-width, same theme colour and hover — rather than becoming one more
                     icon in the row below. --}}
                @if($oidcEnabled)
                {{-- Separates the password form from the provider, which otherwise sit flush
                     against each other. --}}
                <div class="d-flex align-items-center my-3">
                  <hr class="flex-grow-1 m-0">
                  <span class="px-3 text-muted small">{{ __('messages.or') }}</span>
                  <hr class="flex-grow-1 m-0">
                </div>
                <div class="d-flex justify-content-center my-3">
                  <a href="{{ route('social.redirect','openidconnect') }}"
                     class="btn btn-primary" aria-label="{{ $ssoText }}">
                    @if(!empty($oidcIcon))<i class="bi {{ $oidcIcon }} me-1"></i>@endif{{ $ssoText }}
                  </a>
                </div>
                @endif
                {{-- The heading introduces the icon row, so it appears only when that row has
                     something in it: an instance with single sign-on alone should not be
                     offered "other accounts" that do not exist. --}}
                @if($otherProviders)
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
                @endif
                @else
                <br>
                @endif
                @if ((env('ALLOW_REGISTRATION')) and !config('linkstack.single_user_mode'))
                <p class="mt-3 text-center">
                  {{__('messages.Don’t have an account?')}} <a href="{{ route('register') }}" class="text-underline">{{__('messages.Click here to sign up')}}.</a>
                </p>
                @endif
              </form>
            </div>
          </div>          

    </x-auth-card>
</x-guest-layout>

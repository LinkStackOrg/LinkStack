<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo"></a>
        </x-slot>

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
              <h2 class="mb-2 text-center">{{__('messages.Reset Password')}}</h2>
              <p class="text-center">{{__('messages.Enter a new password')}}</p>
              <form method="POST" action="{{ route('password.update') }}">
                @csrf
            
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
            
                <div class="row">
                    <!-- Email Address -->
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('messages.Email') }}</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus>
                        </div>
                    </div>
            
                    <!-- Password -->
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('messages.Password') }}</label>
                            <input id="password" class="form-control" type="password" name="password" required>
                        </div>
                    </div>
            
                    <!-- Confirm Password -->
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">{{ __('messages.Confirm Password') }}</label>
                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
                        </div>
                    </div>
            
                    <!-- Remember Me Checkbox -->
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="form-check mb-3">
                            <input id="remember_me" class="form-check-input" type="checkbox" name="remember">
                            <label for="remember_me" class="form-check-label">{{ __('messages.Remember Me') }}</label>
                        </div>
                        <a href="{{ route('password.request') }}">{{ __('messages.Forgot Password?') }}</a>
                    </div>
            
                    <!-- Reset Password Button -->
                    <div class="col-lg-12 d-flex justify-content-end">
                        <button class="btn btn-primary">{{ __('messages.Reset Password') }}</button>
                    </div>
                </div>
            </form>
            </div>
          </div>       
        
    </x-auth-card>
</x-guest-layout>

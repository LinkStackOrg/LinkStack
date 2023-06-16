<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
        </x-slot>

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
              <div class="mb-4 text-sm text-gray-600">
                {{__('messages.auth_thanks')}}
            </div>
    
            @if (session('status') == 'verification-link-sent')
                <div class="font-medium text-sm text-green-600">
                  {{__('messages.auth_verification')}}
                </div>
            @endif
    
            <div class="flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
    
                    <div>
                        <button type="submit" class="btn btn-gray mb-2">
                          {{__('messages.Resend Verification Email')}}
                        </button>
                    </div>
                </form>

                <hr style="border-top: 2px solid #6c757d;">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
    
                    <button type="submit" class="btn btn-primary mt-2">
                        {{ __('messages.Log out') }}
                    </button>
                </form>
            </div>
            </div>
          </div>          

    </x-auth-card>
</x-guest-layout>

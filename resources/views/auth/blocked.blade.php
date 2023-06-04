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
              <h2 class="mb-2 text-center mt-4">{{__('messages.Verification Status')}}</h2>
              <p class="text-center"><b>{{__('messages.auth_pending')}}</b></p>
              <p class="text-center mb-4">{{__('messages.auth_unverified')}}</p>

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

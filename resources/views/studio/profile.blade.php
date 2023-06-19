@extends('layouts.sidebar')

@section('content')

<div class="conatiner-fluid content-inner mt-n5 py-0">
  <div class="row">   
      
   <div class="col-lg-12">
      <div class="card   rounded">
          <div class="card-body">
             <div class="row">
                 <div class="col-sm-12">  

                  @if(session()->has('success'))
                  <div class="alert alert-success">
                      {{ session()->get('success') }}
                  </div>
              @endif
              
              @if(session()->has('error'))
                  <div class="alert alert-danger">
                      {{ session()->get('error') }}
                  </div>
              @endif
              
              @if($_SERVER['QUERY_STRING'] === '')
              <section class="text-gray-400">
                      <h3 class="mb-4 card-header"><i class="bi bi-person">{{__('messages.Account Settings')}}</i></h3>
              <div class="card-body p-0 p-md-3">
              
                      @foreach($profile as $profile)
              
              @if(env('REGISTER_AUTH') != 'verified' or auth()->user()->role == 'admin')
                      <form  action="{{ route('editProfile') }}" method="post">
                      @csrf
                        <div class="form-group col-lg-8">
                          <h4>Email</h4>
                          <input type="email" class="form-control" name="email" value="{{ $profile->email }}" required>
                        </div>
                        <button type="Change " class="mt-3 ml-3 btn btn-primary">{{__('messages.Change email')}}</button>
                      </form>
              @endif
              
              <br><br><form  action="{{ route('editProfile') }}" method="post">
                @csrf
                  <div class="form-group col-lg-8">
                    <h4>{{__('messages.Password')}}</h4>
                    <input type="password" name="password" class="form-control" placeholder="At least 8 characters" required>
                  </div>
                  <button type="Change " class="mt-3 ml-3 btn btn-primary">{{__('messages.Change password')}}</button>
                </form>
              
                @csrf
                  <br><br><div class="form-group col-lg-8">
                    <h4>Role</h4>
                    <input type="text" class="form-control" value="{{ strtoupper($profile->role) }}" readonly>
                  </div>
              
              @if(env('ALLOW_USER_EXPORT') != false)
              <div class="mt-3"><br><br><br>
                <h4>{{__('messages.Export user data')}}</h4>
                <p>{{__('messages.Export your user data')}}</p>
                <div class="row">
                  <div class="col-lg-8">
                    <button class="btn btn-outline-secondary">
                      <a href="{{ route('exportAll') }}">
                        <i class="bi bi-layer-backward"></i> {{__('messages.Export all data')}}
                      </a>
                    </button>
                    <button class="btn btn-outline-secondary">
                      <a href="{{ route('exportLinks') }}">
                        <i class="bi bi-layer-backward"></i> {{__('messages.Export links only')}}
                      </a>
                    </button>
                  </div>
                </div>
              </div>
              @endif
              
              @if(env('ALLOW_USER_IMPORT') != false)
              <form action="{{ route('importData') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group col-lg-8"><br><br><br>
                  <h4>{{__('messages.Import user data')}}</h4>
                    <label>{{__('messages.Import your user data from another instance')}}</label>
                    <input type="file" accept="application/JSON" class="form-control" id="customFile" name="import">
                </div>
              
                <button type="submit" class="mt-3 ml-3 btn btn-primary" onclick="return confirm('{{__('messages.import.user.alert')}}')">{{__('messages.Import')}}</button>
              </form>
              @endif
              
              <br>
              
                        <br><button class="btn btn-danger"><a
                            href="{{ url('/studio/profile/?delete') }}" style="color:#FFFFFF;"><i class="bi bi-exclamation-octagon-fill"></i>
                            {{__('messages.Delete your account')}}</a></button>
                        </div>
              </section>
                        @endforeach
              @endif
              
              @if($_SERVER['QUERY_STRING'] === 'delete')
              <div class="d-flex justify-content-center align-items-center" style="height:100vh;">
                <div class="text-center">
                  <h2 class="text-decoration-underline">{{__('messages.You are about to delete')}}</h2>
                  <p>{{__('messages.You are about to delete This action cannot be undone')}}</p>
                  <div>
                    <button class="redButton btn btn-danger" style="filter: grayscale(100%);" disabled onclick="window.location.href = '{{ url('/studio/delete-user/') . "/" . Auth::id() }}';"><i class="bi bi-exclamation-diamond-fill"></i></button>
                    <button type="submit" class="btn btn-primary"><a style="color:#fff;" href="{{ url('/studio/profile') }}">{{__('messages.Cancel')}}</a></button>
                  </div>
                </div>
              </div>
              
              <script>
              var seconds = 10;
              var interval = setInterval(function() {
                document.querySelector(".redButton").innerHTML = --seconds;
              
                if (seconds <= 0)
                  clearInterval(interval);
              }, 1000);
              
              setTimeout(function(){
                document.querySelector(".redButton").disabled = false;
                document.querySelector(".redButton").innerHTML = '{{__('messages.Delete account')}}';
                document.querySelector(".redButton").style.filter = "none";
              }, 10000);
              </script>

              @endif

                 </div>
             </div>
          </div>
       </div>
      </div>
    </div>
  </div>

@endsection

@extends('layouts.sidebar')

@section('content')

@if($_SERVER['QUERY_STRING'] === '')
<section class="shadow text-gray-400">
        <h3 class="mb-4 card-header"><i class="bi bi-person"> Account Settings</i></h3>
<div class="card-body p-0 p-md-3">

        @foreach($profile as $profile)

        {{-- <form  action="{{ route('editProfile') }}" method="post">
        @csrf
          <div class="form-group col-lg-8">
            <h3>Name</h3>
            <input type="text" class="form-control" name="name" value="{{ $profile->name }}" required>
          </div>
          <button type="Change " class="mt-3 ml-3 btn btn-info">Change name</button>
        </form><br><br> --}}

@if(env('REGISTER_AUTH') != 'verified' or auth()->user()->role == 'admin')
        <form  action="{{ route('editProfile') }}" method="post">
        @csrf
          <div class="form-group col-lg-8">
            <h4>Email</h4>
            <input type="email" class="form-control" name="email" value="{{ $profile->email }}" required>
          </div>
          <button type="Change " class="mt-3 ml-3 btn btn-info">Change email</button>
        </form>
@endif

        <br><br><form  action="{{ route('editProfile') }}" method="post">
        @csrf
          <div class="form-group col-lg-8">
            <h4>Password</h4>
            <input type="password" name="password" class="form-control" placeholder="At least 8 characters" required>
          </div>
          <button type="Change " class="mt-3 ml-3 btn btn-info">Change password</button>
        </form>
		
        @csrf
          <br><br><div class="form-group col-lg-8">
            <h4>Role</h4>
            <input type="text" class="form-control" value="{{ strtoupper($profile->role) }}" readonly>
          </div>
          <br><button class="mt-3 ml-3 btn btn-primary" style="margin-bottom:2rem;margin-top:2rem!important;background-color:tomato!important;border-color:tomato!important;"><a href="{{ url('/studio/profile/?delete')}}" style="color:#FFFFFF;"><i class="bi bi-exclamation-octagon-fill"></i> Delete your account</a></button>
          </div>
</section>
          @endforeach
@endif


@if($_SERVER['QUERY_STRING'] === 'delete')
<center style="margin-top: 14%;">
    <h2 style="text-decoration: underline;">You are about to delete your account!</h2>
    <p>You are about to delete your account! This action cannot be undone.</p>
    <div>
        <button class="redButton mt-3 ml-3 btn btn-primary" style="width:10rem; background-color:tomato!important;border-color:tomato!important; filter: grayscale(100%);" disabled onclick="window.location.href = '{{ url('/studio/delete-user/') . "/" . Auth::id() }}';"><i class="bi bi-exclamation-diamond-fill"></i></button>
        <button type="submit" class="mt-3 ml-3 btn btn-info"><a style="color:#fff;" href="{{ url('/studio/profile') }}">Cancel</a></button>
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
  document.querySelector(".redButton").innerHTML = 'Delete account';
  document.querySelector(".redButton").style.filter = "none";
}, 10000);
</script>
</center>


@endif

@endsection

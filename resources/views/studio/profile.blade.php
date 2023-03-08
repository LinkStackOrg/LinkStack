@extends('layouts.sidebar')

@section('content')

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
<section class="shadow text-gray-400">
        <h3 class="mb-4 card-header"><i class="bi bi-person"> Account Settings</i></h3>
<div class="card-body p-0 p-md-3">

        @foreach($profile as $profile)

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

@if(env('ALLOW_USER_EXPORT') != false)
<br><br><br>
<div class="form-group col-lg-8">
<h4>Export user data</h4>
<label>Export your user data to transfer to a different instance.</label>
<div class="row">
<button class="mt-3 ml-3 btn btn-outline-secondary"><a href="{{ route('exportAll') }}" style="color:#fff;"><i class="bi bi-layer-backward"></i> Export all data</a></button>
<button class="mt-3 ml-3 btn btn-outline-secondary"><a href="{{ route('exportLinks') }}" style="color:#fff;"><i class="bi bi-layer-backward"></i> Export links only</a></button>
</div></div>
@endif

@if(env('ALLOW_USER_IMPORT') != false)
<form action="{{ route('importData') }}" enctype="multipart/form-data" method="post">
  @csrf
  <div class="form-group col-lg-8"><br><br><br>
    <h4>Import user data</h4>
      <label>Import your user data from another instance.</label>
      <input type="file" accept="application/JSON" class="form-control-file" name="import">
  </div>

  <button type="submit" class="mt-3 ml-3 btn btn-info" onclick="return confirm('Are you sure you want to import this file? This action will replace all your current data, including links!')">Import</button>
</form>
@endif

<br>

          <br><button class="mt-3 ml-3 btn btn-primary"
          style="margin-bottom:2rem;margin-top:2rem!important;background-color:tomato!important;border-color:tomato!important;"><a
              href="{{ url('/studio/profile/?delete') }}" style="color:#FFFFFF;"><i class="bi bi-exclamation-octagon-fill"></i>
              Delete your account</a></button>
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

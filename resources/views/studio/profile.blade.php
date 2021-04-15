@extends('layouts.sidebar')

@section('content')

        <h2 class="mb-4"><i class="bi bi-person"> Profile</i></h2>

        <form  action="{{ route('editProfile') }}" method="post">
        @csrf
        @foreach($profile as $profile)
          <div class="form-group col-lg-8">
            <label>name</label>
            <input type="text" class="form-control" name="name" value="{{ $profile->name }}">
          </div>
          <div class="form-group col-lg-8">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{ $profile->email }}">
          </div>
          <div class="form-group col-lg-8">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
          </div>
          <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
          @endforeach
        </form>

@endsection

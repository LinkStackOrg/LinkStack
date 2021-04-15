@extends('layouts.sidebar')

@section('content')

      <h2 class="mb-4"><i class="bi bi-person"> Edit User</i></h2>
      @foreach($user as $user)
      <form action="{{ route('editUser', $user->id) }}" enctype="multipart/form-data" method="post">
        @csrf
            <div class="form-group col-lg-8">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
          </div>
          <div class="form-group col-lg-8">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
          </div>
          <div class="form-group col-lg-8">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
          </div>
          <div class="form-group col-lg-8">
            <label>Logo</label>
            <input type="file" class="form-control-file" name="image">
          </div>
          <div class="form-group col-lg-8">
            <label>Littlelink name </label>
            <input type="text" class="form-control" name="littlelink_name" value="{{ $user->littlelink_name }}">
          </div>
          <div class="form-group col-lg-8">
            <label> Littlelink description</label>
            <textarea class="form-control" name="littlelink_description" rows="3">{{ $user->littlelink_description }}</textarea>
          </div>
          <div class="form-group col-lg-8">
            <label for="exampleFormControlSelect1">Role</label>
            <select class="form-control" name="role">
              <option>User</option>
              <option>Vip</option>
              <option>Admin</option>
            </select>
          </div>
          @endforeach
          <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
        </form>

@endsection

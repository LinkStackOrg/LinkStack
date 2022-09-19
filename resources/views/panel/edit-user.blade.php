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
            <input type="password" class="form-control" name="password" placeholder="Leave empty for no change">
          </div>
          
          <div class="form-group col-lg-8">
            <label>Logo</label>
            <input type="file" class="form-control-file" name="image">
          </div>
          
          <div class="form-group col-lg-8">
          @if(file_exists(base_path("img/$user->arcanelink_name" . ".png" )))
          <img src="{{ asset("img/$user->arcanelink_name" . ".png") }}" srcset="{{ asset("img/$user->arcanelink_name" . "@2x.png 2x") }}" width="128px" height="128px" style="object-fit: cover;">
          @elseif(file_exists(base_path("arcanelink/images/avatar.png" )))
          <img class="rounded-avatar" src="{{ asset('content/images/avatar.png') }}" srcset="{{ asset('content/images/avatar@2x.png 2x') }}" width="128px" height="128px" style="object-fit: cover;">
          @else
          <img src="{{ asset('content/images/arcanelink-logo.png') }}" srcset="{{ asset('content/images/avatar@2x.png 2x') }}" width="128px" height="128px" style="object-fit: cover;">
          @endif
          </div>
          
          <!--<div class="form-group col-lg-8">
            <label>Arcane Link name </label>
            <input type="text" class="form-control" name="arcanelink_name" value="{{ $user->arcanelink_name }}">
          </div>-->
          
          <div class="form-group col-lg-8">
            <label>Page URL</label>
	          <div class="input-group">
				  <div class="input-group-prepend">
					<div class="input-group-text">{{ url('') }}/@</div>
				  </div>
				  <input type="text" class="form-control" name="arcanelink_name" value="{{ $user->arcanelink_name }}">
			  </div>
		  </div>
          
          <div class="form-group col-lg-8">
            <label> Page description</label>
            <textarea class="form-control" name="arcanelink_description" rows="3">{{ $user->arcanelink_description }}</textarea>
          </div>
          <div class="form-group col-lg-8">
            <label for="exampleFormControlSelect1">Role</label>
            <select class="form-control" name="role">
              <option <?= ($user->role === strtolower('user')) ? 'selected' : '' ?>>user</option>
              <option <?= ($user->role === strtolower('vip')) ? 'selected' : '' ?>>vip</option>
              <option <?= ($user->role === strtolower('admin')) ? 'selected' : '' ?>>admin</option>
            </select>
          </div>
          @endforeach
          <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
        </form>

@endsection

@extends('layouts.sidebar')

@section('content')

<section class="shadow text-gray-400">
      <h2 class="mb-4 card-header"><i class="bi bi-person"> Edit User</i></h2>
        <div class="card-body p-0 p-md-3">

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
          @if(file_exists(base_path("img/" . $user->id . ".png")))
          <img src="{{ asset("img/" . $user->id . ".png") }}" srcset="{{ asset("img/$user->id" . "@2x.png 2x") }}" width="128px" height="128px" style="object-fit: cover;">
          @elseif(file_exists(base_path("littlelink/images/").findFile('avatar')))
          <img class="rounded-avatar" src="{{ asset('littlelink/images/'.findFile('avatar')) }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="128px" height="128px" style="object-fit: cover;">
          @else
          <img src="{{ asset('littlelink/images/logo.svg') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="128px" height="128px" style="object-fit: cover;">
          @endif
          @if(file_exists(base_path("img/" . $user->id . ".png")))<br><a title="Remove icon" class="hvr-grow p-1 text-danger" style="padding-left:5px;" href="?delete"><i class="bi bi-trash-fill"></i> Delete</a>@endif
          @if($_SERVER['QUERY_STRING'] === 'delete' and File::exists(base_path('img/' . $user->id . '.png')))@php File::delete(base_path('img/' . $user->id . '.png')); header("Location: ".url()->current()); die(); @endphp @endif
          </div>
          
          <!--<div class="form-group col-lg-8">
            <label>Littlelink name </label>
            <input type="text" class="form-control" name="littlelink_name" value="{{ $user->id }}">
          </div>-->
          
          <div class="form-group col-lg-8">
            <label>Page URL</label>
	          <div class="input-group">
				  <div class="input-group-prepend">
					<div class="input-group-text">{{ url('') }}/@</div>
				  </div>
				  <input type="text" class="form-control" name="littlelink_name" value="{{ $user->littlelink_name }}">
			  </div>
		  </div>
          
          <div class="form-group col-lg-8">
            <label> Page description</label>
            <textarea class="form-control" name="littlelink_description" rows="3">{{ $user->littlelink_description }}</textarea>
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

          </div>
</section>
@endsection

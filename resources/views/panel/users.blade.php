@extends('layouts.sidebar')

@section('content')

<style>.delete{color:transparent; background-color:tomato; border-radius:5px; padding:8px 12px; cursor: pointer;}.delete:hover{color:transparent;background-color:#f13d1d;}html,body{max-width:100%;overflow-x:hidden;}.shorten{cursor:help;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px;}</style>

<section class="shadow text-gray-400">
        <h2 class="mb-4 card-header"><i class="bi bi-person"> Users</i></h2>
        <div class="card-body p-0 p-md-3">

        <form action="{{ route('searchUser') }}" method="post">
        @csrf
					<div class="row">
						<div class="col-lg-8">
							<div class="input-group mb-3">
                <input type="text" name="name" placeholder="search user" class="form-control">
								<div class="input-group-append">
                  <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                </div>
              </div>
            </div>
          </div>
        </form>
        Users: 
        <a href="{{ url('') }}/panel/users/all">All</a> - 
        <a href="{{ url('') }}/panel/users/user">User</a> - 
        <a href="{{ url('') }}/panel/users/vip">Vip</a> - 
        <a href="{{ url('') }}/panel/users/admin">Admin</a> 

        <div class="row"><div class="col-12"><div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">E-Mail</th>
              <th scope="col">Page</th>
              <th scope="col">Role</th>
              <th scope="col">Edit</th>
              <th scope="col">Links</th>
              @if(env('REGISTER_AUTH') !== 'auth')<th style="width:15%" scope="col">E-Mail Verified</th>@endif
              <th scope="col">Block</th>
              <th scope="col" style="width:150px">Delete user</th>
            </tr>
          </thead>
          <tbody>
          @foreach($users as $user)
            <tr>
              <td class="shorten" title="{{ $user->name }}"> {{ $user->name }} </td>
              <td class="shorten" title="{{ $user->email }}"> {{ $user->email }} </td>
              <td><a href="{{ url('') }}/@<?= $user->littlelink_name ?>" target="_blank" class="text-info"><i class="bi bi-box-arrow-up-right"></i>&nbsp; {{ $user->littlelink_name }} </a></td>
              <td>{{ $user->role }}</td>
              <td><a href="{{ route('editUser', $user->id ) }}">Edit</a></td>
              <td><a href="{{ route('showLinksUser', $user->id ) }}" class="text-primary">View</a></td>
              @if(env('REGISTER_AUTH') !== 'auth')
              <td>@if($user->find($user->id)->role == 'admin' and $user->email_verified_at != '')yes @else
              <a href="{{ route('verifyUser', ['verify' => '-' . $user->email_verified_at, 'id' => $user->id] ) }}" class="text-danger">@if($user->email_verified_at == '')<span>no</span>@else<span style="color:#228B22">yes</span></a>@endif</td>
              @endif
              @endif
              <td>@if($user->find($user->id)->role == 'admin')-@else<a href="{{ route('blockUser', ['block' => $user->block, 'id' => $user->id] ) }}" class="text-danger">{{ $user->block }}</a>@endif</td>
              <td>@if($user->find($user->id)->role == 'admin')<center>-</center>@else<center><a href="{{ route('deleteUser', ['id' => $user->id] ) }}" class="confirmation delete"><i style="color: #fff !important" class="bi bi-trash-fill"></i><span class="hide-mobile-del"></span></a></center>@endif</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div></div></div>
        <a href="{{ url('') }}/panel/new-user">+ Add new user</a>

              <script type="text/javascript">
                var elems = document.getElementsByClassName('confirmation');
                var confirmIt = function (e) {
                    if (!confirm('Are you sure you want to delete this user? \nThis action cannot be undone!')) e.preventDefault();
                };
                for (var i = 0, l = elems.length; i < l; i++) {
                    elems[i].addEventListener('click', confirmIt, false);
                }
              </script>

          </div>
</section>

@endsection

@extends('layouts.sidebar')

@section('content')

        <h2 class="mb-4"><i class="bi bi-person"> Users</i></h2>

        <form action="{{ route('searchUser') }}" method="post">
        @csrf
          <div class="form-group col-lg-8 mb-5">
            <input type="text" name="name" placeholder="search user">
            <button type="submit" class="btn-primary"><i class="bi bi-search"></i></button>
          </div>
        </form>
        Users: 
        <a href="{{ url('') }}/panel/users/all">All</a> - 
        <a href="{{ url('') }}/panel/users/user">User</a> - 
        <a href="{{ url('') }}/panel/users/vip">Vip</a> - 
        <a href="{{ url('') }}/panel/users/admin">Admin</a> 

        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Page</th>
              <th scope="col">Role</th>
              <th scope="col">Edit</th>
              <th scope="col">Links</th>
              @if(env('REGISTER_AUTH') !== 'auth')<th style="width:10%" scope="col">E-Mail Verified</th>@endif
              <th scope="col">Block</th>
            </tr>
          </thead>
          <tbody>
          @foreach($users as $user)
            <tr>
              <td> {{ $user->name }} </td>
              <td><a href="{{ url('') }}/@<?= $user->littlelink_name ?>" target="_blank" class="text-info"><i class="bi bi-box-arrow-up-right"></i>&nbsp; {{ $user->littlelink_name }} </a></td>
              <td>{{ $user->role }}</td>
              <td><a href="{{ route('editUser', $user->id ) }}">Edit</a></td>
              <td><a href="{{ route('showLinksUser', $user->id ) }}" class="text-primary">View</a></td>
              @if(env('REGISTER_AUTH') !== 'auth')<td><a href="{{ route('verifyUser', ['verify' => '-' . $user->email_verified_at, 'id' => $user->id] ) }}" class="text-danger">@if($user->email_verified_at == '')<span>no</span>@else<span style="color:#228B22">yes</span>@endif</a></td>@endif
              <td><a href="{{ route('blockUser', ['block' => $user->block, 'id' => $user->id] ) }}" class="text-danger">{{ $user->block }}</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>

@endsection

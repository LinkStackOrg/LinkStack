@extends('layouts.sidebar')

@section('content')

<style>#cs{cursor: pointer;}.delete{color:transparent; background-color:tomato; border-radius:5px; padding:8px 12px; cursor: pointer;}.delete:hover{color:transparent;background-color:#f13d1d;}html,body{max-width:100%;overflow-x:hidden;}.shorten{cursor:help;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px;}</style>

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
              <th id="cs" scope="col" data-sort="id" data-order="asc">ID</th>
              <th id="cs" scope="col" data-sort="name" data-order="asc">Name</th>
              <th id="cs" scope="col" data-sort="email" data-order="asc">E-Mail</th>
              <th id="cs" scope="col" data-sort="page" data-order="asc">Page</th>
              <th id="cs" scope="col" data-sort="role" data-order="asc">Role</th>              
              <th id="cs" scope="col" data-sort="links" data-order="asc">Total links</th>
              <th id="cs" scope="col" data-sort="clicks" data-order="asc">Total clicks</th>
              <th id="cs" scope="col" data-sort="created" data-order="asc">Created at</th>
              <th data-sortable="false">Edit</th>
              <th data-sortable="false">Links</th>
              @if(env('REGISTER_AUTH') !== 'auth')<th id="cs" style="width:15%" scope="col">E-Mail Verified</th>@endif
              <th id="cs" scope="col" data-sort="block" data-order="asc">Block</th>
              <th scope="col" style="width:150px" data-sortable="false">Delete user</th>
            </tr>
          </thead>
          <tbody>
          @foreach($users as $user)
          <?php
          $date = date('d.m.Y', strtotime($user->created_at));
          if(!isset($user->created_at)){$date = "NULL";}
          ?>
            <tr>
              <td data-id>{{ $user->id }}</td>
              <td class="shorten" title="{{ $user->name }}" data-name> {{ $user->name }} </td>
              <td class="shorten" title="{{ $user->email }}" data-email> {{ $user->email }} </td>
              <td data-page>@if(isset($user->littlelink_name))<a href="{{ url('') }}/@<?= $user->littlelink_name ?>" target="_blank" class="text-info"><i class="bi bi-box-arrow-up-right"></i>&nbsp; {{ $user->littlelink_name }} </a>@else N/A @endif</td>
              <td data-role>{{ $user->role }}</td>
              <td data-links>{{$user->links}}</td>
              <td data-clicks>{{$user->clicks}}</td>
              <td data-created>{{$date}}</td>
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
<script>
const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const comparer = (idx, asc) => (a, b) =>
  ((v1, v2) =>
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
  )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

// Find the table and its headers
const table = document.querySelector('table');
const headers = table.querySelectorAll('th');

// Add caret icon to initial header element
const initialHeader = table.querySelector('[data-order]');
initialHeader.innerHTML = `${initialHeader.innerText} <i class="bi bi-caret-down-fill"></i>`;

// Attach click event listener to all headers
headers.forEach(th => th.addEventListener('click', function() {
  // Get the clicked header's index, sort order, and sortable attribute
  const thIndex = Array.from(th.parentNode.children).indexOf(th);
  const isAscending = this.asc = !this.asc;
  const isSortable = th.getAttribute('data-sortable') !== 'false';

  // If the column is not sortable, do nothing
  if (!isSortable) {
    return;
  }

  // Remove caret icon and active class from all headers
  headers.forEach(h => {
    h.classList.remove('active');
    h.innerHTML = h.innerText;
  });

  // Add caret icon and active class to clicked header
  th.classList.add('active');
  th.innerHTML = `${th.innerText} ${isAscending ? '<i class="bi bi-caret-down-fill"></i>' : '<i class="bi bi-caret-up-fill"></i>'}`;

  // Sort the table rows based on the clicked header
  Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
    .sort(comparer(thIndex, isAscending))
    .forEach(tr => table.appendChild(tr));
}));
</script>


@endsection
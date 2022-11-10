@extends('layouts.sidebar')

@section('content')

<section class="shadow text-gray-400">
        <h2 class="mb-4 card-header"><i class="bi bi-link-45deg"> Links</i></h2>
        <div class="card-body p-0 p-md-3">

        <div style="overflow-y: auto;">
        <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Link</th>
            <th scope="col">Title</th>
            <th scope="col">Clicks</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
        @foreach($links as $link)
          <tr>
            <td title="{{ $link->link }}"><a style="color:#3985ff;text-decoration:underline;" href="{{ $link->link }}" target="_blank">{{ Str::limit($link->link, 50) }}</a></td>
            <td title="{{ $link->title }}">{{ Str::limit($link->title, 30) }}</td>
            <td class="text-right">{{ $link->click_number }}</td>
            <td><a href="{{ route('deleteLinkUser', $link->id ) }}" class="text-danger">Delete</a></td>
          </tr>
          @endforeach
        </tbody>
        </table>
</div>

            <ul class="pagination justify-content-center">
                  {!! $links ?? ''->links() !!}
            </ul>

<a class="btn btn-primary" href="{{ url('/panel/users/all') }}">⬅ Back</a>

          </div>
</section>
@endsection

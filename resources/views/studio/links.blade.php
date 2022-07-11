@extends('layouts.sidebar')

@section('content')

        <h2 class="mb-4"><i class="bi bi-link-45deg"> Links</i></h2>

        <div style="overflow-y: auto;">
        <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Link</th>
            <th scope="col">Title</th>
            <th scope="col">Clicks</th>
            <th scope="col">Order ⏶</th>
            <th scope="col">Pin Link ⏶</th>
            <th scope="col">Edit</th>
            @if(env('ENABLE_BUTTON_EDITOR') === true)<th scope="col">Button Editor</th>@endif
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
        @foreach($links as $link)
          <tr>
            <td title="{{ $link->link }}">{{ Str::limit($link->link, 30) }}</td>
            <td title="{{ $link->title }}">{{ Str::limit($link->title, 30) }}</td>
            <td class="text-right">{{ $link->click_number }}</td>
            <td class="text-right">{{ $link->order }}</td>
            <td><a href="{{ route('upLink', ['up' => $link->up_link, 'id' => $link->id]) }}" class="text-primary">{{ $link->up_link }}</a></td>
            <td><a href="{{ route('editLink', $link->id ) }}">Edit</a></td>
            @if(env('ENABLE_BUTTON_EDITOR') === true)
            @if($link->button_id == 1 or $link->button_id == 2)
            <td><a href="{{ route('editCSS', $link->id ) }}" class="text-success">Customize Button</a></td>
            @else
            <td><a> - </a></td>
            @endif
            @endif
            <td><a href="{{ route('deleteLink', $link->id ) }}" class="text-danger">Delete</a></td>
          </tr>
          @endforeach
        </tbody>
        </table>
</div>

            <ul class="pagination justify-content-center">
                  {!! $links ?? ''->links() !!}
            </ul>

<a class="btn btn-primary" href="{{ url('/studio/add-link') }}">Add a link</a>

@endsection

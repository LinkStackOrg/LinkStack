@extends('layouts.sidebar')

@section('content')

@push('sidebar-stylesheets')
		<base href="{{asset('')}}" />
@endpush

@if(Request::is('studio/links/10'))
    @php setcookie("LinkCount", "10", time()+60*60*24*5, "/"); @endphp
@elseif(Request::is('studio/links/20'))
    @php setcookie("LinkCount", "20", time()+60*60*24*5, "/"); @endphp
@elseif(Request::is('studio/links/30'))
    @php setcookie("LinkCount", "30", time()+60*60*24*5, "/"); @endphp
@elseif(Request::is('studio/links/all'))
    @php setcookie("LinkCount", "all", time()+60*60*24*5, "/"); @endphp
@endif

        <h2 class="mb-4"><i class="bi bi-link-45deg"> Links</i></h2>

<div style="text-align: right;"><a href="{{ url('/studio/links') }}/10">10</a> | <a href="{{ url('/studio/links') }}/20">20</a> | <a href="{{ url('/studio/links') }}/30">30</a> | <a href="{{ url('/studio/links') }}/all">all</a></div>
        <div style="overflow-y: auto;">
        <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Link</th>
            <th scope="col">Title</th>
            <th scope="col">Clicks</th>
            <th scope="col">Order ⏶</th>
            {{-- <th scope="col">Pin Link ⏶</th> --}}
            <th scope="col">Edit</th>
            @if(env('ENABLE_BUTTON_EDITOR') === true)<th scope="col">Button Editor</th>@endif
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody id="links-table-body" data-page="{{request('page', 1)}}" data-per-page="{{$pagePage ? $pagePage : 0}}">
        @foreach($links as $link)
          <tr data-id="{{$link->id}}">
            <td title="{{ $link->link }}"><span class="sortable-handle"></span> {{ Str::limit($link->link, 30) }}</td>
            <td title="{{ $link->title }}">{{ Str::limit($link->title, 30) }}</td>
            <td class="text-right">{{ $link->click_number }}</td>
            <td class="text-right">{{ $link->order }}</td>
            {{-- <td><a href="{{ route('upLink', ['up' => $link->up_link, 'id' => $link->id]) }}" class="text-primary">{{ $link->up_link }}</a></td> --}}
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
        <script type="text/javascript">
          const linksTableOrders = "{{ implode("|", $links->pluck('id')->toArray()) }}"
        </script>
</div>

            <ul class="pagination justify-content-center">
                  {!! $links ?? ''->links() !!}
            </ul>

<a class="btn btn-primary" href="{{ url('/studio/add-link') }}">Add a link</a>

@endsection

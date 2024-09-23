@php
    $librariesToInclude = [];
@endphp

@foreach($links as $link)
    @if(isset($link->custom_html) && isset($link->include_libraries) && $link->custom_html && is_array($link->include_libraries))
        @foreach($link->include_libraries as $library => $include)
            @if($include)
                @php
                    $librariesToInclude[$library] = true;
                @endphp
            @endif
        @endforeach
    @endif
@endforeach

@foreach($librariesToInclude as $library => $include)
    @switch($library)

        @case('jquery')
            @once
                @push('linkstack-head')
                    <script src="{{ asset('assets/external-dependencies/jquery-3.4.1.min.js') }}"></script>
                @endpush
            @endonce
        @break

        @case('sweetalert')
            @once
                @push('linkstack-head')
                    <script src="{{ asset('assets/external-dependencies/sweetalert2.min.js') }}"></script>
                @endpush
            @endonce
        @break

    @endswitch
@endforeach


@php /* For debugging purposes, you can add a script to the end of the body that logs the inclusion of each library: */ @endphp
{{-- @push('linkstack-body-end')
    <script>
        function logAssetInclusion(library) {
            console.log(library + ' has been included.');
        }

        @foreach($librariesToInclude as $library => $include)
            logAssetInclusion('{{ ucfirst($library) }}');
        @endforeach
    </script>
@endpush --}}
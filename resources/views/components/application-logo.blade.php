@if(file_exists(base_path("/images/avatar.png" )))
<img class="mb-5" src="{{ asset('/images/avatar.png') }}" srcset="{{ asset('/images/avatar@2x.png 2x') }}" style="width: 150px;">
@else
<img class="mb-5" src="{{ asset('/images/avatar@2x.png') }}">
@endif

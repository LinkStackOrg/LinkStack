@if(file_exists(base_path("/content/images/avatar.png" )))
<img class="mb-5" src="{{ asset('/content/images/avatar.png') }}" srcset="{{ asset('/content/images/avatar@2x.png 2x') }}" style="width: 150px;">
@else
<img class="mb-5" src="{{ asset('/content/images/avatar@2x.png') }}">
@endif

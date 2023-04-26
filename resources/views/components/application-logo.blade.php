@if(file_exists(base_path("/assets/linkstack/images/avatar.png" )))
    <img class="mb-5" src="{{ asset('/assets/linkstack/images/avatar.png') }}"  style="width: 150px;">
@else
    <img class="mb-5" src="{{ asset('/assets/linkstack/images/avatar@2x.png') }}">
@endif

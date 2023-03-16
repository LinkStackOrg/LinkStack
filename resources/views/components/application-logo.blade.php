@if(file_exists(base_path("/littlelink/images/avatar.png" )))
    <img class="mb-5" src="{{ asset('/littlelink/images/avatar.png') }}"  style="width: 150px;">
@else
    <img class="mb-5" src="{{ asset('/littlelink/images/avatar@2x.png') }}">
@endif

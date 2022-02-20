@if(file_exists(base_path("littlelink/images/avatar.png" )))
<img class="mb-5" src="{{ asset('littlelink/images/avatar.png') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}">
@else
<img src="{{ asset('littlelink/images/logo.svg') }}" alt="Logo"></img>
@endif

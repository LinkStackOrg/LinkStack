<label for='title' class='form-label'>{{__('messages.Spacing height')}}</label>
{{-- <input type='number' name='height' value="{{$params->height ?? ''}}" class='form-control w-25' /> --}}

<input type="range" class="custom-range" id="height" name='height' value={{$params->height??5}} oninput="this.nextElementSibling.value = this.value"><output class='font-weight-bold'>{{$params->height??5}}</output>





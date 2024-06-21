<label for='title' class='form-label'>{{__('messages.Title')}}</label>
<input type='text' name='title' value='{{$title}}' class='form-control' required />

<label for='title' class='form-label'>{{__('messages.URL')}}</label>
<input type='url' name='link' value='{{$link}}' class='form-control' required />

<div class="custom-control custom-checkbox m-2">
    <input type="checkbox" class="custom-control-input" value='1' {{((isset($params->GetSiteIcon) ? boolval($params->GetSiteIcon) : false) ? 'checked': '') }} name='GetSiteIcon' id="GetSiteIcon" @if($button_id == 2)checked @endif>

    <label class="custom-control-label"  for="GetSiteIcon">{{__('messages.Show website icon on button')}}</label>



</div>


<label for='title' class='form-label'>Title</label>
<input type='text' name='title' value='{{$link_title}}' class='form-control' required />

<label for='title' class='form-label'>URL</label>
<input type='url' name='link' value='{{$link_url}}' class='form-control' />

<div class="custom-control custom-checkbox m-2">
    <input type="checkbox" class="custom-control-input" value='1' {{((isset($params->GetSiteIcon) ? boolval($params->GetSiteIcon) : false) ? 'checked': '') }} name='GetSiteIcon' id="GetSiteIcon" @if($button_id == 2)checked @endif>

    <label class="custom-control-label"  for="GetSiteIcon">Show website icon on button</label>



</div>


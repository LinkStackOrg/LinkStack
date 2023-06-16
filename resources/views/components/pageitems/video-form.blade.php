<label for='title' class='form-label'>{{__('messages.Title')}}</label>
<input type='text' name='title' value='{{$link_title}}' placeholder="Leave blank for default video title" class='form-control' />

<label for='link' class='form-label'>{{__('messages.URL')}}</label>
<input type='url' name='link' value='{{$link_url}}' class='form-control' />
<span class='small text-muted'>{{__('messages.URL to the video')}}</span>


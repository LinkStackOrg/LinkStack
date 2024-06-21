<?php use App\Models\Button; $button = Button::find($button_id); if(isset($button->name)){$buttonName = $button->name;}else{$buttonName = 0;} ?>

<select style="display:none" name="button" class="form-control"><option class="button button-default email" value="phone">{{__('messages.Phone')}}</option></select>

<label for='title' class='form-label'>{{__('messages.Custom Title')}}</label>
<input type='text' name='title' value='{{$title}}' class='form-control' />
<span class='small text-muted'>{{__('messages.Leave blank for default title')}}</span><br>

<label for='link' class='form-label'>{{__('messages.Telephone number')}}</label>
<input type='tel' name='link' value='{{str_replace("tel:", "", $link)}}' class='form-control' required />
<span class='small text-muted'>{{__('messages.Enter your telephone number')}}</span>

<script>
$(document).ready(function() {
    $('form').on('submit', function(e) {
        var linkInput = $(this).find('input[name="link"]');
        var linkValue = linkInput.val();
        if (!linkValue.toLowerCase().startsWith('tel:')) {
            linkInput.val('tel:' + linkValue);
        }
    });
});
</script>
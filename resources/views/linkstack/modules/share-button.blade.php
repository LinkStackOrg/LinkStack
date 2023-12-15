<?php use App\Models\UserData; ?>

@php
    $ShowShrBtn = config('advanced-config.display_share_button');

    if ($ShowShrBtn === 'false') {
        $ShowShrBtn = 'false';
    } elseif ($ShowShrBtn === 'user') {
        $ShowShrBtn = Auth::user()->littlelink_name ? 'true' : 'false';
    } elseif (UserData::getData($userinfo->id, 'disable-sharebtn') == "true") {
        $ShowShrBtn = 'false';
    } else {
        $ShowShrBtn = 'true';
    }

@endphp

<div align="right" @if($ShowShrBtn == 'false') style="visibility:hidden" @endif class="sharediv">
  <div>
    <span class="sharebutton button-hover icon-hover share-button" data-share="{{url()->current()}}" tabindex="0" role="button" aria-label="{{__('messages.Share this page')}}">
      <i style="color: black;" class="fa-solid fa-share sharebutton-img share-icon hvr-icon"></i>
      <span class="sharebutton-mb">{{__('messages.Share')}}</span>
    </span>
  </div>
</div>
<span class="copy-icon" tabindex="0" role="button" aria-label="{{__('messages.Copy URL to clipboard')}}"></span>

@if($ShowShrBtn == 'true')
<script>const shareButtons=document.querySelectorAll(".share-button");shareButtons.forEach((e=>{e.addEventListener("click",(()=>{const r=e.dataset.share;navigator.share?navigator.share({title:"{{__('messages.Share this page')}}",url:r}).catch((e=>console.error("Error:",e))):navigator.clipboard.writeText(r).then((()=>{alert("{{__('messages.URL has been copied to your clipboard!')}}")})).catch((e=>{alert("Error",e)}))}))}));</script>
@endif
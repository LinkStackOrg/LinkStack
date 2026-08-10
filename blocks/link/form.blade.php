<label for='title' class='form-label'>{{__('messages.Title')}}</label>
<input type='text' name='title' value='{{$title}}' class='form-control' required />

<label for='title' class='form-label'>{{__('messages.URL')}}</label>
<input type='url' name='link' value='{{$link}}' class='form-control' required />

<div class="custom-control custom-checkbox m-2">
    <input type="checkbox" class="custom-control-input" value='1' {{((isset($params->GetSiteIcon) ? boolval($params->GetSiteIcon) : false) ? 'checked': '') }} name='GetSiteIcon' id="GetSiteIcon" @if($button_id == 2)checked @endif>

    <label class="custom-control-label"  for="GetSiteIcon">{{__('messages.Show website icon on button')}}</label>

</div>

<div class="form-group m-2">
    <label for='custom_icon' class='form-label'>{{__('messages.Custom icon')}}</label>
    <input type="text" name="custom_icon" id="custom_icon" value="{{ $custom_icon ?? '' }}" class="form-control" placeholder="fa-briefcase" />
    <div class="btn btn-primary mt-2 mb-2" onclick="document.getElementById('icon-picker').classList.toggle('d-none')">{{__('messages.Choose icon')}}</div>
    <div id="icon-picker" class="d-none" style="max-height:240px;overflow-y:auto;border:1px solid #ddd;border-radius:5px;padding:8px;">
        <input type="text" class="form-control mb-2" placeholder="{{__('messages.Search icons')}}..." onkeyup="filterIcons(this.value)">
        <div class="d-flex flex-wrap" id="icon-grid">
            @foreach(['briefcase','user','users','globe','camera','video','book','bookmark','heart','star','envelope','house','code','mug-hot','folder','folder-open','file','file-alt','laptop','phone','music','play','external-link-alt','external-link-square-alt','link','search','rss','paper-plane','comments','calendar','clock','map-marked-alt','map-pin','bolt','key','shield-alt','shopping-bag','shopping-cart','box','download','upload','image','palette','pen-nib','pencil','quote-left','address-card','award','trophy','sun','moon','tree','leaf','gift','gamepad','dice','puzzle-piece','compass','tags','newspaper','clipboard','check-circle','info-circle','question-circle','lock','tools','wrench','sliders-h','chart-bar','chart-pie','dollar-sign','coins','university','wallet','lightbulb','heartbeat','user-check','paperclip','link'] as $icon)
                <span class="icon-pick m-1" data-icon="fa-{{$icon}}" style="cursor:pointer;font-size:20px;" onclick="pickIcon('fa-{{$icon}}')"><i class="fa fa-{{$icon}}"></i></span>
            @endforeach
        </div>
    </div>
</div>

<script>
function pickIcon(icon) {
    document.getElementById('custom_icon').value = icon;
    document.getElementById('icon-picker').classList.add('d-none');
}
function filterIcons(q) {
    q = q.toLowerCase();
    document.querySelectorAll('#icon-grid .icon-pick').forEach(function(el) {
        el.style.display = el.dataset.icon.indexOf(q) !== -1 ? '' : 'none';
    });
}
</script>


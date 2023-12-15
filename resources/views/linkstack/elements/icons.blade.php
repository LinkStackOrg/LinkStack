<?php use App\Models\UserData; ?>

        @php $icons = DB::table('links')->where('user_id', $userinfo->id)->where('button_id', 94)->get(); @endphp
        @if(count($icons) > 0)
        <div class="row fadein social-icon-div">
        @foreach($icons as $icon)
        <a class="social-hover social-link" href="{{ $icon->link }}" title="{{ucfirst($icon->title)}}" aria-label="{{ucfirst($icon->title)}}" @if((UserData::getData($userinfo->id, 'links-new-tab') != false))target="_blank"@endif><i id="{{ $icon->id }}" class="button-click dynamic-contrast social-icon fa-brands fa-{{$icon->title}}"></i></a>
        @endforeach
        </div>
        @endif
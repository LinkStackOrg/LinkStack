@php
    $BaseURL = str_replace(array('http://', 'https://'), '', $link->link)

@endphp

<a class="button button-custom button button-hover icon-hover" rel="noopener noreferrer nofollow" href="{{ route('clickNumber') . '/' . $link->id . '/' . $link->link}}" @if(theme('open_links_in_same_tab') !="true" )target="_blank" @endif>
    @if($params->GetSiteIcon ?? true)
        <img alt="button-icon" class="icon hvr-icon" src="{{asset('studio/favicon/favicon.gif')}}" onload="this.src='{{url('ico').'?'.$link->id}}'" loading="lazy">
        @endif

    {{ $link->title }}
</a>


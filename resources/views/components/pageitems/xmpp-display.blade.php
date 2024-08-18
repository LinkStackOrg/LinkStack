
<a class="button button-{{ $params->button }} button button-hover icon-hover" rel="noopener noreferrer nofollow" href="{{ route('clickNumber') . '/' . $link->id . '/' . $link->link}}" @if(theme('open_links_in_same_tab') !="true" )target="_blank" @endif>
    <img alt="button-icon" class="icon hvr-icon" src="@if(theme('use_custom_icons') == " true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/{{$params->button}}{{theme('custom_icon_extension')}} @else{{ asset('\/assets/linkstack/icons\/') . $params->button }}.svg @endif">

    {{ ucfirst($link->title) }}
</a>

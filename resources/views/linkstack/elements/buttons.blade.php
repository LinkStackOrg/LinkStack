<?php use App\Models\UserData; ?>

        @php 
        $initial = 1; 
        @endphp

        @include('linkstack.modules.block-libraries', ['links' => $links])

        @foreach($links as $link)
        @if(isset($link->custom_html) && $link->custom_html)
            @if(isset($link->ignore_container) && $link->ignore_container)
            </div></div></div>
            @endif
                @php setBlockAssetContext($link->type); @endphp
                @include('blocks::' . $link->type . '.display', ['link' => $link, 'initial' => $initial++])
            @if(isset($link->ignore_container) && $link->ignore_container)
            <div class="container"><div class="row"><div class="column">
            @endif
        @else
            @switch($link->name)
                @case('icon')
                    @break
                @case('vcard')
                    <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a id="{{ $link->id }}" class="button button-default button-click button-hover icon-hover" rel="noopener noreferrer nofollow noindex" href="{{ route('vcard') . '/' . $link->id }}"><img alt="{{ $link->name }}" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/vcard{{theme('custom_icon_extension')}} @else{{ asset('\/assets/linkstack/icons\/')}}vcard.svg @endif"></i>{{ $link->title }}</a></div>
                        @break
                @case('phone')
                <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a id="{{ $link->id }}" class="button button-default button-click button-hover icon-hover" rel="noopener noreferrer nofollow noindex" href="{{ $link->link }}"><img alt="{{ $link->name }}" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/phone{{theme('custom_icon_extension')}} @else{{ asset('\/assets/linkstack/icons\/')}}phone.svg @endif"></i>{{ $link->title }}</a></div>
                    @break
                @case('custom')
                  @if($link->custom_css === "" or $link->custom_css === "NULL" or (theme('allow_custom_buttons') == "false"))
                   <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a id="{{ $link->id }}" class="button button-custom button-click button-hover icon-hover" rel="noopener noreferrer nofollow noindex" href="{{ $link->link }}" @if((UserData::getData($userinfo->id, 'links-new-tab') != false))target="_blank"@endif ><i style="color: {{$link->custom_icon}}" class="icon hvr-icon fa {{$link->custom_icon}}"></i>{{ $link->title }}</a></div>
                      @break
                   @elseif($link->custom_css != "")
                   <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a id="{{ $link->id }}" class="button button-custom button-click button-hover icon-hover" style="{{ $link->custom_css }}" rel="noopener noreferrer nofollow noindex" href="{{ $link->link }}" @if((UserData::getData($userinfo->id, 'links-new-tab') != false))target="_blank"@endif ><i style="color: {{$link->custom_icon}}" class="icon hvr-icon fa {{$link->custom_icon}}"></i>{{ $link->title }}</a></div>
                      @break
                    @endif
                @case('custom_website')
                   @if($link->custom_css === "" or $link->custom_css === "NULL" or (theme('allow_custom_buttons') == "false"))
                     <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a id="{{ $link->id }}" class="button button-custom_website button-click button-hover icon-hover" rel="noopener noreferrer nofollow noindex" href="{{ $link->link }}" @if((UserData::getData($userinfo->id, 'links-new-tab') != false))target="_blank"@endif ><img alt="{{ $link->name }}" class="icon hvr-icon" src="@if(file_exists(base_path("assets/favicon/icons/").localIcon($link->id))){{url('assets/favicon/icons/'.localIcon($link->id))}}@else{{getFavIcon($link->id)}}@endif" onerror="this.onerror=null; this.src='{{asset('assets/linkstack/icons/website.svg')}}';">{{ $link->title }}</a></div>
                       @break
                   @elseif($link->custom_css != "")
                    <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a id="{{ $link->id }}" class="button button-custom_website button-click button-hover icon-hover" style="{{ $link->custom_css }}" rel="noopener noreferrer nofollow noindex" href="{{ $link->link }}" @if((UserData::getData($userinfo->id, 'links-new-tab') != false))target="_blank"@endif ><img alt="{{ $link->name }}" class="icon hvr-icon" src="@if(file_exists(base_path("assets/favicon/icons/").localIcon($link->id))){{url('assets/favicon/icons/'.localIcon($link->id))}}@else{{getFavIcon($link->id)}}@endif" onerror="this.onerror=null; this.src='{{asset('assets/linkstack/icons/website.svg')}}';">{{ $link->title }}</a></div>
                     @break
                   @endif
                   @default
                <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a id="{{ $link->id }}" class="button button-{{ $link->name }} button-click button-hover icon-hover" rel="noopener noreferrer nofollow noindex" href="{{ $link->link }}" @if((UserData::getData($userinfo->id, 'links-new-tab') != false))target="_blank"@endif ><img alt="{{ $link->name }}" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/{{str_replace('default ','',$link->name)}}{{theme('custom_icon_extension')}} @else{{ asset('\/assets/linkstack/icons\/') . str_replace('default ','',$link->name) }}.svg @endif">{{ $link->title }}</a></div>
            @endswitch
        @endif
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function handleClickOrTouch(event) {
                if (event.target.classList.contains('button-click')) {
                    var id = event.target.id;
                    if (!sessionStorage.getItem('clicked-' + id)) {
                        var url = '{{ route("clickNumber") }}/' + id;
                        fetch(url, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                        });
                        sessionStorage.setItem('clicked-' + id, 'true');
                    }
                }
            }
    
            document.addEventListener('mousedown', function (event) {
                if (event.button === 0 || event.button === 1) {
                    handleClickOrTouch(event);
                }
            });
    
            document.addEventListener('touchstart', handleClickOrTouch);
        });
    </script>
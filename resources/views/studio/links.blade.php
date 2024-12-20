@extends('layouts.sidebar')

@section('content')

<?php use App\Models\Button; 

// Check if the LinkCount cookie is set
if (isset($_COOKIE['LinkCount'])) {
  // Set the expiration time of the cookie to one hour in the past
  setcookie('LinkCount', '', time() - 3600);
}

?>

<style>
.sortable-handle {
    margin-right: 25px;
    width: 25px;
    height: auto;
    transform: rotate(90deg);
    cursor: grab;
    cursor: -webkit-grabbing;
    fill: currentColor;
}
</style>

@push('sidebar-stylesheets')
<script src="{{ asset('assets/external-dependencies/fontawesome.js') }}" crossorigin="anonymous"></script>
<style>
@media only screen and (max-width: 1500px) {
  .pre-side{display:none!important;}
  .pre-left{width:100%!important;}
  .pre-bottom{display:block!important;}
}

@media only screen and (min-width: 1501px) {
  .pre-left{width:70%!important;}
  .pre-right{width:30%!important;}
  .pre-bottom{display:none!important;}
}
</style>
<style>.delete{position:relative; color:transparent; background-color:tomato; border-radius:5px; left:5px; padding:5px 12px; cursor: pointer;}.delete:hover{color:transparent;background-color:#f13d1d;}html,body{max-width:100%;overflow-x:hidden;}</style>
@endpush

@include('components.favicon')
@include('components.favicon-extension')

<?php if(!function_exists('strp')){function strp($urlStrp){return str_replace(array('http://', 'https://'), '', $urlStrp);}} ?>

<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">   

        <div class="col-lg-12">
            <div class="card   rounded">
               <div class="card-body">
                  <div class="row">
                      <div class="col-sm-12">  
    
                        <div class="row">
                            <section class='pre-left text-gray-400'>
                                <h3 class="card-header mb-3"><i class="bi bi-link-45deg">{{__('messages.My Links')}}</i>
                                        <a class="btn btn-primary float-end" href="{{ url('/studio/add-link') }}"> {{__('messages.Add new Link')}}</a>
                                </h3>
                            
                                <div>
                            
                                    {{-- <div style="text-align: right;"><a href="{{ url('/studio/links') }}/10">10</a> | <a href="{{ url('/studio/links') }}/20">20</a> | <a href="{{ url('/studio/links') }}/30">30</a> | <a href="{{ url('/studio/links') }}/all">all</a></div> --}}
                            
                                <div style="overflow-y: none;" class="col col-md-7 ms-3">
                            
                                    <div id="links-table-body" data-page="{{request('page', 1)}}" data-per-page="{{$pagePage ? $pagePage : 0}}">
                                        @if($links->total() == 0)
                                              <div class="col-6 text-center">
                                                <p class="mt-5">{{__('messages.No Link Added')}}</p>
                                              </div>
                                        @else
                                        @foreach($links as $link)
                                        @php $button = Button::find($link->button_id); if(isset($button->name)){$buttonName = $button->name;}else{$buttonName = 0;} @endphp
                                        @php if($buttonName == "default email"){$buttonName = "email";} if($buttonName == "default email_alt"){$buttonName = "email_alt";} @endphp
                                        @if($button && $button->name !== 'icon')
                                        <div class='row h-100 pb-0 mb-2 border rounded hvr-glow w-100' data-id="{{$link->id}}">
                                            <div class="d-flex ">
                            
                            
                                                <div class='col-auto p-2 my-auto mr-2' title="{{ $link->link }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sortable-handle" viewBox="0 0 16 16">
                                                        <path d="M1 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V4zM1 9a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V9zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V9z"/>
                                                      </svg>
                                                </div>
                            
                                            <div class='col h-100'>
                            
                                                <div class='row h-100'>
                                                    <div class='col-12 p-2' style="max-width:300px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;" title="{{ $link->title }}">
                                                        <span class='h6'>
                                                            @if($button->name == "custom_website")
                                                            <span class="bg-soft-secondary" style="border: 1px solid #d0d4d7 !important;border-radius:5px;width:25px!important;height:25px!important;"><img style="margin-bottom:3px;margin-left:4px;margin-right:4px;max-width:15px;max-height:15px;" alt="button-icon" class="icon hvr-icon" src="@if(file_exists(base_path("assets/favicon/icons/").localIcon($link->id))){{url('assets/favicon/icons/'.localIcon($link->id))}}@else{{getFavIcon($link->id)}}@endif" onerror="this.onerror=null; this.src='{{asset('assets/linkstack/icons/website.svg')}}';"></span>
                                                            @elseif($button->name == "space")
                                                            <span class="bg-soft-secondary" style="border: 1px solid #d0d4d7 !important;border-radius:5px;width:25px!important;height:25px!important;"><i style="margin-left:2.83px;margin-right:-1px;color:#fff;" class='bi bi-distribute-vertical'>&nbsp;</i></span>
                                                            @elseif($button->name == "heading")
                                                            <span class="bg-soft-secondary" style="border: 1px solid #d0d4d7 !important;border-radius:5px;width:25px!important;height:25px!important;"><i style="margin-left:2.83px;margin-right:-1px;color:#fff;" class='bi bi-card-heading'>&nbsp;</i></span>
                                                            @elseif($button->name == "text")
                                                            <span class="bg-soft-secondary" style="border: 1px solid #d0d4d7 !important;border-radius:5px;width:25px!important;height:25px!important;"><i style="margin-left:2.83px;margin-right:-1px;color:#fff;" class='bi bi-fonts'>&nbsp;</i></span>
                                                            @elseif($link->custom_icon && $link->type && $link->type !== 'predefined')
                                                            <span class="bg-soft-secondary" style="border: 1px solid #d0d4d7 !important;border-radius:5px;width:25px!important;height:25px!important;"><i style="width:20px;margin:1px;color:#fff;" class='fa {{$link->custom_icon}}'>&nbsp;</i></span>
                                                            @else
                                                            <span class="bg-soft-secondary" style="border: 1px solid #d0d4d7 !important;border-radius:5px;width:25px!important;height:25px!important;"><img style="max-width:15px !important;" alt="button-icon" height="15" class="m-1 " src="{{ asset('\/assets/linkstack/icons\/') . $buttonName }}.svg "></span>
                                                            @endif
                            
                                                            {{strip_tags($link->title,'')}}</span>
                            
                                                        @if(!empty($link->link) and $button->name != "vcard")
                                                        <br>
                                                        <a title='{{$link->link}}' href="{{ $link->link}}" target="_blank" class="d-none d-md-block ml-4 text-muted small">{{Str::limit($link->link, 75 )}}</a>
                                                        <a title='{{$link->link}}' href="{{ $link->link}}" target="_blank" class="d-md-none ml-4 text-muted small">{{Str::limit($link->link, 25 )}}</a>
                                                        @elseif(!empty($link->link) and $button->name == "vcard")
                                                        <br><a href="{{ url('vcard/'.$link->id) }}" target="_blank" class="ml-4 small">{{__('messages.Download')}}</a>
                            
                                                        @endif
                            
                                                    </div>
                            
                                                    <div class='col' class="text-right">
                                                        {{Str::limit($link->params['text'] ?? null, 150)  }}
                            
                                                        @if($link->typename == 'video')
                                                            @php
                                                                $embed = OEmbed::get($link->link);
                                                                if ($embed && $embed->hasThumbnail()) {
                                                                    echo "<img style='max-height: 150px;' src='".$embed->thumbnailUrl()."' />";
                            
                                                                }
                                                            @endphp
                            
                                                        @endif
                                                    </div>
                            
                            
                                                    <div class='col-12 py-1 px-3 m-0 mt-2'>
                            
                                                        @if(!empty($link->link))
                                                        <span><i class="bi bi-bar-chart-line"></i> {{ $link->click_number }} {{__('messages.Clicks')}}</span>
                            
                                                        @endif

                                                        <a style="float: right;" href="{{ route('deleteLink', $link->id ) }}" onclick="return confirm('{{ __('messages.confirm_delete', ['title' => addslashes($link->title)]) }}')" class="btn btn-sm me-1 btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete" data-bs-placement="top" data-original-title="{{__('messages.Delete')}}">
                                                            <span class="btn-inner">
                                                               <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                                  <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                  <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                  <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                               </svg>
                                                            </span>
                                                         </a>

                                                            <a style="float: right;" href="{{ route('editLink', $link->id ) }}" class="btn btn-sm me-1 btn-icon btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="{{__('messages.Edit')}}" aria-label="Edit" data-bs-original-title="{{__('messages.Edit')}}">
                                                               <span class="btn-inner">
                                                                  <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                     <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                     <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                     <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                  </svg>
                                                               </span>
                                                            </a>

                                                            @if(env('ENABLE_BUTTON_EDITOR') === true)
                                                            @if(($link->button_id == '1' || $link->button_id == '2') && $link->type == 'link')
                                                                <a style="float: right;" href="{{ route('editCSS', $link->id ) }}" class="btn btn-sm me-1 btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Add" data-bs-placement="top" data-original-title="{{__('messages.Customize')}}">
                                                                    <span class="btn-inner">
                                                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8064 7.62361L20.184 6.54352C19.6574 5.6296 18.4905 5.31432 17.5753 5.83872V5.83872C17.1397 6.09534 16.6198 6.16815 16.1305 6.04109C15.6411 5.91402 15.2224 5.59752 14.9666 5.16137C14.8021 4.88415 14.7137 4.56839 14.7103 4.24604V4.24604C14.7251 3.72922 14.5302 3.2284 14.1698 2.85767C13.8094 2.48694 13.3143 2.27786 12.7973 2.27808H11.5433C11.0367 2.27807 10.5511 2.47991 10.1938 2.83895C9.83644 3.19798 9.63693 3.68459 9.63937 4.19112V4.19112C9.62435 5.23693 8.77224 6.07681 7.72632 6.0767C7.40397 6.07336 7.08821 5.98494 6.81099 5.82041V5.82041C5.89582 5.29601 4.72887 5.61129 4.20229 6.52522L3.5341 7.62361C3.00817 8.53639 3.31916 9.70261 4.22975 10.2323V10.2323C4.82166 10.574 5.18629 11.2056 5.18629 11.8891C5.18629 12.5725 4.82166 13.2041 4.22975 13.5458V13.5458C3.32031 14.0719 3.00898 15.2353 3.5341 16.1454V16.1454L4.16568 17.2346C4.4124 17.6798 4.82636 18.0083 5.31595 18.1474C5.80554 18.2866 6.3304 18.2249 6.77438 17.976V17.976C7.21084 17.7213 7.73094 17.6516 8.2191 17.7822C8.70725 17.9128 9.12299 18.233 9.37392 18.6717C9.53845 18.9489 9.62686 19.2646 9.63021 19.587V19.587C9.63021 20.6435 10.4867 21.5 11.5433 21.5H12.7973C13.8502 21.5001 14.7053 20.6491 14.7103 19.5962V19.5962C14.7079 19.088 14.9086 18.6 15.2679 18.2407C15.6272 17.8814 16.1152 17.6807 16.6233 17.6831C16.9449 17.6917 17.2594 17.7798 17.5387 17.9394V17.9394C18.4515 18.4653 19.6177 18.1544 20.1474 17.2438V17.2438L20.8064 16.1454C21.0615 15.7075 21.1315 15.186 21.001 14.6964C20.8704 14.2067 20.55 13.7894 20.1108 13.5367V13.5367C19.6715 13.284 19.3511 12.8666 19.2206 12.3769C19.09 11.8873 19.16 11.3658 19.4151 10.928C19.581 10.6383 19.8211 10.3982 20.1108 10.2323V10.2323C21.0159 9.70289 21.3262 8.54349 20.8064 7.63277V7.63277V7.62361Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                          <circle cx="12.1747" cy="11.8891" r="2.63616" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>   
                                                                      </svg>
                                                                     </span>
                                                                </a>
                                                            @endif
                                                            @endif

                                                        @if(file_exists(base_path("assets/favicon/icons/").localIcon($link->id)))<a style="float: right;" href="{{ route('clearIcon', $link->id ) }}"  data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Add" data-bs-placement="top" data-original-title="Clear icon cache" class="float-right hvr-grow p-1 text-primary"><i style="-webkit-text-stroke:1px;padding-right:5px;" class="bi bi-arrow-repeat"></i></a>@endif
                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                            
                            
                                    <script type="text/javascript">
                                        var linksTableOrders = "{{ implode(' | ', $links->pluck('id')->toArray()) }}"
                                    </script>
                                </div>
                            
                                <ul class="pagination justify-content-center">
                                    {!! $links ?? ''->links() !!}
                                </ul>
                            
                                @if(count($links) > 3)<a class="btn btn-primary" href="{{ url('/studio/add-link') }}">{{__('messages.Add new Link')}}</a>@endif
                                </div>
                            </section>
                            
                            <section class='pre-right text-gray-400 pre-side'>
                                <h3 class="card-header"><i class="bi bi-window-fullscreen" style="font-style:normal!important;"> {{__('messages.Preview')}}</i></h3>
                                    <div class='card-body p-0 p-md-3'>
                                            <center><iframe allowtransparency="true" id="frPreview1" style=" border-radius:0.25rem !important; background: #FFFFFF; min-height:600px; height:100%; max-width:500px !important;" class='w-100' src="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>">{{__('messages.No compatible browser')}}</iframe></center>
                                     </div>
                            </section>
                            </div>
                            
                            <br>
                            <section style="margin-left:-15px;margin-right:-15px;" style="width:100%!important;" class='pre-bottom text-gray-400 pre-side'>
                                <h3 class="card-header"><i class="bi bi-window-fullscreen" style="font-style:normal!important;">{{__('messages.Preview')}}</i></h3>
                                    <div class='card-body p-0 p-md-3'>
                                            <center><iframe allowtransparency="true" id="frPreview2" style=" border-radius:0.25rem !important; background: #FFFFFF; min-height:600px; height:100%; width:100% !important;" class='w-100' src="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>">{{__('messages.No compatible browser')}}</iframe></center>
                                     </div>
                            </section><br>
                            
                            <section style="margin-left:-15px;margin-right:-15px;" class='text-gray-400'>
                            <a name="icons"></a>
                            <h3 class="mb-4 card-header"><i class="fa-solid fa-icons"></i> {{__('messages.Page Icons')}}</i></h3>
                            <div class="card-body p-0 p-md-3">
                            
                            <form action="{{ route('editIcons') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-group col-lg-8">
                            
                                    @php
                                    if (!function_exists('iconLink')) {
                                        function iconLink($icon) {
                                            $iconLink = DB::table('links')
                                                ->where('user_id', Auth::id())
                                                ->where('title', $icon)
                                                ->where('button_id', 94)
                                                ->value('link');
                                            if (is_null($iconLink)){
                                                return false;
                                            } else {
                                                return $iconLink;
                                            }
                                        }
                                    }
                                    
                                    if (!function_exists('searchIcon')) {
                                        function searchIcon($icon) {
                                            $iconId = DB::table('links')
                                                ->where('user_id', Auth::id())
                                                ->where('title', $icon)
                                                ->where('button_id', 94)
                                                ->value('id');
                                            if (is_null($iconId)){
                                                return false;
                                            } else {
                                                return $iconId;
                                            }
                                        }
                                    }
                                    
                                    if (!function_exists('iconclicks')) {
                                        function iconclicks($icon) {
                                            $iconClicks = searchIcon($icon);
                                            $iconClicks = DB::table('links')->where('id', $iconClicks)->value('click_number');
                                            if (is_null($iconClicks)){
                                                return 0;
                                            } else {
                                                return $iconClicks;
                                            }
                                        }
                                    }
                                    
                                    if (!function_exists('icon')) {
                                        function icon($name, $label) {
                                            echo '<div class="mb-3">
                                                    <label class="form-label">'.$label.'</label>
                                                    <span class="form-text" style="font-size: 90%; font-style: italic;">'.__('messages.Clicks').': '.iconclicks($name).'</span>
                                                    <div class="input-group">
                                                      <span class="input-group-text"><i class="fab fa-'.$name.'"></i></span>
                                                      <input type="url" class="form-control" name="'.$name.'" value="'.iconLink($name).'" />
                                                      '.(searchIcon($name) != NULL ? '<a href="'.route("deleteLink", searchIcon($name)).'" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>' : '').'
                                                    </div>
                                                  </div>';
                                        }
                                    }
                                    @endphp
                                    <style>input{border-top-right-radius: 0.25rem!important; border-bottom-right-radius: 0.25rem!important;}</style>
                            
                            
                                {!!icon('mastodon', 'Mastodon')!!}
                            
                                {!!icon('instagram', 'Instagram')!!}
                            
                                {!!icon('x-twitter', 'X')!!}
                            
                                {!!icon('facebook', 'Facebook')!!}
                            
                                {!!icon('github', 'GitHub')!!}
                            
                                {!!icon('twitch', 'Twitch')!!}
                            
                                {!!icon('linkedin', 'LinkedIn')!!}
                            
                                {!!icon('tiktok', 'TikTok')!!}
                            
                                {!!icon('discord', 'Discord')!!}
                            
                                {!!icon('youtube', 'YouTube')!!}
                            
                                {!!icon('snapchat', 'Snapchat')!!}
                            
                                {!!icon('reddit', 'Reddit')!!}
                            
                                {!!icon('pinterest', 'Pinterest')!!}

                                {!!icon('telegram', 'Telegram')!!}

                                {!!icon('whatsapp', 'WhatsApp')!!}

                                {!! icon('behance', 'Behance') !!}

                                {!! icon('dribbble', 'Dribble') !!}

                                {!! icon('bluesky', 'Bluesky') !!}

                                {!! icon('threads', 'Threads') !!}

                        
                            
                                <button type="submit" class="mt-3 ml-3 btn btn-primary">{{__('messages.Save links')}}</button>
                            </form>
                            
                            
                            </div>
                            </section>
    
                      </div>
                  </div>
               </div>
            </div>
         </div>


      </div>
    </div>

    <script type="text/javascript">
        var iframes = ['frPreview1', 'frPreview2'];
        
        iframes.forEach(id => {
            var iframe = document.getElementById(id);
        
            iframe.onload = function() {
                var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
                var style = document.createElement('style');
                style.innerHTML = `
                    * {
                        pointer-events: none !important;
                    }
                `;
                iframeDocument.head.appendChild(style);
            };
        });
        </script>
@endsection

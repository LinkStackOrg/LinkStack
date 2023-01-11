@extends('layouts.sidebar')

@section('content')

<?php use App\Models\Button; 

// Check if the LinkCount cookie is set
if (isset($_COOKIE['LinkCount'])) {
  // Set the expiration time of the cookie to one hour in the past
  setcookie('LinkCount', '', time() - 3600);
}

?>

@push('sidebar-stylesheets')
<script src="{{ asset('studio/external-dependencies/fontawesome.js') }}" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('studio/external-dependencies/fontawesome.css') }}" />
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

<?php function strp($urlStrp){return str_replace(array('http://', 'https://'), '', $urlStrp);} ?>

<div class="row">
<section class='pre-left shadow text-gray-400'>
    <h3 class="card-header"><i class="bi bi-link-45deg">My Links</i>
            <a class="btn btn-primary float-right" href="{{ url('/studio/add-link') }}">Add new <span class='d-none d-md-inline'>item</span></a>


    </h3>

    <div class='card-body p-0 p-md-3'>

        {{-- <div style="text-align: right;"><a href="{{ url('/studio/links') }}/10">10</a> | <a href="{{ url('/studio/links') }}/20">20</a> | <a href="{{ url('/studio/links') }}/30">30</a> | <a href="{{ url('/studio/links') }}/all">all</a></div> --}}



    <div style="overflow-y: none;" class="col col-md-7 ">


        <div id="links-table-body" data-page="{{request('page', 1)}}" data-per-page="{{$pagePage ? $pagePage : 0}}">
            @foreach($links as $link)
            @php $button = Button::find($link->button_id); if(isset($button->name)){$buttonName = $button->name;}else{$buttonName = 0;} @endphp
            @if($button->name !== 'icon')
            <div class='row h-100  pb-0  mb-2 border rounded hvr-glow ' data-id="{{$link->id}}">


                <div class='col-auto p-2 my-auto mr-2' title="{{ $link->link }}">
                    <span class=" sortable-handle"></span>
                </div>


                <div class='col border-left h-100'>

                    <div class='row h-100'>
                        <div class='col-12 p-2' style="max-width:300px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;" title="{{ $link->title }}">
                            <span class='h6'>
                                @if($button->name == "custom_website")
                                <span style="border: 1px solid #d0d4d7 !important;border-radius:5px;background-color:#6c757d;width:25px!important;height:25px!important;"><img style="margin-bottom:3px;margin-left:4px;margin-right:4px;max-width:15px;max-height:15px;" alt="button-icon" class="icon hvr-icon" src="@if(file_exists(base_path("studio/favicon/icons/").localIcon($link->id))){{url('studio/favicon/icons/'.localIcon($link->id))}}@else{{getFavIcon($link->id)}}@endif"></span>
                                @elseif($button->name == "space")
                                <span style="border: 1px solid #d0d4d7 !important;border-radius:5px;background-color:#6c757d;width:25px!important;height:25px!important;"><i style="margin-left:2.83px;margin-right:-1px;color:#fff;" class='bi bi-distribute-vertical'>&nbsp;</i></span>
                                @elseif($button->name == "heading")
                                <span style="border: 1px solid #d0d4d7 !important;border-radius:5px;background-color:#6c757d;width:25px!important;height:25px!important;"><i style="margin-left:2.83px;margin-right:-1px;color:#fff;" class='bi bi-card-heading'>&nbsp;</i></span>
                                @elseif($button->name == "text")
                                <span style="border: 1px solid #d0d4d7 !important;border-radius:5px;background-color:#6c757d;width:25px!important;height:25px!important;"><i style="margin-left:2.83px;margin-right:-1px;color:#fff;" class='bi bi-fonts'>&nbsp;</i></span>
                                @elseif($button->name == "buy me a coffee")
                                <span style="border: 1px solid #d0d4d7 !important;border-radius:5px;background-color:#6c757d;width:25px!important;height:25px!important;"><img style="margin-left:6px!important;margin-right:6px!important;" alt="button-icon" height="15" class="m-1 " src="{{ asset('\/littlelink/icons\/') . "coffee" }}.svg "></span>
                                @else
                                <span style="border: 1px solid #d0d4d7 !important;border-radius:5px;background-color:#6c757d;width:25px!important;height:25px!important;"><img style="max-width:15px !important;" alt="button-icon" height="15" class="m-1 " src="{{ asset('\/littlelink/icons\/') . $buttonName }}.svg "></span>
                                @endif

                                {{strip_tags($link->title,'')}}</span>

                            @if(!empty($link->link))
                            <br /><a  title='{{$link->link}}' href="{{ $link->link}}" target="_blank" class="ml-4 text-muted small">{{Str::limit($link->link, 75 )}}</a>

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


                        <div class='col-12 py-1 px-3  m-0 bg-blend-darken card-footer  mt-2'>

                            <a href="{{ route('editLink', $link->id ) }}" class="hvr-grow mr-2"><i class='bi bi-pencil'></i> Edit</a>

                            @if(env('ENABLE_BUTTON_EDITOR') === true)
                                @if($link->button_id == '1' or $link->button_id == '2')
                                    <a href="{{ route('editCSS', $link->id ) }}" class="mr-2 hvr-grow text-success">Customize</a>
                                @endif
                            @endif

                            @if(!empty($link->link))
                            <span class='hvr-grow'><i class="bi bi-bar-chart-line"></i> {{ $link->click_number }} Clicks</span>

                            @endif

                            <a href="{{ route('deleteLink', $link->id ) }}" title="Delete" onclick="return confirm('Are you sure you want to delete `{{$link->title}}` ?')" class="float-right hvr-grow  p-1 text-danger"><i class='bi bi-trash'></i></a>

                            @if(file_exists(base_path("studio/favicon/icons/").localIcon($link->id)))<a href="{{ route('clearIcon', $link->id ) }}" title="Clear icon cache" class="float-right hvr-grow p-1 text-primary"><i style="-webkit-text-stroke:1px;padding-right:5px;" class="bi bi-arrow-repeat"></i></a>@endif



                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>


        <script type="text/javascript">
            const linksTableOrders = "{{ implode(' | ', $links->pluck('id')->toArray()) }}"
        </script>
    </div>

    <ul class="pagination justify-content-center">
        {!! $links ?? ''->links() !!}
    </ul>

    <a class="btn btn-primary" href="{{ url('/studio/add-link') }}">Add new item</a>
    </div>
</section>

<section class='pre-right shadow text-gray-400 pre-side'>
    <h3 class="card-header"><i class="bi bi-window-fullscreen" style="font-style:normal!important;"> Preview:</i></h3>
        <div class='card-body p-0 p-md-3'>
                <center><iframe allowtransparency="true" id="frPreview1" style=" border-radius:0.25rem !important; background: #FFFFFF; min-height:600px; height:100%; max-width:500px !important;" class='w-100' src="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>">Your browser isn't compatible</iframe></center>
         </div>
</section>
</div>

<br>
<section style="margin-left:-15px;margin-right:-15px;" style="width:100%!important;" class='pre-bottom shadow text-gray-400 pre-side'>
    <h3 class="card-header"><i class="bi bi-window-fullscreen" style="font-style:normal!important;"> Preview:</i></h3>
        <div class='card-body p-0 p-md-3'>
                <center><iframe allowtransparency="true" id="frPreview2" style=" border-radius:0.25rem !important; background: #FFFFFF; min-height:600px; height:100%; width:100% !important;" class='w-100' src="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>">Your browser isn't compatible</iframe></center>
         </div>
</section><br>

<section style="margin-left:-15px;margin-right:-15px;" class='shadow text-gray-400'>
<a name="icons"></a>
<h3 class="mb-4 card-header"><i class="fa-solid fa-icons"></i> Page Icons</i></h3>
<div class="card-body p-0 p-md-3">

<form action="{{ route('editIcons') }}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="form-group col-lg-8">

            @php
            function iconLink($icon){
            $iconLink = DB::table('links')
            ->where('user_id', Auth::id())
            ->where('title', $icon)
            ->where('button_id', 94)
            ->value('link');
              if (is_null($iconLink)){
                   return false;
              } else {
                    return $iconLink;}}
            function searchIcon($icon)
        {$iconId = DB::table('links')
            ->where('user_id', Auth::id())
            ->where('title', $icon)
            ->where('button_id', 94)
            ->value('id');
        if(is_null($iconId)){return false;}else{return $iconId;}}
            function iconclicks($icon){
            $iconClicks = searchIcon($icon);
            $iconClicks = DB::table('links')->where('id', $iconClicks)->value('click_number');
              if (is_null($iconClicks)){return 0;}
              else {return $iconClicks;}}

        function icon($name, $label){ echo '
        <label>'.$label.'</label><span style="font-size:90%;font-style:italic;">&emsp; Clicks: '.iconclicks($name).'</span>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa-brands fa-'.$name.'"></i></div>
            </div>
            <input type="url" class="form-control" name="'.$name.'" value="'.iconLink($name).'" >';
            if(searchIcon($name) != NULL){echo '<a href="'. route("deleteLink", searchIcon($name) ) .'" class="delete"><i style="color:#fff" class="bi bi-trash-fill"></i></a>';}
        echo '</div><br>';}
            @endphp
        <style>input{border-top-right-radius: 0.25rem!important; border-bottom-right-radius: 0.25rem!important;}</style>


    {!!icon('mastodon', 'Mastodon')!!}

    {!!icon('instagram', 'Instagram')!!}

    {!!icon('twitter', 'Twitter')!!}

    {!!icon('facebook', 'Facebook')!!}

    {!!icon('github', 'GitHub')!!}

    {!!icon('linkedin', 'LinkedIn')!!}

    {!!icon('tiktok', 'TikTok')!!}

    {!!icon('discord', 'Discord')!!}

    {!!icon('youtube', 'YouTube')!!}

    {!!icon('snapchat', 'Snapchat')!!}

    {!!icon('reddit', 'Reddit')!!}

    {!!icon('pinterest', 'Pinterest')!!}´

    {{-- {!!icon('telegram', 'Telegram')!!}

    {!!icon('whatsapp', 'WhatsApp')!!} --}}


    <button type="submit" class="mt-3 ml-3 btn btn-info">Save links</button>
</form>


</div>
</section>


<script src="{{ asset('studio/external-dependencies/jquery-1.12.4.min.js') }}"></script>
<script type="text/javascript">$("iframe").load(function() { $("iframe").contents().find("a").each(function(index) { $(this).on("click", function(event) { event.preventDefault(); event.stopPropagation(); }); }); });</script>

@endsection

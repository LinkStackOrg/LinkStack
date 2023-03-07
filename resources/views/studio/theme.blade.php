@extends('layouts.sidebar')

@section('content')
@foreach($pages as $page)

<section class=' shadow text-gray-400'>
<h3 class="mb-4 card-header"><i class="bi bi-brush"> Select a theme</i></h3>
<div class="card-body p-0 p-md-3">

<section class="shadow text-gray-400"></section>
<div class="card-body p-0 p-md-3">
<form action="{{ route('editTheme') }}" enctype="multipart/form-data" method="post">
    @csrf

    <div class="form-group row">

        <div class="col-8 col-md-4">
            <select id="theme-select" style="margin-left: 15px; margin-bottom: 20px;" class="form-control" name="theme" data-base-url="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>">
                <?php
                    if ($handle = opendir('themes')) {
                        while (false !== ($entry = readdir($handle))) {
                            if ($entry != "." && $entry != "..") {
                                if(file_exists(base_path('themes') . '/' . $entry . '/readme.md')){
                                    $text = file_get_contents(base_path('themes') . '/' . $entry . '/readme.md');
                                    $pattern = '/Theme Name:.*/';
                                    preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);
                                    if(sizeof($matches) > 0) {
                                        $themeName = substr($matches[0][0],12);
                                    }
                                }
                                if($page->theme != $entry and isset($themeName)){
                                    echo '<option value="'.$entry.'" data-image="'.url('themes/'.$entry.'/screenshot.png').'">'.$themeName.'</option>';
                                }
                            }
                        }
                    }
        
                    if($page->theme != "default" and $page->theme != ""){
                        if(file_exists(base_path('themes') . '/' . $page->theme . '/readme.md')){
                            $text = file_get_contents(base_path('themes') . '/' . $page->theme . '/readme.md');
                            $pattern = '/Theme Name:.*/';
                            preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);
                            $themeName = substr($matches[0][0],12);
                        }
                        echo '<option value="'.$page->theme.'" data-image="'.url('themes/'.$page->theme.'/screenshot.png').'" selected>'.$themeName.'</option>';
                    }
        
                    echo '<option value="default" data-image="'.url('themes/default/screenshot.png').'"';
                    if($page->theme == "default" or $page->theme == ""){
                        echo ' selected';
                    }
                    echo '>Default</option>';
                ?>
            </select>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary">Apply</button>
        </div>
    </div>

    {{-- <br><br><div class="form-group col-lg-8">
            <h3>Current theme</h3>
            @if(empty($page->theme))
            <input type="text" class="form-control" value="default" readonly>
            @else
            <input type="text" class="form-control" value="{{ $page->theme }}" readonly>
    @endif
    </div><br> --}}

    <div id="result" style="left: 1%; position: relative; background-color:#2c2d3a; border-radius: 25px; min-width:300px; max-width:950px; box-shadow: 0 10px 20px -10px rgba(0,0,0, 0.6);">
        <div style="padding:5%5%;">
            <h3 align="center" style="color:white">Preview:</h3>
            @if(env('USE_THEME_PREVIEW_IFRAME') === false or $page->littlelink_name == '')
            <center><img style="width:95%;max-width:700px;argin-left:1rem!important;" src="@if(file_exists(base_path() . '/themes/' . $page->theme . '/preview.png')){{url('/themes/' . $page->theme . '/preview.png')}}@elseif($page->theme === 'default' or empty($page->theme)){{url('/littlelink/images/themes/default.png')}}@else{{url('/littlelink/images/themes/no-preview.png')}}@endif"></img></center>
             @else
            <iframe frameborder="0" allowtransparency="true" id="frPreview" style="background: #FFFFFF;height:400px;" class='w-100' src="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>">Your browser isn't compatible</iframe>
            @endif



        </div>
    </div><br>


</form>
</details>

@if(auth()->user()->role == 'admin')
@if(env('ENABLE_THEME_UPDATER') == 'true')
<div id="ajax-container" style="height: 123px;"></div>
<div id="my-lazy-element"></div>
@endif
@endif

@if(env('ALLOW_CUSTOM_BACKGROUNDS') == true)
<br><br><br>
<form action="{{ route('themeBackground') }}" enctype="multipart/form-data" method="post">
    @csrf
    <h3>Custom background</h3>
    <div style="display: none;" class="form-group col-lg-8">
        <select class="form-control" name="theme">
            <option>{{ $page->theme }}</option>
        </select>
        <br>
    </div>
    <div class="form-group col-lg-8">
        @if(!file_exists(base_path('/img/background-img/'.findBackground(Auth::user()->id))))<p><i>No image selected</i></p>@endif
        <img style="width:95%;max-width:400px;argin-left:1rem!important;border-radius:5px;" src="@if(file_exists(base_path('/img/background-img/'.findBackground(Auth::user()->id)))){{url('/img/background-img/'.findBackground(Auth::user()->id))}}@else{{url('/littlelink/images/themes/no-preview.png')}}@endif"><br>
        @if(file_exists(base_path('/img/background-img/'.findBackground(Auth::user()->id))))<button class="mt-3 ml-3 btn btn-primary" style="background-color:tomato!important;border-color:tomato!important;transform: scale(.9);" title="Delete background image"><a href="{{ url('/studio/rem-background') }}" style="color:#FFFFFF;"><i class="bi bi-trash-fill"></i> Remove background</a></button><br>@endif
        <br>
        <label>Upload background image</label>
        <input type="file" accept="image/jpeg,image/jpg,image/png" class="form-control-file" name="image">
    </div>
    <div class="row">
        <button type="submit" class="mt-3 ml-3 btn btn-secondary">Upload background</button>
    </div>
</form>
@endif

@if(auth()->user()->role == 'admin')
<br><br><br>
<form action="{{ route('editTheme') }}" enctype="multipart/form-data" method="post">
    @csrf
    <h3>Upload themes</h3>
    <div style="display: none;" class="form-group col-lg-8">
        <select class="form-control" name="theme">
            <option>{{ $page->theme }}</option>
        </select>
        <br>
    </div>
    <div class="form-group col-lg-8">
        <label>Upload theme</label>
        <input type="file" accept=".zip" class="form-control-file" name="zip">
    </div>
    <style>
        .deltheme {
            color: tomato;
            font-size: 120%;
        }

        .deltheme:hover {
            color: red;
            text-decoration: underline;
        }

    </style>
    <div class="row">
        <button type="submit" class="mt-3 ml-3 btn btn-info">Upload theme</button>
        <button class="mt-3 ml-3 btn btn-primary" style="background-color:tomato!important;border-color:tomato!important;" title="Delete themes"><a href="{{ url('/panel/theme') }}" target="_blank" style="color:#FFFFFF;">Delete themes</a></button>
        <button class="mt-3 ml-3 btn btn-primary" title="Download more themes"><a href="https://littlelink-custom.com/themes.php" target="_blank" style="color:#FFFFFF;">Download themes</a></button>
    </div>
</form>
</details>
</div>
@endif

@endforeach

<script src="{{ asset('studio/external-dependencies/jquery-1.12.4.min.js') }}"></script>
</section>
<script>
$(document).ready(function() {
    var placeholder = $('#ajax-container');
    var lazyElement = $('#my-lazy-element');
    
    $.ajax({
        url: '../theme-updater',
        success: function(response) {
            placeholder.replaceWith(lazyElement);
            
            lazyElement.html(response);
        }
    });
});
</script>
<script type="text/javascript">$("iframe").load(function() { $("iframe").contents().find("a").each(function(index) { $(this).on("click", function(event) { event.preventDefault(); event.stopPropagation(); }); }); });</script>
@endsection
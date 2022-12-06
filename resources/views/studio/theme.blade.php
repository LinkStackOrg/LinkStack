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
            <select style="margin-left: 15px; margin-bottom: 20px;" class="form-control" name="theme" data-base-url="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>">

                <?php if ($handle = opendir('themes')) {
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
                    if($page->theme != $entry and isset($themeName)){echo '<option value="'; print_r($entry); echo '">'; echo $themeName; echo '</option>'; }}}} ?>
                    <?php 
                    if($page->theme != "default" and $page->theme != ""){
                    if(file_exists(base_path('themes') . '/' . $page->theme . '/readme.md')){
                    $text = file_get_contents(base_path('themes') . '/' . $page->theme . '/readme.md');
                    $pattern = '/Theme Name:.*/';
                    preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);
                    $themeName = substr($matches[0][0],12);}
                    if(isset($themeName)){echo '<option value="'.$page->theme.'" selected>'.$themeName.'</option>';}} ?>
                    <?php echo '<option value="default"'; if($page->theme == "default" or $page->theme == ""){echo 'selected';} echo '>Default</option>'; ?>
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
<style>
    details {
        width: 65%;
        margin-left: 15px;

            {
                {
                -- max-width: calc(100% - 20rem);
                --
            }
        }

        position: relative;
        border: 1px solid #78909C;
        border-radius: 6px;
        background-color: #ECEFF1;
        color: #263238;
        transition: background-color .15s;

        > :last-child {
            margin-bottom: 1rem;
        }

        &::before {
            width: 100%;
            height: 100%;
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            border-radius: inherit;
            opacity: .15;
            box-shadow: 0 .25em .5em #263238;
            pointer-events: none;
            transition: opacity .2s;
            z-index: -1;
        }

        &[open] {
            background-color: #FFF;

            &::before {
                opacity: .6;
            }
        }
    }

    summary {
        padding: 0.375rem 0.75rem;
        width: 100%;
        display: block;
        position: relative;
        font-size: 1.33em;
        font-weight: bold;
        cursor: pointer;

        &::before,
        &::after {
            width: .75em;
            height: 2px;
            position: absolute;
            top: 50%;
            right: 0;
            content: '';
            background-color: currentColor;
            text-align: right;
            transform: translateY(-50%);
            transition: transform .2s ease-in-out;
        }

        &::after {
            transform: translateY(-50%) rotate(90deg);

            [open] & {
                transform: translateY(-50%) rotate(180deg);
            }
        }

        &::-webkit-details-marker {
            display: none;
        }
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    .updatespin {
        animation: upspin 1s linear infinite;
        display: inline-block;
    }

    @keyframes upspin {
        100% {
            transform: rotate(360deg)
        }
    }

</style>
<br><br><br>
<details>
    <summary><i class="bi bi-caret-down-fill"></i> Theme updater </summary>
    <div class="content" style="padding:10px;">
        <table>
            <tr>
                <th style="width:85%;">Theme name:</th>
                <th style="width: 15%;">Update status:</th>
                <th>Version:&nbsp;</th>
            </tr>
            <?php

            if ($handle = opendir('themes')) {
             while (false !== ($entry = readdir($handle))) {

                    if(file_exists(base_path('themes') . '/' . $entry . '/readme.md')){
                    $text = file_get_contents(base_path('themes') . '/' . $entry . '/readme.md');
                    $pattern = '/Theme Version:.*/';
                    preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);
                    if(sizeof($matches) > 0) {
                      $verNr = substr($matches[0][0],15);
                    }
                  }

                    $themeVe = NULL;
                    if(!isset($verNr)){$verNr = "error";};

                if ($entry != "." && $entry != "..") {
                    echo '<tr>';
                    echo '<th>'; print_r(ucfirst($entry));
                    echo '</th>';
                    echo '<th><center>';
                    if(file_exists(base_path('themes') . '/' . $entry . '/readme.md')){
                      if(!strpos(file_get_contents(base_path('themes') . '/' . $entry . '/readme.md'), 'Source code:')){$hasSource = false;}else{
                        $hasSource = true;

                        $text = file_get_contents(base_path('themes') . '/' . $entry . '/readme.md');
                        $pattern = '/Source code:.*/';
                        preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);
                        $sourceURL = substr($matches[0][0],13);

                        $replaced = str_replace("https://github.com/", "https://raw.githubusercontent.com/", trim($sourceURL));
                        $replaced = $replaced . "/main/readme.md";

                        if (strpos($sourceURL, 'github.com')){

                        ini_set('user_agent', 'Mozilla/4.0 (compatible; MSIE 6.0)');
                        try{
                            $textGit = file_get_contents($replaced);
                            $patternGit = '/Theme Version:.*/';
                            preg_match($patternGit, $textGit, $matches, PREG_OFFSET_CAPTURE);
                            $sourceURLGit = substr($matches[0][0],15);
                            $Vgitt = 'v' . $sourceURLGit;
                            $verNrv = 'v' . $verNr;
                        }catch(Exception $ex){
                            $themeVe = "error";
                            $Vgitt = NULL;
                            $verNrv = NULL;
                        }

                        if(trim($Vgitt) > trim($verNrv)){
                          $updateAv = true;
                          $GLOBALS['updateAv'] = true;
                        } else {
                          $updateAv = false;
                        }
                        } else {$themeVe = "error";}

                        }
                      }

                    if ($themeVe == "error") {
                    echo '<img style="scale:0.9" src="https://img.llc.ovh/static/v1?label=&message=Error!&color=red">';
                    } elseif ($hasSource == false) {
                    echo '<a href="https://littlelink-custom.com/themes.php" target="_blank"><img style="scale:0.9" src="https://img.llc.ovh/static/v1?label=&message=Update manually&color=red"></a>';
                    } elseif($updateAv == true) {
                    echo '<img style="scale:0.9" src="https://img.llc.ovh/static/v1?label=&message=Update available&color=yellow">';
                    } else {
                    echo '<img style="scale:0.9" src="https://img.llc.ovh/static/v1?label=&message=Up to date&color=green">';
                    }
                    echo '</center></th>';
                    echo '<th>' . $verNr . '</th>';
                    echo '</tr>';}
                    }} ?>
        </table>
    </div>
    <a href="{{url('update/theme')}}" onclick="updateicon()" class="mt-3 ml-3 btn btn-info row"><span id="updateicon" class=""><i class="bi bi-arrow-repeat"></i></span> Update all themes</a><br><br>
    <script>
        function updateicon() {
            var element = document.getElementById("updateicon");
            element.classList.add("updatespin");
        }

    </script>
</details>

<?php
try{ if($GLOBALS['updateAv'] == true) echo '<img style="padding-left:40px; padding-top:15px; scale: 1.5;" src="https://img.llc.ovh/static/v1?label=&message=A theme needs updating&color=brightgreen">';
}catch(Exception $ex){}
?>

@endif

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

@push('sidebar-scripts')
<script>
    $(function() {
        $('select[name=theme]').on('change', function() {
            var s = $(this).data('base-url') + "?t=" + $(this).val();
            $("#frPreview").prop('src', s);
        })
    });

    class Accordion {
        constructor(el) {
            // Store the <details> element
            this.el = el;
            // Store the <summary> element
            this.summary = el.querySelector('summary');
            // Store the <div class="content"> element
            this.content = el.querySelector('.content');

            // Store the animation object (so we can cancel it if needed)
            this.animation = null;
            // Store if the element is closing
            this.isClosing = false;
            // Store if the element is expanding
            this.isExpanding = false;
            // Detect user clicks on the summary element
            this.summary.addEventListener('click', (e) => this.onClick(e));
        }

        onClick(e) {
            // Stop default behaviour from the browser
            e.preventDefault();
            // Add an overflow on the <details> to avoid content overflowing
            this.el.style.overflow = 'hidden';
            // Check if the element is being closed or is already closed
            if (this.isClosing || !this.el.open) {
                this.open();
                // Check if the element is being openned or is already open
            } else if (this.isExpanding || this.el.open) {
                this.shrink();
            }
        }

        shrink() {
            // Set the element as "being closed"
            this.isClosing = true;

            // Store the current height of the element
            const startHeight = `${this.el.offsetHeight}px`;
            // Calculate the height of the summary
            const endHeight = `${this.summary.offsetHeight}px`;

            // If there is already an animation running
            if (this.animation) {
                // Cancel the current animation
                this.animation.cancel();
            }

            // Start a WAAPI animation
            this.animation = this.el.animate({
                // Set the keyframes from the startHeight to endHeight
                height: [startHeight, endHeight]
            }, {
                duration: 400
                , easing: 'ease-out'
            });

            // When the animation is complete, call onAnimationFinish()
            this.animation.onfinish = () => this.onAnimationFinish(false);
            // If the animation is cancelled, isClosing variable is set to false
            this.animation.oncancel = () => this.isClosing = false;
        }

        open() {
            // Apply a fixed height on the element
            this.el.style.height = `${this.el.offsetHeight}px`;
            // Force the [open] attribute on the details element
            this.el.open = true;
            // Wait for the next frame to call the expand function
            window.requestAnimationFrame(() => this.expand());
        }

        expand() {
            // Set the element as "being expanding"
            this.isExpanding = true;
            // Get the current fixed height of the element
            const startHeight = `${this.el.offsetHeight}px`;
            // Calculate the open height of the element (summary height + content height)
            const endHeight = `${this.summary.offsetHeight + this.content.offsetHeight}px`;

            // If there is already an animation running
            if (this.animation) {
                // Cancel the current animation
                this.animation.cancel();
            }

            // Start a WAAPI animation
            this.animation = this.el.animate({
                // Set the keyframes from the startHeight to endHeight
                height: [startHeight, endHeight]
            }, {
                duration: 400
                , easing: 'ease-out'
            });
            // When the animation is complete, call onAnimationFinish()
            this.animation.onfinish = () => this.onAnimationFinish(true);
            // If the animation is cancelled, isExpanding variable is set to false
            this.animation.oncancel = () => this.isExpanding = false;
        }

        onAnimationFinish(open) {
            // Set the open attribute based on the parameter
            this.el.open = open;
            // Clear the stored animation
            this.animation = null;
            // Reset isClosing & isExpanding
            this.isClosing = false;
            this.isExpanding = false;
            // Remove the overflow hidden and the fixed height
            this.el.style.height = this.el.style.overflow = '';
        }
    }

    document.querySelectorAll('details').forEach((el) => {
        new Accordion(el);
    });

</script>
</div>
</section>
@endpush
@endif

@endforeach

<script src="{{ asset('studio/external-dependencies/jquery-1.12.4.min.js') }}"></script>
<script type="text/javascript">$("iframe").load(function() { $("iframe").contents().find("a").each(function(index) { $(this).on("click", function(event) { event.preventDefault(); event.stopPropagation(); }); }); });</script>
@endsection

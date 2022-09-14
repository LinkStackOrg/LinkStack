@extends('layouts.sidebar')

@section('content')
@foreach($pages as $page)
        <h2 class="mb-4"><i class="bi bi-brush"> Select a theme</i></h2>

        <form action="{{ route('editTheme') }}" enctype="multipart/form-data" method="post">
        @csrf

        <br><br><div class="form-group col-lg-8">
            <h3>Current theme</h3>
            @if(empty($page->theme))
            <input type="text" class="form-control" value="default" readonly>
            @else
            <input type="text" class="form-control" value="{{ $page->theme }}" readonly>
            @endif
          </div><br>

<div id="result" style="left: 1%; position: relative; background-color:#2c2d3a; border-radius: 25px; min-width:300px; max-width:950px; box-shadow: 0 10px 20px -10px rgba(0,0,0, 0.6);">
<div style="padding:5%5%;">
<h3 align="center" style="color:white">Preview:</h3>
<center><img style="width:95%;max-width:700px;argin-left:1rem!important;" src="@if(file_exists(base_path() . '/themes/' . $page->theme . '/preview.png')){{url('/themes/' . $page->theme . '/preview.png')}}@elseif($page->theme === 'default' or empty($page->theme)){{url('/littlelink/images/themes/default.png')}}@else{{url('/littlelink/images/themes/no-preview.png')}}@endif"></img></center>
</div></div><br>

        <div class="form-group col-lg-8">
        <h3>Select a theme</h3>
          <select class="form-control" name="theme">
            <?php if ($handle = opendir('themes')) {
             while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    echo '<option>'; print_r($entry); echo '</option>'; }}} ?>
                    <option>default</option>
          </select>

        </div>
        <button type="submit" class="mt-3 ml-3 btn btn-info">Update theme</button>
        </form>
        </details>

        @if(auth()->user()->role == 'admin')
@if(env('ENABLE_THEME_UPDATER') == 'true')
<style>
details {
  width: 65%;
  margin-left: 15px;
  {{-- max-width: calc(100% - 20rem); --}}
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
table, th, td {
  border:1px solid black;
}
</style>
<br><br><br>
<details>
  <summary><i class="bi bi-caret-down-fill"></i> Theme updater <img src="https://img.shields.io/static/v1?label=&message=BETA&color=yellow"></summary>
  <div style="padding:10px;">
  <table>
    <tr>
      <th style="width:85%;">Theme name:</th>
      <th style="width: 15%;">Update status:</th>
      <th>Version:</th>
    </tr>
            <?php 

            if ($handle = opendir('themes')) {
             while (false !== ($entry = readdir($handle))) {

                    if(file_exists(base_path('themes') . '/' . $entry . '/readme.md')){
                    $text = file_get_contents(base_path('themes') . '/' . $entry . '/readme.md');
                    $pattern = '/Theme Version:.*/';
                    preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);
                    $verNr = substr($matches[0][0],15);}

                    $themeVe = NULL;

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
                    echo '<img style="scale:0.9" src="https://img.shields.io/static/v1?label=&message=Error!&color=red">';
                    } elseif ($hasSource == false) {
                    echo '<img style="scale:0.9" src="https://img.shields.io/static/v1?label=&message=Update manually&color=red">';
                    } elseif($updateAv == true) {
                    echo '<img style="scale:0.9" src="https://img.shields.io/static/v1?label=&message=Update available&color=yellow">';
                    } else {
                    echo '<img style="scale:0.9" src="https://img.shields.io/static/v1?label=&message=Up to date&color=green">';
                    }
                    echo '</center></th>';
                    echo '<th>' . $verNr . '</th>';
                    echo '</tr>';}
                    }} ?>
  </table>
  </div>
  <a href="{{url('update/theme')}}" class="mt-3 ml-3 btn btn-info">Update themes</a><br><br>
</details>

<?php 
try{ if($GLOBALS['updateAv'] == true) echo '<img style="padding-left:40px; padding-top:15px; scale: 1.5;" src="https://img.shields.io/static/v1?label=&message=A theme needs updating&color=brightgreen">';
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
          <style>.deltheme{color:tomato;font-size:120%;}.deltheme:hover{color:red;text-decoration:underline;}</style>
          <a class="deltheme" href="{{ url('/panel/theme') }}">&emsp; Delete themes</a>
        <div class="row">
        <button type="submit" class="mt-3 ml-3 btn btn-info">Upload theme</button>
        <button class="mt-3 ml-3 btn btn-primary" title="Download more themes"><a href="https://littlelink-custom.com/themes.php" target="_blank" style="color:#FFFFFF;">Download themes</a></button>
        </div>
        </form>
        </details>
        
        @endif

          @endforeach
@endsection

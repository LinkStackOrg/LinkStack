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
        <button type="submit" class="mt-3 ml-3 btn btn-info">Upload theme</button>
        </form>
        </details>


        
        @endif


          @endforeach
@endsection

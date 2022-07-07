@extends('layouts.sidebar')

@section('content')

@if(env('ALLOW_USER_HTML') === true) <script src="{{ asset('resources/ckeditor/ckeditor.js') }}"></script> @endif

        <h2 class="mb-4"><i class="bi bi-file-earmark-break"> Page</i></h2>
        
        @foreach($pages as $page)
        <form action="{{ route('editPage') }}" enctype="multipart/form-data" method="post">
          @csrf
        @if($page->littlelink_name != '')
          <div class="form-group col-lg-8">
            <label>Logo</label>
            <input type="file" accept="image/jpeg,image/jpg,image/png" class="form-control-file" name="image">
          </div>
        @endif
          
          <div class="form-group col-lg-8">
          @if(file_exists(base_path("img/$page->littlelink_name" . ".png" )))
          <img src="{{ asset("img/$page->littlelink_name" . ".png") }}" style="width: 75px; height: 75px; border-radius: 50%; object-fit: cover;">
          @else
          <img src="{{ asset('littlelink/images/logo.svg') }}" style="width: 75px; height: 75px; object-fit: cover;">
          @endif
          </div>
          
          <!--<div class="form-group col-lg-8">
            <label>Path name</label>
            @<input type="text" class="form-control" name="pageName" value="{{ $page->littlelink_name ?? '' }}">
          </div>-->
          
          <div class="form-group col-lg-8">
           <?php 
            $url = $_SERVER['REQUEST_URI'];
             if( strpos( $url, "no_page_name" ) == true ) echo '<span style="color:#FF0000; font-size:120%;">You do not have a Page URL</span>'; ?>
              <br>
            <label>Page URL</label>
	          <div class="input-group">
				  <div class="input-group-prepend">
					<div class="input-group-text">{{ url('') }}/@</div>
				  </div>
				  <input type="text" class="form-control" name="pageName" value="{{ $page->littlelink_name ?? '' }}" required>
			  </div>
		  </div>
          
          <div class="form-group col-lg-8">
            <label>Page Description</label>
            <textarea class="form-control @if(env('ALLOW_USER_HTML') === true) ckeditor @endif" name="pageDescription" rows="3">{{ $page->littlelink_description ?? '' }}</textarea>
          </div>
          @endforeach
          <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
        </form>

@endsection

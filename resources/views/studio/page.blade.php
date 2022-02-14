@extends('layouts.sidebar')

@section('content')

        <h2 class="mb-4"><i class="bi bi-file-earmark-break"> Page</i></h2>
        
        <form action="{{ route('editPage') }}" enctype="multipart/form-data" method="post">
          @csrf
          <div class="form-group col-lg-8">
            <label>Logo</label>
            <input type="file" class="form-control-file" name="image">
          </div>
          @foreach($pages as $page)
          
          <div class="form-group col-lg-8">
          @if(file_exists(base_path("img/$page->littlelink_name" . ".png" )))
          <img src="{{ asset("img/$page->littlelink_name" . ".png") }}" srcset="{{ asset("img/$page->littlelink_name" . "@2x.png 2x") }}" width="100px" height="100px">
          @else
          <img src="{{ asset('littlelink/images/avatar.png') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}">
          @endif
          </div>
          
          <!--<div class="form-group col-lg-8">
            <label>Path name</label>
            @<input type="text" class="form-control" name="pageName" value="{{ $page->littlelink_name ?? '' }}">
          </div>-->
          
          <div class="form-group col-lg-8">
            <label>Page URL</label>
	          <div class="input-group">
				  <div class="input-group-prepend">
					<div class="input-group-text">{{ config('app.url') }}/@</div>
				  </div>
				  <input type="text" class="form-control" name="pageName" value="{{ $page->littlelink_name ?? '' }}">
			  </div>
		  </div>
          
          <div class="form-group col-lg-8">
            <label>Page Description</label>
            <textarea class="form-control" name="pageDescription" rows="3">{{ $page->littlelink_description ?? '' }}</textarea>
          </div>
          @endforeach
          <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
        </form>

@endsection

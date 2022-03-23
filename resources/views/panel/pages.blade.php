@extends('layouts.sidebar')

@section('content')

<script src="{{ asset('resources/ckeditor/ckeditor.js') }}"></script>

      <h2 class="mb-4"><i class="bi bi-person"> Edit Pages</i></h2>
        
      <form action="{{ route('editSitePage') }}" method="post">
        @csrf
        @foreach($pages as $page)
          <div class="form-group col-lg-8">
            <h3>Terms</h3>
            <textarea class="form-control ckeditor" name="terms" rows="3">{{ $page->terms }}</textarea>
          </div><br>
          <div class="form-group col-lg-8">
            <h3>Privacy</h3>
            <textarea class="form-control ckeditor" name="privacy" rows="3">{{  $page->privacy }}</textarea>
          </div><br>
          <div class="form-group col-lg-8">
            <h3>Contact</h3>
            <textarea class="form-control ckeditor" name="contact" rows="3">{{ $page->contact }}</textarea>
          </div><br>
        <div class="form-group col-lg-8">
          <h3 for="exampleFormControlSelect1">Allow registration</h3>
          <select class="form-control" name="register">
		  @if($page->register == 'true')
            <option>true</option>
            <option>false</option>
		  @else
            <option>false</option>
            <option>true</option>
		  @endif
          </select>
        </div>
          @endforeach
          <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
        </form>

@endsection

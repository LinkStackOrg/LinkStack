@extends('layouts.sidebar')

@section('content')

      <h2 class="mb-4"><i class="bi bi-person"> Edit Pages</i></h2>
        
      <form action="{{ route('editSitePage') }}" method="post">
        @csrf
        @foreach($pages as $page)
          <div class="form-group col-lg-8">
            <label>Terms</label>
            <textarea class="form-control" name="terms" rows="3">{{ $page->terms }}</textarea>
          </div>
          <div class="form-group col-lg-8">
            <label>Privacy</label>
            <textarea class="form-control" name="privacy" rows="3">{{  $page->privacy }}</textarea>
          </div>
          <div class="form-group col-lg-8">
            <label>Contact</label>
            <textarea class="form-control" name="contact" rows="3">{{ $page->contact }}</textarea>
          </div>
        <div class="form-group col-lg-8">
          <label for="exampleFormControlSelect1">Allow registration</label>
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

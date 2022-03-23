@extends('layouts.sidebar')

@section('content')

<script src="{{ asset('resources/ckeditor/ckeditor.js') }}"></script>

      <h2 class="mb-4"><i class="bi bi-person"> Site</i></h2>
        
        <form action="{{ route('editSite') }}" enctype="multipart/form-data" method="post">
        @csrf
          <div class="form-group col-lg-8">
            <label>Site logo</label>
            <input type="file" class="form-control-file" name="image">
          </div>
          <div class="form-group col-lg-8">
            <h3>Home message</h3>
            <textarea class="form-control ckeditor" name="message" rows="3">{{ $home_message }}</textarea>
          </div>
          <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
        </form>

@endsection

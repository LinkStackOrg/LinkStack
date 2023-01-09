@extends('layouts.sidebar')

@section('content')

<script src="{{ asset('resources/ckeditor/ckeditor.js') }}"></script>

<section class="shadow text-gray-400">
      <h2 class="mb-4 card-header"><i class="bi bi-person"> Edit Pages</i></h2>
      <div class="card-body p-0 p-md-3">
        
      <form action="{{ route('editSitePage') }}" method="post">
        @csrf
        @foreach($pages as $page)
          <div class="form-group col-lg-8">
            <h3>{{str_replace('"', "", EnvEditor::getKey('TITLE_FOOTER_TERMS'))}}</h3>
            <textarea class="form-control ckeditor" name="terms" rows="3">{{ $page->terms }}</textarea>
          </div><br>
          <div class="form-group col-lg-8">
            <h3>{{str_replace('"', "", EnvEditor::getKey('TITLE_FOOTER_PRIVACY'))}}</h3>
            <textarea class="form-control ckeditor" name="privacy" rows="3">{{  $page->privacy }}</textarea>
          </div><br>
          <div class="form-group col-lg-8">
            <h3>{{str_replace('"', "", EnvEditor::getKey('TITLE_FOOTER_CONTACT'))}}</h3>
            <textarea class="form-control ckeditor" name="contact" rows="3">{{ $page->contact }}</textarea>
          </div><br>
          @endforeach
          <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
        </form>

          </div>
</section>
@endsection

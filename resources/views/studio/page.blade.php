@extends('layouts.sidebar')

@section('content')

<style>
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }

    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }

</style>

<section class=' shadow text-gray-400'>
<h3 class="mb-4 card-header"><i class="bi bi-file-earmark-break"> My Page</i></h3>
<div class="card-body p-0 p-md-3">

<div class="card-body"></div>
@foreach($pages as $page)
<form action="{{ route('editPage') }}" enctype="multipart/form-data" method="post">
    @csrf
    @if($page->littlelink_name != '')
    <div class="form-group col-lg-8">
        <label>Logo</label>@if(file_exists(base_path("img/" . $page->littlelink_name . ".png")))<a title="Remove icon" class="hvr-grow p-1 text-danger" style="padding-left:5px;" href="{{ route('delProfilePicture') }}"><i class="bi bi-trash-fill"></i></a>@endif
        <input type="file" accept="image/jpeg,image/jpg,image/png" class="form-control-file" name="image">
    </div>
    @endif

    <div class="form-group col-lg-8">
        @if(file_exists(base_path("img/$page->littlelink_name" . ".png" )))
        <img src="{{ asset("img/$page->littlelink_name" . ".png") }}" style="width: 75px; height: 75px; border-radius: 50%; object-fit: cover;">
        @else
        @if(!empty($page->image))
        <img src="{{ $page->image }}" style="width: 75px; height: 75px; object-fit: cover;">
        @else
        <img src="{{ asset('littlelink/images/logo.svg') }}" style="width: 75px; height: 75px; object-fit: cover;">
        @endif
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
            <input type="text" class="form-control" name="littlelink_name" value="{{ $page->littlelink_name ?? '' }}" required>
        </div>

         <label style="margin-top:15px">Display name</label>
        <div class="input-group">
            {{-- <div class="input-group-prepend">
                <div class="input-group-text">Name:</div>
            </div> --}}
            <input type="text" class="form-control" name="name" value="{{ $page->name }}" required>
        </div>
    </div>

    <div class="form-group col-lg-8">
        <label>Page Description</label>
        <textarea class="form-control @if(env('ALLOW_USER_HTML') === true) ckeditor @endif" name="pageDescription" rows="3">{{ $page->littlelink_description ?? '' }}</textarea>
    </div>
    @endforeach
    <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
</form>

@if(env('ALLOW_USER_HTML') === true)
<script src="{{ asset('studio/external-dependencies/ckeditor.js') }}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('.ckeditor'), {

            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|'
                    , 'findAndReplace', 'selectAll', '|'
                    , 'heading', '|'
                    , 'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|'
                    , 'bulletedList', 'numberedList', 'todoList', '|'
                    , 'outdent', 'indent', '|'
                    , 'undo', 'redo'

                    , 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|'
                    , 'alignment', '|'
                    , 'link', 'blockQuote', '|'
                    , 'specialCharacters', 'horizontalLine', '|'
                    , 'textPartLanguage', '|'
                ]
                , shouldNotGroupWhenFull: true
            }
            , fontFamily: {
                options: [
                    'default'
                    , 'Arial, Helvetica, sans-serif'
                    , 'Courier New, Courier, monospace'
                    , 'Georgia, serif'
                    , 'Lucida Sans Unicode, Lucida Grande, sans-serif'
                    , 'Tahoma, Geneva, sans-serif'
                    , 'Times New Roman, Times, serif'
                    , 'Trebuchet MS, Helvetica, sans-serif'
                    , 'Verdana, Geneva, sans-serif'
                ]
                , supportAllValues: true
            },
 fontSize: {
 options: [ 10, 12, 14, 'default', 18, 20, 22 ],
 supportAllValues: true
 },

        })
        .catch(error => {
            console.error(error);
        });

</script>

@endif
</div>

</div>
</section>
@endsection

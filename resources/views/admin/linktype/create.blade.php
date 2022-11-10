@extends('layouts.sidebar')

@section('content')

<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Create New Link Type</h1>
    </div>
    <div class='card-body'>

        <!-- if there are creation errors, they will show here -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif



        <form action='/admin/linktype' method="post">

            @csrf



            <div class="form-group">
                <label for="icon">Icon</label>
                <input type='text' value="{{@old('icon')}}" name='icon' class="form-control @error('icon') is-invalid @enderror">
                <a href="https://icons.getbootstrap.com/" target="_blank">View Icons Here</a>

                @error('icon')
                    <span class="text-danger d-blcok">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group">
                <label for="typename">Short Name</label>
                <input type='text' value="{{@old('typename')}}" name='typename' class="form-control @error('typename') is-invalid @enderror">

                @error('typename')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type='text' name='title' value="{{@old('title')}}" class='form-control @error("title") is-invalid @enderror'>
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name='description'  class="form-control @error('description') is-invalid @enderror" rows='3'>{{@old('description')}}</textarea>


                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            <div class="form-group">
                <label for="params">Parms</label>
                <textarea name='params' class="form-control  @error('params') is-invalid @enderror" rows='20'>{{@old('params')}}</textarea>


                @error('params')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>


            <div>
                <button type="submit" class="mt-3 ml-3 btn btn-info">Save</button>

            </div>
        </form>
    </div>
</div>
@endsection

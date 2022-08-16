@extends('layouts.sidebar')

@section('content')

        <h2 class="mb-4"><i class="bi bi-pen"> Edit Link</i></h2>

        <form action="{{ route('editLink', $id) }}" method="post">
        @csrf
        <div class="form-group col-lg-8">
          <label>Link</label>
          <input type="text" name="link" value="{{ $link }}" class="form-control" placeholder="https://example.com" required>
        </div>
        <div class="form-group col-lg-8">
          <label>Title</label>
          <input type="text" name="title" value="{{ $title }}" class="form-control" placeholder="Example">
        </div>
        <div class="form-group col-lg-8">
          <label for="exampleFormControlSelect1">Button</label>
          <select class="form-control" name="button">
            <option style="background-color:#1e90ff;color:#fff"> {{ $buttonName }} </option>

            @if ($buttonName != "custom")<option style="background-color:#ffe8e4;"> custom </option>@endif
            @if ($buttonName != "custom_website")<option style="background-color:#ffe8e4;"> custom_website </option>@endif
            @foreach($buttons as $button)
            @if (!in_array($button->name, ['custom', 'custom_website', 'heading', 'space']))
            @if ($button->name != $buttonName)
            <option> {{ $button->name }} </option>
            @endif
            @endif
            @endforeach
            @if ($buttonName != "heading")<option style="background-color:#ebebeb;"> heading </option>@endif
            @if ($buttonName != "space")<option style="background-color:#ebebeb;"> space </option>@endif

          </select>
        </div>
        
        <div class="form-group col-lg-8">
          <label>Order</label>
          <input type="number" name="order" value="{{ $order }}" class="form-control" placeholder="use for ordering links">
        </div>
        
        <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
        </form>

@endsection

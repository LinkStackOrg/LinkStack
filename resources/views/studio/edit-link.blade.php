@extends('layouts.sidebar')

@section('content')

        <h2 class="mb-4"><i class="bi bi-pen"> Edit Link</i></h2>

        <form action="{{ route('editLink', $id) }}" method="post">
        @csrf
        <div class="form-group col-lg-8">
          <label>Link</label>
          <input type="text" name="link" value="{{ $link }}" class="form-control" placeholder="https://google.com">
        </div>
        <div class="form-group col-lg-8">
          <label for="exampleFormControlSelect1">Button</label>
          <select class="form-control" name="button">
            @foreach($buttons as $button)
            <option> {{ $button->name }} </option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
        </form>

@endsection

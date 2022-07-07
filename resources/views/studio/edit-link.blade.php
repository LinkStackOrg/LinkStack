@extends('layouts.sidebar')

@section('content')

        <h2 class="mb-4"><i class="bi bi-pen"> Edit Link</i></h2>

        <form action="{{ route('editLink', $id) }}" method="post">
        @csrf
        <div class="form-group col-lg-8">
          <label>Link</label>
          <input type="text" name="link" value="{{ $link }}" class="form-control" placeholder="https://google.com" required>
        </div>
        <div class="form-group col-lg-8">
          <label>Title</label>
          <input type="text" name="title" value="{{ $title }}" class="form-control" placeholder="Google">
        </div>
        <div class="form-group col-lg-8">
          <label for="exampleFormControlSelect1">Button</label>
          <select class="form-control" name="button">
            @foreach($buttons as $button)
            <option <?= ($buttonId === $button->id) ? 'selected' : '' ?>> {{ $button->name }} </option>
            @endforeach
          </select>
        </div>
        
        <div class="form-group col-lg-8">
          <label>Order</label>
          <input type="number" name="order" value="{{ $order }}" class="form-control" placeholder="use for ordering links">
        </div>
        
        <button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button>
        </form>

@endsection

@extends('layouts.sidebar')

@section('content')
<h1>Link Types</h1>

<div>
    <a href="{{ url('admin/linktype/create') }}">Add New</a>
</div>


<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif


<div class=''>
    @foreach($linktype as $key => $value)

    <div class='row mb-2 border  shdadow'>
        <div class='col-12 h5'><i class='{{ $value->icon }}'></i> {{ $value->title }} <span class='small text-muted'>[{{ $value->typename }}]</span></div>


        <div class='col-12'>{{ $value->description }}</div>

        <div class='col-12 card-footer bg-light border border-top border-light'>


            <form action='/admin/linktype/{{$value->id}}' method="POST">

            <a class="btn btn-link btn-sm" href="{{ URL::to('admin/linktype/' . $value->id . '/edit') }}"><i class='bi bi-pencil'></i> Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-link p-2 text-danger" href="{{ URL::to('admin/linktype/' . $value->id . '/edit') }}" onclick="return confirm('Are you sure?')"><i class='bi bi-trash'></i> Delete</a>

            </form>
        </div>

    </div>
    @endforeach
</div>

@endsection

@extends('layouts.sidebar')

@section('content')

        <h2 class="mb-4"><i class="bi bi-plus">{{__('messages.Add Link')}}</i></h2>

        <form action="{{ route('addLink') }}" method="post">
        @csrf
        <div class="form-group col-lg-8">
          <label>{{__('messages.Link')}}</label>
          <input type="text" name="link" class="form-control" placeholder="https://example.com" required>
        </div>
        <div class="form-group col-lg-8">
          <label>{{__('messages.Title')}}</label>
          <input type="text" name="title" class="form-control" placeholder="Internal name (optional)">
        </div>
        <div class="form-group col-lg-8">
          <label for="exampleFormControlSelect1">{{__('messages.Button')}}</label>
          <select class="form-control" name="button">
            <option style="background-color:#ffe8e4;"> custom </option>
            <option style="background-color:#ffe8e4;"> custom_website </option>
            @foreach($buttons as $button)
            @if (!in_array($button->name, ['custom', 'custom_website', 'heading', 'space']))
            <option> {{ $button->name }} </option>
            @endif
            @endforeach
            <option style="background-color:#ebebeb;"> heading </option>
            <option style="background-color:#ebebeb;"> space </option>
          </select>
          <br>
          <label>{{__('messages.Required fields')}}</label><br>
        </div>
        <div class="row"><button type="submit" class="mt-3 ml-3 btn btn-info">{{__('messages.Submit')}}</button><a style="color:white;background-color:#f8b739;" class="mt-3 ml-3 btn" href="{{ url('/studio/links') }}">{{__('messages.See all links')}}</a></div>
        </form>

        <br><br><details>
    <summary>{{__('messages.More information')}}</summary>
<pre style="color: grey;">
{{__('messages.addli.description.1-5')}}
{{__('messages.addli.description.2-5')}}
{{__('messages.addli.description.3-5')}}
{{__('messages.addli.description.4-5')}}
{{__('messages.addli.description.5-5')}}
</pre>
</details>

@endsection

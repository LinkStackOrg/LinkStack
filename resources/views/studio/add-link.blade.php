@extends('layouts.sidebar')

@section('content')

        <h2 class="mb-4"><i class="bi bi-plus"> Add Link</i></h2>

        <form action="{{ route('addLink') }}" method="post">
        @csrf
        <div class="form-group col-lg-8">
          <label>Link*</label>
          <input type="text" name="link" class="form-control" placeholder="https://example.com" required>
        </div>
        <div class="form-group col-lg-8">
          <label>Title</label>
          <input type="text" name="title" class="form-control" placeholder="Internal name (optional)">
        </div>
        <div class="form-group col-lg-8">
          <label for="exampleFormControlSelect1">Button*</label>
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
          <label>* Required fields</label><br>
        </div>
        <div class="row"><button type="submit" class="mt-3 ml-3 btn btn-info">Submit</button><a style="color:white;background-color:#f8b739;" class="mt-3 ml-3 btn" href="{{ url('/studio/links') }}">See all links</a></div>
        </form>

        <br><br><details>
    <summary>More information</summary>
<pre style="color: grey;">
The 'Custom' button allows you to add a custom link, where the text on the button is determined with the link title set above.
The 'Custom_website' button functions similar to the Custom button, with the addition of a function that requests the favicon from the chosen URL and uses it as the button icon.

The 'Space' button will be replaced with an empty space, so buttons could be visually separated into groups. Entering a number between 1-10 in the title section will change the empty space's distance.
The 'Heading' button will be replaced with a sub-heading, where the title defines the text on that heading.
</pre>
</details>

@endsection

@extends('layouts.sidebar')

@section('content')

        <h2 class="mb-4"><i class="bi bi-brush"> Delete a theme</i></h2>

        <form action="{{ route('deleteTheme') }}" enctype="multipart/form-data" method="post">
        @csrf

        <div class="form-group col-lg-8">
        <h3>Delete theme</h3>
          <select class="form-control" name="deltheme">
            <?php if ($handle = opendir('themes')) {
             while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    echo '<option>'; print_r($entry); echo '</option>'; }}} ?>
          </select>

        </div>
        <button type="submit" class="mt-3 ml-3 btn btn-info">Delete theme</button>
        </form>
        </details>

<br><br><a class="btn btn-primary" href="{{ url('/studio/theme') }}">⬅ Back</a>

@endsection

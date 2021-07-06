@extends('layouts.sidebar')

@section('content')

        <h2 class="mb-4"> 👋 Hi, @<?= $littlelink_name ?></h2>

        <p>
            Welcome to {{ config('app.name') }}!
        </p>
        <div class="mt-5 row">
          <h5 class="mb-4"><i class="bi bi-link"> link: {{ $links }} </i></h5>
          <h5 class="mb-4 ml-5"><i class="bi bi-eye"> click: {{ $clicks }} </i></h5>
        </div>

@endsection

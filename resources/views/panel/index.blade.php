@extends('layouts.sidebar')

@section('content')
@if($littlelink_name == '')
        <h2 class="mb-4"> 👋 Hi, stranger</h2>
        <h5>You do not have a Page URL set, yet you can change that on the <a href="{{ url('/studio/page') }}">Page section</a></h5>
	@else
        <h2 class="mb-4"> 👋 Hi, @<?= $littlelink_name ?></h2>
		@endif
        <p>
          Welcome to {{ config('app.name') }}!
        </p>

        <div class="mt-5 row">
          <h5 class="mb-4" title="all links"><i class="bi bi-share-fill"> {{ $siteLinks }} </i></h5>
          <h5 class="mb-4 ml-5" title="all clicks"><i class="bi bi-eye-fill"> {{ $siteClicks }} </i></h5>
          <h5 class="mb-4 ml-5" title="all Users"><i class="bi bi bi-person-fill"> {{ $userNumber }}</i></h5>
        </div>

        <div class="mt-5 row">
        <h5 class="mb-4"><i class="bi bi-link"> link: {{ $links }} </i></h5>
          <h5 class="mb-4 ml-5"><i class="bi bi-eye"> click: {{ $clicks }} </i></h5>
        </div>

@endsection

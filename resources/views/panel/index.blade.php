@extends('layouts.sidebar')


@section('content')
@if($littlelink_name == '')
        <h3 class="mb-4"> 👋 Hi, stranger</h3>
        <h5>You do not have a Page URL set, yet you can change that on the <a href="{{ url('/studio/page') }}">Page section</a></h5>
	@else
        <h3 class="mb-4"> 👋 Hi, @<?= $littlelink_name ?></h2>
		@endif
        <p>
          Welcome to {{ config('app.name') }}!
        </p>


        <!-- Section: Design Block -->
        <section class="mb-3 text-gray-800 text-center shadow p-4 w-full">
            <div class='font-weight-bold text-left'>User stats:</div>
            <div class="d-flex flex-wrap justify-content-around">

                <div class="p-2">
                    <h3 class="text-primary"><strong><i class="bi bi-share-fill"> {{ $siteLinks }} </i></strong></h3>
                    <span class="text-muted">Total links</span>
                </div>

                <div class="p-2">
                    <h3 class="text-primary"><strong><i class="bi bi-eye-fill"> {{ $siteClicks }} </i></strong></h3>
                    <span class="text-muted">Total clicks</span>
                </div>

                <div class="p-2">
                    <h3 class="text-primary"><strong><i class="bi bi bi-person-fill"> {{ $userNumber }}</i></strong></h3>
                    <span class="text-muted">Total users</span>
                </div>

            </div>
        </section>

        <section class="mb-3 text-center shadow p-4 w-full">
            <div class=" d-flex">

                <div class='p-2 h6'><i class="bi bi-link"> Links: {{ $links }} </i></span></div>

                <div class='p-2 h6'><i class="bi bi-eye"> Clicks: {{ $clicks }} </i></span></div>
            </div>
        </section>



        {{-- <pre>{{ print_r($pageStats) }}</pre> --}}

        @endsection

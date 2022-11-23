@extends('layouts.sidebar')


@section('content')
@if($greeting == '')
<h3 class="mb-3"> 👋 Hi, stranger</h2>
    <h5>You do not have a Page URL set, yet you can change that on the <a href="{{ url('/studio/page') }}">Page section</a></h5>
    @else
    <h3 class="mb-3"> 👋 Hi, <?= $greeting ?></h2>
        @endif
        <p>
            Welcome to {{ config('app.name') }}!
        </p>


        {{-- <!-- Section: Design Block -->
        <section class="mb-3 text-gray-800 text-center shadow p-4 w-full">
            <div class='font-weight-bold text-left'>Visitor analytics:</div>
            <div class="d-flex flex-wrap justify-content-around">

                <div class="p-2">
                    <h3 class="text-primary"><strong>{{ $pageStats['visitors']['day']}}</strong></h3>
                    <span class="text-muted">Today</span>

                </div>

                <div class="p-2">
                    <h3 class="text-primary"><strong>{{ $pageStats['visitors']['week']}}</strong></h3>
                    <span class="text-muted">Week</span>


                </div>

                <div class="p-2">
                    <h3 class="text-primary"><strong>{{ $pageStats['visitors']['month']}}</strong></h3>
                    <span class="text-muted">Month</span>


                </div>
                <div class="p-2">
                    <h3 class="text-primary"><strong>{{ $pageStats['visitors']['year']}}</strong></h3>
                    <span class="text-muted">Year</span>


                </div>
                <div class="p-2">
                    <h3 class="text-primary"><strong>{{ $pageStats['visitors']['all']}}</strong></h3>
                    <span class="text-muted">All Time</span>


                </div>

            </div>
        </section> --}}



        <section class="mb-3 text-center shadow p-4 w-full">
            <div class=" d-flex">

                <div class='p-2 h6'><i class="bi bi-link"></i> Total Links: <span class='text-primary'>{{ $links }} </span></div>

                <div class='p-2 h6'><i class="bi bi-eye"></i> Link Clicks: <span class='text-primary'>{{ $clicks }}</span></div>
            </div>
            <div class='text-center w-100'>
                <a href="{{ url('/studio/links') }}">View/Edit Links</a>

            </div>
            <div class='w-100 text-left'>
                <h6><i class="bi bi-sort-up"></i> Top Links:</h6>

                                @php $i = 0; @endphp


                @foreach($toplinks as $link)
                @php $linkName = str_replace('default ','',$link->name) @endphp
                @php  $i++; @endphp
                <ol class='list-group list-group-flush bg-transparent'>

                @if($link->name !== "phone" && $link->name !== 'heading')
                <li class="list-group-item bg-transparent">
                  {{ $i }}.)  {{$link->title}} -- <span class='text-primary' title='Click Count'>{{$link->click_number}}  </span> <br />


                    <a href="{{$link->link}}" class='small ml-3' title='{{$link->link}}' target="_blank">{{$link->link}}</a></li>

                @endif
                </ol>

                @endforeach
        </section>

        {{-- <pre>{{ print_r($pageStats) }}</pre> --}}

        @endsection

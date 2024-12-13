<div class="row">

    <div class="col-lg-12">
        <div class="card   rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">

                        <h3 class="mb-4"><i class="bi bi-menu-up"></i> {{ __('messages.Dashboard') }}</h3>

                        <section class="mb-3 text-center p-4 w-full">
                            <div class=" d-flex">

                                <div class='p-2 h6'><i class="bi bi-link"></i> {{ __('messages.Total Links:') }} <span
                                        class='text-primary'>{{ $links }} </span></div>

                                <div class='p-2 h6'><i class="bi bi-eye"></i> {{ __('messages.Link Clicks:') }} <span
                                        class='text-primary'>{{ $clicks }}</span></div>
                            </div>
                            <div class='text-center w-100'>
                                <a href="{{ url('/studio/links') }}">{{ __('messages.View/Edit Links') }}</a>

                            </div>
                            <div class='w-100 text-left'>
                                <h6><i class="bi bi-sort-up"></i> {{ __('messages.Top Links:') }}</h6>

                                @php $i = 0; @endphp


                                <div class="bd-example">
                                    <ol class="list-group list-group-numbered" style="text-align: left;">
                                        @if ($toplinks == '[]')
                                            <div class="container">
                                                <div class="row justify-content-center mt-3">
                                                    <div class="col-6 text-center">
                                                        <p class="p-2">
                                                            {{ __('messages.You haven’t added any links yet') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            @foreach ($toplinks as $link)
                                                @php $linkName = str_replace('default ','',$link->name) @endphp
                                                @php  $i++; @endphp

                                                @if ($link->name !== 'phone' && $link->name !== 'heading' && $link->button_id !== 96)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                        <div class="ms-2 me-auto text-truncate">
                                                            <div class="fw-bold text-truncate">{{ $link->title }}</div>
                                                            {{ $link->link }}
                                                        </div>
                                                        <span
                                                            class="badge bg-primary rounded-pill p-2">{{ $link->click_number }}
                                                            - {{ __('messages.clicks') }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ol>
                                </div>

                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->role == 'admin' && !config('linkstack.single_user_mode'))
        <div class="col-lg-12">
            <div class="card   rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">

                            <!-- Section: Design Block -->
                            <section class="mb-3 text-gray-800 text-center p-4 w-full">
                                <div class='font-weight-bold text-left h3'>{{ __('messages.Site statistics:') }}</div>
                                <br>
                                <div class="d-flex flex-wrap justify-content-around">

                                    <div class="p-2">
                                        <h3 class="text-primary"><strong><i class="bi bi-share-fill">
                                                    {{ $siteLinks }} </i></strong></h3>
                                        <span class="text-muted">{{ __('messages.Total links') }}</span>
                                    </div>

                                    <div class="p-2">
                                        <h3 class="text-primary"><strong><i class="bi bi-eye-fill"> {{ $siteClicks }}
                                                </i></strong></h3>
                                        <span class="text-muted">{{ __('messages.Total clicks') }}</span>
                                    </div>

                                    <div class="p-2">
                                        <h3 class="text-primary"><strong><i class="bi bi bi-person-fill">
                                                    {{ $userNumber }}</i></strong></h3>
                                        <span class="text-muted">{{ __('messages.Total users') }}</span>
                                    </div>

                                </div>
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card   rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">

                            <!-- Section: Design Block -->
                            <section class="mb-3 text-gray-800 text-center p-4 w-full">
                                <div class='font-weight-bold text-left h3'>{{ __('messages.Registrations:') }}</div>
                                <br>
                                <div class="d-flex flex-wrap justify-content-around">

                                    <div class="p-2">
                                        <h3 class="text-primary"><strong> {{ $lastMonthCount }} </i></strong></h3>
                                        <span class="text-muted">{{ __('messages.Last 30 days') }}</span>
                                    </div>

                                    <div class="p-2">
                                        <h3 class="text-primary"><strong> {{ $lastWeekCount }} </i></strong></h3>
                                        <span class="text-muted">{{ __('messages.Last 7 days') }}</span>
                                    </div>

                                    <div class="p-2">
                                        <h3 class="text-primary"><strong> {{ $last24HrsCount }}</i></strong></h3>
                                        <span class="text-muted">{{ __('messages.Last 24 hours') }}</span>
                                    </div>

                                </div>
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card   rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">


                            <!-- Section: Design Block -->
                            <section class="mb-3 text-gray-800 text-center p-4 w-full">
                                <div class='font-weight-bold text-left h3'>{{ __('messages.Active users:') }}</div><br>
                                <div class="d-flex flex-wrap justify-content-around">

                                    <div class="p-2">
                                        <h3 class="text-primary"><strong> {{ $updatedLast30DaysCount }} </i></strong>
                                        </h3>
                                        <span class="text-muted">{{ __('messages.Last 30 days') }}</span>
                                    </div>

                                    <div class="p-2">
                                        <h3 class="text-primary"><strong> {{ $updatedLast7DaysCount }} </i></strong>
                                        </h3>
                                        <span class="text-muted">{{ __('messages.Last 7 days') }}</span>
                                    </div>

                                    <div class="p-2">
                                        <h3 class="text-primary"><strong> {{ $updatedLast24HrsCount }}</i></strong>
                                        </h3>
                                        <span class="text-muted">{{ __('messages.Last 24 hours') }}</span>
                                    </div>

                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

@extends('layouts.sidebar')

@section('content')
    <div id="site-stats" class="conatiner-fluid content-inner mt-n5 py-0" style="">
        <style>
            :root {
                --spinnerColor: #8a92a6;
            }

            .placeholder {
                height: 1.2rem;
                display: inline-block;
                background-color: #8a92a6;
                background: linear-gradient(90deg, var(--spinnerColor) 25%, #b8bcc5 50%, var(--spinnerColor) 75%);
                background-size: 200% 100%;
                animation: shimmer 2s infinite linear;
            }

            @keyframes shimmer {
                0% {
                    background-position: -200% 0;
                }

                100% {
                    background-position: 200% 0;
                }
            }
        </style>
        <div class="row">

            <div class="col-lg-12">
                <div class="card   rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">

                                <h3 class="mb-4"><i class="bi bi-menu-up"></i> {{ __('messages.Dashboard') }}</h3>

                                <section class="mb-3 text-center p-4 w-full">
                                    <div class=" d-flex">

                                        <div class="p-2 h6 d-flex align-items-center"><i class="bi bi-link"></i>
                                            {{ __('messages.Total Links:') }}
                                            <span style="width:3rem" class="placeholder ms-1"></span>
                                        </div>

                                        <div class="p-2 h6 d-flex align-items-center"><i class="bi bi-link"></i>
                                            {{ __('messages.Link Clicks:') }}
                                            <span style="width:3rem" class="placeholder ms-1"></span>
                                        </div>
                                    </div>
                                    <div class="text-center w-100">
                                        <a href="{{ url('/studio/links') }}">{{ __('messages.View/Edit Links') }}</a>

                                    </div>
                                    <div class="w-100 text-left">
                                        <h6><i class="bi bi-sort-up"></i> {{ __('messages.Top Links:') }}</h6>



                                        <div class="bd-example">
                                            <ol class="list-group list-group-numbered" style="text-align: left;">

                                                @for ($i = 0; $i < 5; $i++)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                        <div class="ms-2 me-auto text-truncate">
                                                            <div class="d-flex align-items-center"><span style="width:9rem"
                                                                    class="placeholder ms-1"></span></div>
                                                            <span style="width:20rem" class="placeholder ms-1 mt-1"></span>
                                                        </div>
                                                        <span style="height:2rem;width:5rem"
                                                            class="placeholder rounded-pill p-2"></span>
                                                    </li>
                                                @endfor
                                            </ol>
                                        </div>

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

                                    <section class="mb-3 text-gray-800 text-center p-4 w-full">
                                        <div class='font-weight-bold text-left h3'>{{ __('messages.Site statistics:') }}
                                        </div>
                                        <br>
                                        <div class="d-flex flex-wrap justify-content-around">

                                            <div class="p-2">
                                                <h3 class="text-primary d-flex align-items-center">
                                                    <i class="bi bi-share-fill"></i>
                                                    <div class="spinner-border text-primary ms-2" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </h3>
                                                <span class="text-muted">{{ __('messages.Total links') }}</span>
                                            </div>

                                            <div class="p-2">
                                                <h3 class="text-primary d-flex align-items-center">
                                                    <i class="bi bi-eye-fill"></i>
                                                    <div class="spinner-border text-primary ms-2" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </h3>
                                                <span class="text-muted">{{ __('messages.Total clicks') }}</span>
                                            </div>

                                            <div class="p-2">
                                                <h3 class="text-primary d-flex align-items-center">
                                                    <i class="bi bi bi-person-fill"></i>
                                                    <div class="spinner-border text-primary ms-2" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </h3>
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

                                    <section class="mb-3 text-gray-800 text-center p-4 w-full">
                                        <div class='font-weight-bold text-left h3'>{{ __('messages.Registrations:') }}
                                        </div>
                                        <br>
                                        <div class="d-flex flex-wrap justify-content-around">

                                            <div class="p-2 d-flex flex-column justify-content-center align-items-center">
                                                <h3 class="text-primary d-flex align-items-center">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </h3>
                                                <span class="text-muted">{{ __('messages.Last 30 days') }}</span>
                                            </div>

                                            <div class="p-2 d-flex flex-column justify-content-center align-items-center">
                                                <h3 class="text-primary d-flex align-items-center">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </h3>
                                                <span class="text-muted">{{ __('messages.Last 7 days') }}</span>
                                            </div>

                                            <div class="p-2 d-flex flex-column justify-content-center align-items-center">
                                                <h3 class="text-primary d-flex align-items-center">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
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

                <div class="col-lg-12">
                    <div class="card   rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">

                                    <section class="mb-3 text-gray-800 text-center p-4 w-full">
                                        <div class='font-weight-bold text-left h3'>{{ __('messages.Active users:') }}</div>
                                        <br>
                                        <div class="d-flex flex-wrap justify-content-around">

                                            <div class="p-2 d-flex flex-column justify-content-center align-items-center">
                                                <h3 class="text-primary d-flex align-items-center">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </h3>
                                                <span class="text-muted">{{ __('messages.Last 30 days') }}</span>
                                            </div>

                                            <div class="p-2 d-flex flex-column justify-content-center align-items-center">
                                                <h3 class="text-primary d-flex align-items-center">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </h3>
                                                <span class="text-muted">{{ __('messages.Last 7 days') }}</span>
                                            </div>

                                            <div class="p-2 d-flex flex-column justify-content-center align-items-center">
                                                <h3 class="text-primary d-flex align-items-center">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
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
    </div>

    @push('sidebar-scripts')
        <script>
            $(document).ready(function() {
                async function fetchAndReplaceContent() {
                    try {
                        const response = await $.ajax({
                            url: "{{ url('dashboard/site-stats') }}",
                            method: 'GET',
                            dataType: 'html'
                        });
                        $('#site-stats').html(response);
                    } catch (error) {
                        console.error('Error fetching content:', error);
                    }
                }

                fetchAndReplaceContent();
            });
        </script>
    @endpush
@endsection

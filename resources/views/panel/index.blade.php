@extends('layouts.sidebar')


@section('content')
    <div id="site-stats" class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">

            <div class="col-lg-12">
                <div class="card   rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">

                                <h3 class="mb-4"><i class="bi bi-menu-up"></i> {{ __('messages.Dashboard') }}</h3>

                                <section class="mb-3 text-center p-4 w-full">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </section>

                            </div>
                        </div>
                    </div>
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
                                $('#site-stats').fadeOut(0, function() {
                                    $('#site-stats').html(response).fadeIn(400);
                                });
                            } catch (error) {
                                console.error('Error fetching content:', error);
                            }
                        }

                        fetchAndReplaceContent();
                    });
                </script>
            @endpush
        @endsection

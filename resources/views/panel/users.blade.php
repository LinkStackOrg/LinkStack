<?php use App\Models\User; ?>

@extends('layouts.sidebar')

@section('content')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">


            <div class="col-lg-12">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">

                                <section class="text-gray-400">
                                    <h2 class="mb-4 card-header"><i class="bi bi-person">
                                            {{ __('messages.Manage Users') }}</i></h2>
                                    <div class="card-body p-0 p-md-3">

                                        <livewire:users-table lazy />

                                        <section id="loading-spinner" style="height:50vh" class="mb-3 text-center p-4 w-full">
                                          <div class="spinner-border text-primary" role="status">
                                              <span class="visually-hidden">Loading...</span>
                                          </div>
                                        </section>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                Livewire.on('table-loaded', () => {
                                                  document.getElementById('loading-spinner').style.display = 'none';
                                                    setTimeout(() => {
                                                        attachClickEventListeners('confirmation', confirmIt);
                                                        attachClickEventListeners('user-email', handleUserClick);
                                                        attachClickEventListeners('user-block', handleUserClick);
                                                    }, 500);
                                                })
                                            });
                                        </script>

                                        <a href="{{ url('') }}/admin/new-user">+ {{ __('messages.Add new user') }}</a>

                                    </div>
                                </section>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    @push('sidebar-stylesheets')
        @livewireStyles
    @endpush

    @push('sidebar-scripts')
        <script src="{{ asset('assets/vendor/livewire/livewire.js') }}" data-update-uri="/livewire/update" data-navigate-once="true"></script>
        <script src="{{ asset('assets/external-dependencies/sweetalert2.min.js') }}"></script>
        <script type="text/javascript">
            // Function to confirm and delete users
            var confirmIt = function(e) {
                e.preventDefault();
                var userId = this.getAttribute('data-id');
                var name = document.querySelector(`td[wire\\:key="table-table-td-${userId}-name"]`)?.textContent.trim() || null;
                var title = '{{ __('messages.confirm_delete', ['title' => 'DL_USER_NAME']) }}';
                let updatedTitle = title.replace("DL_USER_NAME", name);
                Swal.fire({
                    title: updatedTitle,
                    text: '{{ __('messages.confirm.delete.user') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('messages.Delete') }}',
                    cancelButtonText: '{{ __('messages.Cancel') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.innerHTML =
                            '<div class="d-flex justify-content-center"><div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
                        deleteUserData(userId);
                    }
                });
            };

            var deleteUserData = function(userId) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', `{{ route('deleteTableUser', ['id' => ':id']) }}`.replace(':id', userId), true);
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        refreshLivewireTable();
                    }
                };
                xhr.send(JSON.stringify({
                    id: userId
                }));
            };

            // Function to handle user actions (verification and blocking)
            var handleUserClick = function(e) {
                e.preventDefault();
                var userId = this.getAttribute('data-id');
                this.innerHTML =
                    '<div class="d-flex justify-content-center"><div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
                sendUserAction(userId);
            };

            var sendUserAction = function(userId) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', userId, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        refreshLivewireTable();
                    }
                };
                xhr.send();
            };

            // Attach click event listeners to elements with class 'confirmation', 'user-email', and 'user-block'
            var attachClickEventListeners = function(className, handler) {
                var elems = document.getElementsByClassName(className);
                for (var i = 0, l = elems.length; i < l; i++) {
                    elems[i].addEventListener('click', handler, false);
                }
            };

            // Function to refresh the Livewire table
            var refreshLivewireTable = function() {
                Livewire.dispatch('refresh');
            };
        </script>
    @endpush
@endsection

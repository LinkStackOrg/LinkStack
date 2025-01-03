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

                                        <section id="loading-spinner">
                                          <style>
                                            :root {
                                              --spinnerColor: #8a92a6;
                                            }

                                            .placeholder {
                                              height: 1.2rem;
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
                                          <div class="d-flex flex-column">
                                            <div class="d-md-flex justify-content-between mb-3">
                                                <div class="d-md-flex">
                                                    <div class="mb-3 mb-md-0 input-group flex">
                                                        <input disabled="" placeholder="Search" type="text" class="block w-full form-control" />
                                                    </div>
                                                </div>
                                                <div class="d-md-flex">
                                                    <div class="">
                                                        <div class="dropdown d-block d-md-inline">
                                                            <button disabled="" style="border:none" class="btn dropdown-toggle d-block w-100 d-md-inline" type="button">
                                                                Columns
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="ms-0 ms-md-2"><select disabled="" style="border-color: var(--bs-btn-disabled-border-color);" class="form-select"><option>{{request('tableperPage', 50)}}</option></select></div>
                                                </div>
                                            </div>
                                          </div>

                                          @php
                                          $widths = [30, 20, 12.5, 12.5, 12.5];
                                          @endphp

                                          <table class="laravel-livewire-table table">
                                            <thead>
                                                <tr>
                                                  @foreach ($widths as $width)
                                                    <th scope="col" style="width: {{ $width }}%;"><div class="d-flex align-items-center laravel-livewire-tables-cursor"><span>{{ __('messages.Loading...') }}</span></div></th>
                                                  @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @for ($ii = 0; $ii < 3; $ii++)
                                                <tr>
                                                    @for ($i = 0; $i < 5; $i++)
                                                      <td><div class="placeholder"></div></td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                  @for ($i = 0; $i < 5; $i++)
                                                    <td><div class="placeholder"></div></td>
                                                  @endfor
                                                </tr>
                                              @endfor
                                            </tbody>
                                          </table>
                                        </section>

                                        <script>
                                            document.addEventListener('table-loaded', function() {
                                                document.getElementById('loading-spinner').style.display = 'none';
                                                    setTimeout(() => {
                                                        attachClickEventListeners('confirmation', confirmIt);
                                                        attachClickEventListeners('user-email', handleUserClick);
                                                        attachClickEventListeners('user-block', handleUserClick);
                                                    }, 500);
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
        @if(!env('SPA_MODE', false))
            @livewireStyles
        @endif
        <link rel="stylesheet" href="{{ asset('assets/vendor/livewire/core.min.css') }}" />
    @endpush

    @push('sidebar-scripts')
        @if(!env('SPA_MODE', false))
            @livewireScripts
            <script src="{{ asset('assets/vendor/livewire/core.min.js') }}"></script>
        @endif
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
        <script>
            document.addEventListener('table-loaded', () => {
                setTimeout(() => {
                    const bulkActionsDiv = document.querySelector('.dropdown-menu[aria-labelledby="table-bulkActionsDropdown"]');

                    if (bulkActionsDiv) {
                        const dropdownItems = bulkActionsDiv.querySelectorAll("a.dropdown-item");
                    
                        dropdownItems.forEach(item => {
                            item.style.cursor = "pointer";
                            item.removeAttribute("href");
                        });
                    }

                    const checkboxes = document.querySelectorAll('.form-check-input');
                    let lastChecked;
                
                    function handleShiftSelect(e) {
                        let inBetween = false;
                    
                        if (e.shiftKey && this.checked) {
                            checkboxes.forEach(checkbox => {
                                if (checkbox === this || checkbox === lastChecked) {
                                    inBetween = !inBetween;
                                }
                                if (inBetween || checkbox === this || checkbox === lastChecked) {
                                    checkbox.checked = true;
                                    checkbox.dispatchEvent(new Event('change'));
                                }
                            });
                        }
                    
                        lastChecked = this;
                    }
                
                    checkboxes.forEach(checkbox =>
                        checkbox.addEventListener('click', handleShiftSelect)
                    );
                }, 500);
            });
        </script>
    @endpush
@endsection

<?php use App\Models\User; ?>

@extends('layouts.sidebar')

@section('content')

<style>
  [x-cloak] { display: none !important; }
</style>

<div class="conatiner-fluid content-inner mt-n5 py-0">
  <div class="row">   


      <div class="col-lg-12">
          <div class="card rounded">
             <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">  
  
                      <section class="text-gray-400">
                        <h2 class="mb-4 card-header"><i class="bi bi-person"> {{__('messages.Manage Users')}}</i></h2>
                        <div class="card-body p-0 p-md-3">

                        <livewire:user-table />
                        
                        <a href="{{ url('') }}/admin/new-user">+ {{__('messages.Add new user')}}</a>
                
                        <script type="text/javascript">
                          // Function to confirm and delete users
                          var elems = document.getElementsByClassName('confirmation');
                          var confirmIt = function (e) {
                              e.preventDefault();
                              if (confirm("{{ __('messages.confirm.delete.user') }}")) {
                                  var userId = this.getAttribute('data-id');
                                  deleteUserData(userId);
                              }
                          };
                          
                          var deleteUserData = function(userId) {
                              var url = "{{ route('deleteTableUser', ['id' => ':id']) }}".replace(':id', userId);
                              var xhr = new XMLHttpRequest();
                              xhr.open('POST', url, true);
                              xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                              xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                              xhr.onreadystatechange = function () {
                                  if (xhr.readyState === 4 && xhr.status === 200) {
                                      refreshLivewireTable();
                                  }
                              };
                              var data = JSON.stringify({ id: userId });
                              xhr.send(data);
                          };
                          
                          // Function to refresh the Livewire table
                          var refreshLivewireTable = function () {
                            Livewire.components.getComponentsByName('user-table')[0].$wire.$refresh()
                          };
                          
                          // Attach click event listeners to elements with class 'confirmation'
                          for (var i = 0, l = elems.length; i < l; i++) {
                              elems[i].addEventListener('click', confirmIt, false);
                          }
                       </script>
                       <script type="text/javascript">
                          // Function to handle user verification requests
                          var elems = document.getElementsByClassName('user-email');
                          
                          var handleUserClick = function (e) {
                            e.preventDefault();
                            var userId = this.getAttribute('data-id');
                            sendVerificationRequest(userId);
                          };
                          
                          var sendVerificationRequest = function(userId) {
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', userId, true);
                            xhr.onreadystatechange = function () {
                              if (xhr.readyState === 4 && xhr.status === 200) {
                                refreshLivewireTable();
                              }
                            };
                            xhr.send();
                          };
                          
                          // Attach click event listeners to elements with class 'user-email'
                          for (var i = 0, l = elems.length; i < l; i++) {
                            elems[i].addEventListener('click', handleUserClick, false);
                          }
                       </script>
                       <script type="text/javascript">
                          // Function to handle user blocking
                          var elems = document.getElementsByClassName('user-block');
                          
                          var handleUserClick = function (e) {
                            e.preventDefault();
                            var userId = this.getAttribute('data-id');
                            sendVerificationRequest(userId);
                          };
                          
                          var sendVerificationRequest = function(userId) {
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', userId, true);
                            xhr.onreadystatechange = function () {
                              if (xhr.readyState === 4 && xhr.status === 200) {
                                refreshLivewireTable();
                              }
                            };
                            xhr.send();
                          };
                          
                          // Attach click event listeners to elements with class 'user-block'
                          for (var i = 0, l = elems.length; i < l; i++) {
                            elems[i].addEventListener('click', handleUserClick, false);
                          }
                       </script>

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
<script defer src="{{url('assets/js/cdn.min.js')}}"></script>
<script src="{{url('vendor/livewire/livewire/dist/livewire.js')}}"></script>
@endpush

@push('sidebar-scripts')
<livewire:scripts />
<script src="{{url('assets/js/livewire-sortable.js')}}"></script>
@endpush

@endsection
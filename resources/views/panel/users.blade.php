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
                          var confirmIt = function(e) {
                              e.preventDefault();
                              if (confirm("{{ __('messages.confirm.delete.user') }}")) {
                                  var userId = this.getAttribute('data-id');
                                  this.innerHTML = '<div class="d-flex justify-content-center"><div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
                                  deleteUserData(userId);
                              }
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
                              xhr.send(JSON.stringify({ id: userId }));
                          };
                      
                          // Function to handle user actions (verification and blocking)
                          var handleUserClick = function(e) {
                              e.preventDefault();
                              var userId = this.getAttribute('data-id');
                              this.innerHTML = '<div class="d-flex justify-content-center"><div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
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
                            Livewire.components.getComponentsByName('user-table')[0].$wire.$refresh()
                          };
                      
                          attachClickEventListeners('confirmation', confirmIt);
                          attachClickEventListeners('user-email', handleUserClick);
                          attachClickEventListeners('user-block', handleUserClick);
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
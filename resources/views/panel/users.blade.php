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
                                var elems = document.getElementsByClassName('confirmation');
                                var confirmIt = function (e) {
                                    if (!confirm("{{__('messages.confirm.delete.user')}}")) e.preventDefault();
                                };
                                for (var i = 0, l = elems.length; i < l; i++) {
                                    elems[i].addEventListener('click', confirmIt, false);
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
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="{{url('vendor/livewire/livewire/dist/livewire.js')}}"></script>
@endpush

@push('sidebar-scripts')
<livewire:scripts />
<script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.1.1/dist/livewire-sortable.js"></script>
@endpush

@endsection
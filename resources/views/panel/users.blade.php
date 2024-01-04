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

                        <div id="select-active" class="d-none">
                          <h5 class="mb-2">{{__('messages.Select Action')}}:</h3>
                          <button class="mb-3 btn btn-danger rounded-pill btn-sm">
                              <span class="btn-inner">
                                <svg class="icon-16" width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2871 5.24297C20.6761 5.24297 21 5.56596 21 5.97696V6.35696C21 6.75795 20.6761 7.09095 20.2871 7.09095H3.71385C3.32386 7.09095 3 6.75795 3 6.35696V5.97696C3 5.56596 3.32386 5.24297 3.71385 5.24297H6.62957C7.22185 5.24297 7.7373 4.82197 7.87054 4.22798L8.02323 3.54598C8.26054 2.61699 9.0415 2 9.93527 2H14.0647C14.9488 2 15.7385 2.61699 15.967 3.49699L16.1304 4.22698C16.2627 4.82197 16.7781 5.24297 17.3714 5.24297H20.2871ZM18.8058 19.134C19.1102 16.2971 19.6432 9.55712 19.6432 9.48913C19.6626 9.28313 19.5955 9.08813 19.4623 8.93113C19.3193 8.78413 19.1384 8.69713 18.9391 8.69713H5.06852C4.86818 8.69713 4.67756 8.78413 4.54529 8.93113C4.41108 9.08813 4.34494 9.28313 4.35467 9.48913C4.35646 9.50162 4.37558 9.73903 4.40755 10.1359C4.54958 11.8992 4.94517 16.8102 5.20079 19.134C5.38168 20.846 6.50498 21.922 8.13206 21.961C9.38763 21.99 10.6811 22 12.0038 22C13.2496 22 14.5149 21.99 15.8094 21.961C17.4929 21.932 18.6152 20.875 18.8058 19.134Z" fill="currentColor"></path>
                                </svg>                        
                              </span>
                              Delete
                          </button>
                        </div>

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
{{-- <script type="text/javascript">
// Get the delete button div
var deleteButtonDiv = document.getElementById('select-active');

// Get all checkboxes
var checkboxes = document.querySelectorAll('.form-check-input');

// Function to check if at least one checkbox is selected
var isAnyCheckboxSelected = function() {
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            return true;
        }
    }
    return false;
};

// Function to show or hide the delete button div
var showOrHideDeleteButton = function() {
    if (isAnyCheckboxSelected()) {
        deleteButtonDiv.classList.remove('d-none');
    } else {
        setTimeout(function() {
            deleteButtonDiv.classList.add('d-none');
        });
    }
};

// Add event listener to checkboxes
for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', showOrHideDeleteButton);
}

// Get the delete button
var deleteButton = deleteButtonDiv.querySelector('button');

// Function to delete selected users
var deleteSelectedUsers = function() {
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked && checkboxes[i].getAttribute('data-id') !== null) {
            var userId = checkboxes[i].getAttribute('data-id');

            // Find the corresponding <a> element
            var deleteButton = document.querySelector('a[data-id="' + userId + '"]');

            // If the <a> element exists, add loading spinner to it
            if (deleteButton) {
                deleteButton.innerHTML = '<div class="d-flex justify-content-center"><div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            }

            deleteUserData(userId);
        }
    }
};

// Add event listener to delete button
deleteButton.addEventListener('click', deleteSelectedUsers);
</script> --}}

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
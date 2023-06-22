@extends('layouts.sidebar')

@section('content')

<script src="{{ asset('resources/ckeditor/ckeditor.js') }}"></script>

<div class="conatiner-fluid content-inner mt-n5 py-0">
  <div class="row">   


      <div class="col-lg-12">
          <div class="card   rounded">
             <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">  
  
                      <section class="text-gray-400">
                        <h2 class="mb-4 card-header"><i class="bi bi-person"> {{__('messages.Site Customization')}}</i></h2>
                                <div class="card-body p-0 p-md-3">
                          
                          <form action="{{ route('editSite') }}" enctype="multipart/form-data" method="post">
                          @csrf
                            <div class="form-group col-lg-8">
                              <label>{{__('messages.Site logo')}}</label>@if(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))<a title="Remove icon" class="hvr-grow p-1 text-danger" style="padding-left:5px;" href="{{ route('delAvatar') }}"><i class="bi bi-trash-fill"></i></a>@endif
                              <div class="mb-3">
                                <input type="file" class="form-control form-control-lg" name="image" aria-label="Large file input example">
                            </div>
                            </div>
                            <div class="form-group col-lg-8">
                              <label>{{__('messages.Favicon')}}</label>@if(file_exists(base_path("assets/linkstack/images/").findFile('favicon')))<a title="Remove icon" class="hvr-grow p-1 text-danger" style="padding-left:5px;" href="{{ route('delFavicon') }}"><i class="bi bi-trash-fill"></i></a>@endif
                              <div class="mb-3">
                                <input type="file" class="form-control form-control-lg" name="icon" aria-label="Large file input example">
                            </div><br>
                            </div>
                            <div class="form-group col-lg-8">
                              <h3>{{__('messages.Home message')}}</h3>
                              @php
                              if($home_message == "default") $home_message = __('messages.HOME.MESSAGE');
                              @endphp
                              <textarea class="form-control ckeditor" name="message" rows="3">{{ $home_message }}</textarea>
                            </div>
                            <button type="submit" class="mt-3 ml-3 btn btn-primary">{{__('messages.Save')}}</button>
                          </form>
                  
                            </div>
                  </section>
  
                    </div>
                </div>
             </div>
          </div>
       </div>


    </div>
  </div>

@endsection

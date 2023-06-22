@extends('layouts.sidebar')

@section('content')

<script src="{{ asset('resources/ckeditor/ckeditor.js') }}"></script>

<div class="conatiner-fluid content-inner mt-n5 py-0">
  <div class="row">   

    <form action="{{ route('editSitePage') }}" method="post">
      @csrf
      @foreach($pages as $page)

      <div class="col-lg-12">
          <div class="card   rounded">
             <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">  
  
                          <div class="form-group col-lg-8">
                            <h3>{{footer('Terms')}}</h3><br>
                            <textarea class="form-control ckeditor" name="terms" rows="3">{{ $page->terms }}</textarea>
                          </div>
                          
                          <button type="submit" class="mt-3 ml-3 btn btn-primary">{{__('messages.Save')}}</button>
  
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
    
                            <div class="form-group col-lg-8">
                              <h3>{{footer('Privacy')}}</h3><br>
                              <textarea class="form-control ckeditor" name="privacy" rows="3">{{  $page->privacy }}</textarea>
                            </div>

                            <button type="submit" class="mt-3 ml-3 btn btn-primary">{{__('messages.Save')}}</button>
    
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
      
                              <div class="form-group col-lg-8">
                                <h3>{{footer('Contact')}}</h3><br>
                                <textarea class="form-control ckeditor" name="contact" rows="3">{{ $page->contact }}</textarea>
                              </div>
                              
                              <button type="submit" class="mt-3 ml-3 btn btn-primary">{{__('messages.Save')}}</button>
      
                        </div>
                    </div>
                 </div>
              </div>
           </div>
  
          </form>
          @endforeach

        </div>
      </div>

@endsection

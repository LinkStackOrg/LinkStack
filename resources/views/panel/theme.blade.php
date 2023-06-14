@extends('layouts.sidebar')

@section('content')

<div class="conatiner-fluid content-inner mt-n5 py-0">
  <div class="row">   


      <div class="col-lg-12">
          <div class="card   rounded">
             <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">  
  
                      <h2 class="mb-4"><i class="bi bi-brush"> {{__('messages.Delete a theme')}}</i></h2>

                      <form action="{{ route('deleteTheme') }}" enctype="multipart/form-data" method="post">
                      @csrf
              
                      <div class="form-group col-lg-8">
                      <h3>{{__('messages.Delete theme')}}</h3>
                        <select class="form-control" name="deltheme">
                          <?php if ($handle = opendir('themes')) {
                           while (false !== ($entry = readdir($handle))) {
                              if ($entry != "." && $entry != "..") {
                                  echo '<option>'; print_r($entry); echo '</option>'; }}} ?>
                        </select>
              
                      </div>
                      <button type="submit" class="mt-3 ml-3 btn btn-danger">{{__('messages.Delete theme')}}</button>
                      </form>
                      </details>
              
              <br><br><a class="btn btn-primary" href="{{ url('/studio/theme') }}"><i class="bi bi-arrow-left-short"></i> {{__('messages.Back')}}</a>
  
                    </div>
                </div>
             </div>
          </div>
       </div>


    </div>
  </div>

@endsection

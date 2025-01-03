@extends('layouts.sidebar')

@section('content')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">   
      
      
            <div class="col-lg-12">
                <div class="card rounded mb-0">
                   <div class="card-body">
                      <div class="row">
                          <div class="col-sm-12">  
        
                            <section class="">
                              <h2 class="mb-4 card-header"><i class="bi bi-person"> Error 500</i></h2>
                                      <div style="min-height: calc(100vh - 340px);" class="card-body mt-n5 p-0 p-md-3 d-flex flex-column justify-content-center align-items-center">
                                
                                        <div class="d-flex flex-row align-items-center">
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-12 text-center">
                                                        <span class="display-1 d-block">500</span>
                                                        <div class="mb-4 lead">HTTP Error 500 - Internal Server Error</div>
                                                        <a href="{{url('dashboard')}}" class="btn btn-primary">Back to Home</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        @if(auth()->check() && auth()->user()->role == 'admin')
                                            <div class="d-flex flex-row align-items-center mt-5">
                                                <div class="container">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-12">
                                                            <div class="alert alert-danger mb-0" role="alert">
                                                                @php
                                                                    try {
                                                                        preg_match('/^(.*?)\s?\((.*?)\)$/', $message, $matches);
                                                                        $outside = $matches[1];
                                                                        $inside = $matches[2];
                                                                    } catch (\Throwable $th) {
                                                                        $outside = $message;
                                                                        $inside = '';
                                                                    }
                                                                @endphp
                                                                <h4 class="alert-heading">{{$outside}}</h4>
                                                                <p>{{$inside}}</p>
                                                                @php dump($error); @endphp
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        </div>
                                        
                        
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
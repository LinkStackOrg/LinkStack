@extends('layouts.sidebar')

@section('content')

<div class="conatiner-fluid content-inner mt-n5 py-0">
  <div class="row">   
      
   <div class="col-lg-12">
      <div class="card   rounded">
          <div class="card-body">
             <div class="row">
                 <div class="col-sm-12">  

                  @if($_SERVER['QUERY_STRING'] == '')
                  
                  <div id="exTab2" class="">
                      <ul id="myTab" class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href="#1" data-toggle="tab" id="home-tab">{{__('messages.Config')}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#2" data-toggle="tab" id="advanced-tab">{{__('messages.Advanced Config')}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#3" data-toggle="tab" id="backup-tab">{{__('messages.Take Backup')}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#4" data-toggle="tab" id="backups4-tab">{{__('messages.All Backups')}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#5" data-toggle="tab" id="diagnose5-tab">{{__('messages.Diagnosis')}}</a></li>
                      </ul>
                  
                  <div class="tab-content ">
                  
                  
                  <div class="tab-pane fade show active" role="tabpanel" style="scroll-margin-top: 1000px;" aria-labelledby="home-tab" id="1">
                      <section class="text-gray-400">
                        <h2 class="mb-4 card-header"><i class="bi bi-pencil-square"> {{__('messages.Config')}}</i></h2>
                      <div class="card-body p-0 p-md-3">
                  
                  <style>
                  /* Temporary fix for the unintended scrolling bug when applying settings */
                  html {scroll-behavior: unset !important;}
                  </style>
                  
                  <style>
                    .option{
                      -webkit-transition-duration: 0.3s;
                        transition-duration: 0.3s;
                    }
                    .option:hover, .option:focus, .option:active {
                      -webkit-transform: scale(1.01);
                      transform: scale(1.01);
                      box-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
                    }
                    .opt-img{
                      font-size: 4rem;
                      vertical-align: middle;
                      display: flex;
                      padding-right: 20px;
                      padding-left: 10px;
                    }
                    </style>

                  @if(!config('linkstack.single_user_mode'))
                  <div class="tab-pane fade show active" role="tabpanel" style="scroll-margin-top: 1000px;" aria-labelledby="home-tab" id="1">
                    <section class="text-gray-400">
                      <div class="card-body p-0 p-md-3 d-flex flex-column">
                        <a href="?alternative-config" class="mb-1">
                          <div class="card bg-soft-primary option w-100 p-3">
                            <div class="card-body p-3">
                              <div class="d-flex align-items-center text-body">
                                <i class="bi bi-pencil-square opt-img mr-3"></i>
                                <div>
                                  <h3 class="counter mb-2 text-body" style="visibility: visible;">{{__('messages.Alternative Config Editor')}}</h3>
                                  <p class="mb-0">{{__('messages.Use the Alternative Config Editor to edit the config directly')}}</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                        <a href="{{ url('admin/phpinfo') }}" class="mb-1">
                          <div class="card bg-soft-primary option w-100 p-3">
                            <div class="card-body p-3">
                              <div class="d-flex align-items-center text-body">
                                <i class="bi bi-filetype-php opt-img mr-3"></i>
                                <div>
                                  <h3 class="counter mb-2 text-body" style="visibility: visible;">{{__('messages.PHP info')}}</h3>
                                  <p class="mb-0">{{__('messages.Display debugging information about your PHP setup')}}</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                    </section>
                  </div>
                  
                  @endif
                  
                      <label class="mb-2">{{__('messages.Jump directly to:')}}</label>
                      <div class="col-md-12 col-lg-12">
                        <div class="row row-cols-1">
                          <div class="overflow-hidden d-slider1 swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                            <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline" id="swiper-wrapper-a3b63471782f110100" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                              <li class="swiper-slide card card-slide aos-init aos-animate swiper-slide-active">
                                <a href="#Application" class="btn btn-primary">{{__('messages.Application')}}</a>
                              </li>
                              <li class="swiper-slide card card-slide aos-init aos-animate swiper-slide-next">
                                <a href="#Panel-settings" class="btn btn-primary">{{__('messages.Panel settings')}}</a>
                              </li>
                              <li class="swiper-slide card card-slide aos-init aos-animate swiper-slide-next">
                                <a href="#Security" class="btn btn-primary">{{__('messages.Security')}}</a>
                              </li>
                              <li class="swiper-slide card card-slide aos-init aos-animate swiper-slide-next">
                                <a href="#Advanced" class="btn btn-primary">{{__('messages.Advanced')}}</a>
                              </li>
                              <li class="swiper-slide card card-slide aos-init aos-animate swiper-slide-next">
                                <a href="#SMTP" class="btn btn-primary">{{__('messages.SMTP')}}</a>
                              </li>
                              <li class="swiper-slide card card-slide aos-init aos-animate swiper-slide-next">
                                <a href="#Footer" class="btn btn-primary">{{__('messages.Footer links')}}</a>
                              </li>
                              <li class="swiper-slide card card-slide aos-init aos-animate swiper-slide-next">
                                <a href="#Debug" class="btn btn-primary">{{__('messages.Debug')}}</a>
                              </li>
                              <li class="swiper-slide card card-slide aos-init aos-animate swiper-slide-next">
                                <a href="#Debug" class="btn btn-primary">{{__('messages.Language')}}</a>
                              </li>
                            </ul>
                            <div class="swiper-button swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-a3b63471782f110100" aria-disabled="false"></div>
                            <div class="swiper-button swiper-button-prev swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-a3b63471782f110100" aria-disabled="true"></div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                          </div>
                        </div>
                      </div>
                  
                      @include('components.config.config')
                  
                      </div>
                      </section>
                  </div>
                  
                  
                  <div class="tab-pane" role="tabpanel" style="scroll-margin-top: 1000px;" aria-labelledby="advanced-tab" id="2">
                      <section class="text-gray-400">
                      <h2 class="mb-4 card-header"><i class="bi bi-pencil-square"> {{__('messages.Advanced Config')}}</i></h2>
                      <div class="card-body p-0 p-md-3">
                      @include('components.config.advanced-config')
                      </div>
                      </section>
                  </div>
                  
                  
                  <div class="tab-pane" role="tabpanel" style="scroll-margin-top: 1000px;" aria-labelledby="backup-tab" id="3">
                      <section class="text-gray-400">
                      <h2 class="mb-4 card-header"><i class="bi bi-link-45deg"> {{__('messages.Backup')}}</i></h2>
                      <div class="card-body p-0 p-md-3">
                      @include('components.config.backup')
                      </div>
                      </section>
                  </div>
                  
                  
                  <div class="tab-pane" role="tabpanel" style="scroll-margin-top: 1000px;" aria-labelledby="backups4-tab" id="4">
                      <section class="text-gray-400">
                      <h2 class="mb-4 card-header"><i class="bi bi-link-45deg"> {{__('messages.All Backups')}}</i></h2>
                      <div class="card-body p-0 p-md-3">
                      @include('components.config.backups')
                      </div>
                      </section>
                  </div>
                  
                  
                  <div class="tab-pane" role="tabpanel" style="scroll-margin-top: 1000px;" aria-labelledby="diagnose5-tab" id="5">
                      <section class="text-gray-400">
                      <h2 class="mb-4 card-header"><i class="bi bi-braces-asterisk"> {{__('messages.Debugging information')}}</i> <span class="text-muted" style="font-size:60%;vertical-align: middle;">v{{file_get_contents(base_path("version.json"))}}</span></h2>
                      <div class="card-body p-0 p-md-3">
                      @include('components.config.diagnose')
                      </div>
                      </section>
                  </div>
                  
                  
                  </div>
                  </div>
                  
                  <!-- Back to top button -->
                  <a id="button-top"></a>
                  
                  @elseif($_SERVER['QUERY_STRING'] == 'alternative-config' && !config('linkstack.single_user_mode'))
                  @include('components.config.alternative-config')
                  @include('components.config.back-button')
                  @endif
                  
                  @push("sidebar-scripts")
                  <script src="{{ asset('assets/external-dependencies/jquery-1.11.1.min.js') }}"></script>
                  <script src="{{ asset('assets/external-dependencies/bootstrap.min.js') }}"></script>
                  <script>
                  //$('#myTab a').click(function(e) {
                  // e.preventDefault();
                  // $(this).tab('show');
                  //});
                  // store the currently selected tab in the hash value
                  
                  $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
                    var id = $(e.target).attr("href").substr(1);
                    window.location.hash = id;
                  });
                  
                  // on load of the page: switch to the currently selected tab
                  var hash = window.location.hash;
                  
                  $('#myTab a[href="' + hash + '"]').tab('show');
                  
                  var btn = $('#button-top');
                  
                  $(window).scroll(function() {
                    if ($(window).scrollTop() > 300) {
                      btn.addClass('show');
                    } else {
                      btn.removeClass('show');
                    }
                  });
                  
                  btn.on('click', function(e) {
                    e.preventDefault();
                    $('html, body').animate({scrollTop:280}, '300');
                  });
                  </script>
                  <script src="{{ asset('assets/external-dependencies/bootstrap.min.js') }}"></script>
                  @endpush

                 </div>
             </div>
          </div>
       </div>
      </div>

    </div>
  </div>

@endsection

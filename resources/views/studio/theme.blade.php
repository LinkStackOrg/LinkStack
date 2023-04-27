@extends('layouts.sidebar')

@section('content')

<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">   
        
     <div class="col-lg-12">
        <div class="card   rounded">
            <div class="card-body">
               <div class="row">
                   <div class="col-sm-12">  
  
                    @foreach($pages as $page)

                    <section class='text-gray-400'>
                    <h3 class="mb-4 card-header"><i class="bi bi-brush"> Select a theme</i></h3>
                    <div>
                    
                    <section class="text-gray-400"></section>
                    <div>
                    <form action="{{ route('editTheme') }}" enctype="multipart/form-data" method="post">
                        @csrf
                    
                        <div class="form-group row">
                    
                            <div class="col-8 col-md-4">
                                <select id="theme-select" style="margin-left: 15px; margin-bottom: 20px;" class="form-control" name="theme" data-base-url="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>">
                                    <?php
                                        if ($handle = opendir('themes')) {
                                            while (false !== ($entry = readdir($handle))) {
                                                if ($entry != "." && $entry != "..") {
                                                    if(file_exists(base_path('themes') . '/' . $entry . '/readme.md')){
                                                        $text = file_get_contents(base_path('themes') . '/' . $entry . '/readme.md');
                                                        $pattern = '/Theme Name:.*/';
                                                        preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);
                                                        if(sizeof($matches) > 0) {
                                                            $themeName = substr($matches[0][0],12);
                                                        }
                                                    }
                                                    if($page->theme != $entry and isset($themeName)){
                                                        echo '<option value="'.$entry.'" data-image="'.url('themes/'.$entry.'/screenshot.png').'">'.$themeName.'</option>';
                                                    }
                                                }
                                            }
                                        }
                            
                                        if($page->theme != "default" and $page->theme != ""){
                                            if(file_exists(base_path('themes') . '/' . $page->theme . '/readme.md')){
                                                $text = file_get_contents(base_path('themes') . '/' . $page->theme . '/readme.md');
                                                $pattern = '/Theme Name:.*/';
                                                preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);
                                                $themeName = substr($matches[0][0],12);
                                            }
                                            echo '<option value="'.$page->theme.'" data-image="'.url('themes/'.$page->theme.'/screenshot.png').'" selected>'.$themeName.'</option>';
                                        }
                            
                                        echo '<option value="default" data-image="'.url('themes/default/screenshot.png').'"';
                                        if($page->theme == "default" or $page->theme == ""){
                                            echo ' selected';
                                        }
                                        echo '>Default</option>';
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                        </div>

                        <div style="max-width:1000px" class="col-md-12">
                            <div class="card rounded shadow-lg bg-light aos-init aos-animate" data-aos="fade-up" data-aos-delay="800">
                              <div class="flex-wrap card-header d-flex justify-content-between align-items-center bg-light">
                                <div class="header-title">
                                  <h4 class="card-title">Preview</h4>         
                                </div>
                              </div>
                              <div class="card-body">
                                @if(env('USE_THEME_PREVIEW_IFRAME') === false or $page->littlelink_name == '')
                                <center><img style="width:95%;max-width:700px;argin-left:1rem!important;" src="@if(file_exists(base_path() . '/themes/' . $page->theme . '/preview.png')){{url('/themes/' . $page->theme . '/preview.png')}}@elseif($page->theme === 'default' or empty($page->theme)){{url('/assets/linkstack/images/themes/default.png')}}@else{{url('/assets/linkstack/images/themes/no-preview.png')}}@endif"></img></center>
                                 @else
                                <iframe frameborder="0" allowtransparency="true" id="frPreview" style="background: #FFFFFF;height:400px;" class='w-100' src="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>">Your browser isn't compatible</iframe>
                                @endif
                              </div>
                            </div>
                          </div>
                          
                    </form>
                    </details>
  
                   </div>
               </div>
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
                    @if(env('ALLOW_CUSTOM_BACKGROUNDS') == true)
                    <form action="{{ route('themeBackground') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <h3 class="mb-4 card-header">Custom background</h3>
                        <div style="display: none;" class="form-group col-lg-8">
                            <select class="form-control" name="theme">
                                <option>{{ $page->theme }}</option>
                            </select>
                            <br>
                        </div>
                        <div class="form-group col-lg-8">
                            <figure style="max-width:1000px;max-height:562.5px;" class="figure">
                            @if(!file_exists(base_path('assets/img/background-img/'.findBackground(Auth::user()->id))))<p><i>No image selected</i></p>@endif
                            <img class="bd-placeholder-img figure-img img-fluid rounded" src="@if(file_exists(base_path('assets/img/background-img/'.findBackground(Auth::user()->id)))){{url('assets//img/background-img/'.findBackground(Auth::user()->id))}}@else{{url('/assets/linkstack/images/themes/no-preview.png')}}@endif"><br>
                            @if(file_exists(base_path('assets/img/background-img/'.findBackground(Auth::user()->id))))<button class="mt-3 ml-3 btn btn-primary" style="background-color:tomato!important;border-color:tomato!important;transform: scale(.9);" title="Delete background image"><a href="{{ url('/studio/rem-background') }}" style="color:#FFFFFF;"><i class="bi bi-trash-fill"></i> Remove background</a></button><br>@endif
                            {{-- <figcaption class="figure-caption">A caption for the above image.</figcaption> --}}
                        </figure>
                            <br>
                            <br><br>
                            <div class="mb-3">
                                <input type="file" accept="image/jpeg,image/jpg,image/png" class="form-control form-control-lg" name="image"><br>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary">Apply</button>
                    </form>
                    @endif
                  </div>
              </div>
           </div>
        </div>
     </div>  

     @if(auth()->user()->role == 'admin')
    <div class="col-lg-12">
        <div class="card   rounded">
           <div class="card-body">
              <div class="row">
                  <div class="col-sm-12">  
                    <h3 class="mb-4 card-header">Manage themes</h3>
                    @if(env('ENABLE_THEME_UPDATER') == 'true')
                    
                    <div id="ajax-container">
                    
                        <br><br><br>
                        <div class="accordion">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="details-header">
                                <button class="accordion-button collapsed disabled" type="button" aria-expanded="false" aria-controls="details-collapse">
                                    <div style="max-height:20px;max-width:20px;" class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </button>
                              </h2>
                              <div id="details-collapse" class="accordion-collapse collapse" aria-labelledby="details-header">
                                <div class="accordion-body"></div>
                              </div>
                            </div>
                          </div>
                    
                    </div>
                    <div id="my-lazy-element"></div>
                    @endif
                    
                    <br><br><br>
                    <form action="{{ route('editTheme') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        {{-- <h3>Upload themes</h3> --}}
                        <div style="display: none;" class="form-group col-lg-8">
                            <select class="form-control" name="theme">
                                <option>{{ $page->theme }}</option>
                            </select>
                            <br>
                        </div>
                        <div class="mb-3">
                            <label>Upload theme</label>
                            <input type="file" accept=".zip" name="zip" class="form-control form-control-lg">
                        </div><br><br>
                        <div class="d-flex flex-column flex-md-row align-items-md-center">
                            <button type="submit" class="btn btn-primary me-md-3 mb-3 mb-md-0">Upload theme</button>
                            <button class="btn btn-danger me-md-3 mb-3 mb-md-0 delete-themes" title="Delete themes"><a href="{{ url('/panel/theme') }}" class="text-white">Delete themes</a></button>
                            <button class="btn btn-info download-themes" title="Download more themes"><a href="https://linkstack.org/themes/" target="_blank" class="text-white">Download themes</a></button>
                          </div>
                    </form>
                    </details>
                    </div>
                  </div>
              </div>
           </div>
        </div>
     </div>   
     @endif 

@endforeach

<script src="{{ asset('assets/external-dependencies/jquery-1.12.4.min.js') }}"></script>
</section>
<script>
$(window).on('load', function() {
    var placeholder = $('#ajax-container');
    var lazyElement = $('#my-lazy-element');
    
    $.ajax({
        url: '../theme-updater',
        success: function(response) {
            placeholder.replaceWith(lazyElement);
            
            lazyElement.html(response);
        }
    });
});
</script>
<script type="text/javascript">$("iframe").load(function() { $("iframe").contents().find("a").each(function(index) { $(this).on("click", function(event) { event.preventDefault(); event.stopPropagation(); }); }); });</script>

@endsection
@if(env('ENABLE_BUTTON_EDITOR') === true)
@extends('layouts.sidebar')

@include('components.favicon')
@include('components.favicon-extension')

@section('content')
<div class="conatiner-fluid content-inner mt-n5 py-0">
  <div class="row">   
      
   <div class="col-lg-12">
      <div class="card   rounded">
          <div class="card-body">
             <div class="row">
                 <div class="col-sm-12">  

                  @push('sidebar-scripts')
                  <?php function strp($urlStrp){return str_replace(array('http://', 'https://'), '', $urlStrp);} ?>
                    <!-- start button editor -->
                    <script>
                      $(document).ready(function() {
                        $('#code').click(function() {
                          var css_text = 'color: ' + button_css.color + ';' + '\nbackground-image: ' + button_css.background_image + ';';
                          $('#sCode').html(css_text);
                          Rainbow.color(div, function() {
                            document.getElementById('output').appendChild(div);
                          });
                      
                          $('.modal-profile').fadeIn("slow");
                          $('.modal-lightsout').fadeTo("slow", .9);
                        });
                      
                        $('a.modal-close-profile, .modal-lightsout').click(function() {
                          $('.modal-profile').fadeOut("slow");
                          $('.modal-lightsout').fadeOut("slow");
                        });
                      
                        var $button = $("#sample");
                        $("#ex1").gradientPicker({
                          change: function(points, styles) {
                            for (i = 1; i < styles.length; ++i) {
                              $button.css("background-image", styles[i]);
                              button_css.background_image = styles[i];
                            }
                          },
                          fillDirection: "45deg",
                          controlPoints: ["white 0%", "#888888 100%"]
                        });
                      
                        $('#color').ColorPicker({
                          color: '#000000',
                          onShow: function(colpkr) {
                            $(colpkr).fadeIn(500);
                            return false;
                          },
                          onHide: function(colpkr) {
                            $(colpkr).fadeOut(500);
                            return false;
                          },
                          onChange: function(hsb, hex, rgb) {
                            $('#color').css('background-color', '#' + hex);
                            document.getElementById("sample").style.color = '#' + hex;
                            button_css.color = '#' + hex;
                          }
                        });
                      });
                      // Only include the necessary properties
                      var button_css = {
                        color: 'inherit',
                        background_image: 'inherit'
                      };
                      </script>                      
                  
                  <link rel="stylesheet" type="text/css" href="{{asset('assets/button-editor/styles/button-gen.css')}}">
                  <link rel="stylesheet" href="{{asset('assets/button-editor/styles/jquery.gradientPicker.css')}}" type="text/css" />
                  <link rel="stylesheet" href="{{asset('assets/button-editor/styles/colorpicker_1.css')}}" type="text/css" />
                  <link rel="stylesheet" type="text/css" href="{{asset('assets/button-editor/themes/blackboard.css')}}">
                  <link rel="stylesheet" href="{{asset('assets/linkstack/css/animations.css') }}">
                  <link rel="stylesheet" type="text/css" href="{{asset('assets/button-editor/css/style.css')}}">
                  
                    <script src="{{asset('assets/button-editor/js/rainbow.js')}}"></script>
                    <script src="{{asset('assets/button-editor/js/css.js')}}"></script>
                  
                    <script src="{{asset('assets/button-editor/js/jquery-1.7.js')}}"></script> 
                    <script src="{{asset('assets/button-editor/js/jqueryUI-custom.js')}}"></script>
                    <script src="{{asset('assets/button-editor/js/colorpicker.js')}}"></script>
                    <script src="{{asset('assets/button-editor/js/jquery.gradientPicker.js')}}"></script>
                    <!-- end button editor -->
                  @endpush
                    <script src="{{ asset('assets/external-dependencies/fontawesome.js') }}" crossorigin="anonymous"></script>
                  
                  <div>
                  <section class="shadow text-gray-400">
                  <h2 class="mb-4 card-header"><i class="bi bi-pen"> Button Editor</i></h2>
                          <div class="card-body p-0 p-md-3">
                  
                  <a class="btn btn-primary" href="{{ url('/studio/links') }}"><i class="bi bi-arrow-left-short"></i> Back</a><br><br>
                  
                          <h2>Custom Button</h2><br>
                  
                          <!-- start button editor -->
                  <div style="left: 10px;">
                    <div class="modal-profile">
                  <h2>CSS</h2>
                      <a class="modal-close-profile" title="Close profile window" href="#"><img href="{{asset('assets/button-editor/images/close.png')}}" alt="Close profile window" /></a>
                       <div id="output">
                       </div>
                   </div>
                      
                      
                      <div class="modal-lightsout"></div>
                  
                  
                  
                  
                  
                  <aside id="panel-right">
                  
                  
                  
                  </br>
                  
                  
                  <div class="tool">
                  <heading>Color &nbsp;<span>Text</span></heading>
                  </br>
                  <input type="button" id="color" style="background-color:#FFFFFF; border:thin solid white;height:50px;width:50px;margin-left:5px;">
                  
                  
                  </div>
                  
                  
                  </br>
                  
                  
                  <div class="tool">
                  <heading>background &nbsp;<span>gradient</span></heading>
                  </br>
                  <div class="grad_ex" id="ex1"></div>
                  </div>
                  
                  
                  </br>
                  
                  
                  
                  
                  </aside>
                  
                  <section id="preview">
                  @if($buttonId == 1)
                  <center><div id="sample" style="border-radius: 8px !important; max-width: 350px; height: 48px; display: flex; align-items: center; justify-content: center;font-size: 18px;" class="button-demo button"><img class="icon hvr-icon" src="{{ asset('\/assets/linkstack/icons\/') . 'custom' }}.svg">{{ $title }}</div></center>
                  @else
                  <center><div id="sample" style="border-radius: 8px !important; max-width: 350px; height: 48px; display: flex; align-items: center; justify-content: center;font-size: 18px;" class="button-demo button"><img class="wicon hvr-icon" src="@if(file_exists(base_path("assets/favicon/icons/").localIcon($id))){{url('assets/favicon/icons/'.localIcon($id))}}@else{{getFavIcon($id)}}@endif">{{ $title }}</div></center>
                  @endif
                  
                  </section>
                  </div>
                  <!-- end button editor -->
                  
                  <br>
                  <details>
                  <summary>Show CSS</summary>
                  <div style="padding-left: 15px;">
                  <form action="{{ route('editCSS', $id) }}" method="post">
                          @csrf
                          <div class="form-group col-lg-8"><br>
                            <p>Custom CSS</p>
                  
                            <textarea name="custom_css" rows="9" id="sCode" type="text" value="{{ $custom_css }}" class="form-control" required>{{ $custom_css }}</textarea>
                          </div>
                  </div>
                  </details>
                  <br><button id="code" class="btn btn-primary">Save</button><br>
                        </form>
                  
                        <form action="{{ route('editCSS', $id) }}" method="post">
                          @csrf
                          <div class="form-group col-lg-8">
                  <textarea style="display: none;" rows="9" type="text" name="custom_css" value="" class="form-control">
                  NULL
                  </textarea>
                          </div>
                          <button type="submit" class="btn btn-danger">Reset to default</button>
                        </form>
                  
                  <br><br><div id="result" style="left: 1%; position: relative; background-color:#2c2d3a; border-radius: 25px; min-width:300px; max-width:950px; height:300px; box-shadow: 0 10px 20px -10px rgba(0,0,0, 0.6);">
                    <div style="position: relative; top: 50%; transform: translateY(-50%);">
                      <h2 align="center" style="color:white">Result:</h2>
                        @if($custom_css === "" or $custom_css === "NULL" and $buttonId == 1)
                          <center><div style="--delay: 1s" class="button-entrance"><div class="button-demo button-custom button hvr-grow hvr-icon-wobble-vertical"><img class="icon hvr-icon fa {{$custom_icon}}">{{ $title }}</div></div></center>
                          @elseif($custom_css === "" or $custom_css === "NULL" and $buttonId == 2)
                          <center><div style="--delay: 1s" class="button-entrance"><div class="button-custom_website button hvr-grow hvr-icon-wobble-vertical"><img class="wicon hvr-icon" src="@if(file_exists(base_path("assets/favicon/icons/").localIcon($id))){{url('assets/favicon/icons/'.localIcon($id))}}@else{{getFavIcon($id)}}@endif">{{ $title }}</div></div></center>
                          @elseif($custom_css != "" and $buttonId == 2)
                          <center><div style="--delay: 1s" class="button-entrance"><div style="{{ $custom_css }}" class="button-custom_website button hvr-grow hvr-icon-wobble-vertical"><img class="wicon hvr-icon" src="@if(file_exists(base_path("assets/favicon/icons/").localIcon($id))){{url('assets/favicon/icons/'.localIcon($id))}}@else{{getFavIcon($id)}}@endif">{{ $title }}</div></div></center>
                          @else
                          <center><div style="--delay: 1s" class="button-entrance"><div style="{{ $custom_css }}" class="button-demo hvr-grow hvr-icon-wobble-vertical"><i style="color: {{$custom_icon}}" class="icon hvr-icon fa {{$custom_icon}}"></i>{{ $title }}</div></div></center>
                        @endif
                        </div>
                  </div>
                          <br><br>
                          @if($buttonId == 1)
                          <form action="{{ route('editCSS', $id) }}" method="post">
                          @csrf
                          <div class="form-group col-lg-8">
                            <h2>Custom Icon</h2>
                            <textarea id="textareabox" type="text" name="custom_icon" value="{{ $custom_icon }}" class="form-control" required>{{ $custom_icon }}</textarea>
                          </div>
                          <script type="text/javascript">
                          // Displays alert if custom icon doesn't contain string "fa-"
                          var textarea = document.getElementById('textareabox');
                          var word = 'fa-';
                          var textValue=textarea.value;
                          if (textValue.indexOf(word)==-1)
                            {
                             alert('Your custom icon\'s short code does not contain the string "fa-" always use icons in the format: fa-ghost, for example.')
                            } 
                            </script>
                  
                          <details>
                          <p>Custom icons can be added to buttons via Font Awesome. You can use any icon from the list below, you can access this list by clicking the 'See all icons' button. Each icon on that list has a short code, which you can copy and enter in the custom icon field.</p>
                          <p>Every icon short code consists of a prefix and main part. If the short code is not a brand icon, you can simply enter the code in the format: fa-icon-name. The 'fa-...' formatting is important here. For example 'fa-code'.</p>
                          <p>If the short code is a brand icon, it is important to include a 'fab' before the short code part. Again, The 'fa-...' formatting still applies here. For example, 'fab fa-github'</p>
                          <p>To apply color to your icons, you can simply write out the color name or just write the HEX value before the icon, followed by a ';'. Here it is important to put the color before the icon short code and the color code must be ended with a semicolon.<br>
                          You can find a list of available colors <a href="https://www.w3schools.com/cssref/css_colors.asp" target="_blank">here</a>.</p>
                          <br>
                          <div class="table-responsive">
                          <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">Style</th>
                              <th scope="col">Prefix</th>
                              <th scope="col" style="max-width: 1%">Icon</th>
                              <th scope="col">Short Code</th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td>Regular</td>
                              <td></td>
                              <td><i class="fa fa-user"></i></td>
                              <td><p>fa-user</p></td>
                            </tr>
                            <tr>
                              <td>Brands</td>
                              <td>fab</td>
                              <td><i class="fab fa-github"></i></td>
                              <td><p>fab fa-github</p></td>
                            </tr>
                            <tr>
                              <td>Color</td>
                              <td>color_name;</td>
                              <td><i style="color: red;" class="fa fa-ghost"></i></td>
                              <td><p style="color: red;">red; fa-ghost</p></td>
                            </tr>
                            <tr>
                              <td>Color HEX</td>
                              <td>color_HEX;</td>
                              <td><i style="color: #1DA1F2;" class="fab fa-twitter"></i></td>
                              <td><p style="color: #1DA1F2;">#1DA1F2; fab fa-twitter</p></td>
                            </tr>
                          </tbody>
                          </table>
                        </div>
                          </details>
                  
                          <br>
                          <button type="submit" class="btn btn-primary">Update icon</button>
                          <a class="btn btn-primary" href="https://fontawesome.com/search?m=free" target="_blank">See all icons</a>
                          
                        </form><br><br><br><br>
                        @endif
                  
                  </div>
                  
                  <a class="btn btn-primary" href="{{ url('/studio/links') }}"><i class="bi bi-arrow-left-short"></i> Back</a>
                  
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
@endif
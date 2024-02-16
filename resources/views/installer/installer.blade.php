@extends('layouts.installing')


@Push('installer-body')
<div class="container">

@if($_SERVER['QUERY_STRING'] === '')
{{-- Landing page --}}

@if(!DB::table('users')->get()->isEmpty())
    @php
    if(file_exists(base_path("INSTALLING"))){unlink(base_path("INSTALLING"));}
    header("Refresh:0");
    @endphp
@else
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>{{__('messages.Setup LinkStack')}}</h1>
        <p class="inst-txt">
        <div class="left-txt glass-container">
         {{__('messages.Welcome to the setup for LinkStack!')}}<br><br>
        <b>{{__('messages.This setup will:')}}</b><br>
        {{__('messages.Check the server dependencies')}}<br>
        {{__('messages.Setup the database')}}<br>
        {{__('messages.Create the admin user')}}<br>
        {{__('messages.Configure the app')}}<br>
        </div></p>  
        
{{-- start language --}}
<?php $configValue2 = str_replace('"', "", EnvEditor::getKey('LOCALE')); ?>
<form id="language-form" action="{{route('editConfigInstaller')}}" enctype="multipart/form-data" method="post">
    <div class="form-group col-lg-8">
        <input value="homeurl" name="type" style="display:none;" type="text" class="form-control form-control-lg" required>
        <input value="LOCALE" name="entry" style="display:none;" type="text" class="form-control form-control-lg" required>
        <p class="text-muted">{{__('messages.Choose a language')}}</p>
        <div class="input-group">
            <select style="max-width:600px;min-width:300px;" class="form-control" name="value">
                @if($configValue2 != '')
                    <option>{{$configValue2}}</option>
                @endif
                <?php
                try {
                    $langFolders = array_filter(glob(base_path('resources/lang') . '/*'), 'is_dir');
                } catch (\Exception $e) {
                    $langFolders = [];
                }

                foreach($langFolders as $folder) {
                    $folderName = basename($folder);
                    if ($folderName != $configValue2) {
                        echo '<option>' . $folderName . '</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <script type="text/javascript">
        document.getElementById("language-form").addEventListener("change", function() {
            this.submit();
        });
    </script>
</form>
{{-- end language --}}

<p style="margin:25px;max-width:350px;">{{__('messages.setup.disclaimer')}} <a href="https://linkstack.org/terms-and-conditions/" target="_blank">{{__('messages.Terms and Conditions')}}</a>.</p>

        &ensp;<a class="btn" href="{{url('?2')}}"><button>{{__('messages.Next')}}</button></a>&ensp;
@endif
      
@endif

@if($_SERVER['QUERY_STRING'] === 'error')
{{-- Landing page --}}
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>{{__('messages.Setup failed')}}</h1>
        <p class="inst-txt">{{__('messages.An error has occured. Please try again')}}</p>
        <div class="row">
        &ensp;<a class="btn" href="{{url('')}}"><button>{{__('messages.Try again')}}</button></a>&ensp;
        </div>
      
@endif

@if($_SERVER['QUERY_STRING'] === '2')
{{-- Landing page --}}
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>{{__('messages.Dependency check')}}</h1>
        <p class="inst-txt">{{__('messages.Required PHP modules:')}}</p>
        <div class="left-txt glass-container">
        <table style="width:115%">
        <style>.bi-x-lg{color:tomato}</style>
        <tr><td>BCMath: </td><td>@if(extension_loaded('bcmath'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>Ctype: </td><td>@if(extension_loaded('Ctype'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>cURL: </td><td>@if(extension_loaded('cURL'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>DOM: </td><td>@if(extension_loaded('DOM'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>Fileinfo: </td><td>@if(extension_loaded('Fileinfo'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>JSON: </td><td>@if(extension_loaded('JSON'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>iconv: </td><td>@if(extension_loaded('iconv'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>Mbstring: </td><td>@if(extension_loaded('Mbstring'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>OpenSSL: </td><td>@if(extension_loaded('OpenSSL'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>PCRE: </td><td>@if(extension_loaded('PCRE'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>PDO: </td><td>@if(extension_loaded('PDO'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>Tokenizer: </td><td>@if(extension_loaded('Tokenizer'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>XML: </td><td>@if(extension_loaded('XML'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        </table>
        <br>
        <b style="font-size:90%;margin-bottom:5px;display:flex;">{{__('messages.Depending on your database type:')}}</b>
        <table style="width:123%">
        <tr><td>SQLite: </td><td>@if(extension_loaded('PDO_SQLite'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>MySQL: </td><td>@if(extension_loaded('PDO_MySQL'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        </table>
        </div><br>
        <div class="row">
        &ensp;<a class="btn" href="?3"><button>{{__('messages.Next')}}</button></a>&ensp;
        </div>
      
@endif

@if($_SERVER['QUERY_STRING'] === '3')
{{-- Landing page --}}
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>{{__('messages.Setup LinkStack')}}</h1>
        <p class="inst-txt">{{__('messages.Select a database type')}}</p>
<p>{{__('messages.Under most circumstances, we recommend using SQLite')}}
   <br>
   {{__('messages.MySQL requires a separate, empty MySQL database')}}</p><br>
<form id="home-url-form" action="{{route('db')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<div class="input-group">
<label>{{__('messages.Database type:')}}</label>
<select style="max-width:300px" class="form-control" name="database">
<option>SQLite</option>
<option>MySQL</option>
</select>
</div></div><br><br>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<button type="submit" class="mt-3 ml-3 btn btn-info">{{__('messages.Next')}}</button>
</form>
      
@endif

@if($_SERVER['QUERY_STRING'] === 'mysql')
{{-- Landing page --}}
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>{{__('messages.Setup LinkStack')}}</h1>
        <p class="inst-txt">MySQL</p>

<form id="home-url-form" action="{{route('mysql')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<label>{{__('messages.Database host:')}}</label>
<input style="max-width:275px;" class="form-control" name="host" type="text" required>
<label>{{__('messages.Database port:')}}</label>
<input style="max-width:275px;" class="form-control" name="port" type="text" required>
<label>{{__('messages.Database name:')}}</label>
<input style="max-width:275px;" class="form-control" name="name" type="text" required>
<label>{{__('messages.Database username:')}}</label>
<input style="max-width:275px;" class="form-control" name="username" type="text" required>
<label>{{__('messages.Database password:')}}</label>
<input style="max-width:275px;" class="form-control" name="password" type="password" />
<div class="input-group">
</div></div><br>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<button type="submit" class="mt-3 ml-3 btn btn-info">{{__('messages.Next')}}</button>
</form>

        <div class="row">
        </div>
      
@endif

@if($_SERVER['QUERY_STRING'] === '4')
{{-- Landing page --}}
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>{{__('messages.Setup LinkStack')}}</h1>
        <p class="inst-txt">{{__('messages.Create an admin account')}}</p>

<form id="home-url-form" action="{{route('createAdmin')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<label>{{__('messages.Admin email:')}}</label>
<input style="max-width:275px;" class="form-control" placeholder="admin@admin.com" name="email" type="email" required>
<label>{{__('messages.Admin password:')}}</label>
<input style="max-width:275px;" class="form-control" placeholder="12345678" name="password" type="password" required>
<label>{{__('messages.Handle:')}}</label>
<div class="input-group">
<div class="input-group-prepend"><div class="input-group-text">@</div></div>
<input style="max-width:237px; padding-left:50px;" class="form-control" name="handle" type="text" required>
</div>
<label>{{__('messages.Name:')}}</label>
<input style="max-width:275px;" class="form-control" name="name" type="text" required>
<div class="input-group">
</div></div><br>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<button type="submit" class="mt-3 ml-3 btn btn-info">{{__('messages.Next')}}</button>
</form>
      
@endif

@if($_SERVER['QUERY_STRING'] === '5')
{{-- Landing page --}}
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>{{__('messages.Setup LinkStack')}}</h1>
        <p class="inst-txt">{{__('messages.Configure your page')}}</p>
<form id="home-url-form" action="{{route('options')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<div class="input-group">

<label>{{__('messages.Enable registration:')}}</label>
<select style="max-width:300px" class="form-control" name="register">
<option value="Yes">{{__('messages.Yes')}}</option>
<option value="No">{{__('messages.No')}}</option>
</select>

<label>{{__('messages.Enable email verification:')}}</label>
<select style="max-width:300px" class="form-control" name="verify">
<option value="Yes">{{__('messages.Yes')}}</option>
<option value="No">{{__('messages.No')}}</option>
</select>

<label>{{__('messages.Set your page as Home Page')}}</label>
<select id="select" style="max-width:300px" class="form-control" name="page">
<option value="No">{{__('messages.No')}}</option>
<option value="Yes">{{__('messages.Yes')}}</option>
</select>
<script src="{{ asset('assets/external-dependencies/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/external-dependencies/sweetalert2.min.js') }}"></script>
<script>
$("#select").change(function(){
    if($(this).val() == "Yes") {
        $('.container').hide();

        Swal.fire({
            title: "{{__('messages.Set your page as Home Page')}}",
            text: "{{__('messages.This will move the Home Page to /home')}}",
            icon: 'info',
            confirmButtonText: "{{__('messages.Confirm')}}",
        }).then((result) => {
            $('.container').show();
        });
    }
});
</script>

<label>{{__('messages.App Name:')}}</label>
<input style="max-width:275px;" class="form-control" value="LinkStack" name="app" type="text" required>

</div></div><br>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<button type="submit" class="mt-3 ml-3 btn btn-info">{{__('messages.Finish setup')}}</button>
</form>
      
@endif


</div>
@endpush
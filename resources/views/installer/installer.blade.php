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
           <img class="logo-img" src="{{ asset('littlelink/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>Setup LittleLink Custom</h1>
        <p class="inst-txt">
        <div class="left-txt glass-container">
        Welcome to the setup for LittleLink Custom!<br><br>
        <b>This setup will:</b><br>
        1. Check the server dependencies<br>
        2. Setup the database<br>
        3. Create the admin user<br>
        4. Configure the app<br>
        </div></p>  
        &ensp;<a class="btn" href="{{url('?2')}}"><button>Next</button></a>&ensp;
@endif
      
@endif

@if($_SERVER['QUERY_STRING'] === 'error')
{{-- Landing page --}}
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>Setup failed</h1>
        <p class="inst-txt">An error has occured. Please try again.</p>
        <div class="row">
        &ensp;<a class="btn" href="{{url('')}}"><button>Try again</button></a>&ensp;
        </div>
      
@endif

@if($_SERVER['QUERY_STRING'] === '2')
{{-- Landing page --}}
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>Dependency check</h1>
        <p class="inst-txt">Required PHP modules:</p>
        <div class="left-txt glass-container">
        <table style="width:115%">
        <style>.bi-x-lg{color:tomato}</style>
        <tr><td>BCMath: </td><td>@if(extension_loaded('bcmath'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>Ctype: </td><td>@if(extension_loaded('Ctype'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>cURL: </td><td>@if(extension_loaded('cURL'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>DOM: </td><td>@if(extension_loaded('DOM'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>Fileinfo: </td><td>@if(extension_loaded('Fileinfo'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>JSON: </td><td>@if(extension_loaded('JSON'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>Mbstring: </td><td>@if(extension_loaded('Mbstring'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>OpenSSL: </td><td>@if(extension_loaded('OpenSSL'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>PCRE: </td><td>@if(extension_loaded('PCRE'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>PDO: </td><td>@if(extension_loaded('PDO'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>Tokenizer: </td><td>@if(extension_loaded('Tokenizer'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>XML: </td><td>@if(extension_loaded('XML'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        </table>
        <br>
        <b style="font-size:90%;margin-bottom:5px;display:flex;">Depending on your database type:</b>
        <table style="width:123%">
        <tr><td>SQLite: </td><td>@if(extension_loaded('PDO_SQLite'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        <tr><td>MySQL: </td><td>@if(extension_loaded('PDO_MySQL'))<i class="bi bi-check-lg"></i>@else<i class="bi bi-x-lg"></i>@endif</td></tr>
        </table>
        </div><br>
        <div class="row">
        &ensp;<a class="btn" href="?3"><button>Next</button></a>&ensp;
        </div>
      
@endif

@if($_SERVER['QUERY_STRING'] === '3')
{{-- Landing page --}}
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>Setup LittleLink Custom</h1>
        <p class="inst-txt">Select a database type</p>
<p>Under most circumstances, we recommend using SQLite.<br>MySQL requires a separate, empty MySQL database.</p><br>
<form id="home-url-form" action="{{route('db')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<div class="input-group">
<label>Database type:</label>
<select style="max-width:300px" class="form-control" name="database">
<option>SQLite</option>
<option>MySQL</option>
</select>
</div></div><br><br>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<button type="submit" class="mt-3 ml-3 btn btn-info">Next</button>
</form>
      
@endif

@if($_SERVER['QUERY_STRING'] === 'mysql')
{{-- Landing page --}}
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>Setup LittleLink Custom</h1>
        <p class="inst-txt">MySQL</p>

<form id="home-url-form" action="{{route('mysql')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<label>Database host:</label>
<input style="max-width:275px;" class="form-control" name="host" type="text" required>
<label>Database port:</label>
<input style="max-width:275px;" class="form-control" name="port" type="text" required>
<label>Database name:</label>
<input style="max-width:275px;" class="form-control" name="name" type="text" required>
<label>Database username:</label>
<input style="max-width:275px;" class="form-control" name="username" type="text" required>
<label>Database password:</label>
<input style="max-width:275px;" class="form-control" name="password" type="password" />
<div class="input-group">
</div></div><br>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<button type="submit" class="mt-3 ml-3 btn btn-info">Next</button>
</form>

        <div class="row">
        </div>
      
@endif

@if($_SERVER['QUERY_STRING'] === '4')
{{-- Landing page --}}
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>Setup LittleLink Custom</h1>
        <p class="inst-txt">Create an admin account.</p>

<form id="home-url-form" action="{{route('createAdmin')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<label>Admin email:</label>
<input style="max-width:275px;" class="form-control" placeholder="admin@admin.com" name="email" type="email" required>
<label>Admin password:</label>
<input style="max-width:275px;" class="form-control" placeholder="12345678" name="password" type="password" required>
<label>Handle:</label>
<div class="input-group">
<div class="input-group-prepend"><div class="input-group-text">@</div></div>
<input style="max-width:237px; padding-left:50px;" class="form-control" name="handle" type="text" />
</div>
<label>Name:</label>
<input style="max-width:275px;" class="form-control" name="name" type="text" />
<div class="input-group">
</div></div><br>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<button type="submit" class="mt-3 ml-3 btn btn-info">Next</button>
</form>
      
@endif

@if($_SERVER['QUERY_STRING'] === '5')
{{-- Landing page --}}
        
        <div class="logo-container fadein">
           <img class="logo-img" src="{{ asset('littlelink/images/logo.svg') }}" alt="Logo">
        </div>
        <h1>Setup LittleLink Custom</h1>
        <p class="inst-txt">Configure your page</p>
<form id="home-url-form" action="{{route('options')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<div class="input-group">

<label>Enable registration:</label>
<select style="max-width:300px" class="form-control" name="register">
<option>Yes</option>
<option>No</option>
</select>

<label>Enable email verification:</label>
<select style="max-width:300px" class="form-control" name="verify">
<option>Yes</option>
<option>No</option>
</select>

<label>Set your page as Home Page</label>
<select id="select" style="max-width:300px" class="form-control" name="page">
<option>No</option>
<option>Yes</option>
</select>
<style>.hidden{display:flex!important;}</style>
<span class="" id="hidden" style="display:none;margin-top:-22px;margin-bottom:10px;color:#6c757d;font-size:90%;">This will move the Home Page to /home</span>
<script src="{{ asset('studio/external-dependencies/jquery-3.4.1.min.js') }}"></script>
<script>
$("#select").change(function(){
    if($(this).val() == "Yes") {
       $('#hidden').addClass('hidden');
    } else {
       $('#hidden').removeClass('hidden');
    }
});
</script>

<label>App Name:</label>
<input style="max-width:275px;" class="form-control" value="LittleLink Custom" name="app" type="text" required>

</div></div><br>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<button type="submit" class="mt-3 ml-3 btn btn-info">Finish setup</button>
</form>
      
@endif


</div>
@endpush
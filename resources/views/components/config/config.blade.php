<?php use App\Models\Page; ?>
<style>
@supports (-webkit-appearance: none) or (-moz-appearance: none) {
  input[type=checkbox],
input[type=radio] {
    --active: #275EFE;
    --active-inner: #fff;
    --focus: 2px rgba(39, 94, 254, .3);
    --border: #BBC1E1;
    --border-hover: #275EFE;
    --background: #fff;
    --disabled: #F6F8FF;
    --disabled-inner: #E1E6F9;
    -webkit-appearance: none;
    -moz-appearance: none;
    height: 21px;
    outline: none;
    display: inline-block;
    vertical-align: top;
    position: relative;
    margin: 0;
    cursor: pointer;
    border: 1px solid var(--bc, var(--border));
    background: var(--b, var(--background));
    transition: background 0.3s, border-color 0.3s, box-shadow 0.2s;
  }
  input[type=checkbox]:after,
input[type=radio]:after {
    content: "";
    display: block;
    left: 0;
    top: 0;
    position: absolute;
    transition: transform var(--d-t, 0.3s) var(--d-t-e, ease), opacity var(--d-o, 0.2s);
  }
  input[type=checkbox]:checked,
input[type=radio]:checked {
    --b: var(--active);
    --bc: var(--active);
    --d-o: .3s;
    --d-t: .6s;
    --d-t-e: cubic-bezier(.2, .85, .32, 1.2);
  }
  input[type=checkbox]:disabled,
input[type=radio]:disabled {
    --b: var(--disabled);
    cursor: not-allowed;
    opacity: 0.9;
  }
  input[type=checkbox]:disabled:checked,
input[type=radio]:disabled:checked {
    --b: var(--disabled-inner);
    --bc: var(--border);
  }
  input[type=checkbox]:disabled + label,
input[type=radio]:disabled + label {
    cursor: not-allowed;
  }
  input[type=checkbox]:hover:not(:checked):not(:disabled),
input[type=radio]:hover:not(:checked):not(:disabled) {
    --bc: var(--border-hover);
  }
  input[type=checkbox]:focus,
input[type=radio]:focus {
    box-shadow: 0 0 0 var(--focus);
  }
  input[type=checkbox]:not(.switch),
input[type=radio]:not(.switch) {
    width: 21px;
  }
  input[type=checkbox]:not(.switch):after,
input[type=radio]:not(.switch):after {
    opacity: var(--o, 0);
  }
  input[type=checkbox]:not(.switch):checked,
input[type=radio]:not(.switch):checked {
    --o: 1;
  }
  input[type=checkbox] + label,
input[type=radio] + label {
    font-size: 14px;
    line-height: 21px;
    display: inline-block;
    vertical-align: top;
    cursor: pointer;
    margin-left: 4px;
  }

  input[type=checkbox]:not(.switch) {
    border-radius: 7px;
  }
  input[type=checkbox]:not(.switch):after {
    width: 5px;
    height: 9px;
    border: 2px solid var(--active-inner);
    border-top: 0;
    border-left: 0;
    left: 7px;
    top: 4px;
    transform: rotate(var(--r, 20deg));
  }
  input[type=checkbox]:not(.switch):checked {
    --r: 43deg;
  }
  input[type=checkbox].switch {
    width: 38px;
    border-radius: 11px;
  }
  input[type=checkbox].switch:after {
    left: 2px;
    top: 2px;
    border-radius: 50%;
    width: 15px;
    height: 15px;
    background: var(--ab, var(--border));
    transform: translateX(var(--x, 0));
  }
  input[type=checkbox].switch:checked {
    --ab: var(--active-inner);
    --x: 17px;
  }
  input[type=checkbox].switch:disabled:not(:checked):after {
    opacity: 0.6;
  }

  input[type=radio] {
    border-radius: 50%;
  }
  input[type=radio]:after {
    width: 19px;
    height: 19px;
    border-radius: 50%;
    background: var(--active-inner);
    opacity: 0;
    transform: scale(var(--s, 0.7));
  }
  input[type=radio]:checked {
    --s: .5;
  }
}
.txt-label{
    color: white;
    padding-left: 5px;
    font-size: 200%;
    position: relative;
}
.toggle-btn{
    padding-left: 20px;
}
.ch2{
    padding-top: 60px;
}
</style>

<?php 
function toggle($key){
    $configNames = json_decode(file_get_contents(base_path('config/config-legends.json')));
	echo '
    <form id="'.$key.'-form" action="'.route('editConfig').'" enctype="multipart/form-data" method="post">
	<div class="form-group col-lg-8">
	<input value="toggle" name="type" style="display:none;" type="text" required>
	<input value="'.$key.'" name="entry" style="display:none;" type="text" required>
	<h5 style="margin-top:50px">'; foreach($configNames as $obj){if($obj->value == $key){echo $obj->title;}}; echo '</h5>
    <p class="text-muted">'; foreach($configNames as $obj){if($obj->value == $key){echo $obj->description;}}; echo '</p>
	<div class="input-group">
	<div class="row toggle-btn"><input name="toggle" class="switch toggle-btn" type="checkbox" id="'.$key.'"'; if(EnvEditor::getKey($key) == 'false'){echo '/>';}else{echo 'checked>';} echo '<label for="'.$key.'" class="label txt-label">Enable</label></div>
	</div></div>
    <input type="hidden" name="_token" value="'.csrf_token().'">
    <script type="text/javascript">
document.getElementById("'.$key.'-form").addEventListener("change", function() { 
    this.submit(); 
});
</script>
    </form>
	';
}
?>


<?php 
function toggle2($key){
    $configNames = json_decode(file_get_contents(base_path('config/config-legends.json')));
	echo '
    <form id="'.$key.'-form" action="'.route('editConfig').'" enctype="multipart/form-data" method="post">
	<div class="form-group col-lg-8">
	<input value="toggle2" name="type" style="display:none;" type="text" required>
	<input value="'.$key.'" name="entry" style="display:none;" type="text" required>
	<h5 style="margin-top:50px">'; foreach($configNames as $obj){if($obj->value == $key){echo $obj->title;}}; echo '</h5>
    <p class="text-muted">'; foreach($configNames as $obj){if($obj->value == $key){echo $obj->description;}}; echo '</p>
	<div class="input-group">
	<div class="row toggle-btn"><input name="toggle" class="switch toggle-btn" type="checkbox" id="'.$key.'"'; if(EnvEditor::getKey($key) == 'auth'){echo '/>';}else{echo 'checked>';} echo '<label for="'.$key.'" class="label txt-label">Enable</label></div>
	</div></div>
    <input type="hidden" name="_token" value="'.csrf_token().'">
    <script type="text/javascript">
document.getElementById("'.$key.'-form").addEventListener("change", function() { 
    this.submit(); 
});
</script>
    </form>
	';
}
?>


<?php 
function text($key){
    $configNames = json_decode(file_get_contents(base_path('config/config-legends.json')));
    $configValue = str_replace('"', "", EnvEditor::getKey($key));
	echo '
    <form id="'.$key.'-form" action="'.route('editConfig').'" enctype="multipart/form-data" method="post">
    <div class="form-group col-lg-8">
    <input value="text" name="type" style="display:none;" type="text" required>
    <input value="'.$key.'" name="entry" style="display:none;" type="text" required>
	<h5 style="margin-top:50px">'; foreach($configNames as $obj){if($obj->value == $key){echo $obj->title;}}; echo '</h5>
    <p class="text-muted">'; foreach($configNames as $obj){if($obj->value == $key){echo $obj->description;}}; echo '</p>
    <div class="input-group">
    <input type="text" style="border-radius:.25rem;max-width:600px" class="form-control" name="value" value="'.$configValue.'" required>';  echo '
    <input type="hidden" name="_token" value="'.csrf_token().'">
	<button style="position:relative;bottom:17px;" type="submit" class="mt-3 ml-3 btn btn-info">Apply</button>
    </div></div>
    </form>
	';
}
?>


<a name="Application"><h2 class="ch2">Application</h2></a>


{{-- start register --}}
<form id="register-form" action="{{route('editConfig')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<input value="register" name="type" style="display:none;" type="text" required>
<input value="register" name="entry" style="display:none;" type="text" required>
<h5 style="margin-top:50px">Enable registration</h5>
<p class="text-muted">Determines whether users can register for your application.</p>
<div class="input-group">
<div class="row toggle-btn"><input name="toggle" class="switch toggle-btn" type="checkbox" id="toggle-register" <?php if(Page::pluck('register') == '["false"]'){echo '/>';}else{echo 'checked>';} ?> <label for="toggle-register" class="label txt-label">Enable</label></div>
</div></div>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<script type="text/javascript">document.getElementById("register-form").addEventListener("change", function() { this.submit(); });</script>
</form>
{{-- end register --}}


{{toggle2('REGISTER_AUTH')}}


{{-- start home url --}}
<?php $configValue2 = str_replace('"', "", EnvEditor::getKey('HOME_URL')); ?>
<form id="home-url-form" action="{{route('editConfig')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<input value="homeurl" name="type" style="display:none;" type="text" required>
<input value="HOME_URL" name="entry" style="display:none;" type="text" required>
<h5 style="margin-top:50px">Set user page as Home Page</h5>
<p class="text-muted">Set a user page as the home page. This will move the previous home page to example.com/home.</p>
<div class="input-group">

<select style="max-width:600px" class="form-control" name="value">
@if($configValue2 != '')<option>{{$configValue2}}</option>@endif
@if($configValue2 != 'default')<option>default</option>@endif
<?php $users = DB::table('users')->where('littlelink_name', '!=', '')->get();
foreach($users as $user){if($user->littlelink_name != $configValue2){echo '<option>' . $user->littlelink_name . '</option>';}} ?>
</select>

</div></div>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<script type="text/javascript">document.getElementById("home-url-form").addEventListener("change", function() { this.submit(); });</script>
</form>
{{-- end home url --}}


{{toggle('FORCE_HTTPS')}}


{{text('APP_NAME')}}


<a name="Panel-settings"><h2 class="ch2">Panel settings</h2></a>

{{toggle('NOTIFY_EVENTS')}}


{{toggle('NOTIFY_UPDATES')}}


{{toggle('ENABLE_BUTTON_EDITOR')}}


{{toggle('USE_THEME_PREVIEW_IFRAME')}}


<a name="Security"><h2 class="ch2">Security</h2></a>


{{toggle('ALLOW_USER_HTML')}}


{{toggle('ALLOW_CUSTOM_CODE_IN_THEMES')}}


{{toggle('ENABLE_THEME_UPDATER')}}


<a name="Advanced"><h2 class="ch2">Advanced</h2></a>


{{-- start MAINTENANCE_MODE --}}
<form id="MAINTENANCE_MODE-form" action="{{route('editConfig')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<input value="maintenance" name="type" style="display:none;" type="text" required>
<input value="MAINTENANCE_MODE" name="entry" style="display:none;" type="text" required>
<h5 style="margin-top:50px">Enable Maintenance Mode</h5>
<p class="text-muted">Displays a maintenance message on all public pages. This will disable the login pages.</p>
<div class="input-group">
<div class="row toggle-btn"><input name="toggle" class="switch toggle-btn" type="checkbox" id="MAINTENANCE_MODE" <?php if(EnvEditor::getKey('MAINTENANCE_MODE') == 'true' or file_exists(base_path("storage/MAINTENANCE"))){echo 'checked>';}else{echo '/>';} ?><label for="MAINTENANCE_MODE" class="label txt-label">Enable</label></div>
</div></div>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<script type="text/javascript">
document.getElementById("MAINTENANCE_MODE-form").addEventListener("change", function() { 
    this.submit(); 
});
</script>
</form>
{{-- end MAINTENANCE_MODE --}}


{{toggle('JOIN_BETA')}}


{{toggle('SKIP_UPDATE_BACKUP')}}


{{toggle('CUSTOM_META_TAGS')}}


{{toggle('ENABLE_SOCIAL_LOGIN')}}


{{toggle('FORCE_ROUTE_HTTPS')}}


{{-- start SMTP settings --}}
<a name="SMTP"><h2 class="ch2">SMTP</h2></a>
<form id="smtp-form" action="{{route('editConfig')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<input value="smtp" name="type" style="display:none;" type="text" required>
<input value="smtp" name="entry" style="display:none;" type="text" required>
<h5 style="margin-top:50px">Use built in SMTP server</h5>
<p class="text-muted">Uses SMTP server provided by LittleLink Custom. Might not be 100% reliable. Some errors may occur.</p>
<div class="input-group">
<div class="row toggle-btn"><input name="toggle" class="switch toggle-btn" type="checkbox" id="toggle-smtp" <?php if(EnvEditor::getKey('MAIL_MAILER') != 'built-in'){echo '/>';}else{echo 'checked>';} ?> <label for="toggle-smtp" class="label txt-label">Enable</label></div>
</div></div>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<div style="max-width: 600px; padding-left: 20px;">
<br><h5>Custom SMTP server:</h5>
<label style="margin-top:15px">Host</label>
<input type="text" class="form-control" name="MAIL_HOST" value="{{EnvEditor::getKey('MAIL_HOST')}}" />
<label style="margin-top:15px">Port</label>
<input type="text" class="form-control" name="MAIL_PORT" value="{{EnvEditor::getKey('MAIL_PORT')}}" />
<label style="margin-top:15px">Username</label>
<input type="text" class="form-control" name="MAIL_USERNAME" value="{{EnvEditor::getKey('MAIL_USERNAME')}}" />
<label style="margin-top:15px">Password</label>
<input type="password" class="form-control" name="MAIL_PASSWORD" value="{{EnvEditor::getKey('MAIL_PASSWORD')}}" />
<label style="margin-top:15px">Encryption type</label>
<input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{EnvEditor::getKey('MAIL_ENCRYPTION')}}" />
<label style="margin-top:15px">From adress</label>
<input type="text" class="form-control" name="MAIL_FROM_ADDRESS" value="{{EnvEditor::getKey('MAIL_FROM_ADDRESS')}}" />
</div>
<button type="submit" class="mt-3 ml-3 btn btn-info">Apply changes</button>
</form>
{{-- end SMTP settings --}}


{{-- start footer settings --}}
<a name="Footer"><h2 class="ch2">Footer links</h2></a>

{{toggle('DISPLAY_FOOTER')}}

{{toggle('DISPLAY_CREDIT')}}

{{toggle('DISPLAY_FOOTER_HOME')}}
{{text('TITLE_FOOTER_HOME')}}

@php
    $configNames = json_decode(file_get_contents(base_path('config/config-legends.json')));
    $configValue = str_replace('"', "", EnvEditor::getKey('HOME_FOOTER_LINK'));
@endphp
    <form id="HOME_FOOTER_LINK-form" action="{{route('editConfig')}}" enctype="multipart/form-data" method="post">
    <div class="form-group col-lg-8">
    <input value="text" name="type" style="display:none;" type="text" required>
    <input value="HOME_FOOTER_LINK" name="entry" style="display:none;" type="text" required>
	<h5 style="margin-top:50px">@php foreach($configNames as $obj){if($obj->value == 'HOME_FOOTER_LINK'){echo $obj->title;}}; @endphp</h5>
    <p class="text-muted">@php foreach($configNames as $obj){if($obj->value == 'HOME_FOOTER_LINK'){echo $obj->description;}}; @endphp</p>
    <div class="input-group">
    <input type="url" style="border-radius:.25rem;max-width:600px" class="form-control" name="value" value="{{$configValue}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
	<button style="position:relative;bottom:17px;" type="submit" class="mt-3 ml-3 btn btn-info">Apply</button>
    </div></div>
    </form>

{{toggle('DISPLAY_FOOTER_TERMS')}}
{{text('TITLE_FOOTER_TERMS')}}

{{toggle('DISPLAY_FOOTER_PRIVACY')}}
{{text('TITLE_FOOTER_PRIVACY')}}

{{toggle('DISPLAY_FOOTER_CONTACT')}}
{{text('TITLE_FOOTER_CONTACT')}}
{{-- end footer settings --}}


{{-- start debug settings --}}
<a name="Debug"><h2 class="ch2">Debug</h2></a>
<form id="debug-form" action="{{route('editConfig')}}" enctype="multipart/form-data" method="post">
<div class="form-group col-lg-8">
<input value="debug" name="type" style="display:none;" type="text" required>
<input value="debug" name="entry" style="display:none;" type="text" required>
<h5 style="margin-top:50px">Debug mode</h5>
<p class="text-muted">Should be disabled in a production environment. Useful for debugging during setup.</p>
<div class="input-group">
<div class="row toggle-btn"><input name="toggle" class="switch toggle-btn" type="checkbox" id="toggle-debug" <?php if(EnvEditor::getKey('APP_DEBUG') == 'false'){echo '/>';}else{echo 'checked>';} ?> <label for="toggle-debug" class="label txt-label">Enable</label></div>
</div></div>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<script type="text/javascript">document.getElementById("debug-form").addEventListener("change", function() { this.submit(); });</script>
</form>
{{-- end debug settings --}}

<br><br><br><br><br>

<script src="{{ asset('studio/external-dependencies/jquery-3.4.1.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function () {

    if (localStorage.getItem("my_app_name_here-quote-scroll") != null) {
        $(window).scrollTop(localStorage.getItem("my_app_name_here-quote-scroll"));
    }

    $(window).on("scroll", function() {
        localStorage.setItem("my_app_name_here-quote-scroll", $(window).scrollTop());
    });

  });
</script>


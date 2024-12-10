<?php use JeroenDesloovere\VCard\VCard; use App\Models\Button; $button = Button::find($button_id); if(isset($button->name)){$buttonName = $button->name;}else{$buttonName = 0;} ?>

<select style="display:none" name="button" class="form-control"><option class="button button-default email" value="vcard">{{__('messages.Vcard')}}</option></select>

@php
try {
$data = json_decode($link);

$prefix = $data->prefix;
$firstName = $data->first_name;
$middleName = $data->middle_name;
$lastName = $data->last_name;
$suffix = $data->suffix;
$organization = $data->organization;
$vtitle = $data->vtitle;
$role = $data->role;
$workUrl = $data->work_url;
$email = $data->email;
$workEmail = $data->work_email;
$homePhone = $data->home_phone;
$workPhone = $data->work_phone;
$cellPhone = $data->cell_phone;
$homeAddressLabel = $data->home_address_label;
$homeAddressStreet = $data->home_address_street;
$homeAddressCity = $data->home_address_city;
$homeAddressState = $data->home_address_state;
$homeAddressZip = $data->home_address_zip;
$homeAddressCountry = $data->home_address_country;
$workAddressLabel = $data->work_address_label;
$workAddressStreet = $data->work_address_street;
$workAddressCity = $data->work_address_city;
$workAddressState = $data->work_address_state;
$workAddressZip = $data->work_address_zip;
$workAddressCountry = $data->work_address_country;
}
catch (exception $e) {}
@endphp

<label for='title' class='form-label'>{{__('messages.Custom Title')}}</label>
<input type='text' name='link_title' value='{{ $title }}' class='form-control' />
<span class='small text-muted'>{{__('messages.Leave blank for default title')}}</span><br>

{{-- <br><h5>Upload existing file</h5>
<div class="form-group col-lg-8">
    <label>Vcard</label>
    <input type="file" accept="text/vcard" class="form-control-file" name="vcard">
</div> --}}

<br><br><h4>{{__('messages.Name')}}</h4>
<label for='prefix' class='form-label'>{{__('messages.Prefix')}}</label>
<input type='text' name='prefix' value='{{$prefix ?? ''}}' class='form-control'/>
<br>
<label for='first_name' class='form-label'>{{__('messages.First Name')}}</label>
<input type='text' name='first_name' value='{{$firstName ?? ''}}' class='form-control'/>
<br>
<label for='middle_name' class='form-label'>{{__('messages.Middle Name')}}</label>
<input type='text' name='middle_name' value='{{$middleName ?? ''}}' class='form-control'/>
<br>
<label for='last_name' class='form-label'>{{__('messages.Last Name')}}</label>
<input type='text' name='last_name' value='{{$lastName ?? ''}}' class='form-control'/>
<br>
<label for='suffix' class='form-label'>{{__('messages.Suffix')}}</label>
<input type='text' name='suffix' value='{{$suffix ?? ''}}' class='form-control'/>
<br>
{{-- <label for='nickname' class='form-label'>Nickname</label>
<input type='text' name='nickname' value='{{ ?? ''}}' class='form-control'/>
<br> --}}

<br><h4>{{__('messages.Work')}}</h4>
<label for='organization' class='form-label'>{{__('messages.Organization')}}</label>
<input type='text' name='organization' value='{{$organization ?? ''}}' class='form-control'/>
<br>
<label for='vtitle' class='form-label'>{{__('messages.Title')}}</label>
<input type='text' name='vtitle' value='{{$vtitle ?? ''}}' class='form-control'/>
<br>
<label for='role' class='form-label'>{{__('messages.Role')}}</label>
<input type='text' name='role' value='{{$role ?? ''}}' class='form-control'/>
<br>
<label for='work_url' class='form-label'>{{__('messages.Work URL')}}</label>
<input type='url' name='work_url' value='{{$workUrl ?? ''}}' class='form-control'/>
<br>

<br><h4>{{__('messages.Emails')}}</h4>
<label for='email' class='form-label'>{{__('messages.Email')}}</label>
<input type='email' name='email' value='{{$email ?? ''}}' class='form-control'/>
<span class='small text-muted'>{{__('messages.Enter your personal email')}}</span>
<br>
<label for='work_email' class='form-label'>{{__('messages.Work Email')}}</label>
<input type='email' name='work_email' value='{{$workEmail ?? ''}}' class='form-control'/>
<span class='small text-muted'>{{__('messages.Enter your work email')}}</span>
<br>

<br><h4>{{__('messages.Phones')}}</h4>
<label for='home_phone' class='form-label'>{{__('messages.Home Phone')}}</label>
<input type='tel' name='home_phone' value='{{$homePhone ?? ''}}' class='form-control'/>
<br>
<label for='work_phone' class='form-label'>{{__('messages.Work Phone')}}</label>
<input type='tel' name='work_phone' value='{{$workPhone ?? ''}}' class='form-control'/>
<br>
<label for='cell_phone' class='form-label'>{{__('messages.Cell Phone')}}</label>
<input type='tel' name='cell_phone' value='{{$cellPhone ?? ''}}' class='form-control'/>
<br>

<br><h4>Home Address</h4>
<label for='home_address_label' class='form-label'>{{__('messages.Label')}}</label>
<input type='text' name='home_address_label' value='{{$homeAddressLabel ?? ''}}' class='form-control'/>
<br>
<label for='home_address_street' class='form-label'>{{__('messages.Street')}}</label>
<input type='text' name='home_address_street' value='{{$homeAddressStreet ?? ''}}' class='form-control'/>
<br>
<label for='home_address_city' class='form-label'>{{__('messages.City')}}</label>
<input type='text' name='home_address_city' value='{{$homeAddressCity ?? ''}}' class='form-control'/>
<br>
<label for='home_address_state' class='form-label'>{{__('messages.State/Province')}}</label>
<input type='text' name='home_address_state' value='{{$homeAddressState ?? ''}}' class='form-control'/>
<br>
<label for='home_address_zip' class='form-label'>{{__('messages.Zip/Postal Code')}}</label>
<input type='text' name='home_address_zip' value='{{$homeAddressZip ?? ''}}' class='form-control'/>
<br>
<label for='home_address_country' class='form-label'>{{__('messages.Country')}}</label>
<input type='text' name='home_address_country' value='{{$homeAddressCountry ?? ''}}' class='form-control'/>
<br>
<br><h4>{{__('messages.Work Address')}}</h4>
<label for='work_address_label' class='form-label'>{{__('messages.Label')}}</label>
<input type='text' name='work_address_label' value='{{$workAddressLabel ?? ''}}' class='form-control'/>
<br>
<label for='work_address_street' class='form-label'>{{__('messages.Street')}}</label>
<input type='text' name='work_address_street' value='{{$workAddressStreet ?? ''}}' class='form-control'/>
<br>
<label for='work_address_city' class='form-label'>{{__('messages.City')}}</label>
<input type='text' name='work_address_city' value='{{$workAddressCity ?? ''}}' class='form-control'/>
<br>
<label for='work_address_state' class='form-label'>{{__('messages.State/Province')}}</label>
<input type='text' name='work_address_state' value='{{$workAddressState ?? ''}}' class='form-control'/>
<br>
<label for='work_address_zip' class='form-label'>{{__('messages.Zip/Postal Code')}}</label>
<input type='text' name='work_address_zip' value='{{$workAddressZip ?? ''}}' class='form-control'/>
<br>
<label for='work_address_country' class='form-label'>{{__('messages.Country')}}</label>
<input type='text' name='work_address_country' value='{{$workAddressCountry ?? ''}}' class='form-control'/>
<br>


<?php use App\Models\Button; $button = Button::find($button_id); if(isset($button->name)){$buttonName = $button->name;}else{$buttonName = 0;} ?>

<select style="display:none" name="button" class="form-control"><option class="button button-default email" value="vcard">Vcard</option></select>

<label for='title' class='form-label'>Custom Title</label>
<input type='text' name='link_title' value='' class='form-control' />
<span class='small text-muted'>Leave blank for default title</span><br>

<br><h5>Upload existing file</h5>
<div class="form-group col-lg-8">
    <label>Vcard</label>
    <input type="file" accept="text/vcard" class="form-control-file" name="vcard">
</div>

<br><h4>Name</h4>
<label for='prefix' class='form-label'>Prefix</label>
<input type='text' name='prefix' value='' class='form-control'/>
<br>
<label for='first_name' class='form-label'>First Name</label>
<input type='text' name='first_name' value='' class='form-control'/>
<br>
<label for='middle_name' class='form-label'>Middle Name</label>
<input type='text' name='middle_name' value='' class='form-control'/>
<br>
<label for='last_name' class='form-label'>Last Name</label>
<input type='text' name='last_name' value='' class='form-control'/>
<br>
<label for='suffix' class='form-label'>Suffix</label>
<input type='text' name='suffix' value='' class='form-control'/>
<br>
{{-- <label for='nickname' class='form-label'>Nickname</label>
<input type='text' name='nickname' value='' class='form-control'/>
<br> --}}

<br><h4>Work</h4>
<label for='organization' class='form-label'>Organization</label>
<input type='text' name='organization' value='' class='form-control'/>
<br>
<label for='title' class='form-label'>Title</label>
<input type='text' name='title' value='' class='form-control'/>
<br>
<label for='role' class='form-label'>Role</label>
<input type='text' name='role' value='' class='form-control'/>
<br>
<label for='work_url' class='form-label'>Work URL</label>
<input type='url' name='work_url' value='' class='form-control'/>
<br>

<br><h4>Emails</h4>
<label for='email' class='form-label'>Email</label>
<input type='email' name='email' value='' class='form-control'/>
<span class='small text-muted'>Enter your personal email</span>
<br>
<label for='work_email' class='form-label'>Work Email</label>
<input type='email' name='work_email' value='' class='form-control'/>
<span class='small text-muted'>Enter your work email</span>
<br>

<br><h4>Phones</h4>
<label for='home_phone' class='form-label'>Home Phone</label>
<input type='tel' name='home_phone' value='' class='form-control'/>
<br>
<label for='work_phone' class='form-label'>Work Phone</label>
<input type='tel' name='work_phone' value='' class='form-control'/>
<br>
<label for='cell_phone' class='form-label'>Cell Phone</label>
<input type='tel' name='cell_phone' value='' class='form-control'/>
<br>

<br><h4>Home Address</h4>
<label for='home_address_label' class='form-label'>Label</label>
<input type='text' name='home_address_label' value='' class='form-control'/>
<br>
<label for='home_address_street' class='form-label'>Street</label>
<input type='text' name='home_address_street' value='' class='form-control'/>
<br>
<label for='home_address_city' class='form-label'>City</label>
<input type='text' name='home_address_city' value='' class='form-control'/>
<br>
<label for='home_address_state' class='form-label'>State/Province</label>
<input type='text' name='home_address_state' value='' class='form-control'/>
<br>
<label for='home_address_zip' class='form-label'>Zip/Postal Code</label>
<input type='text' name='home_address_zip' value='' class='form-control'/>
<br>
<label for='home_address_country' class='form-label'>Country</label>
<input type='text' name='home_address_country' value='' class='form-control'/>
<br>
<br><h4>Work Address</h4>
<label for='work_address_label' class='form-label'>Label</label>
<input type='text' name='work_address_label' value='' class='form-control'/>
<br>
<label for='work_address_street' class='form-label'>Street</label>
<input type='text' name='work_address_street' value='' class='form-control'/>
<br>
<label for='work_address_city' class='form-label'>City</label>
<input type='text' name='work_address_city' value='' class='form-control'/>
<br>
<label for='work_address_state' class='form-label'>State/Province</label>
<input type='text' name='work_address_state' value='' class='form-control'/>
<br>
<label for='work_address_zip' class='form-label'>Zip/Postal Code</label>
<input type='text' name='work_address_zip' value='' class='form-control'/>
<br>
<label for='work_address_country' class='form-label'>Country</label>
<input type='text' name='work_address_country' value='' class='form-control'/>
<br>


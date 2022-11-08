<label for='button' class='form-label'>Select a predefined site</label>

<select name='button' class='form-control'>

    @foreach ($buttons as $b)
        <option class='button button-{{$b["name"]}}' value='{{$b["name"]}}' {{ $b["selected"] == true ? "selected" : ""}}>{{$b["title"]}}</option>

    @endforeach
</select>

<label for='title' class='form-label'>Custom Title</label>
<input type='text' name='title' value='{{$link_title}}' class='form-control' />
<span class='small text-muted'>Leave blank for default title</span>

<label for='link' class='form-label'>URL</label>
<input type='url' name='link' value='{{$link_url}}' class='form-control' required />
<span class='small text-muted'>Enter the URL for to your profile page</span>


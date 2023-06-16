<p>{{__('messages.AC.description')}}</p>
<form action="{{ route('editAC') }}" method="post">
  @csrf
  <div class="form-group">
    <label>{{__('messages.Advanced Configuration file.')}}</label>
    <textarea style="width:100%;display:none;" class="form-control" name="AdvancedConfig" rows="280">{{ file_get_contents('config/advanced-config.php') }}</textarea>
    <div id="editor" style="width:100%; height:<?php echo count(file('config/advanced-config.php')) * 24 + 15;?>px; background-color:transparent !important;" class="form-control border-1 border-light" name="AdvancedConfig" rows="280">{{ file_get_contents('config/advanced-config.php') }}</div>
  </div>
  <button type="submit" class="btn btn-primary">{{__('messages.Save')}}</button>
  <a class="btn btn-danger confirmation" href="{{url('/admin/advanced-config?restore-defaults')}}">{{__('messages.Restore defaults')}}</a>
  <script type="text/javascript">
      var elems = document.getElementsByClassName('confirmation');
      var confirmIt = function (e) {
          if (!confirm('Are you sure?')) e.preventDefault();
      };
      for (var i = 0, l = elems.length; i < l; i++) {
          elems[i].addEventListener('click', confirmIt, false);
      }
  </script>
</form>


<script src="{{ asset('assets/external-dependencies/ace.js') }}" type="text/javascript" charset="utf-8"></script>
<script>
var editor = ace.edit("editor");
//if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
if(!$('#toggle-switch').is(':checked')){
// dark mode
editor.setTheme("ace/theme/tomorrow_night");
} else {
editor.setTheme("ace/theme/xcode");
}
editor.getSession().setMode("ace/mode/javascript");
editor.session.setUseWorker(false);
</script>
<script>
editor.getSession().on('change', function(e) {
$('textarea[name=AdvancedConfig]').val(editor.getSession().getValue());
});
</script>

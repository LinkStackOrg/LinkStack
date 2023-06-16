<section class="shadow text-gray-400">
  <h2 class="mb-4 card-header"><i class="bi bi-pencil-square"> .ENV</i></h2>
  <div class="card-body p-0 p-md-3">
  
  
          <form action="{{ route('editENV') }}" method="post">
            @csrf
            <div class="form-group">
              <label>{{__('messages.Strings with a # in front of them are comments and wont affect anything')}}</label>
              <textarea style="width:100%!important;display:none;" class="form-control" name="altConfig" rows="{{count(file('.env'))}}">{{ file_get_contents('.env') }}</textarea>
              <div id="editor2" style="width:100%; height:<?php echo count(file('.env')) * 24 + 50;?>px;" class="form-control" name="altConfig" rows="280">{{ file_get_contents('.env') }}</div>
            </div>
            <button type="submit" class="mt-3 ml-3 btn btn-info">{{__('messages.Save')}}</button>
          </form>
  
  <script src="{{ asset('assets/external-dependencies/ace.js') }}" type="text/javascript" charset="utf-8"></script>
  <script>
  var editor = ace.edit("editor2");
  editor.setTheme("ace/theme/xcode");
  editor.getSession().setMode("ace/mode/ruby");
  </script>
  <script>
  editor.getSession().on('change', function(e) {
  $('textarea[name=altConfig]').val(editor.getSession().getValue());
  });
  </script>
  
  
  </div>
  </section>
  
  {{-- <style>
  .float{
    position:fixed;
    width:60px;
    height:60px;
    bottom:40px;
    right:40px;
    background-color:#0C9;
    color:#FFF;
    border-radius:5px;
    text-align:center;
    align-items: middle;
    box-shadow: 2px 2px 3px #999;
    display: flex;
  }
  </style>
  <a href="#" class="float">back</a> --}}
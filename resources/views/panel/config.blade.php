@extends( ($_SERVER['QUERY_STRING'] === 'restore-defaults') ? 'layouts.lang' : 'layouts.sidebar')

@if($_SERVER['QUERY_STRING'] === 'restore-defaults')
<?php 
copy(base_path('storage/templates/advanced-config.php'), base_path('config/advanced-config.php')); 
echo "<meta http-equiv=\"refresh\" content=\"0; " . url()->current() . "/../../panel/config#2\" />";
?>
@else

@section('content')


@if(str_ends_with($_SERVER['REQUEST_URI'], 'advanced-config'))
        <h2 class="mb-4"><i class="bi bi-pencil-square"> Advanced config</i></h2>
          <p>Allows editing the frontend of your site. Amongst other things, this file allows customization of:<br> 
Home Page, links, titles, Google Analytics and meta tags.</p>
        <form action="{{ route('editAC') }}" method="post">
          @csrf
          <div class="form-group col-lg-8">
            <label>Advanced Configuration file.</label>
            <pre><textarea class="form-control" name="AdvancedConfig" rows="280">{{ file_get_contents('config/advanced-config.php') }}</textarea></pre>
          </div>
          <button type="submit" class="mt-3 ml-3 btn btn-info">Save</button>
          <a class="mt-3 ml-3 btn btn-primary confirmation" href="{{url('/panel/advanced-config?restore-defaults')}}">Restore defaults</a>
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
@elseif(str_ends_with($_SERVER['REQUEST_URI'], 'env'))
        <h2 class="mb-4"><i class="bi bi-pencil-square"> ENV</i></h2>
        
        <form action="{{ route('editENV') }}" method="post">
          @csrf
          <div class="form-group col-lg-8">
            <label>.env</label>
            <pre><textarea class="form-control" name="AdvancedConfig" rows="80">{{ file_get_contents('.env') }}</textarea></pre>
          </div>
          <button type="submit" class="mt-3 ml-3 btn btn-info">Save</button>
        </form>
@endif



@endsection
@endif
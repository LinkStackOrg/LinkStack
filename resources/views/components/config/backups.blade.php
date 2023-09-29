
<style>button{border-style: none;background-color: #0085ff;color: #fff;border-radius: 5px;}button:hover {background-color:#0065c1;color: #FFF;box-shadow: 0 10px 20px -10px rgba(0,0,0, 0.6);}.buttondm{display:inline-block;text-decoration:none;height:48px;text-align:center;vertical-align:middle;font-size:18px;width:300px;font-weight:700;line-height:48px;letter-spacing:.1px;white-space:wrap;border-radius:8px;cursor:pointer}.button-hover,.credit-hover{display:inline-block;-webkit-transform:perspective(1px) translateZ(0);transform:perspective(1px) translateZ(0);box-shadow:0 0 1px rgba(0,0,0,0);-webkit-transition-duration:.3s;transition-duration:.3s;-webkit-transition-property:transform;transition-property:transform}.button-hover:active,.credit-hover:active,.button-hover:focus,.credit-hover:focus,.button-hover:hover,.credit-hover:hover{-webkit-transform:scale(1.06);transform:scale(1.06)}.container{align-items:center;display:flex;flex-direction:column;justify-content:center;height:50%;width:100%}</style>
  <!-- Custom icons font-awesome -->
  <script src="{{ asset('assets/external-dependencies/fontawesome.js') }}" crossorigin="anonymous"></script>
  @if (file_exists(base_path('backups/updater-backups/')) and is_dir(base_path('backups/updater-backups/')))
    @if($_SERVER['QUERY_STRING'] != '')
    <?php
    $filename = $_SERVER['QUERY_STRING'];
    
    $filepath = base_path('backups/updater-backups/') . $filename;
    
    $strFile = file_get_contents($filepath);			
    
      header("Content-type: application/force-download");
      header('Content-Disposition: attachment; filename="'.$filename.'"');	
      
      header('Content-Length: ' . filesize($filepath));	
      echo $strFile;
      while (ob_get_level()) {
    	ob_end_clean();
      }
      readfile($filepath);	 
    	exit;
    ?>
    @endif
    
<div class="container">
<br><br><h3>{{__('messages.Download your updater backups:')}}</h3>
<hp>{{__('messages.The server will never store more that two backups at a time')}}</hp><br><br><br>
    <?php 
    $test="test";
    if ($handle = opendir('backups/updater-backups')) {
     while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $entrys = substr($entry, 17);
            echo '<div class="button-entrance"><a class="buttondm button-hover icon-hover" style="color:#ffffff; background-color:#000;" href="' . url('admin/backups') . '/?' . $entry . '"><i style="color: " class="icon hvr-icon fa fa-download"></i>&nbsp; '; print_r($entrys); echo '</a></div><br>';
            }}} ?>
</div>

  @else
<div class="container">
<h3>{{__('messages.No backups found')}}</h3></div>
  @endif
<center><a data-toggle="tab" href="#3"><button class="btn btn-primary" style="padding:10px"><i class="fa-solid fa-floppy-disk"></i> {{__('messages.Backup your instance')}}</button></a></center>

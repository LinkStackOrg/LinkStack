@extends('layouts.sidebar')

@section('content')
  @if (file_exists(base_path('backups/updater-backups/')) and is_dir(base_path('backups/updater-backups/')))
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
  
@endsection
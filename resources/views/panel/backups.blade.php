@extends('layouts.sidebar')

@section('content')
  @if (file_exists(base_path('backups/updater-backups/')) and is_dir(base_path('backups/updater-backups/')))
  <?php
  $filename = $_SERVER['QUERY_STRING'];
  $filepath = base_path('backups/updater-backups/') . $filename;
  
  if (file_exists($filepath)) {
      header("Content-type: application/octet-stream");
      header('Content-Disposition: attachment; filename="' . $filename . '"');
      header('Content-Length: ' . filesize($filepath));
  
      $file = fopen($filepath, 'rb');
      if ($file) {
          while (!feof($file)) {
              echo fread($file, 8192);
              ob_flush();
              flush();
          }
          fclose($file);
      }
      exit;
  } else {
      echo 'File not found.';
  }
  ?> 
  @endif
  
@endsection
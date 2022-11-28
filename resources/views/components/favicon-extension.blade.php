<?php

function localIcon($id) {
  $directory = base_path("studio/favicon/icons");
  $files = scandir($directory);
  $pathinfo = "error.error";
  foreach($files as $file) {
  if (strpos($file, $id.'.') !== false) {
  $pathinfo = $id. "." . pathinfo($file, PATHINFO_EXTENSION);
  }}
  return $pathinfo;
}
  
?>

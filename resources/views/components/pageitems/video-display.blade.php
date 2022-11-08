<div class='button-video'>
<?php
  $embed = OEmbed::get($link->link);
  if ($embed) {

    echo $embed->html();


  // Print default embed html code.
  //--echo $embed->html();

  // Print embed html code with custom width. Works for IFRAME and VIDEO html embed code.
  // echo $embed->html(['width' => 600]);

  // Checks if embed data contains details on thumbnail.
  //--$embed->hasThumbnail();

  // Returns an array containing thumbnail details: url, width and height.
  //--$embed->thumbnail();

  // Return thumbnail url if it exists or null.
  //--$embed->thumbnailUrl();

  // Returns an array containing all available embed data including default HTML code.
  //print_r( $embed->data());

  }

?>




</div>

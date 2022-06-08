<!-- Analytics -->
<?php
$analyticsHTML = Config::get('meta.analytics');
$analyticsHTML = preg_replace("~<!--(.*?)-->~s", "", $analyticsHTML);
echo $analyticsHTML;
?>
<!-- /Analytics -->
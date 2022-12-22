
<?php
use Illuminate\Support\Facades\Http;

$wtrue = "<td style=\"text-align: center; cursor: help;\" title=\"Everything is working as expected!\"><i class='bi bi-check-lg'></i></td>";
$wfalse = "<td style=\"text-align: center; cursor: help;\" title=\"This file cannot be written to. This may impede proper operation.\"><i class='bi bi-x'></i></td>";

$utrue = "<td style=\"text-align: center; cursor: help;\" title=\"Your security is at risk. This file can be accessed by everyone. Immediate action is required!\"><i class='bi bi-exclamation-lg'></i></td>";
$ufalse = "<td style=\"text-align: center; cursor: help;\" title=\"Everything is working as expected!\"><i class='bi bi-check-lg'></i></td>";
$unull = "<td style=\"text-align: center; cursor: help;\" title=\"Something went wrong. This might be normal if you're running behind a proxy or docker container.\">➖</td>";


$server = $_SERVER['SERVER_NAME'];
$uri = $_SERVER['REQUEST_URI'];

// Tests if a URL has a valid SSL certificate
function has_ssl( $domain ) {
  $ssl_check = @fsockopen( 'ssl://' . $domain, 443, $errno, $errstr, 30 );
  $res = !! $ssl_check;
  if ( $ssl_check ) { fclose( $ssl_check ); }
  return $res;
}

// Changes probed URL to HTTP if no valid SSL certificate is present, otherwise an error would be thrown
if (has_ssl($server)) {
  $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
} else {
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}

function getUrlSatusCode($url, $timeout = 3)
 {
 $ch = curl_init();
 $opts = array(CURLOPT_RETURNTRANSFER => true, // do not output to browser
 CURLOPT_URL => $url, 
 CURLOPT_NOBODY => true, // do a HEAD request only
 CURLOPT_TIMEOUT => $timeout); 
 curl_setopt_array($ch, $opts);
 curl_exec($ch);
 $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 curl_close($ch);
 return $status;
 }

//Files or directories to test if writable
$wrt1 = is_writable('.env');
$wrt2 = is_writable('database/database.sqlite');

//Files or directories to test if accessible externally
$url1 = getUrlSatusCode($actual_link . '/../../.env');
$url2 = getUrlSatusCode($actual_link . '/../../database/database.sqlite');

?>

        @if($url1 == '200' or $url2 == '200')
        <a href="https://docs.littlelink-custom.com/d/installation-requirements/" target="_blank"><h4 style="color:tomato;">Your security is at risk. Some files can be accessed by everyone. Immediate action is required! <br> Click this message to learn more.</h4></a>
        @endif

        <h3 class="mb-4">Security</h3>
        <p>Here, you can easily verify if critical system files can be accessed externally. It is important that these files cannot be accessed, otherwise user data like passwords could get leaked. Entries marked with a '<i class='bi bi-check-lg'></i>' cannot be accessed externally, entries marked with a '<i class='bi bi-exclamation-lg'></i>' can be accessed by anyone and require immediate action to protect your data.</p>

        <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" style="width: 90%;">Link</th>
            <th title="You can hover over entries to learn more about their current status" style="cursor: help;" scope="col">Hover for more</th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <td title="">{{ url('/.env') }}</td>
            <?php if($url1 == '200'){echo "$utrue";} elseif($url1 == '0'){echo "$unull";} else{echo "$ufalse";} ?>
          </tr>
          <tr>
            <td title="">{{ url('/database/database.sqlite') }}</td>
            <?php if($url2 == '200'){echo "$utrue";} elseif($url2 == '0'){echo "$unull";} else{echo "$ufalse";} ?>
          </tr>
        </tbody>
        </table>

        <br><h3 class="mb-4">Write access</h3>
        <p>Here, you can easily verify if important system files can be written to. This is important for every function to work properly. Entries marked with a '<i class='bi bi-check-lg'></i>' work as expected, entries marked with a '<i class='bi bi-x'></i>' do not.</p>

        <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" style="width: 90%;">File</th>
            <th title="You can hover over entries to learn more about their current status" style="cursor: help;" scope="col">Hover for more</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td title="">{{ base_path(".env") }}</td>
          <?php if ($wrt1 > 0) {echo "$wtrue";} else {echo "$wfalse";} ?>
          </tr>
          <tr>
            <td title="">{{ base_path("database/database.sqlite") }}</td>
            <?php if ($wrt2 > 0) {echo "$wtrue";} else {echo "$wfalse";} ?>
          </tr>
        </tbody>
        </table>

        <br><h3 class="mb-4">Dependencies</h3>
        <p>Required PHP modules.</p>

<style>#dp{width:10%!important;text-align:center;}</style>
        <table class="table table-bordered">
        <style>.bi-x-lg{color:tomato}</style>
        <tr><td>BCMath PHP Extension</td><td id="dp">@if(extension_loaded('bcmath'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>Ctype PHP Extension</td><td id="dp">@if(extension_loaded('Ctype'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>cURL PHP Extension</td><td id="dp">@if(extension_loaded('cURL'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>DOM PHP Extension</td><td id="dp">@if(extension_loaded('DOM'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>Fileinfo PHP Extension</td><td id="dp">@if(extension_loaded('Fileinfo'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>JSON PHP Extension</td><td id="dp">@if(extension_loaded('JSON'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>Mbstring PHP Extension</td><td id="dp">@if(extension_loaded('Mbstring'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>OpenSSL PHP Extension</td><td id="dp">@if(extension_loaded('OpenSSL'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>PCRE PHP Extension</td><td id="dp">@if(extension_loaded('PCRE'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>PDO PHP Extension</td><td id="dp">@if(extension_loaded('PDO'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>Tokenizer PHP Extension</td><td id="dp">@if(extension_loaded('Tokenizer'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>XML PHP Extension</td><td id="dp">@if(extension_loaded('XML'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>SQLite PHP Extension</td><td id="dp">@if(extension_loaded('PDO_SQLite'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>MySQL PHP Extension</td><td id="dp">@if(extension_loaded('PDO_MySQL'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        </table>
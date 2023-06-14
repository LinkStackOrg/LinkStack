@extends('layouts.sidebar')

@section('content')

<?php
use Illuminate\Support\Facades\Http;

$wtrue = "<td style=\"text-align: center; cursor: help;\" title=\"{{__('messages.wtrue')}}\">✔️</td>";
$wfalse = "<td style=\"text-align: center; cursor: help;\" title=\"{{__('messages.wfalse')}}\">❌</td>";

$utrue = "<td style=\"text-align: center; cursor: help;\" title=\"{{__('messages.utrue')}}\">❗</td>";
$ufalse = "<td style=\"text-align: center; cursor: help;\" title=\"{{__('messages.ufalse')}}\">✔️</td>";
$unull = "<td style=\"text-align: center; cursor: help;\" title=\"{{__('messages.unull')}}\">➖</td>";


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

        <h2 class="mb-4"><i class="bi bi-braces-asterisk">{{__('messages.Debugging information')}}</i></h2>

        @if($url1 == '200' or $url2 == '200')
        <a href="https://docs.linkstack.org/d/installation-requirements/" target="_blank"><h4 style="color:tomato;">{{__('messages.security.risk')}}</h4></a>
        @endif

        <h3 class="mb-4">Write access</h3>
        <p>{{__('messages.Write access.description.1-3')}} '✔️' {{__('messages.Write access.description.2-3')}} '❌' {{__('messages.Write access.description.3-3')}}</p>

        <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" style="width: 90%;">{{__('messages.File')}}</th>
            <th title="You can hover over entries to learn more about their current status" style="cursor: help;" scope="col">{{__('messages.Hover for more')}}</th>
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

        <br><h3 class="mb-4">{{__('messages.Security')}}</h3>
        <p>{{__('messages.security.risk.1-3')}} '✔️' {{__('messages.security.risk.2-3')}} '❗' {{__('messages.security.risk.3-3')}}</p>

        <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" style="width: 90%;">{{__('messages.Link')}}</th>
            <th title="You can hover over entries to learn more about their current status" style="cursor: help;" scope="col">{{__('messages.Hover for more')}}</th>

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


@endsection
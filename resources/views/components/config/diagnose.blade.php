
<?php
use Illuminate\Support\Facades\Http;

$wtrue = "<td style=\"text-align: center; cursor: help;\" title=\"".__('messages.wtrue')."\"><i class='bi bi-check-lg'></i></td>";
$wfalse = "<td style=\"text-align: center; cursor: help;\" title=\"".__('messages.wfalse')."\"><i class='bi bi-x'></i></td>";

$utrue = "<td style=\"text-align: center; cursor: help;\" title=\"".__('messages.utrue')."\"><i class='bi bi-exclamation-lg'></i></td>";
$ufalse = "<td style=\"text-align: center; cursor: help;\" title=\"".__('messages.ufalse')."\"><i class='bi bi-check-lg'></i></td>";
$unull = "<td style=\"text-align: center; cursor: help;\" title=\"".__('messages.unull')."\">➖</td>";

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
$wrt1 = is_writable(base_path('.env'));
$wrt2 = is_writable(base_path('database/database.sqlite'));

//Files or directories to test if accessible externally
$url1 = getUrlSatusCode(url('.env'));
$url2 = getUrlSatusCode(url('database/database.sqlite'));

?>

        @if($url1 == '200' or $url2 == '200')
        <a href="https://docs.linkstack.org/installation-requirements/" target="_blank"><h4 style="color:tomato;">{{__('messages.security.risk')}}</h4></a>
        @endif

        <h3 class="mb-4">{{__('messages.Security')}}</h3>
        <p>{{__('messages.security.risk.1-3')}} '<i class='bi bi-check-lg'></i>' {{__('messages.security.risk.2-3')}} '<i class='bi bi-exclamation-lg'></i>' {{__('messages.security.risk.3-3')}}</p>

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

        <br><h3 class="mb-4">{{__('messages.Write access')}}</h3>
        <p>{{__('messages.Write access.description.1-3')}} '<i class='bi bi-check-lg'></i>' {{__('messages.Write access.description.2-3')}} '<i class='bi bi-x'></i>' {{__('messages.Write access.description.3-3')}}</p>

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

        <br><h3 class="mb-4">{{__('messages.Dependencies')}}</h3>
        <p>{{__('messages.Required PHP modules')}}</p>

<style>#dp{width:10%!important;text-align:center;}</style>
        <table class="table table-bordered">
        <style>.bi-x-lg{color:tomato}</style>
        <tr><td>BCMath {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('bcmath'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>Ctype {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('Ctype'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>cURL {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('cURL'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>DOM {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('DOM'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>Fileinfo {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('Fileinfo'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>JSON {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('JSON'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>Mbstring {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('Mbstring'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>OpenSSL {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('OpenSSL'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>PCRE {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('PCRE'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>PDO {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('PDO'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>Tokenizer {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('Tokenizer'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>XML {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('XML'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>SQLite {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('PDO_SQLite'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        <tr><td>MySQL {{__('messages.PHP Extension')}}</td><td id="dp">@if(extension_loaded('PDO_MySQL'))<i class='bi bi-check-lg'></i>@else<i class='bi bi-x'></i>@endif</td></tr>
        </table>
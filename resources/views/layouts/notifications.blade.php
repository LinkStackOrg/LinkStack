@php
use App\Models\UserData;
$GLOBALS['activenotify'] = true;
$compromised = false;
function notification($dismiss = '', $ntid, $heading, $body) {
    $dismissBtn = '';
    if ($dismiss) {
        $dismissBtn = '<a href="' . url()->current() . '?dismiss=' . $dismiss . '" class="btn btn-danger">Dismiss</a>';
    }
    echo <<<MODAL
    <div class="modal fade" id="$ntid" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="${ntid}-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="${ntid}-label">$heading</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="bd-example">
                        $body
                    </div>
                </div>
                <div class="modal-footer">
                    $dismissBtn
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
MODAL;
}

function notificationCard($ntid, $icon, $heading, $subheading) {
  echo "<a data-bs-target=\"#{$ntid}\" data-bs-toggle=\"modal\" style=\"cursor:pointer!important;\" class=\"iq-sub-card\">
          <div class=\"d-flex align-items-center\">
            <i class=\"{$icon} p-1 avatar-40 rounded-pill bg-soft-primary d-flex justify-content-center align-items-center\"></i>
            <div class=\"ms-3 w-100\">
              <h6 class=\"mb-0 \">{$heading}</h6>
              <div class=\"d-flex justify-content-between align-items-center\">
                <p class=\"mb-0\">{$subheading}</p>
              </div>
            </div>
          </div>
        </a>";
}

//security check, checks if config files got compromised
if(auth()->user()->role == 'admin'){

$serversb = $_SERVER['SERVER_NAME'];
$urisb = $_SERVER['REQUEST_URI'];

// Tests if a URL has a valid SSL certificate
function has_sslsb( $domain ) {
	$ssl_check = @fsockopen( 'ssl://' . $domain, 443, $errno, $errstr, 30 );
	$res = !! $ssl_check;
	if ( $ssl_check ) { fclose( $ssl_check ); }
	return $res;
  }
  
  // Changes probed URL to HTTP if no valid SSL certificate is present, otherwise an error would be thrown
  if (has_sslsb($serversb)) {
	$actual_linksb = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  } else {
	$actual_linksb = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  }

function getUrlSatusCodesb($urlsb, $timeoutsb = 3)
 {
 $chsb = curl_init();
 $optssb = array(CURLOPT_RETURNTRANSFER => true, // do not output to browser
 CURLOPT_URL => $urlsb, 
 CURLOPT_NOBODY => true, // do a HEAD request only
 CURLOPT_TIMEOUT => $timeoutsb); 
 curl_setopt_array($chsb, $optssb);
 curl_exec($chsb);
 $status = curl_getinfo($chsb, CURLINFO_HTTP_CODE);
 curl_close($chsb);
 return $status;
 }

// Files or directories to test if accessible externally
$url1sb = getUrlSatusCodesb($actual_linksb . '/../../.env');
$url2sb = getUrlSatusCodesb($actual_linksb . '/../../database/database.sqlite');

// sets compromised to true if config files got compromised
if($url1sb == '200'  or $url2sb == '200') {
	$compromised = true;
} else {
	$compromised = false;
}
}
 // end security check

$notifyID = Auth::user()->id;
@endphp


{{-- Notification Cards --}}
    @php
        $notifications = [
            [
                'id' => 'modal-1',
                'icon' => 'bi bi-exclamation-triangle-fill text-danger',
                'title' => 'Your security is at risk!',
                'message' => 'Immediate action is required!',
                'condition' => $compromised,
                'dismiss' => 'Dismiss this notification',
                'adminonly' => true,
            ],
            [
                'id' => 'modal-star',
                'icon' => 'bi bi-heart-fill',
                'title' => 'Enjoying Linkstack?',
                'message' => 'Help Us Out',
                'condition' => UserData::getData($notifyID, 'hide-star-notification') !== true,
                'dismiss' => 'Hide this notification',
                'adminonly' => true,
            ],
        ];

        $shownNotifications = array_filter($notifications, function($notification) {
            return $notification['condition'] && (!$notification['adminonly'] || (auth()->user()->role == 'admin'));
        });
    @endphp

    @if(count($shownNotifications) > 0)
        @foreach($shownNotifications as $notification)
        @push('notifications')
            {{ notificationCard($notification['id'], $notification['icon'], $notification['title'], $notification['message'], $notification['dismiss']) }}
        @endpush
        @endforeach
    @else
        @php $GLOBALS['activenotify'] = false; @endphp
        @push('notifications')
        <center class='p-2'><i>No notifications</i></center>
        @endpush
    @endif



{{-- Notification Modals --}}
@push('sidebar-scripts') @php
notification('', 'modal-1', 'Your security is at risk!', '<b>Your security is at risk.</b> Some files can be accessed by everyone. Immediate action is required!<br><br>Some important files, are publicly accessible, putting your security at risk. Please take immediate action to revoke public access to these files to prevent unauthorized access to your sensitive information.<br><a href="'.url('admin/config#5').'">Learn more</a>.');
notification('hide-star-notification', 'modal-star', 'Support Linkstack', 'If you\'re enjoying using Linkstack, we would greatly appreciate it if you could take a moment to <a target="_blank" href="https://github.com/linkstackorg/linkstack">give our project a star on GitHub</a>. Your support will help us reach a wider audience and improve the quality of our project.<br><br>If you\'re able to <a target="_blank" href="https://linkstack.org/donate">make a financial contribution</a>, even a small amount would help us cover the costs of maintaining and improving Linkstack.<br><br>Thank you for your support and for being a part of the LinkStack community!');
@endphp @endpush

@php 
if(isset($_GET['dismiss'])) {
    $dismiss = $_GET['dismiss'];
    $param = str_replace('dismiss=', '', $dismiss);
    UserData::saveData($notifyID, $param, true);
    exit(header("Location: " . url()->current()));
}
@endphp
@php
use App\Models\UserData;
$GLOBALS['activenotify'] = true;
$compromised = false;
function notification($dismiss = '', $ntid, $heading, $body) {
    $closeMSG = __('messages.Close');
    $dismissMSG = __('messages.Dismiss');
    $dismissBtn = '';
    if ($dismiss) {
        $dismissBtn = '<a href="' . url()->current() . '?dismiss=' . $dismiss . '" class="btn btn-danger">'.$dismissMSG.'</a>';
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">$closeMSG</button>
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
$url1sb = getUrlSatusCodesb(url('.env'));
$url2sb = getUrlSatusCodesb(url('database/database.sqlite'));

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
                'title' => __('messages.Your security is at risk!'),
                'message' => __('messages.Immediate action is required!'),
                'condition' => $compromised,
                'dismiss' => '',
                'adminonly' => true,
            ],
            [
                'id' => 'modal-star',
                'icon' => 'bi bi-heart-fill',
                'title' => __('messages.Enjoying Linkstack?'),
                'message' => __('messages.Help Us Out'),
                'condition' => UserData::getData($notifyID, 'hide-star-notification') !== true,
                'dismiss' => __('messages.Hide this notification'),
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
        <center class='p-2'><i>{{__('messages.No notifications')}}</i></center>
        @endpush
    @endif



{{-- Notification Modals --}}
@push('sidebar-scripts') @php
notification('', 'modal-1', __('messages.Your security is at risk!'), '<b>'.__('messages.security.msg1').'</b> '.__('messages.security.msg2').'<br><br>'.__('messages.security.msg3').'<br><a href="'.url('admin/config#5').'">'.__('messages.security.msg3').'</a>.');
notification('hide-star-notification', 'modal-star', __('messages.Support Linkstack'), ''.__('messages.support.msg1').' <a target="_blank" href="https://github.com/linkstackorg/linkstack">'.__('messages.support.msg2').'</a>. '.__('messages.support.msg3').'<br><br>'.__('messages.support.msg4').' <a target="_blank" href="https://linkstack.org/donate">'.__('messages.support.msg5').'<br><br>'.__('messages.support.msg6').'');
@endphp @endpush

@php 
if(isset($_GET['dismiss'])) {
    $dismiss = $_GET['dismiss'];
    $param = str_replace('dismiss=', '', $dismiss);
    UserData::saveData($notifyID, $param, true);
    exit(header("Location: " . url()->current()));
}
@endphp
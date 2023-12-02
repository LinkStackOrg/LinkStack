@if($userinfo->role == 'user' and env('ENABLE_REPORT_ICON') == true)
<style>
    .report-pill-container {
      position: fixed;
      bottom: 60px;
      left: 30px;
      z-index: 5;
    }

    .report-icon {
      font-size: 36px;
      z-index: 5;
      position: absolute;
      top: 7px;
      left: 7px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .report-expanding-pill {
      background-color: #58595b;
      position: absolute;
      width: 0px;
      height: 30px;
      border-radius: 50px;
      overflow: hidden;
      padding-right: 30px;
      /* box-shadow: 0px 0px 15px #777;   */
      display: flex;
      justify-content: flex-end;
      align-items: center;
      transition: all 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    .report-text {
      opacity: 0;
      font-size: 14px !important;
      transition: opacity 0.3s ease-out !important;
      color: white !important;
      text-decoration: none;
      font-family: "Open Sans", sans-serif, sans !important;
      text-transform: none !important;
    }

    .report-text:hover {
      text-decoration: underline;
      color: white;
    }


    .report-show {
      transition: all 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
      width: 130px;
    }

    .report-show-text {
      transition: opacity 3s ease-out;
      opacity: 1;
    }

    .report-hide {
      opacity: 0;
      transition: opacity 0.3s ease-out;
    }
  </style>
  <div class="report-pill-container">
    <div class="report-icon-container">
      <div class="report-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-info-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
</svg></div>
    </div>
    <div class="report-expanding-pill">
      <a href="{{url('report?'.$userinfo->id)}}" target="_blank" class="report-text">Report abuse</a>
    </div>
  </div>

  <script>
    let icon = document.querySelector('.report-icon-container')
    let expandingPill = document.querySelector('.report-expanding-pill')
    let text = document.querySelector('.report-text')

    icon.addEventListener('click', function() {
      expandingPill.classList.toggle('report-show');
      text.classList.toggle('report-show-text');
      notification.classList.add('report-hide')
    });
  </script>
@endif
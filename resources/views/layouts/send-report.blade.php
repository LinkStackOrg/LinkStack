<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        h2 {
            color: #333;
        }

        .report-details {
            margin-bottom: 20px;
        }

        .user-details {
            margin-top: 20px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff!important;
            text-decoration: none;
            border-radius: 5px;
        }

        .button.view {
            background-color: #2ecc71;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ __('messages.report_mail_admin_report') }}</h2>

        <div class="report-details">
            <h3>{{ __('messages.report_mail_reported_profile') }}</h3>
            <strong>{{ __('messages.report_mail_reported_url') }}:</strong> <span>{{ $formData['url'] }}</span><br>
            <strong>{{ __('messages.report_mail_type') }}:</strong> <span>{{ $formData['report-type'] }}</span><br>
            <strong>{{ __('messages.report_mail_message') }}:</strong> <span>{{ $formData['message'] }}</span>
        </div>
        
        @if(auth()->check())
            <div class="user-details">
                <h3>{{ __('messages.report_mail_report_submitted_by') }}</h3>
                <strong>{{ __('messages.report_mail_reported_by') }}:</strong> <span>{{ auth()->user()->email }}</span><br>
                <strong>{{ __('messages.report_mail_profile') }}:</strong> <span>{{ url('u') . "/" . auth()->user()->id }}</span>
            </div>
        @endif        

        <div class="button-container">
            <a href="{{url('admin/users')."?table[search]=".$formData['name']}}" class="button view">{{ __('messages.report_mail_button_profile') }}</a>
            <a href="{{url('admin/delete-user')."/".$formData['id']}}" class="button" style="margin-left: 10px;">{{ __('messages.report_mail_button_delete') }}</a>
        </div>
    </div>
</body>
</html>

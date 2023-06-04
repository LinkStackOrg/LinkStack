<x-guest-layout>
        <div class="mb-4 text-sm text-gray-600">
            <h2>{{__('messages.A new user has registered on')}} {{ str_replace(['http://', 'https://'], '', url('')) }} {{__('messages.and is awaiting verification')}}</h2>
            <p>{{__('messages.The user')}} <i>{{$user}}</i> {{__('messages.with the email')}} <i>{{$email}}</i> {{__('messages.has registered a new account on')}} {{ url('') }} {{__('messages.and is awaiting confirmation by an admin')}} {{__('messages.Click')}} <a href="{{ url('admin/users/all') }}">{{__('messages.here')}}</a> {{__('messages.to verify the user')}}</p>
        </div>
        <a href="{{ url('admin/users/all') }}"><button>{{__('messages.Manage users')}}</button></a>
        <br><br>
</x-guest-layout>

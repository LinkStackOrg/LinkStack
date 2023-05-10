<x-guest-layout>
        <div class="mb-4 text-sm text-gray-600">
            <h2>A new user has registered on {{ str_replace(['http://', 'https://'], '', url('')) }} and is awaiting verification</h2>
            <p>The user <i>{{$user}}</i> with the email <i>{{$email}}</i> has registered a new account on {{ url('') }} and is awaiting confirmation by an admin. Click <a href="{{ url('admin/users/all') }}">here</a> to verify the user.</p>
        </div>
        <a href="{{ url('admin/users/all') }}"><button>Manage users</button></a>
        <br><br>
</x-guest-layout>

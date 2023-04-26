<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="{{app()->getLocale()}}" xml:lang="{{config('app.locale')}}" itemscope itemtype="http://schema.org/WebSite">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('env-editor::env-editor.menuTitle')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="stylesheet"
          href="{{ asset('assets/external-dependencies/fontawesome.css') }}"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
          crossorigin="anonymous"/>

    @stack('styles')
</head>
<body>

<span class="javascripts">
    <script src="{{ asset('assets/external-dependencies/jquery.slim.min.js') }}"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="{{ asset('assets/external-dependencies/vue.js') }}"></script>
    <script src="{{ asset('assets/external-dependencies/bootstrap.bundle.min.js') }}"
            integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
            crossorigin="anonymous"></script>


    @stack('scripts')

</span>
</body>
</html>

<!-- Custom icons font-awesome -->
<style>{!! str_replace('../', 'studio/', file_get_contents(base_path("assets/external-dependencies/fontawesome.css"))) !!}</style>

@include('layouts.fonts')

<style>{!! file_get_contents(base_path("assets/linkstack/css/normalize.css")) !!}</style>
<style>{!! file_get_contents(base_path("assets/linkstack/css/animate.css")) !!}</style>

<script>{!! file_get_contents(base_path("assets/js/dynamic-contrast.min.js")) !!}</script>
<script>{!! file_get_contents(base_path("assets/js/jquery.min.js")) !!}</script>
<!DOCTYPE html>
@include('layouts.lang')
<head>
   @include('linkstack.modules.meta')
   
   @stack('linkstack-head')
   @include('linkstack.modules.assets')
   @foreach($information as $info)
   @stack('linkstack-head-end')
</head>
<body>
   @stack('linkstack-body-start')
   @include('linkstack.modules.admin-bar')
   @include('linkstack.modules.share-button')
   @include('linkstack.modules.report-icon')
   <div class="container">
      <div class="row">
         <div class="column" style="margin-top: 5%">
            @include('linkstack.elements.avatar')
            @include('linkstack.elements.heading')
            @include('linkstack.elements.bio')
            @include('linkstack.elements.icons')
            @endforeach
            @yield('content')
            @include('linkstack.modules.footer')
         </div>
      </div>
   </div>
   @stack('linkstack-body-end')
</body>
</html>
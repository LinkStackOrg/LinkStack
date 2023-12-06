@push('linkstack-body-end')
<script>
    BackgroundCheck.init({
    targets: '.dynamic-contrast',
    images: 'body'
  });
  </script>
@endpush

@push('linkstack-head-end')
<style>
.background--light {
  color: black !important;
}

.background--dark {
  color: white !important;
}

.background--complex {
  color: gray !important;
}
</style>
@endpush
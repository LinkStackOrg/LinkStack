@if($customBackgroundExists == true)
  @if(($info->theme == '' || $info->theme == 'default') || theme('enable_dynamic_contrast') == 'true')
    @push('linkstack-body-end')
      <script>
          BackgroundCheck.init({
          targets: '.dynamic-contrast',
          images: 'body'
        });
        BackgroundCheck.refresh();
        BackgroundCheck.init({
          targets: '.dynamic-contrast-footer',
          images: 'body'
        });
        BackgroundCheck.refresh();
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

      .dynamic-contrast-footer.background--light {
        color: #0085FF !important;
      }
      .dynamic-contrast-footer.background--dark {
        color: white !important;
      }
      .dynamic-contrast-footer.background--complex {
        color: gray !important;
      }
      </style>
    @endpush
  @endif
@endif
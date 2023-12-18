<script>{!! file_get_contents(base_path("assets/js/jquery.min.js")) !!}</script>
<script>
    $(document).ready(function () {
      var submitBtn = $('#submit-btn');
      
      $('#littlelink_name').on('keyup', function () {
        var littlelinkName = $(this).val();
  
        if (littlelinkName.trim() !== '') {
          $.ajax({
            type: 'POST',
            url: '{{url("/validate-handle")}}',
            data: {
              '_token': '{{ csrf_token() }}',
              'littlelink_name': littlelinkName
            },
            success: function (data) {
              $('#littlelink_name').removeClass('is-valid is-invalid');
              $('#username-error').remove();
  
              if (typeof exceptionvar !== 'undefined' && littlelinkName.trim() === exceptionvar) {
                submitBtn.prop('disabled', false);
              } else {
                if (data.valid) {
                  $('#littlelink_name').addClass('is-valid');
                  submitBtn.prop('disabled', false);
                } else {
                  $('#littlelink_name').addClass('is-invalid');
                  $('<div id="username-error" class="invalid-feedback">That username is already taken</div>').insertAfter('#littlelink_name');
                  submitBtn.prop('disabled', true);
                }
              }
            }
          });
        } else {
          $('#littlelink_name').removeClass('is-valid is-invalid');
          $('#username-error').remove();
          submitBtn.prop('disabled', true);
        }
      });
    });
  </script>
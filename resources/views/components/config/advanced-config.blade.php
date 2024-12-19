<p>{{ __('messages.AC.description') }}</p>
<form action="{{ route('editAC') }}" method="post" id="editForm">
    @csrf
    <div class="form-group">
        <label>{{ __('messages.Advanced Configuration file.') }}</label>
        <textarea style="width:100%;display:none;" class="form-control" name="AdvancedConfig" rows="280">{{ file_get_contents('config/advanced-config.php') }}</textarea>
        <div id="editor" style="width:100%; height:<?php echo count(file('config/advanced-config.php')) * 24 + 15; ?>px; background-color:transparent !important;"
            class="form-control border-1 border-light" name="AdvancedConfig" rows="280">
            {{ file_get_contents('config/advanced-config.php') }}</div>
    </div>
    <button type="submit" class="btn btn-primary" id="saveBtn">{{ __('messages.Save') }}</button>
    <a class="btn btn-danger confirmation" href="#"
        id="restoreDefaultsBtn">{{ __('messages.Restore defaults') }}</a>
</form>

@push('sidebar-stylesheets')
    <script src="{{ asset('assets/external-dependencies/ace.js') }}" type="text/javascript" charset="utf-8"></script>
@endpush
@push('sidebar-scripts')
    <script>
        function performOperation() {
            var editor = ace.edit("editor");

            editor.getSession().on('change', function(e) {
                $('textarea[name=AdvancedConfig]').val(editor.getSession().getValue());
            });

            $('#restoreDefaultsBtn').on('click', function(e) {
                e.preventDefault();

                var isAdvancedConfig = $(this).hasClass('confirmation');
                var confirmationMessage = "Are you sure?";

                if (isAdvancedConfig) {
                    $('#editForm').append(
                        '<input type="hidden" name="ResetAdvancedConfig" value="RESET_DEFAULTS">');
                }

                if (confirm(confirmationMessage)) {
                    $('#editForm').submit();
                }
            });
        };

        document.addEventListener('DOMContentLoaded', () => {
            if (typeof Livewire === 'undefined') {
                performOperation();
            }
        });

        document.addEventListener('livewire:navigated', () => {
            performOperation();
        });
    </script>
@endpush

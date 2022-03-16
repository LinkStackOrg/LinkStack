@php($translatePrefix='env-editor::env-editor.views.currentEnv.')
<template id="env-editor-config-actions">
    <div>
        <button class="btn-outline-dark btn btn-sm" title="{{__($translatePrefix.'btn.deleteConfigCacheDesc')}}"
                @click="deleteConfigCache">{{__($translatePrefix.'btn.deleteConfigCache')}}</button>

    </div>
</template>

@push('scripts')

    <script>

        let configActions = {
            template: '#env-editor-config-actions',
            methods: {
                deleteConfigCache() {
                    this.submit('delete', '{{route(config($package.'.route.name').'.clearConfigCache')}}');
                },
                submit(method, url) {
                    envClient(url,{
                        method: method
                    }).then(data => {
                        if (data.message) {
                            envAlert('info', data.message);
                        }
                    })
                },
            }
        };

    </script>
@endpush

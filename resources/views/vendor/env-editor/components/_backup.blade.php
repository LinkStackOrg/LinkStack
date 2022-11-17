@php($translatePrefix='env-editor::env-editor.views.backup.')
<template id="env-editor-backups">
    <div>
        <div class="h5 my-4">{{__($translatePrefix.'title')}}</div>
        <div>
            <button class="btn-info btn " @click="createBackUp">{{__($translatePrefix.'btn.backUpCurrentEnv')}}</button>
            <a class="btn-info btn" href="{{route(config($package.'.route.name').'.download')}}">{{__($translatePrefix.'btn.downloadCurrentEnv')}}</a>
        </div>
        <div class=" my-3">

            <div v-if="items.length" class="table-responsive">
                <table id="env-editor-table-accordion" class="table">
                    <thead>
                    <tr class="table-secondary">
                        <th scope="col">{{__($translatePrefix.'tableTitles.filename')}}</th>
                        <th scope="col">{{__($translatePrefix.'tableTitles.created_at')}}</th>
                        <th scope="col">{{__($translatePrefix.'tableTitles.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="(item, index) in items">
                        <tr :key="item.real_name" :bind="item">
                            <th scope="row" class="font-weight-bold ">@{{ item.name }}</th>
                            <td>@{{ item.created_at_formatted }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-info" data-toggle="collapse" aria-expanded="false"
                                            :data-target="'#collapse_'+item.real_name"
                                            :aria-controls="'#collaps_'+item.real_name" title="{{__($translatePrefix.'btn.viewContent')}}"><span class="fas fa-eye"></span></button>
                                    <a class="btn btn-info" :href="getDownLoadLink(item)" title="{{__($translatePrefix.'btn.download')}}"><span
                                            class="fas fa-download"></span></a>
                                    <button class="btn btn-secondary" @click="restore(item)" title="{{__($translatePrefix.'btn.restore')}}"><span class="fas fa-redo"></span>
                                    </button>
                                    <button class="btn btn-danger" @click="destroy(item)" title="{{__($translatePrefix.'btn.delete')}}"><span class="fas fa-trash"></span></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="100%" class="p-0">
                                <div class="collapse" :id="'collapse_'+item.real_name" data-parent="#env-editor-table-accordion">
                                    <div class="table-responsive table-sm px-3 pb-3">
                                        <table class="w-100 bg-light">
                                            <tr v-for="(dt, index) in item.parsed_data">
                                                <td class="pl-3"><code>@{{ dt.key||'&nbsp;' }}</code></td>
                                                <td><code>@{{ dt.value }}</code></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    </template>

                    </tbody>
                </table>
            </div>
            <div class="text-primary font-italic" v-else>{!! __($translatePrefix.'noBackUpItems') !!}</div>
        </div>
    </div>
</template>


@push('scripts')

    <script>
        const backUps = {
            template: '#env-editor-backups',
            data: () => {
                return {
                    modalItem: '',
                    items: []
                }
            },
            computed: {},
            mounted() {
                this.getItemsWithAjax();
                envEventBus.$on('env:backupsChanged', () => {
                    this.getItemsWithAjax();
                });
            },
            methods: {

                getDownLoadLink(item) {
                    let downloadUrl = '{{route(config($package.'.route.name').'.download')}}/';
                    return downloadUrl + item.real_name;
                },
                createBackUp() {
                    let url = '{{route(config($package.'.route.name').'.createBackup')}}';
                    this.sendBasicAjaxRequest('post', url, 'backupsChanged');
                },
                restore(item) {
                    let url = '{{route(config($package.'.route.name').'.restoreBackup')}}/';
                    this.sendBasicAjaxRequest('post', url + item.real_name, 'changed');
                },
                destroy(item) {
                    let url = '{{route(config($package.'.route.name').'.destroyBackup')}}/';
                    this.sendBasicAjaxRequest('delete', url + item.real_name, 'backupsChanged');

                },
                sendBasicAjaxRequest($method, $url, $eventToTrigger) {
                    envClient($url, { method: $method }).then((data) => {
                        if (data.message) {
                            envAlert('info', data.message);
                        }
                        envEventBus.$emit('env:' + $eventToTrigger);
                    })
                },
                getItemsWithAjax() {
                    envClient('{{route(config($package.'.route.name').'.getBackups')}}')
                        .then(data => this.items = Object.values(data.items))
                }
            },
        };


    </script>
@endpush

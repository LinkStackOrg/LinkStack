@php($translatePrefix='env-editor::env-editor.views.currentEnv.')
<template id="env-editor-modal">
    <div id="env-editor-keys-modal" class=" modal fade  " tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" :class="'text-'+actionClass">@{{ title }}</h5>
                    <button type="button" class="close" @click="hideModal()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" name="group" v-model.trim="modalItem.group">
                        <div class="form-group">
                            <label for="env_key" class="col-form-label">{{__($translatePrefix.'modal.input.key')}}:</label>
                            <input type="text" class="form-control" id="env_key" :readonly="readonly.key" v-model.trim="modalItem.key"/>
                        </div>
                        <div class="form-group">
                            <label for="env_value" class="col-form-label">{{__($translatePrefix.'modal.input.value')}}:</label>
                            <input type="text" class="form-control" id="env_value" :readonly="readonly.value" v-model.trim="modalItem.value"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="hideModal()">{{__($translatePrefix.'modal.btn.close')}}</button>
                    <button id="save_evnVariable" type="button" class="btn " :class="'btn-'+actionClass" @click="submit()"> @{{ submitBtn }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

@push('scripts')

    <script>

        let itemsModal = {
            template: '#env-editor-modal',
            data: () => {
                return {
                    modal: '#env-editor-keys-modal',
                    type: '',
                    modalItem: {},
                    readonly: {
                        key: false,
                        value: false,
                    }
                }
            },
            mounted() {
                this.modalItem = this.newModalItem();

                envEventBus.$on('env:item:edit', (item) => {
                    this.makeReadOnly('key');
                    this.show('edit', item);
                }).$on('env:item:delete', (item) => {
                    this.makeReadOnly('key');
                    this.makeReadOnly('value');
                    this.show('delete', item);
                }).$on('env:item:new', (item) => {
                    this.show('new', item);
                });
            },
            computed: {
                submitBtn() {
                    let values = {
                        'new': '{{__($translatePrefix."modal.btn.new")}}',
                        'edit': '{{__($translatePrefix."modal.btn.edit")}}',
                        'delete': '{{__($translatePrefix."modal.btn.delete")}}',
                    };

                    return values[this.type.toLowerCase()];
                },
                title() {
                    let values = {
                        'new': '{{__($translatePrefix."modal.title.new")}}',
                        'edit': '{{__($translatePrefix."modal.title.edit")}}',
                        'delete': '{{__($translatePrefix."modal.title.delete")}}',
                    };

                    return values[this.type.toLowerCase()] + ': ' + this.modalItem.key;
                },
                actionClass() {
                    switch (this.type) {
                        case 'delete':
                            return 'danger';
                        case 'edit':
                            return 'info';
                        default:
                            return 'success';
                    }
                }
            },
            methods: {
                newModalItem: () => {
                    return {
                        key: '',
                        value:'',
                        group: null,
                    }
                },
                hideModal() {
                    this.modalItem = this.newModalItem();
                    this.readonly.key = false;
                    this.readonly.value = false;
                    $(this.modal).modal('hide');
                },
                getAjaxMethod() {
                    switch (this.type) {
                        case 'delete':
                            return 'delete';
                        case 'edit':
                            return 'patch';
                        default:
                            return 'post'
                    }
                },
                makeReadOnly(arg = null) {
                    let $vm = this;
                    if (arg) {
                        $vm.readonly[arg] = true;
                        return;
                    }
                    Object.keys($vm.readonly).forEach(function (el) {
                        $vm.readonly[el] = true;
                    });
                },
                show(type = '', item) {
                    (item) ? this.modalItem = item : '';
                    this.type = type;
                    $(this.modal).modal('show')
                },
                submit() {
                    envClient('{{route(config($package.'.route.name').'.key')}}',{
                        method: this.getAjaxMethod(),
                        data: this.modalItem
                    }).then(data => {
                        if (data.message) {
                            envAlert('info', data.message);
                        }
                        envEventBus.$emit('env:changed')

                    }).then(() => {
                        this.hideModal();
                    });
                },
            }
        };

    </script>
@endpush

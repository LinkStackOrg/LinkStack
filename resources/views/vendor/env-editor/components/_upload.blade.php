@php($translatePrefix='env-editor::env-editor.views.upload.')
<template id="env-editor-uploadFile">
    <div>
        <div class="h5 my-4">{{__($translatePrefix.'title')}}</div>
        <div id="uploadEnvForm">
            <div class="input-group  mb-4">
                <div class="custom-file ">
                    <input type="file" class="custom-file-input" :class="formInputNotValidClass" @change="fileInputChanged" lang="en">
                    <label class="custom-file-label" for="customFileLang">@{{ promptMsg }}</label>
                </div>
                <div class="invalid-feedback d-block" v-if="formIsInvalid">
                    @{{ errors }}
                </div>
                <div class="input-group-append" v-if="hasFile">
                    <button class="btn btn-outline-secondary" @click="clearFileInput" type="button">{{__($translatePrefix.'btn.clearFile')}}</button>
                </div>
            </div>
            <div class="my-4">
                <button class="btn-info btn " :disabled="!hasFile" @click="uploadAsBackUp">{{__($translatePrefix.'btn.uploadAsBackup')}}</button>
                <button class="btn-warning btn " :disabled="!hasFile" @click="uploadAndReplaceCurrent">{{__($translatePrefix.'btn.uploadAndReplace')}}</button>
            </div>
        </div>
    </div>
</template>

@push('scripts')

    <script>
        const fileUpload = {
            template: '#env-editor-uploadFile',
            data: () => {
                return {
                    file: null,
                    fileName: null,
                    formIsInvalid: false,
                    errors: ''
                }
            },
            computed: {
                promptMsg() {
                    return this.hasFile ? this.fileName : "{{__($translatePrefix.'selectFilePrompt')}}"
                },
                hasFile() {
                    return (this.file !== null)
                },
                formInputNotValidClass() {
                    return this.formIsInvalid ? 'is-invalid ' : ''
                },
            },
            methods: {
                clearFileInput: function () {
                    this.file = null;
                    this.fileName = null;
                },
                uploadAsBackUp: function (e) {
                    return this.submitForm(e);
                },
                uploadAndReplaceCurrent: function (e) {
                    return this.submitForm(e, true);
                },
                fileInputChanged({ type, target }) {
                    this.fileName = target.files[0].name;
                    this.file = target.files[0]
                },
                submitForm(event, replaceCurrentEnv = false) {
                    this.formIsInvalid = false;
                    const formData = new FormData();
                    formData.append('file', this.file);
                    formData.append('replace_current', replaceCurrentEnv.toString());

                    envClient('{{route(config($package.'.route.name').'.upload')}}', {
                        body: formData,
                        method: 'post',
                    }).then(data => {
                        if (data.message) {
                            envAlert('info', data.message);
                        }
                        (replaceCurrentEnv) ? envEventBus.$emit('env:changed') : envEventBus.$emit('env:backupsChanged');
                        this.fileName = null;
                        this.file = null;
                    }).catch((error) => {
                        this.errors = error.errors.file[0];
                        this.formIsInvalid = true;
                    });
                }

            },
        };


    </script>
@endpush

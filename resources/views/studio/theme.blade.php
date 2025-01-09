@extends('layouts.sidebar')

@section('content')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">

            <div class="col-lg-12">
                <div class="card   rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">

                                @foreach ($pages as $page)
                                    <section class='text-gray-400'>
                                        <h3 class="mb-4 card-header"><i
                                                class="bi bi-brush">{{ __('messages.Select a theme') }}</i></h3>
                                        <div>

                                            @if ($errors->any())
                                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                                                        <use xlink:href="#exclamation-triangle-fill"></use>
                                                    </svg>
                                                    <div>
                                                        @foreach ($errors->all() as $error)
                                                            {{ $error }}
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                {{ __('messages.Select theme') }}
                                            </button>

                                            <section class="text-gray-400"></section>
                                            <div>

                                                <div style="max-width:1000px" class="col-md-12">
                                                    <div class="card rounded shadow-lg bg-light aos-init aos-animate"
                                                        data-aos="fade-up" data-aos-delay="800">
                                                        <div
                                                            class="flex-wrap card-header d-flex justify-content-between align-items-center bg-light">
                                                            <div class="header-title">
                                                                <h4 class="card-title">{{ __('messages.Preview') }}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            @if (env('USE_THEME_PREVIEW_IFRAME') === false or $page->littlelink_name == '')
                                                                <center><img
                                                                        style="width:95%;max-width:700px;argin-left:1rem!important;"
                                                                        src="@if (file_exists(base_path() . '/themes/' . $page->theme . '/preview.png')) {{ url('/themes/' . $page->theme . '/preview.png') }}@elseif($page->theme === 'default' or empty($page->theme)){{ url('/assets/linkstack/images/themes/default.png') }}@else{{ url('/assets/linkstack/images/themes/no-preview.png') }} @endif"></img>
                                                                </center>
                                                            @else
                                                                <iframe frameborder="0" allowtransparency="true"
                                                                    id="frPreview" style="background: #FFFFFF;height:400px;"
                                                                    class='w-100'
                                                                    src="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>">{{ __('messages.No compatible browser') }}</iframe>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card   rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @if (env('ALLOW_CUSTOM_BACKGROUNDS') == true)
                                    <form action="{{ route('themeBackground') }}" enctype="multipart/form-data"
                                        method="post">
                                        @csrf
                                        <h3 class="mb-4 card-header">{{ __('messages.Custom background') }}</h3>
                                        <div style="display: none;" class="form-group col-lg-8">
                                            <select class="form-control" name="theme">
                                                <option>{{ $page->theme }}</option>
                                            </select>
                                            <br>
                                        </div>
                                        <div class="form-group col-lg-8">
                                            <figure style="max-width:1000px;max-height:562.5px;" class="figure">
                                                @if (!file_exists(base_path('assets/img/background-img/' . findBackground(Auth::user()->id))))
                                                    <p><i>{{ __('messages.No image selected') }}</i></p>
                                                @endif
                                                <img class="bd-placeholder-img figure-img img-fluid rounded"
                                                    src="@if (file_exists(base_path('assets/img/background-img/' . findBackground(Auth::user()->id)))) {{ url('assets//img/background-img/' . findBackground(Auth::user()->id)) }}@else{{ url('/assets/linkstack/images/themes/no-preview.png') }} @endif"><br>
                                                @if (file_exists(base_path('assets/img/background-img/' . findBackground(Auth::user()->id))))
                                                    <button class="mt-3 ml-3 btn btn-primary"
                                                        style="background-color:tomato!important;border-color:tomato!important;transform: scale(.9);"
                                                        title="Delete background image"><a
                                                            href="{{ url('/studio/rem-background') }}"
                                                            style="color:#FFFFFF;"><i
                                                                class="bi bi-trash-fill"></i>{{ __('messages.Remove background') }}</a></button><br>
                                                @endif
                                                {{-- <figcaption class="figure-caption">A caption for the above image.</figcaption> --}}
                                            </figure>
                                            <br>
                                            <br><br>
                                            <div class="mb-3">
                                                <input type="file"
                                                    accept="image/jpeg,image/jpg,image/png,image/webp,image/gif"
                                                    class="form-control form-control-lg" name="image"><br>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('messages.Apply') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (auth()->user()->role == 'admin')
                <div class="col-lg-12">
                    <div class="card   rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3 class="mb-4 card-header">{{ __('messages.Manage themes') }}</h3>
                                    @if (env('ENABLE_THEME_UPDATER') == 'true')
                                        <div id="ajax-container">

                                            <br><br><br>
                                            <div class="accordion">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="details-header">
                                                        <button class="accordion-button collapsed disabled" type="button"
                                                            aria-expanded="false" aria-controls="details-collapse">
                                                            <div style="max-height:20px;max-width:20px;"
                                                                class="spinner-border text-primary" role="status">
                                                                <span
                                                                    class="visually-hidden">{{ __('messages.Loading...') }}</span>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="details-collapse" class="accordion-collapse collapse"
                                                        aria-labelledby="details-header">
                                                        <div class="accordion-body"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div id="my-lazy-element"></div>
                                    @endif

                                    <br><br><br>
                                    <form action="{{ route('editTheme') }}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        {{-- <h3>{{__('messages.Upload themes')}}</h3> --}}
                                        <div style="display: none;" class="form-group col-lg-8">
                                            <select class="form-control" name="theme">
                                                <option>{{ $page->theme }}</option>
                                            </select>
                                            <br>
                                        </div>
                                        <div class="mb-3">
                                            <label>{{ __('messages.Upload themes') }}</label>
                                            <input type="file" accept=".zip" name="zip"
                                                class="form-control form-control-lg">
                                        </div><br><br>
                                        <div class="d-flex flex-column flex-md-row align-items-md-center">
                                            <button type="submit"
                                                class="btn btn-primary me-md-3 mb-3 mb-md-0">{{ __('messages.Upload themes') }}</button>
                                            <button class="btn btn-danger me-md-3 mb-3 mb-md-0 delete-themes"
                                                title="Delete themes"><a href="{{ url('/admin/theme') }}"
                                                    class="text-white">{{ __('messages.Delete themes') }}</a></button>
                                            <button class="btn btn-info download-themes" title="Download more themes"><a
                                                    href="https://linkstack.org/themes/" target="_blank"
                                                    class="text-white">{{ __('messages.Download themes') }}</a></button>
                                        </div>
                                    </form>
                                    </details>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @endif
        @endforeach

        </section>
        <script>
            function performOperation() {
                var placeholder = $('#ajax-container');
                var lazyElement = $('#my-lazy-element');

                $.ajax({
                    url: "{{url('theme-updater')}}",
                    success: function(response) {
                        placeholder.replaceWith(lazyElement);

                        lazyElement.html(response);
                    }
                });
            };

            document.addEventListener('DOMContentLoaded', () => {
                if (typeof Livewire === 'undefined') {
                    performOperation();
                }
            });

            document.addEventListener('livewire:navigated', () => {
                console.log('Livewire navigated');
                setTimeout(() => {
                    performOperation();
                }, 1000);
            }, { once: true });
        </script>
        <script type="text/javascript">
            var iframe = document.getElementById('frPreview');

            iframe.onload = function() {
                const iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
                const style = document.createElement('style');
                style.innerHTML = `
        * {
            pointer-events: none !important;
        }
    `;
                iframeDocument.head.appendChild(style);
            };
        </script>

        @push('sidebar-scripts')
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('messages.Select a theme') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="{{ route('editTheme') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <select id="theme-select" style="display:none;" name="theme"
                                    data-base-url="{{ url('') }}/@<?= Auth::user()->littlelink_name ?>">
                                    <option value="default" selected></option>
                                </select>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div
                                            class="card shadow-lg @if ($page->theme == '' or $page->theme == 'default') bg-primary @else bg-soft-primary @endif">
                                            <div class="card-body pb-0">
                                                <a style="cursor:pointer;" onclick="setTheme('default')">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <img draggable="false"
                                                                class="bd-placeholder-img bd-placeholder-img-lg img-fluid"
                                                                src="{{ url('assets/linkstack/images/themes/default.png') }}">
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <h2
                                                            class="m-3 @if ($page->theme == '' or $page->theme == 'default') text-white @else text-gray @endif"">
                                                            Default Theme</h2>
                                                        <div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        if ($handle = opendir('themes')) {
                                            while (false !== ($entry = readdir($handle))) {
                                                if ($entry != "." && $entry != "..") {
                                                    if(file_exists(base_path('themes') . '/' . $entry . '/readme.md')){
                                                        $text = file_get_contents(base_path('themes') . '/' . $entry . '/readme.md');
                                                        $pattern = '/Theme Name:.*/';
                                                        preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);
                                                        if(sizeof($matches) > 0) {
                                                            $themeName = substr($matches[0][0],12);
                                                        }
                                                    }
                                                    if(isset($themeName)){
                                                        ?>

                                    <div class="col-lg-3">
                                        <div
                                            class="card shadow-lg @if ($page->theme == $entry) bg-primary @else bg-soft-primary @endif">
                                            <div class="card-body pb-0">
                                                <a style="cursor:pointer;" onclick="setTheme('{{ $entry }}')">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <img draggable="false"
                                                                class="bd-placeholder-img bd-placeholder-img-lg img-fluid"
                                                                src="{{ url('themes/' . $entry . '/preview.png') }}">
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <h2
                                                            class="m-3 @if ($page->theme == $entry) text-white @else text-gray @endif">
                                                            {{ $themeName }}</h2>
                                                        <div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('messages.Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function setTheme(themeName) {
                    const selectElement = document.getElementById('theme-select');
                    selectElement.querySelector('option').value = themeName;
                    selectElement.form.submit();
                }
            </script>
        @endpush
    @endsection

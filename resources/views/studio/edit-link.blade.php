@extends('layouts.sidebar')

@section('content')

@push('sidebar-stylesheets')
<script src="{{ asset('assets/external-dependencies/fontawesome.js') }}" crossorigin="anonymous"></script>
@endpush

<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">   
        
     <div class="col-lg-12">
        <div class="card rounded">
            <div class="card-body">
               <div class="row">
                   <div class="col-sm-12">  
  
                    @push('sidebar-stylesheets')
                    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
                    @endpush
                    
                    <section class='text-gray-400'>
                    
                        <h3 class="card-header"><i class="bi bi-journal-plus"> @if($LinkID !== 0) {{__('messages.Edit')}} @else {{__('messages.Add')}} @endif {{__('messages.Block')}}</i></h3>
                    
                        <div class='card-body'>
                            <form action="{{ route('addLink') }}" method="post" id="my-form">
                                @method('POST')
                                @csrf
                                <input type='hidden' name='linkid' value="{{ $LinkID }}" />
                    
                                <div class="form-group col-lg-8 flex justify-around">
                                    <div class="btn-group shadow m-2">
                                        <button type="button" id='btnLinkType' class="btn btn-primary rounded-pill" title='{{__('messages.Click to change link blocks')}}' data-toggle="modal" data-target="#SelectLinkType">{{__('messages.Select Block')}}
                                            <span class="btn-inner">
                                                <i class="bi bi-window-plus"></i>
                                            </span>
                                        </button>{{infoIcon(__('messages.Click for a list of available link blocks'))}}
                                          
                                        <input type='hidden' name='typename' value='{{$typename}}'>
                    
                                    </div>
                                </div>
                    
                                <div id='link_params' class='col-lg-8'></div>
                    
                                <div class="d-flex align-items-center pt-4">
                                    <a class="btn btn-danger me-3" href="{{ url('studio/links') }}">{{__('messages.Cancel')}}</a>
                                    <button type="submit" class="btn btn-primary me-3">{{__('messages.Save')}}</button>
                                    <button type="button" class="btn btn-soft-primary me-3" onclick="submitFormWithParam('add_more')">{{__('messages.Save and Add More')}}</button>
                                    <script>
                                        function submitFormWithParam(paramValue) {
                                            // get the form element
                                            var form = document.getElementById("my-form");
                                            
                                            // create a hidden input field with the parameter value
                                            var paramField = document.createElement("input");
                                            paramField.setAttribute("type", "hidden");
                                            paramField.setAttribute("name", "param");
                                            paramField.setAttribute("value", paramValue);
                                            // append the hidden input field to the form
                                            form.appendChild(paramField);
                                            // submit the form
                                            form.submit();
                                        }
                                        </script>
                                </div>                                
                    
                            </form>
                        </div>
                    </section>
                    <br><br>

                    <!-- Modal -->
                    <style>.modal-title{color:#000!important;}</style>
                    <x-modal title="{{__('messages.Select Block')}}" id="SelectLinkType">
                    
                        <div class="d-flex flex-row  flex-wrap p-3">
                            @foreach ($LinkTypes as $lt)
                            @php 
                            if(block_text_translation_check($lt['title'])) {$title = bt($lt['title']);} else {$title = __('messages.block.title.'.$lt['typename']);}
                            $description = bt($lt['description']) ?? __('messages.block.description.'.$lt['typename']); 
                            @endphp
                            <a href="#" data-dismiss="modal" data-typeid="{{$lt['typename']}}" data-typename="{{$title}}" class="hvr-grow m-2 w-100 d-block doSelectLinkType">
                                <div class="rounded mb-3 shadow-lg">
                                    <div class="row g-0">
                                        <div class="col-auto bg-light d-flex align-items-center justify-content-center p-3">
                                            <i class="{{$lt['icon']}} text-primary h1 mb-0"></i>
                                        </div>
                                        <div class="col">
                                            <div class="card-body">
                                                <h5 class="card-title text-dark mb-0">{{$title}}</h5>
                                                <p class="card-text text-muted">{{$description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>      
                            </a>                     
                            @endforeach
                    
                        </div>
                    
                        <x-slot name="buttons">
                            <button type="button" class="btn btn-gray" data-dismiss="modal">{{__('messages.Close')}}</button>
                        </x-slot>
                    
                    </x-modal>
  
                   </div>
               </div>
            </div>
         </div>
        </div>
        
      </div>
    </div>

@endsection

@push("sidebar-scripts")
<script>
$(function() {
    LoadLinkTypeParams($("input[name='typename']").val() , $("input[name=linkid]").val());

    $('.doSelectLinkType').on('click', function() {
        $("input[name='typename']").val($(this).data('typeid'));
        $("#btnLinkType").html($(this).data('typename'));

        LoadLinkTypeParams($(this).data('typeid'), $("input[name=linkid]").val());

        $('#SelectLinkType').modal('hide');
    });


    function LoadLinkTypeParams($TypeId, $LinkId) {
        var baseURL = <?php echo "\"" . url('') . "\""; ?>;
        $("#link_params").html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>').load(baseURL + `/studio/linkparamform_part/${$TypeId}/${$LinkId}`);
        setTimeout(function() { document.dispatchEvent(new Event('contentLoaded')); }, 300);
    }
});
</script>
@endpush

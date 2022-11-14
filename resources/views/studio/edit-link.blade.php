@extends('layouts.sidebar')

@section('content')

<section class=' shadow text-gray-400'>

    <h3 class="card-header"><i class="bi bi-journal-plus"> @if($LinkID !== 0) Edit @else Add @endif Page Item</i></h3>

    <div class='card-body'>
        <form action="{{ route('addLink') }}" method="post">
            @method('POST')
            @csrf
            <input type='hidden' name='linkid' value="{{ $LinkID }}" />

            <div class="form-group col-lg-8 flex justify-around">
                <label class='font-weight-bold'>Blocks: </label>
                <div class="btn-group shadow m-2">
                    <button type="button" id='btnLinkType' class="border-0 p-1" title='Click to change link blocks' data-toggle="modal" data-target="#SelectLinkType">{{$title}}</button>



                    <button type="button" class="dropdown-toggle border-0 border-left-1 px-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        @foreach ( $LinkTypes as $lt )
                        <a data-typeid='{{$lt['id']}}' data-typename='{{$lt['title']}}' class="dropdown-item doSelectLinkType" href="#">
                            <i class="{{$lt['icon']}}"></i> {{$lt['title']}}
                        </a>

                        @endforeach


                    </div>
                    <input type='hidden' name='linktype_id' value='{{$linkTypeID}}'>

                </div>
            </div>

            {{-- @include("components.pageitems.".$SelectedLinkType['typename']."-form", ['some' => 'data']) --}}


            <div id='link_params' class='col-lg-8'></div>


            <div class="row">
                <a class="btn btn-secondary mt-3 ml-3 btn" href="{{ url()->previous() }}">Cancel</a>
                <button type="submit" class="mt-3 ml-3 btn btn-primary">Save</button>
            </div>


        </form>
    </div>
</section>
<br><br>
{{-- <details>
    <summary>More information</summary>
    <pre style="color: grey;">
The 'Custom' button allows you to add a custom link, where the text on the button is determined with the link title set above.
The 'Custom_website' button functions similar to the Custom button, with the addition of a function that requests the favicon from the chosen URL and uses it as the button icon.

The 'Space' button will be replaced with an empty space, so buttons could be visually separated into groups. Entering a number between 1-10 in the title section will change the empty space's distance.
The 'Heading' button will be replaced with a sub-heading, where the title defines the text on that heading.
</pre>
</details> --}}



<!-- Modal -->
<style>.modal-title{color:#000!important;}</style>
<x-modal title="Select Block" id="SelectLinkType">

    <div class="d-flex flex-row  flex-wrap p-3">

        @foreach ( $LinkTypes as $lt )
        <a href="#" data-typeid='{{$lt['id']}}' data-typename='{{$lt['title']}}'' class="hvr-grow m-2 w-100 d-block doSelectLinkType">


            <div class="card w-100">
                <div class="row no-gutters">
                    <div class="col-auto bg-light justify-content-center p-3">
                        <i class="card-img h1 text-primary {{$lt['icon']}} d-block"></i>
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <h5 style="color:#000!important;" class="card-title mb-0">{{$lt['title']}}</h5>
                            <p class="card-text text-muted">{{$lt['description']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach

    </div>

    <x-slot name="buttons">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </x-slot>

</x-modal>

@endsection

@push("sidebar-scripts")
<script>
$(function() {
    LoadLinkTypeParams($("input[name='linktype_id']").val() , $("input[name=linkid]").val());

    $('.doSelectLinkType').on('click', function() {
        $("input[name='linktype_id']").val($(this).data('typeid'));
        $("#btnLinkType").html($(this).data('typename'));

        LoadLinkTypeParams($(this).data('typeid'), $("input[name=linkid]").val());

        $('#SelectLinkType').modal('hide');
    });


    function LoadLinkTypeParams($TypeId, $LinkId) {
        var baseURL = <?php echo "\"" . url('') . "\""; ?>;
        $("#link_params").html(' <img width="70px" src="' + baseURL + '/img/loading.gif" />').load(baseURL + `/studio/linkparamform_part/${$TypeId}/${$LinkId}`);

    }
});
</script>
@endpush

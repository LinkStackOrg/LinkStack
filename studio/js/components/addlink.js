// for use in add-link blade
$(function() {
    LoadLinkTypeParams($("input[name='linktype_id']").val() , $("input[name=linkid]").val());

    $('.doSelectLinkType').on('click', function() {
        $("input[name='linktype_id']").val($(this).data('typeid'));
        $("#btnLinkType").html($(this).data('typename'));

        LoadLinkTypeParams($(this).data('typeid'), $("input[name=linkid]").val());

        $('#SelectLinkType').hide();
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });


    function LoadLinkTypeParams($TypeId, $LinkId) {
        $("#link_params").html(' <img width="70px" src="/img/loading.gif" />').load(`/studio/linkparamform_part/${$TypeId}/${$LinkId}`);

    }
});

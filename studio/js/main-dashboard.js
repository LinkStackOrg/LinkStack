(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
    	$('#sidebar').toggleClass('active');
  	});
	
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });
  	var sortableTbody = document.getElementById("links-table-body");
  	if (sortableTbody) {
		const sortableLinkTable = Sortable.create(sortableTbody, {
			handle: ".sortable-handle",
			onChange: function(event) {
			},
			store: {
				get: function (sortable) {
					var order = linksTableOrders || "";
					return order ? order.split('|') : [];
				},
				set: function (sortable) {
					const linkOrders = sortable.toArray();
					const currentPage = sortableTbody.dataset.page || 1;
					const perPage     = sortableTbody.dataset.perPage || 0;
					const formData = {
						'linkOrders': linkOrders,
						'currentPage': currentPage,
						'perPage': perPage,
					};
					$.blockUI({ 
						message: '<img width="70px" src="img/loading.gif" />',
						css: {
							backgroundColor: 'transparent',
							border: 'none',
							color: '#444444',
						}
					});
					$.post("studio/sort-link", formData, function(response) {
						if (response.linkOrders) {
							$.each(response.linkOrders, function(linkId, linkOrder){
								$("#links-table-body tr[data-id='"+linkId+"']")
									.find("td:eq(3)")
									.html(linkOrder);
							});
							$.unblockUI();
						} else {
							alert("Something went wrong! Please, Try again.")
						}
					});
				}
			}
		});
  	}
})(jQuery);

jQuery(document).ready(function($){

	var sortList  = $('#custom-type-list'),
		animation = $('#loading-animation'),
		pageTitle = $('div h2');

		sortList.sortable({

			update: function ( event, ui){
				animation.show();

				$.ajax({
					url : ajaxurl,
					type: 'POST',
					dataType : 'json',
					data: {
						action : 'save_post',
						order: sortList.sortable('toArray').toString(),
						security: WP_JOB_LISTING.security
					},
					success: function(response){
						$('#message').remove();
						animation.hide();
						if (true === response.success) {
							pageTitle.after('<div id="message" class="updated"><p>'+ WP_JOB_LISTING.success +'</p></div>');
						}else{
							pageTitle.after('<div id="message" class="error"><p>'+ WP_JOB_LISTING.failure +'</p></div>');
						}
					},
					error:function(error){
						$('#message').remove();
						animation.hide();
						pageTitle.after('<div id="message" class="error"><p>'+ WP_JOB_LISTING.failure +'</p></div>');
					}
				});
			}

		});
});
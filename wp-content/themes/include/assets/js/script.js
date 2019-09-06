jQuery(document).ready( function($) {
	
	jQuery('.reflect-now-modal').click(function() {
		jQuery("#modal-title").html(jQuery(this).data('header'));
		jQuery("#modal-body").html(jQuery('#'+jQuery(this).data('id')).html());
	});
	
	$(".accordion-desc").slideUp();
	
	$(".accordion-title").click(function(){
		$(this).next(".accordion-desc").slideToggle();
	})
	$('#module-current').ready(function() {

			$('#module-current a').each(function(i, data){
				if( $(data).attr("href") == window.location.href ) {
					$(data).parent().addClass('current-menu');
					$(data).parent().addClass('active').parent().addClass('active').parent().addClass('active');
				}
			});
	});

	jQuery.noConflict();
	jQuery('[data-toggle="popover"]').popover();

}); 

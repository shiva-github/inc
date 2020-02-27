jQuery(document).ready( function($) {
	
	jQuery('.reflect-now-modal').click(function() {
		var val_show_cbr =  $(this).data('show_cbr');
		if(val_show_cbr == 1) {
			jQuery("#modal-cbr").css('display', 'block');
		} else {
			jQuery("#modal-cbr").css('display', 'none');
		}

		jQuery("#modal-title").html(jQuery(this).data('header'));
		jQuery("#modal-body").html(jQuery('#'+jQuery(this).data('id')).html());
	});
	
	$(".accordion-desc").slideUp();
	
	$(".accordion-title").click(function(){
		$(this).next(".accordion-desc").slideToggle();
	})
	$('#module-current').ready(function() {
		var browserUrl = window.location.href;
		$('#module-current a').each(function(i, data){
			if( $(data).attr("href") == browserUrl ) {
				$(data).parent().addClass('current-menu');
				$(data).parent().addClass('active').parent().addClass('active').parent().addClass('active');
			}
			// console.log($(data).parent().hasClass('current-menu'));
			if(browserUrl.indexOf('chapter') != -1 && $(data).parent().hasClass('current-menu') ) {
				$(data).parent().addClass('active').parent().addClass('active').parent().addClass('active');
			}
		});
	});

	jQuery.noConflict();
	jQuery('[data-toggle="popover"]').popover();
	
}); 

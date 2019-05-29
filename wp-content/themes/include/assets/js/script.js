jQuery(document).ready( function($) {
	

	$('#module-current').ready(function() {

			$('#module-current a').each(function(i, data){
				if( $(data).attr("href") == window.location.href ) {
					$(data).parent().addClass('active').parent().addClass('active').parent().addClass('active');
				}
			});
	});

});

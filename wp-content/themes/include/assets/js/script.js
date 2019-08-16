jQuery(document).ready( function($) {
	$("#ex13").slider({
    ticks: [0, 100, 200, 300, 400],
    ticks_labels: ['$0', '$100', '$200', '$300', '$400'],
    ticks_snap_bounds: 30
});

	
	$(".accordion-desc").slideUp();
	
	$(".accordion-title").click(function(){
		$(this).next().slideToggle();
		$(this).parent().toggleClass('active');
      	});
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

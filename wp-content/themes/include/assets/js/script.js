jQuery(document).ready( function($) {
	
	$(".accordion-desc").slideUp("slow");
	
	$(".accordion-title").click(function(){
		$(this).next().slideToggle("slow");
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

}); 

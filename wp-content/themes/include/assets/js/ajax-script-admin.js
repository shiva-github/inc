jQuery(document).ready( function($) {
	jQuery('.form-load-js').click(function(){
		var tab_text = $(this).attr('href');

		var tab_id = tab_text.substring( tab_text.lastIndexOf('-')+1, tab_text.length);
		var pane_id = 'v-pills-'+ tab_id;

		
		var formData = {
			'action': 'form_data_fetch',
			'form_data': $(this).attr('href'),
			'name_id': $('#'+pane_id + ' input[name="LoggedUserId"]').val()
		};
		jQuery.ajax({
			url: ajax_object.ajax_url,
			data: formData,
			method: "POST",
			success: function(result) {
				console.log(JSON.parse(result));
			}
		});
		
	});
}); 

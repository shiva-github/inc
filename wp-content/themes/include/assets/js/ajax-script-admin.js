jQuery(document).ready( function($) {
	jQuery('.formLoadJs, .form-load-js').click(function(){
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
				var complete_obj = JSON.parse(result);
				// console.log(complete_obj);
				delete(complete_obj['success']["id"]);
				delete(complete_obj['success']["LoggedUserId"]);
				delete(complete_obj['success']["created_time"]);
				delete(complete_obj['success']["updated_time"]);
				for(var key in complete_obj['success']) {

					// console.log(complete_obj['success'][key]);
					// console.log('input[name="'+key.replace(/_/g, '-')+'"]');
					jQuery('[name="'+key.replace(/_/g, '-')+'"]').val(complete_obj['success'][key]);

					// $()
					//console.log(complete_obj['success'][key]);
				}
			}
		});
		
	});
}); 

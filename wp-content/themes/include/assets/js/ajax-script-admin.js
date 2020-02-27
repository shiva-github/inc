jQuery(document).ready( function($) {
	jQuery('.formLoadJs, .form-load-js').click(function(){
		var tab_text = $(this).attr('href');

		var tab_id = tab_text.substring( tab_text.lastIndexOf('-')+1, tab_text.length);
		var pane_id = 'v-pills-'+ tab_id;
		var param1 = $(this).attr('href');
		var param2 = $('#'+pane_id + ' input[name="LoggedUserId"]').val();
		
		formLoadAjax_fun(param1, param2);
	});


	//replacing form on load function calls
	jQuery(document).on('click', '.reflect-now-modal, .save-btn-load', function() {
		try {
			var var_form = jQuery(this).data('fid').split('-')[1];
			var fid = '';
			if (typeof var_form != 'undefined' && var_form != null ) {
				fid = var_form;
			} else {
				return;
			}
			
			var tab_text = '#v-pills-' + fid;
			var cust_pid = jQuery('#cust_pid').val();
			formLoadAjax_fun(tab_text, cust_pid);
		} catch(ex) {
			console.log('Error', ex);
		}
		
	});

	//replacing form on load function calls
	jQuery(document).on('click', '.bookmark', function() {
		try {
			var cust_pid = jQuery('#cust_pid').val();
			var formData = {
				'action'	: 'add_bookmark_for_user',
				'link'		: window.location.href,
				'uid'		: cust_pid,
				'userBtn'	: $(this).attr('id')
			};
			
			if (typeof cust_pid != 'undefined' && cust_pid != null && cust_pid != '' ) {
				add_bookmark(formData);
			}
		} catch(ex) {
			console.log('Error');
		}
	});
	var formData = {
		'action': 'get_bookmark_for_user',
		'uid': jQuery('#cust_pid').val()
	};
	get_bookmark_for_user(formData);
}); 

function formLoadAjax_fun(value1, pane_id) {
	var formData = {
		'action': 'form_data_fetch',
		'form_data': value1,
		'name_id': pane_id
	};
	jQuery.ajax({
		url: ajax_object.ajax_url,
		data: formData,
		method: "POST",
		success: function(result) {
			var complete_obj = JSON.parse(result);

			// delete(complete_obj['success']["id"]);
			// delete(complete_obj['success']["LoggedUserId"]);
			delete(complete_obj['success']["created_time"]);
			delete(complete_obj['success']["updated_time"]);
			for(var key in complete_obj['success']) {
				jQuery('[name="'+key.replace(/_/g, '-')+'"]').val(complete_obj['success'][key]);
				var createid = '#' + key.replace(/_/g, '-');
				// console.log(createid, complete_obj['success'][key]);
				// jQuery(createid).val(complete_obj['success'][key]);
			}
		}
	});
}



function add_bookmark(value1) {	
	jQuery.ajax({
		url: ajax_object.ajax_url,
		data: value1,
		method: "POST",
		success: function(result) {
			var complete_obj = JSON.parse(result);
			console.log(complete_obj);
		},
		err: function(error) {
			console.log(error);
		}
	});
}



function get_bookmark_for_user(value1) {	
	jQuery.ajax({
		url: ajax_object.ajax_url,
		data: value1,
		method: "POST",
		success: function(result) {
			var complete_obj = JSON.parse(result);
			console.log(complete_obj);
		},
		err: function(error) {
			console.log(error);
		}
	});
}

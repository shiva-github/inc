<?php 

add_action( 'wp_footer', 'my_action_javascript' ); // Write our JS below here

function my_action_javascript() { ?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {
		var data = {
			'action': 'my_action',
			'module_number': $('[name="module-number"]').val(),
			'current_page': $('[name="current-page"]').val()
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$('#ajax-btn').click(function() {
			jQuery.post(ajaxurl, data, function(response) {
				$("#page-content").html(response);
			});
		});
	});
	</script> <?php
}

add_action( 'wp_ajax_my_action', 'my_action' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action' );

function my_action() {
	global $wpdb; // this is how you get access to the database

	$module_number = intval( $_POST['module_number'] );
	$module_post = get_post($module_number);
	set_query_var( 'module_post',  $module_post );
	
	$current_page = intval( $_POST['current_page'] );
	if ($current_page != -1) {
		// echo get_post(get_post($module_number)->module_chapters[$current_page+1])->post_content;
	} else {
		// echo get_post(get_post($module_number)->module_chapters[0])->post_content;
		$current_page = 1;
		$data = get_post($module_post->module_chapters[0]);
		$backlink = get_post($module_number);

		set_query_var( 'page_post',  $data );
	}
	get_template_part( 'content', 'pages');
	
		
        // echo $module_number;
        // echo $current_page+1;

	wp_die(); // this is required to terminate immediately and return a proper response
}
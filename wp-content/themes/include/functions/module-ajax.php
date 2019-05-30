<?php 


add_action( 'wp_footer', 'fetch_module_progress_javascript' ); // Write our JS below here
function fetch_module_progress_javascript() { ?>
	<script type="text/javascript" >
		jQuery(document).ready(function($) {
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$('.moduleNum').each(function(){
			var element = $(this);
			var data = {
				'action'		: 'fetch_module_progress',
				'parent_module'	: element.attr('moduleNum'),
			};

			jQuery.post(ajaxurl, data, function(response) {
				element.html(response + '%');
			});
		});
	});
		</script> <?php
	}
	add_action( 'wp_ajax_fetch_module_progress', 'fetch_module_progress' );
	add_action( 'wp_ajax_nopriv_fetch_module_progress', 'fetch_module_progress' );
	function fetch_module_progress() {
	global $wpdb; // this is how you get access to the database
	// current parent module
	
	$user = get_current_user_id();
	$root = intval($_POST['parent_module']);
	$parent_post_childs = get_children($root);
	
	$query = "SELECT count(*) as count FROM wp_progress_tracker WHERE userid=$user and parent_module=" . $root;
	$result = $wpdb->get_results($query);
	
	$div = count($parent_post_childs) ? count($parent_post_childs) : 1;
	echo ($result[0]->count / $div) * 100;
	
	wp_die();
	}
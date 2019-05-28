<?php 

add_action( 'wp_footer', 'my_action_javascript' ); // Write our JS below here

function my_action_javascript() { ?>
	<script type="text/javascript" >
		jQuery(document).ready(function($) {


		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$(".mainpage").on('click', '.btn-ajax', function(event) {
			
			var data = {
				'action'		: 'my_action',
				'module_number'	: $('[name="module-number"]').val(),
				'current_page'	: $('[name="current-page"]').val(),
				'nav'			: $(this).attr('data'),
				'load'			: $(this).attr('load'),
			};

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

	// current parent module
	$current_parent_module 	= intval( $_POST['module_number'] );
	$current_post 			= get_post(intval( $_POST['current_page'] ));

	$action_on_post 		= intval($_POST['load']);
	$action_prev_next 		= intval($_POST['nav']);
	if( 'modules' === $current_post->post_type ) {
		execute_module($current_post, $action_on_post, $action_prev_next);
	}
	if( 'pages' === $current_post->post_type ) {
		execute_pages($current_post, $action_on_post, $action_prev_next);
	}
	wp_die();





	// Ajax data loaded here
	$module_number = intval( $_POST['module_number'] );
	

	$module_post = get_post($module_number);
	$load_post = intval($_POST['load']);
	echo "<pre>";
	
	$current_page = intval( $_POST['current_page'] );
	$has_pages = intval(count(get_post($load_post)->module_chapters));
	
	if ($has_pages) {
		execute_pages();
	} else {
		execute_module();
	}
	var_dump($has_pages);wp_die();
	if ($current_page != -1) {
		// echo get_post(get_post($module_number)->module_chapters[$current_page+1])->post_content;
		

		if( 'prev' == esc_html($_POST['nav'] ) ) {
			$chapters = get_post($module_number)->module_chapters;

			$final_data['current_page'] = $current_page - 1;
			$final_data['prev'] = $final_data['current_page']-1 == -1 ? $module_number: $chapters[$final_data['current_page']-1];

			$final_data['module_num'] = $module_number;
			$final_data['load'] = $chapters[$current_page];

		// if exist or redirect to next module and so on...
			$final_data['next'] = $chapters[$current_page];

			$final_data['first'] = $first_page;
			$final_data['last'] = $last_page;
			
			$final_data['data'] = get_post($load_post)->post_content;

			set_query_var( 'page_post',  $final_data );
		}
		if( 'next' == esc_html($_POST['nav'] ) ) {
			$chapters = get_post($module_number)->module_chapters;

			$final_data['current_page'] = $current_page + 1;
			$final_data['prev'] = $current_page == -1 ? $module_number: $chapters[$current_page];

			$final_data['module_num'] = $module_number;
			$final_data['load'] = $chapters[$final_data['current_page']];

		// if exist or redirect to next module and so on...
			$final_data['next'] = $chapters[$final_data['current_page']+1];

			$final_data['first'] = $first_page;
			$final_data['last'] = $last_page;
			if($final_data['last'] == $final_data['load']) {
				$final_data['next'] = $module_number;
			}
			$final_data['data'] = get_post($load_post)->post_content;

			set_query_var( 'page_post',  $final_data );
		}
	} else {
		$chapters = get_post($module_number)->module_chapters;
		
		$final_data['current_page'] = $current_page + 1;
		$final_data['prev'] = $current_page == -1 ? $module_number: $current_page;

		$final_data['module_num'] = $module_number;
		$final_data['load'] = $chapters[$final_data['current_page']];

		// if exist or redirect to next module and so on...
		$final_data['next'] = $chapters[$final_data['current_page']+1];

		$final_data['first'] = $first_page;
		$final_data['last'] = $last_page;
		
		$final_data['data'] = get_post($load_post)->post_content;
		
		set_query_var( 'page_post',  $final_data );
	}
	get_template_part( 'parts/content', 'pages');
	

        // echo $module_number;
        // echo $current_page+1;

	wp_die(); // this is required to terminate immediately and return a proper response
}

function execute_pages($page_current, $action_on_post, $action) {
	
	return;
}
function execute_module($module_current, $action_on_post, $action) {
	
	// var_dump($module_current);
	if(0 == $action ) {
		var_dump(get_post($action_on_post));
	}
	
	if(1 == $action ) {
		$has_pages = get_post($action_on_post)->module_chapters;
		// var_dump($has_pages);
		if( $has_pages ) {
			echo 1;
		} else {
			echo 2;
		}
	}
	
	if(-1 == $action ) {

	}
	
	return;
}
<?php

require_once 'class-wp-bootstrap-navwalker.php';
require_once 'functions/module-ajax.php';



function fire_theme_enqueue_scripts() {
    // all styles
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), 20141119 );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

    // all scripts
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '20120206', true );
	wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '20120206', true );

	}
add_action( 'wp_enqueue_scripts', 'fire_theme_enqueue_scripts' );


// logo of the website 
function fire_header_logo() {
	$defaults = array(
		'default-image'          => get_template_directory_uri() . '/assets/images/header.jpg',
		'width'                  => 235,
		'height'                 => 72,
		'flex-height'            => false,
		'flex-width'             => false,
		'uploads'                => true,
		'random-default'         => false,
		'default-text-color'     => '',
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-logo', $defaults );
}

add_action('after_setup_theme', 'fire_header_logo');



// header menu and footer menu
function fire_menu_header_foot() {

    // the register_nav_menus call is what you should copy into your own
    // themes setup function.
	register_nav_menus(
		array(
            'footer_nav' => __( 'Footer Menu', 'fire' ), // example of adding a menu location
            'top_menu' => __( 'Top Menu', 'fire' ), // we will be using this top_menu location
        )
	);

}
// this will hook the setup function in after other setup actions.
add_action( 'after_setup_theme', 'fire_menu_header_foot' );


// widget bar 
function fire_sidebar_widgets_init() {

	register_sidebar( array(
		'name'          => 'Primary Sidebar',
		'id'            => 'fire_sidebar',
		'before_widget' => '<div class="widget-wrapper">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2><div class="widget-content">',
	) );

}
add_action( 'widgets_init', 'fire_sidebar_widgets_init' );




// redirect to somepage for subscribers
function login_redirect( $redirect_to, $requested_redirect_to, $user ) {

	if ( isset($user->roles) && is_array($user->roles) ) {

		if ( in_array('subscriber', $user->roles) ) {
			if ( $requested_redirect_to && admin_url() != $requested_redirect_to ) {
				$redirect_to = $requested_redirect_to;
			} else {
				$redirect_to =  site_url() . '/module-library';
			}
		}
	}
	return $redirect_to;
}
add_filter( 'login_redirect', 'login_redirect', 10, 3 );

//redirect for unauthenticated pages for users.
add_action('template_redirect','my_non_logged_redirect');
function my_non_logged_redirect() {
	if ((is_page('my-action-plan')) && !is_user_logged_in() ) {
		wp_redirect( home_url() );
		die();
	}
} 

//custom post type for 8 modules
function module_posttype() {
	$labels = array(
		'name'               => _x( 'Modules', 'post type general name', 'fire' ),
		'singular_name'      => _x( 'Module', 'post type singular name', 'fire' ),
		'menu_name'          => _x( 'Modules', 'admin menu', 'fire' ),
		'name_admin_bar'     => _x( 'Module', 'add new on admin bar', 'fire' ),
		'add_new'            => _x( 'Add New', 'module', 'fire' ),
		'add_new_item'       => __( 'Add New Module', 'fire' ),
		'new_item'           => __( 'New Module', 'fire' ),
		'edit_item'          => __( 'Edit Module', 'fire' ),
		'view_item'          => __( 'View Module', 'fire' ),
		'all_items'          => __( 'All Modules', 'fire' ),
		'search_items'       => __( 'Search Modules', 'fire' ),
		'parent_item_colon'  => __( 'Parent Modules:', 'fire' ),
		'not_found'          => __( 'No moudles found.', 'fire' ),
		'not_found_in_trash' => __( 'No moudles found in Trash.', 'fire' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'fire' ),
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'module' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes')
	);
	add_theme_support( 'post-thumbnails',  array('modules', 'page'));
	register_post_type( 'modules', $args );
}
add_action( 'init', 'module_posttype' );


// adding module parent column for reference
add_filter( 'manage_edit-modules_columns', 'add_columns' );
/**
 * Add columns to management page
 *
 * @param array $columns
 *
 * @return array
 */
function add_columns( $columns ) {
    $columns['page_attributes'] = 'Page Attribute';
    return $columns;
}



// adding data to module parent coulumn
add_action( 'manage_modules_posts_custom_column', 'columns_content', 10, 2 );

/**
 * Set content for columns in management page
 *
 * @param string $column_name
 * @param int $post_id
 *
 * @return void
 */
function columns_content( $column_name, $post_id ) {
	if ( 'page_attributes' != $column_name ) {
		return;
	}
	$postid = get_post($post_id)->post_parent;
	if ( $postid ){
		echo $post_id . ' (Pg Id): ' . get_post($postid)->post_name . '-' . $postid;
	} else {
		echo $post_id . ' (Pg Id): [No Parent]';
	}
	
}


//custom post type for 8 modules
function create_posttype() {
	$labels = array(
		'name'               => _x( 'Chapters', 'post type general name', 'fire' ),
		'singular_name'      => _x( 'Chapter', 'post type singular name', 'fire' ),
		'menu_name'          => _x( 'Chapters', 'admin menu', 'fire' ),
		'name_admin_bar'     => _x( 'Chapter', 'add new on admin bar', 'fire' ),
		'add_new'            => _x( 'Add New', 'chapter', 'fire' ),
		'add_new_item'       => __( 'Add New Chapter', 'fire' ),
		'new_item'           => __( 'New Chapter', 'fire' ),
		'edit_item'          => __( 'Edit Chapter', 'fire' ),
		'view_item'          => __( 'View Chapter', 'fire' ),
		'all_items'          => __( 'Chapters', 'fire' ),
		'search_items'       => __( 'Search Chapters', 'fire' ),
		'parent_item_colon'  => __( 'Parent Chapters:', 'fire' ),
		'not_found'          => __( 'No chapters found.', 'fire' ),
		'not_found_in_trash' => __( 'No chapters found in Trash.', 'fire' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'fire' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => 'edit.php?post_type=modules',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'chapter' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
	);

	register_post_type( 'chapters', $args );
}
add_action( 'init', 'create_posttype' );



function skip_mail($f){
	$submission = WPCF7_Submission::get_instance();
	return true;
}
add_filter('wpcf7_skip_mail','skip_mail');


add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}


add_action("wpcf7_before_send_mail", "save_contact_form_data");  
function save_contact_form_data($cf7) {
    // get the contact form object
    // $wpcf = WPCF7_ContactForm::get_current();
	$submission = WPCF7_Submission::get_instance();
	$text_area_contents = $cf7->posted_data;
	// print_r($submission);die;
	print_r($cf7->raw_values);die;
    // if you wanna check the ID of the Form $wpcf->id

    // if (/*Perform check here*/) {
    //     // If you want to skip mailing the data, you can do it...  
    //     $wpcf->skip_mail = true;    
    // }

	return $wpcf;
}

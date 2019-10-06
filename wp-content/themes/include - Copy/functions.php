<?php

require_once 'class-wp-bootstrap-navwalker.php';



function fire_theme_enqueue_scripts() {
    // all styles
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), 20141119 );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

    // all scripts
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '20120206', true );
	wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '20120206', true );
}
add_action( 'wp_enqueue_scripts', 'fire_theme_enqueue_scripts' );






function fire_header_logo() {
	$defaults = array(
		'default-image'          => get_template_directory_uri() . '/assets/images/header.jpg',
		'width'                  => 100,
		'height'                 => 100,
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







?>
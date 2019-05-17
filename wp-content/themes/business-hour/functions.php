<?php
/*
 * .
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'business_hour_enqueue_styles' );
function business_hour_enqueue_styles() {
    wp_enqueue_style( 'business-hour-parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'business-hour-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('business-hour-parent-style')
    );
}
/*
 * Your code goes below
 */

// hook in late to make sure the parent theme's registration 
// has fired so you can undo it. Otherwise the parent will simply
// enqueue its script anyway.
add_action('wp_enqueue_scripts', 'business_hour_script_fix', 100);
function business_hour_script_fix()
{
    wp_dequeue_script('business-hour-main');
    wp_enqueue_script('business-hour-main', get_stylesheet_directory_uri().'/assets/js/main.js', array('jquery'));
}




/*load a file*/
require_once trailingslashit( get_stylesheet_directory() ) .'/inc/default.php';
require_once trailingslashit( get_stylesheet_directory() ) . '/inc/ample-themes/widgets/business-recents-post-widgets.php';
require_once trailingslashit( get_stylesheet_directory() ) . '/inc/ample-themes/widgets/our-work-service-widgets.php';



function business_hour_remove_section( $wp_customize ) {
    $wp_customize->remove_control('ample_business_comapny_info_section');
}
add_action( 'customize_register', 'business_hour_remove_section' );







// add_action( 'register_form', 'myplugin_register_form' );
// function myplugin_register_form() {

//     $first_name = ( ! empty( $_POST['first_name'] ) ) ? sanitize_text_field( $_POST['first_name'] ) : '';
        
        ?>
        <!-- <p>
            <label for="first_name"><?php //_e( 'First Name', 'mydomain' ) ?><br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php //echo esc_attr(  $first_name  ); ?>" size="25" /></label>
        </p> -->
        <?php
    // }

    //2. Add validation. In this case, we make sure first_name is required.
    // add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
    // function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {
        
    //     if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
    //     $errors->add( 'first_name_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'mydomain' ),__( 'You must include a first name.', 'mydomain' ) ) );

    //     }

    //     return $errors;
    // }

    // //3. Finally, save our extra registration user meta.
    // add_action( 'user_register', 'myplugin_user_register' );
    // function myplugin_user_register( $user_id ) {
    //     if ( ! empty( $_POST['first_name'] ) ) {
    //         update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
    //     }
    // }
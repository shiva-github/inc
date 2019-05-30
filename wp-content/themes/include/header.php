<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php 
  if ( is_singular('modules') && is_user_logged_in() ) {
    $user = get_current_user_id();

    global $post;     // if outside the loop

    if ( is_singular('modules') && $post->post_parent ) {
    // This is a subpage
      $parent2 = get_post($post->post_parent)->post_parent;
      if( $parent2 ) {
       echo $parent2;
       $module_root = $parent2;
       // load_progress_module($user, $post->ID, $post->post_parent);
      } else {
        // echo $user, $post->ID, $post->post_parent;
        $module_root = $post->post_parent;
        load_progress_module($user, $post->ID, $post->post_parent);
      }
    } else {
    // This is not a subpage
      // var_dump($post->ID);
    }
  }

  ?>
  
    <div class="background-header">
        <header>
            <div class="container">
                <div class="user-login-wrapper clearfix">
                    <?php 
                    if(is_user_logged_in()) {
                        ?>
                        <div class="loginText">
                            <nav class="navbar navbar-expand-lg navbar-light float-right">
                                <div class="collapse navbar-collapse float-right" id="header-user-menu">
                                    <div class="navbar-nav form-inline mr-auto float-right">
                                      <a class="nav-item nav-link" href="#">Home</a>
                                      <a class="nav-item nav-link" href="/wp-admin/">My Account</a>
                                      <a class="nav-item nav-link" href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
                                  </div>
                              </div>
                          </nav>
                      </div>
                      <?php 
                  } else {
                    ?>
                    <div class="loginText">
                        <nav class="navbar navbar-expand-lg navbar-light float-right">
                            <div class="collapse navbar-collapse float-right" id="header-user-menu">
                                <div class="navbar-nav form-inline mr-auto float-right">
                                  <a class="nav-item nav-link" href="<?php site_url(); ?>/wp-login.php">Login</a>
                              </div>
                          </div>
                      </nav>
                  </div>
                  <?php 
              }
              ?>
          </div>
      </div>
      <div class="container">
          <div id="header-image">
            <!-- <img src="<?php //get_template_directory_uri() . '/assets/images/header.jpg'?>"> -->
            <?php
            // if ( get_theme_mod('header_text') ) {

            if(is_user_logged_in()) {
              $site = '/module-library';
            }
            else {
              $site = '/';
            }
            ?>
            <div class="row logo-header-text">
                <div class="col-9">
                  <a href="<?php echo site_url() . $site;?>">
                    <h1 class="site-title float-left mr-1"><?php bloginfo( 'name' ); ?></h1>
                    <h1 class="site-description"><?php bloginfo( 'description' ); ?></h1>
                  </a>
                </div>
                <div class="col-3">
                    <?php
            // } else {
                    if (function_exists( 'the_custom_logo' )) {
                        the_custom_logo();

                    }
            // }
                    ?>
                </div>
            </div>
        </div>
    </div>

        <div class="wrapper">
            <div id="main_navbar" class="navbar navbar-expand-md navbar-light bg-light">
                <!-- you can remove this container wrapper if you want things full width -->
                <div class="container">
                    <!-- <a class="navbar-brand" href="#"><?php //esc_html_e( bloginfo( 'name' ), 'fire' ); ?></a> -->

            
            <?php 
            if (is_user_logged_in()) {

              if( is_singular('modules') ) {
            ?>
            <a class="header_module" href="<?php echo get_post_permalink($module_root);?>"><?php echo get_post($module_root)->post_title; ?> </a>
            <?php 
            }
            ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerNav" aria-controls="headerNav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'best-reloaded' ); ?>">
                <span class="navbar-toggler-icon"></span><span class="sr-only"><?php esc_html_e( 'Toggle Navigation', 'fire' ); ?></span>
            </button>
            <nav class="collapse navbar-collapse" id="headerNav" role="navigation" aria-label="Main Menu">
                <span class="sr-only"><?php esc_html_e( 'Main Menu', 'fire' ); ?></span>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'top_menu',
                    'depth' => 2,
                    'container' => false,
                    'menu_class' => 'navbar-nav float-right mr-0 ml-auto',
                    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                    'walker' => new WP_Bootstrap_Navwalker(),
                ) );
                ?>
            </nav>
            
            <?php
        } else {
                // show nothing.
        }
        
        ?>
                </div>
            </div>
    </div>
</header>
</div>



<?php
/**
 * The template part for header
 *
 * @package VW Gardening Landscaping 
 * @subpackage vw_gardening_landscaping
 * @since VW Gardening Landscaping 1.0
 */
?>

<div class="main-header">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3">
        <div class="logo">
          <?php if( has_custom_logo() ){ vw_gardening_landscaping_the_custom_logo();
            }else{ ?>
              <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
              <?php $description = get_bloginfo( 'description', 'display' );
              if ( $description || is_customize_preview() ) : ?>
              <p class="site-description"><?php echo esc_html($description); ?></p>
          <?php endif; } ?>
        </div>
      </div>
      <div class="col-lg-7 col-md-6">
        <?php get_template_part( 'template-parts/header/navigation' ); ?>
      </div>
      <div class="col-lg-2 col-md-3">
        <?php if( get_theme_mod( 'vw_gardening_landscaping_top_btn_url') != '' | get_theme_mod( 'vw_gardening_landscaping_top_btn_text') != '') { ?>
          <div class="top-btn">
            <a href="<?php echo esc_html(get_theme_mod('vw_gardening_landscaping_top_btn_url',''));?>"><?php echo esc_html(get_theme_mod('vw_gardening_landscaping_top_btn_text',''));?></a>
          </div>
        <?php }?>
      </div>
    </div>
  </div>
</div>
<div id="menu-box">
  <div class="container">
    
  </div>
</div>

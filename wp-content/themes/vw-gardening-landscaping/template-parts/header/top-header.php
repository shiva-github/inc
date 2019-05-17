<?php
/**
 * The template part for top header
 *
 * @package VW Gardening Landscaping 
 * @subpackage vw_gardening_landscaping
 * @since VW Gardening Landscaping 1.0
 */
?>

<div id="topbar">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-8">
        <div class="row">
          <div class="col-lg-4 col-md-4">
            <?php if( get_theme_mod( 'vw_gardening_landscaping_phone_number') != '') { ?>
              <i class="fas fa-phone"></i><span><?php echo esc_html(get_theme_mod('vw_gardening_landscaping_phone_number',''));?></span>
            <?php }?>
          </div>
          <div class="col-lg-8 col-md-8">
            <?php if( get_theme_mod( 'vw_gardening_landscaping_email_address') != '') { ?>
              <i class="fas fa-envelope-open"></i><span><?php echo esc_html(get_theme_mod('vw_gardening_landscaping_email_address',''));?></span>
            <?php }?>
          </div>
        </div>
      </div>
      <div class="col-lg-5 col-md-4">
        <div class="row">
          <div class="<?php if( get_theme_mod( 'vw_gardening_landscaping_header_search') != '') { ?>col-lg-11 col-md-10"<?php } else { ?>col-lg-12 col-md-12"<?php } ?>">
            <?php dynamic_sidebar('social-links'); ?>
          </div>
          <?php if( get_theme_mod( 'vw_gardening_landscaping_header_search') != '') { ?>
            <div class="col-lg-1 col-md-1">
              <div class="search-box">
                <span><i class="fas fa-search"></i></span>
              </div>
            </div>
          <?php }?>
        </div>
      </div>
    </div>
    <div class="serach_outer">
      <div class="closepop"><i class="far fa-window-close"></i></div>
      <div class="serach_inner">
        <?php get_search_form(); ?>
      </div>
    </div>
  </div>
</div>
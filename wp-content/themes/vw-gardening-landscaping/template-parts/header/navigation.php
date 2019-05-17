<?php
/**
 * The template part for header
 *
 * @package VW Gardening Landscaping 
 * @subpackage vw_gardening_landscaping
 * @since VW Gardening Landscaping 1.0
 */
?>

<div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','vw-gardening-landscaping'); ?></a></div>
<div id="header" class="menubar">
	<div class="nav">
		<?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
	</div>
</div>
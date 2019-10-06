<?php
/**
* Template Name: page template - left sidebar.
*
* @package WordPress
* @subpackage fire
* @since The Last Fire
*/

wp_link_pages();

get_header(); ?>


<div class="container" style="padding-top: 55px;">
	<div class="row">
		
		<div class="col-xl-3"><?php get_sidebar(); ?></div>
		<div class="col-xl-9 mainpage">
			<?php 
				while (have_posts()) : the_post(); 
					?>
					<h2><?php the_title(); ?></h2>
					<p><?php the_excerpt(); ?></p>
					<?php

				endwhile;
			?>
		</div>
	</div>
</div>


<?php get_footer(); ?>

<?php
/**
* Template Name: Module template
* Template Post Type: modules
*
* @package WordPress
* @subpackage fire
* @since The Last Fire
*/

?>



<div class="container" style="padding-top: 55px;">
	<div class="row">
		<div class="col-xl-12 mainpage">
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

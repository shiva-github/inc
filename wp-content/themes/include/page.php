<?php



get_header(); ?>



<div class="container content-wrapper">
	<div class="row">
		<div class="col-xl-12 mainpage">
			<?php 
				while (have_posts()) : the_post(); 
					?>
					<h2><?php the_title(); ?></h2>
					<p><?php the_content(); ?></p>
					<?php

				endwhile;
			?>
		</div>
	</div>
</div>



<?php get_footer(); ?>

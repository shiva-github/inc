<?php

get_header(); ?>


<div class="container content-wrapper">
	<div class="row">
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
		<div class="col-xl-3"><?php get_sidebar(); ?></div>
	</div>
</div>

<?php get_footer(); ?>















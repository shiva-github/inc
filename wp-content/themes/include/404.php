<?php

get_header(); ?>


<div class="container content-wrapper">
	<div class="row">
		<div class="col-xl-9 mainpage">
			
			<h2><?php _e( 'Oops! That page can&rsquo;t be found.', 'fire' ); ?></h2>
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'fire' ); ?></p>

			<?php get_search_form(); ?></p>

		</div>
		<div class="col-xl-3"><?php get_sidebar(); ?></div>
	</div>
</div>


<?php get_footer(); ?>

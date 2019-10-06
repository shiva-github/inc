<?php



get_header(); ?>


<div class="container content-wrapper">
	<div class="row">
		<div class="col-xl-9 mainpage">
			<?php 
				while (have_posts()) : the_post(); 
					?>
					<h2><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>'); ?></h2>
					<p>
						<?php if ( have_posts() ) : ?>

							<header class="page-header">
								<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
							</header><!-- .page-header -->

							<?php shape_content_nav( 'nav-above' ); ?>

							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'content', 'search' ); ?>

							<?php endwhile; ?>

							<?php shape_content_nav( 'nav-below' ); ?>

							<?php else : ?>

								<?php get_template_part( 'no-results', 'search' ); ?>

							<?php endif; ?>

					</p>
					<?php

				endwhile;
			?>
		</div>
		<div class="col-xl-3"><?php get_sidebar(); ?></div>
	</div>
</div>


<?php get_footer(); ?>

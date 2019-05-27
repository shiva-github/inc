<?php
/**
* Template Name: Module Library
*
* @package WordPress
* @subpackage fire
* @since The Last Fire
*/

get_header(); 
?>



<div class="container" style="padding-top: 55px;">
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
		<div class="clear-both w-100">
			<div class="row">
				<?php 
				$args = array(
					'post_type'   => 'modules',
					'post_status' => 'publish',
					'orderby' => 'meta_value',
					'order' => 'ASC',
					 'post_parent' => 0,
				);
				$module_listing = new WP_Query( $args );
				
				if( $module_listing->have_posts() ) :
					$counter = 0;
					while( $module_listing->have_posts() ):
						$module_listing->the_post();
						?>


						<div class="col-md-4 module-<?php echo ($counter+1); ?>">
							<a href="<?php echo get_permalink(); ?>" class="news-link">
							<div class="module-listing-img">
								<?php 
								if( null != get_the_post_thumbnail_url() ):
									echo the_post_thumbnail('small', array('class'=>' w-100 ')); 
								else:
									?>
									<img src="<?php echo site_url();?>/wp-content/themes/include/assets/images/download.jpg" alt="Default News Image" class="img-responsive" width="100%" />
									<?php
								endif;

								?>
							</div>
							<div class="module-listing-title pl-3 pr-3 pt-1 pb-1" style="background-color: #211261;color: #fff;">
								<?php echo the_title(); ?>
							</div>
							<div class="module-listing-desc clear-both pl-3 pr-3 pt-3 pb-2 " style="background-color: #21126123;color: #333;">
								<div class="w-25 float-left text-center"><img src="<?php echo site_url();?>/wp-content/themes/include/assets/images/grey.jpg" style="border-radius: 50%;width: 75px;height: 75px;">
									<p class="mt-2">0%</p>
								</div>
								<div class="pl-3 pr-3 w-75 float-left"><?php echo the_content(); ?></div>
							</div>
							</a>
						</div>
						<?php
					
					$counter++;
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
	</div>
</div>
</div>


<?php get_footer(); ?>

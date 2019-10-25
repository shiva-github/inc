<?php

wp_link_pages();


get_header(); ?>


<div class="container" style="padding-top: 55px;">
	<div class="row">
		<div class="col-md-12"><h2><strong>Conversations</strong></h2></div>
		<div class="col-md-3">

			<div class="mt-5">
				<ul class="category-listing">
					<?php

					echo '<li><a href="'. site_url() .'/conversations"> Conversations</a></li>';
					?>
					<?php 
					$categories = get_categories(); 
					foreach ($categories as $cat ) {
						$active = '';
						if(strtolower($category_name) == strtolower($cat->name)) {
							$active = ' active';
						}
						if($cat->name != 'Conversations') {
							echo '<li><a class="'. $active . '" href="'. site_url() .'/conversations/?category=' . $cat->slug . '">' . $cat->name . '</a></li>';
						}
					}
					?>	
				</ul>

			</div>
		</div>
		<div class="col-md-9 right-section">
			<?php 
			while (have_posts()) : the_post(); 
				?>
				
				<div class="right-section-wrapper w-100">
					<div class="row">
						<div class="col-md-3">
							<p><?php the_author(); ?></p>
							<p><?php the_date(); ?></p>
						</div>
						<div class="col-md-9">
							<p><b><?php the_title(); ?></b></p>
							<p><?php the_content(); ?></p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="commentlist">
							<?php
								//Gather comments for a specific page/post 
							$comments = get_comments(array(
								'post_id' => get_the_ID(),
									'status' => 'approve' //Change this to the type of comments to be displayed
								));
							wp_list_comments('type=comment&callback=format_comment', $comments); 

							?>
						</div>
						<?php 
						if ( comments_open() || get_comments_number() ) :
							comments_template();
					endif;
					?>

				</div>
			</div>

			<?php

		endwhile;
		?>
	</div>
</div>
</div>


<?php get_footer(); ?>

<?php

wp_link_pages();


get_header(); ?>
<script type="text/javascript">
	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>

<div class="container">
	<div class="row">
		<div class="col-md-12 mainpage">
			<div class="row">
				<?php 
				while (have_posts()) : the_post(); 
					?>
					<div class="col-md-4 left-panel-module">
						<!-- listing of children posts here!!! -->
						<ul class="clear-both" id="module-current">
						<?php 
						$load_post = get_post()->ID;
						$post_parent1 = wp_get_post_parent_id(get_post()->ID);
						$post_parent2 = wp_get_post_parent_id($post_parent1);
						$post_parent3 = wp_get_post_parent_id($post_parent2);

						if ( $post_parent1 ) {
							$load_post = $post_parent1;
						}
						if ( $post_parent2 ) {
							$load_post = $post_parent2;
						}
						if ( $post_parent3 ) {
							$load_post = $post_parent3;
						}
						$arg_child_post =  array(
							'post_parent' 	=> $load_post,
							'post_type'   	=> 'modules', 
							'numberposts' 	=> -1,
							'post_status' 	=> 'publish', 
							'orderby'		=>'menu_order', 
							'order'   		=> 'ASC',
						);
						
						$current_module_child_posts = get_children( $arg_child_post );
						foreach ($current_module_child_posts as $value) {
							
							$arg_child_post =  array(
								'post_parent' 	=> $value->ID,
								'post_type'   	=> 'modules', 
								'numberposts' 	=> -1,
								'post_status'	=> 'publish', 
								'orderby'		=>'menu_order', 
								'order'   		=> 'ASC',
							);
							echo '<li class="clear-both pr-2 pt-2 pb-2 pl-4 btn-ajax" data="0" load="' . $value->ID . '" ><a href="'.get_permalink($value->ID).'">' .  $value->post_title . '</a>';
							$module_child_posts = get_children( $arg_child_post );
							echo '<ul class="mb-2 clear-both">';
							foreach ($module_child_posts as $value1) {
								echo '<li class="clear-both pr-2 pt-2 pb-2 pl-4 btn-ajax" data="0" load="' . $value1->ID . '" ><a href="'.get_permalink($value1->ID).'">' .  $value1->post_title . '</a></li>';
							}
							echo '</ul>';
							echo '</li>';
						}
						?>
						</ul>
					</div>
					<div class="col-md-8 right-panel-module">
						<div class="content-module" id="page-content" style="padding-top: 55px;">
							<h2><?php the_title(); ?></h2>
							<p><?php the_content(); ?></p>
							<div class="content-navigate-module text-center">
								<?php 
									// previous button

								$link_prev =  get_post_meta($post->ID, 'previous_link', true);
								$link_text_prev = get_post_meta($post->ID, 'previous_link_text', true);
								if($link_prev) {

								?>
								

								<?php 

								}
									// previous button end
								$next_link = get_post_meta($post->ID, 'next_link', true);
								$next_text_link = get_post_meta($post->ID, 'next_link', true);
								if($next_link) {
								
									// next button start
								
								?>
								<button class="learn-more btn-ajax" id="ajax-btn" data="-1" load="<?php echo $firstlink; ?>">Continue</button>

								<?php 
								}
								?>
							</div>
						</div>
					</div>
					<?php

				endwhile;
				?>
			</div>
		</div>
	</div>
</div>
<?php

get_footer(); ?>

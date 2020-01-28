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

					$mod_current = get_post_meta(get_the_ID(), 'parent_module', true);
					//when user accessing page which has invalid url
					if ($mod_current == '') {
						echo "Something went wrong. Please avoid to access this page. Invalid page url.";die;
					}
					$load_post = $mod_current;

					$post_parent1 = wp_get_post_parent_id($load_post);
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

					?>
					<div class="col-md-4 left-panel-module">
						<!-- listing of children posts here!!! -->
						<div class="w-100 mt-5 clear-both mb-5">
							<div class="w-50 float-left text-center"><img src="<?php echo site_url();?>/wp-content/themes/include/assets/images/grey.jpg" style="border-radius: 50%;width: 100px;height: 100px;">
							</div>
							<div class="w-50 float-left pl-2" >
								<p style="margin-bottom: 0;">Your progress</p>
								<p style="margin-bottom: 0;font-size: 40px;font-weight: 100;" class="moduleNum" moduleNum="<?php echo $load_post; ?>">0%</p>
								<p style="margin-bottom: 0;font-weight: 700">complete</p>
							</div>
						</div>
						<?php 

						
						
						$arg_child_post =  array(
							'post_parent' 	=> $load_post,
							'post_type'   	=> 'modules', 
							'numberposts' 	=> -1,
							'post_status' 	=> 'publish', 
							'orderby'		=>'menu_order', 
							'order'   		=> 'ASC',
						);
						
						$current_module_child_posts = get_children( $arg_child_post );
						?>

						<ul class="clear-both" id="module-current" parent="<?php echo $mod_current ?>">
							<?php
						foreach ($current_module_child_posts as $value) {
							
							$arg_child_post =  array(
								'post_parent' 	=> $value->ID,
								'post_type'   	=> 'modules', 
								'numberposts' 	=> -1,
								'post_status'	=> 'publish', 
								'orderby'		=>'menu_order', 
								'order'   		=> 'ASC',
							);
							$active = $mod_current == $value->ID ? ' current-menu ': '';

							echo '<li class="clear-both' . $active . '"><a href="'.get_permalink($value->ID) . '" class=" pr-2 pt-2 pb-2 pl-4 modules-menu-list ">' .  $value->post_title . '</a>';
							$module_child_posts = get_children( $arg_child_post );
							if (count($module_child_posts)) {
								echo '<ul class="clear-both">';
								foreach ($module_child_posts as $value1) {
									$active2 = $mod_current == $value1->ID ? ' current-menu ': '';
									echo '<li class="clear-both' . $active2 . '"><a href="'.get_permalink($value1->ID).'" class=" modules-submenu ">' .  $value1->post_title . '</a></li>';
								}
								echo '</ul>';	
							}
							
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

								$link_prev =  get_post_meta(get_the_ID(), 'prev_link', true);
								$link_text_prev = get_post_meta(get_the_ID(), 'prev_link_text', true);
								if($link_prev) {

								?>
								<a href="<?php echo $link_prev; ?>" class="learn-more">
									<?php echo $link_text_prev; ?>
								</a>

								<?php 

								}
									// previous button end

								$next_link = get_post_meta(get_the_ID(), 'next_link', true);
								$next_text_link = get_post_meta(get_the_ID(), 'next_link_text', true);

								if($next_link) {
									// next button start
								?>
								<a href="<?php echo $next_link; ?>" class="learn-more">
									<?php echo $next_text_link; ?>
								</a>

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
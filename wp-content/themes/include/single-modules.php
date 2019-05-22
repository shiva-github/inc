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
				<?php 
				$arg_child_post =  array(
					'post_parent' => get_post()->ID,
					'post_type'   => 'modules', 
					'numberposts' => -1,
					'post_status' => 'publish', 
				);
				
				$current_module_child_posts = get_children( $arg_child_post );
				foreach ($current_module_child_posts as $value) {
					echo $value->post_title;
				}
				?>
			</div>
			<div class="col-md-8 right-panel-module">
				<div class="content-module" id="page-content" style="padding-top: 55px;">
					<h2><?php the_title(); ?></h2>
					<p><?php the_content(); ?></p>
					<div class="content-navigate-module text-center">
						<?php 

						$post_list = get_post()->module_chapters;
						$firstlink = $post_list[0];
						$lastLink  = $post_list[count($post_list)-1];
						
						?>
						<input type="hidden" name="module-number" value="<?php echo get_post()->ID; ?>">
						<input type="hidden" name="current-page" value="-1">
						<input type="hidden" name="first-page" value="<?php echo $firstlink; ?>">
						<input type="hidden" name="last-page" value="<?php echo $lastLink; ?>">
						<button class="learn-more btn-ajax" id="ajax-btn" data="next" load="<?php echo $firstlink; ?>">Continue</button>
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

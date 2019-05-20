<?php

 wp_link_pages();

 
get_header(); ?>


<div class="container">
	<div class="row">
		<div class="col-md-12 mainpage">
			<div class="row">
			<?php 
				while (have_posts()) : the_post(); 
					?>
			<div class="col-md-4 left-panel-module">		

			</div>
			<div class="col-md-8 right-panel-module">
				<div class="content-module" style="padding-top: 55px;">
					<h2><?php the_title(); ?></h2>
					<p><?php the_content(); ?></p>
				</div>
				<div class="content-navigate-module">
					<?php 
					$post_list = get_post()->module_chapters;
					$firstlink = get_post($post_list[0]);

					?>
					<a class="learn-more" href="<?php echo $firstlink->guid; ?>" title="">Continue</a>
					<a class="learn-more" id="click" href="javascript:void(0);" title="">Ajax Call</a>
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
add_action( 'admin_footer', 'my_action_javascript' ); // Write our JS below here

function my_action_javascript() { ?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {

		var data = {
			'action': 'my_action',
			'whatever': 1234
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$("#click").click(function() {
			jQuery.post(ajaxurl, data, function(response) {
				alert('Got this from the server: ' + response);
			});
		})
	});
	</script> <?php
}
 get_footer(); ?>

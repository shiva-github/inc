
<p><?php echo $page_post->post_content; ?></p>

<div class="content-navigate-module text-center">
	<?php 

	$post_list = $module_post->module_chapters;
	$firstlink = get_post($post_list[0]);
	$lastLink  = $post_list[count($post_list)-1];

	?>
	<input type="hidden" name="module-number" value="<?php //echo get_post()->ID; ?>">
	<!-- <input type="hidden" name="current-page" value="<?php //echo $current_page; ?>"> -->
	<input type="hidden" name="first-page" value="<?php echo $firstlink->ID; ?>">
	<input type="hidden" name="last-page" value="<?php echo $lastLink; ?>">
	<button class="learn-more" id="ajax-btn" data='prev'>Previous</button>
	<button class="learn-more" id="ajax-btn" data='next'>Next</button>
</div>



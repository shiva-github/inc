<?php
/**
* Template Name: Add Post
*
* @package WordPress
* @subpackage fire
* @since The Last Fire
*/


get_header(); 



if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == "post") {

//store our post vars into variables for later use
//now would be a good time to run some basic error checking/validation
//to ensure that data for these values have been set
	$title     = $_POST['title'];
	$content   = $_POST['content'];
	$post_type = 'post';
	$categories= $_POST['select_category'];

//the array of arguements to be inserted with wp_insert_post
	$new_post = array(
		'post_title'    => $title,
		'post_content'  => $content,
		'post_status'   => 'publish',          
		'post_type'     => $post_type 
	);

	
//insert the the post into database by passing $new_post to wp_insert_post
//store our post ID in a variable $pid
		$pid = wp_insert_post($new_post);
		$categories = array('conversations', $categories );
		wp_set_object_terms( $pid, $categories, 'category', false);

//we now use $pid (post id) to help add out post meta data
		//add_post_meta($pid, 'meta_key', $custom_field_1, true);
		//add_post_meta($pid, 'meta_key', $custom_field_2, true);

}


?>



<div class="container content-wrapper conversation-pg">
	
	<div class="row">
		<?php 
		
		while (have_posts()) : the_post(); 
			?>
			<div class="col-md-3 mainpage">
				<div class="clear-both">
					<ul class="category-listing">
						
						<?php 
						$categories = get_categories();
						foreach ($categories as $cat ) {
							if($cat->name != 'Conversations') {
								echo '<li><a class="'. $active . '" href="'. site_url() .'/conversations/?category=' . $cat->slug . '">' . $cat->name . '</a></li>';
							}
						}
						?>	
					</ul>
				</div>
			</div>
			<?php

		endwhile;
		?>
		<div class="col-md-9 mainpage">


			<form method="POST" name="front_end" action="" >
				<div class="form-group">
					<label for="subject-post">Subject <span class="required-field">*</span>:</label>
					<input type="text" name="title" placeholder="Subject" class="form-control w-100 subject-post" id="subject-post" />
				</div>

				<div class="form-group">
					<label for="select_category">Module <span class="required-field">*</span>:</label>
					<select id="select_category" class="form-control w-100 select_category" name="select_category">
						<option value="Introduction">Introduction</option>
						<option value="Management">Management</option>
						<option value="Health">Health</option>
						<option value="Education">Education</option>
						<option value="Livelihood">Livelihood</option>
						<option value="Social">Social</option>
						<option value="Empowerment">Empowerment</option>
						<option value="Supplementary">Supplementary</option>
					</select>
				</div>

				<div class="form-group">
					<label for="content-area">Content:</label>
					<textarea id="content-area" class="form-control w-100 content-area" rows="8" type="text" name="content" placeholder="Content"></textarea>
				</div>	
	
	
	
	<button type="submit" class="btn">Submit</button>
	<input type="hidden" name="action" value="post" placeholder="post" />
	<?php wp_nonce_field(); ?>
	
			</form>
		</div>
	</div>

</div>



<?php get_footer(); ?>

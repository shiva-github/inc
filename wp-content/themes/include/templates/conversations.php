<?php
/**
* Template Name: Conversations
*
* @package WordPress
* @subpackage fire
* @since The Last Fire
*/


get_header(); ?>



<div class="container content-wrapper conversation-pg">
	
	<div class="row">
		<?php 
		$category_name = isset($_GET['category']) ? $_GET['category'] : '';
		while (have_posts()) : the_post(); 
			?>
			<div class="col-md-12"><h2><strong><?php the_title(); ?></strong></h2></div>
			<div class="col-md-3 mainpage">
				<div class="mt-5">
					<ul class="category-listing">
						<?php
						if ($category_name) {
							echo '<li><a href="'. site_url() .'/conversations"> Conversations</a></li>';
						} else {
							echo '<li><a href="'. site_url() .'/start-conversation/"> Start a conversation</a></li>';
						}
						
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
			<?php

		endwhile;
		?>
		<div class="col-md-9 mainpage">
			<?php
			if ($category_name == ''){ ?>
				<div class="alert alert-light border border-secondary  alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					All submissions to the INCLUDE CBR training platform are the views of the respective organizations or individuals providing the information and are not verified by WHO.

				</div>
				<p>We invite you to think about what’s happening for you and the people in your community in new ways – hopefully ways that open the heart and mind to supporting the engagement of each unique individual in ways that promote their contribution and involvement in making the community a welcoming place to be.</p>
				<p>To view the conversations for a particular module, select the module you want from the list on the left. To start a new conversation, select the <strong>Start a conversation</strong> button.</p>

				<?php 
			}
			$conversation_type = strlen($category_name) == 0 ? 'All' : ucwords($category_name);
			echo '<h5 class="mb-3"><strong>'. $conversation_type .' conversations</strong></h5>';

			?>
			<?php 
			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array( 'post_type' => 'post', 'posts_per_page' => 10,
				'category_name' => $category_name, 'paged' => $paged );
			$wp_query = new WP_Query($args);
			?>

			<div class="table-responsive">
				<table class="table table-striped table-hover conversation-table">
					<thead>
						<tr class="border-left-0">
							<th>TITLE</th>
							<th>STARTED BY</th>
							<th>UPDATED</th>
							<th>COMMENTS</th>
						</tr>
					</thead>

					<?php 
					while ( have_posts() ) : the_post(); ?>

						<p><?php $date1 = new DateTime((string)get_the_date()); ?></p>
						<p><?php $date2 = new DateTime('now'); ?></p>

						<?php
						$interval = $date1->diff($date2);

						?>
						<tbody> 
							<tr>
								<td><a href="<?php echo get_post_permalink(); ?>"><span style="font-weight: bold;"><?php echo get_the_category()[1]->name; ?>: </span><span><?php the_title(); ?></span></a></td>
								<td><?php the_author() ?></td>
								<td><?php echo $interval->format('%Y Years %M Months');?> </td>
								<td class="text-center"><?php echo get_comments_number( get_the_ID() );?></td>
							</tr>
						</tbody>
					<?php endwhile; ?>
				</table>

				<!-- then the pagination links -->
				<!-- <?php //next_posts_link( '&larr; Older posts', $wp_query ->max_num_pages); ?> -->
				<!-- <?php //previous_posts_link( 'Newer posts &rarr;' ); ?> -->


				<!-- pagination php -->

				<?php 

				if( $wp_query->max_num_pages > 1 ) {
					

					$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
					$max   = intval( $wp_query->max_num_pages );

					/** Add current page to the array */
					if ( $paged >= 1 )
						$links[] = $paged;

					/** Add the pages around the current page to the array */
					if ( $paged >= 3 ) {
						$links[] = $paged - 1;
						$links[] = $paged - 2;
					}

					if ( ( $paged + 2 ) <= $max ) {
						$links[] = $paged + 2;
						$links[] = $paged + 1;
					}

					echo '<div class="pagination-nav"><ul>' . "\n";

					/** Previous Post Link */
					if ( get_previous_posts_link() )
						printf( '<li>%s</li>' . "\n", get_previous_posts_link('Prev') );

					/** Link to first page, plus ellipses if necessary */
					if ( ! in_array( 1, $links ) ) {
						$class = 1 == $paged ? ' class="active"' : '';

						printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

						if ( ! in_array( 2, $links ) )
							echo '<li>…</li>';
					}

					/** Link to current page, plus 2 pages in either direction if necessary */
					sort( $links );
					foreach ( (array) $links as $link ) {
						$class = $paged == $link ? ' class="active"' : '';
						printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
					}

					/** Link to last page, plus ellipses if necessary */
					if ( ! in_array( $max, $links ) ) {
						if ( ! in_array( $max - 1, $links ) )
							echo '<li>…</li>' . "\n";

						$class = $paged == $max ? ' class="active"' : '';
						printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
					}

					/** Next Post Link */
					if ( get_next_posts_link() )
						printf( '<li>%s</li>' . "\n", get_next_posts_link('Next') );

					echo '</ul></div>' . "\n";
				}
				?>
			</div>
		</div>
	</div>

</div>



<?php get_footer(); ?>

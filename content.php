<?php
/**
 * The default template for displaying content
 */
?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
		<!-- /post thumbnail -->
		
		<!-- post title -->
		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>
		<!-- /post title -->
		
		<?php html5wp_excerpt('html5wp_custom_post'); ?>
		
		<!-- post details -->
		<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
		<span class="author"><?php _e( 'Published by', 'o3world' ); ?> <?php the_author_posts_link(); ?></span>
		<span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'o3world' ), __( '1 Comment', 'o3world' ), __( '% Comments', 'o3world' )); ?></span>
		<!-- /post details -->
		
		
		
		<?php edit_post_link(); ?>
		
	</article>
	<!-- /article -->
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

		<header class="entry-header">
			<?php
		
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
				endif;
			?>
		
			<div class="entry-meta">
				<?php
					if ( 'post' == get_post_type() )
						the_time('F jS, Y');
						
					if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) ) : ?>
						
						Posted in: <span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'o3world' ) ); ?></span>
					
				<?php
					endif;
		
					if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
				?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave your thoughts', 'o3world' ), __( '1 Comment', 'o3world' ), __( '% Comments', 'o3world' )); ?></span>
				<?php
					endif;
		
					edit_post_link( __( 'Edit', 'o3world' ), '<span class="edit-link">', '</span>' );
				?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
		
		<?php if ( is_search() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php html5wp_excerpt('html5wp_custom_post'); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
		
		<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
		
	</article>
	<!-- /article -->
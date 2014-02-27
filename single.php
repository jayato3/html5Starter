<?php get_header(); ?>
	
	<!-- section -->
	<section role="main">
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
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
						if ( 'post' == get_post_type() ) ?>
							<span class="time"><?php the_time('F jS, Y'); ?></span>
					<?php		
						if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) ) : ?>
							
							Posted in: <span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'o3world' ) ); ?></span>
						
					<?php
						endif;
					?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->
			
			<?php if ( is_search() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<?php else : ?>
			<div class="entry-content">
				<?php
	
					the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'o3world' ) );
	
					wp_link_pages( array(
						'before'	   => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'o3world' ) . '</span>',
						'after'	   => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php endif; ?>
			
			<?php the_tags( '<footer class="entry-meta">Tags: <span class="tag-links">', ', ', '</span></footer>' ); ?>
			
		</article>
		<!-- /article -->
		
		<?php comments_template(); ?>
		
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<!-- article -->
		<article>
			
			<h1><?php _e( 'Sorry, nothing to display.', 'o3world' ); ?></h1>
			
		</article>
		<!-- /article -->
	
	<?php endif; ?>
	
	</section>
	<!-- /section -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
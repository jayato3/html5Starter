<?php get_header(); ?>
	
	<!-- section -->
	<section role="main">
	
		<h1><?php printf( __( 'Category Archives: %s', 'o3world' ), single_cat_title( '', false ) ); ?></h1>
		
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			
			<?php get_template_part( 'content' ); ?>
			
			<?php endwhile; ?>
		
		<?php else: ?>
		
			<?php 
			// If no content, include the "No posts found" template.
			get_template_part( 'content', 'none' );
			?>
		
		<?php endif; ?>
		
		<?php get_template_part('pagination'); ?>
	
	</section>
	<!-- /section -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
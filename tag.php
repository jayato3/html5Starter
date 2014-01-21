<?php get_header(); ?>
	
	<!-- section -->
	<section role="main">
	
		<h1><?php _e( 'Tag Archive: ', 'o3world' ); echo single_tag_title('', false); ?></h1>
	
		<?php
		
		// Start the Loop.
		while ( have_posts() ) : the_post();
		
		get_template_part( 'content' );
		
		endwhile;
		
		?>
		
		<?php get_template_part('pagination'); ?>
	
	</section>
	<!-- /section -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
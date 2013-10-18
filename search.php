<?php get_header(); ?>
	
	<!-- section -->
	<section role="main">
	
		<h1><?php echo sprintf( __( '%s Search Results for ', 'o3world' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>
		
		<?php get_template_part('loop'); ?>
		
		<?php get_template_part('pagination'); ?>
	
	</section>
	<!-- /section -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
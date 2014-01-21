<?php get_header(); ?>
	
	<!-- section -->
	<section role="main">
	
		<h1><?php _e( 'Latest Posts', 'o3world' ); ?></h1>
	
		<div id="content">
		
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			
			<?php get_template_part( 'content' ); ?>
			
		<?php endwhile; ?>
		
		<?php endif; ?>
		
		</div>
	
	</section>
	<!-- /section -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
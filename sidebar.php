<!-- sidebar -->
<aside class="sidebar" role="complementary">

	<?php get_template_part('searchform'); ?>
	
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="sidebar-widget">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #primary-sidebar -->
	<?php endif; ?>
		
</aside>
<!-- /sidebar -->
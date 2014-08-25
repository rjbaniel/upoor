<div id="left">

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar(1) ) : ?>

	<h2><?php _e("Recent Posts",TEMPLATE_DOMAIN); ?></h2>
	<ul>
	<?php wp_get_archives('postbypost', 10); ?>
	</ul>

	<h2><?php _e("Archives",TEMPLATE_DOMAIN); ?></h2>
	<ul>
	<?php wp_get_archives('type=monthly'); ?>
	</ul>

	<h2><?php _e("Topics",TEMPLATE_DOMAIN); ?></h2>
	<ul><?php wp_list_categories('sort_column=name'); ?>
	</ul>

	<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>				
		<h2><?php _e("Meta",TEMPLATE_DOMAIN); ?></h2>
		<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<?php wp_meta(); ?>
		</ul>
	<?php } ?>

<?php endif; ?>

</div> <!-- end of left -->

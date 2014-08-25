<div id="sidebar">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>   
	<h2><?php _e("Recent Posts",TEMPLATE_DOMAIN); ?></h2>
	<ul>
	<?php wp_get_archives('postbypost', 10); ?>
	<li class='footbar'>&nbsp;</li>
	</ul>
	
	<h2><?php _e("Archives",TEMPLATE_DOMAIN); ?></h2>
	<ul>
	<?php wp_get_archives('type=monthly'); ?>
	<li class='footbar'>&nbsp;</li>
	</ul>

	<h2><?php _e("Topics",TEMPLATE_DOMAIN); ?></h2>
	<ul><?php wp_list_categories('sort_column=name'); ?>
	<li class='footbar'>&nbsp;</li>
	</ul>

<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>				
	<h2><?php _e("Meta",TEMPLATE_DOMAIN); ?></h2>
	<ul>
	<?php wp_register(); ?>
	<li><?php wp_loginout(); ?></li>
	<?php wp_meta(); ?>
	<li class='footbar'>&nbsp;</li>
	</ul>
	<?php } ?>
	
<?php endif; ?>

</div> <!-- end of sidebar -->

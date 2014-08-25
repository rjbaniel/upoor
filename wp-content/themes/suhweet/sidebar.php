<?php
/*
Template Name: Sidebar Right (the wide one)
*/
?>

<div id="contentright">

	<div id="sidebar">
		<ul>
		<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar(2) ) : ?>


      	<?php wp_list_pages('title_li=' . __('<h2>Pages</h2>',TEMPLATE_DOMAIN) ); ?>

			<li><h2><?php _e("Recent Post",TEMPLATE_DOMAIN); ?></h2>
				<ul>
				<?php wp_get_archives('postbypost', 10); ?>      
				</ul>
			</li>

			<?php wp_list_categories('show_count=1&title_li=' . __('<h2>Categories</h2>',TEMPLATE_DOMAIN) ); ?>



		<?php endif; ?>
		</ul>
	</div>

</div>

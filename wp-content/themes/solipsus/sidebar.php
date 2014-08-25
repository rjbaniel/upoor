</div>

<div id="sidebar">

<ul>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : ?>

		</ul>
	</div>
<?php return; ?>

<?php endif; ?>

	<li>
		<h2><?php _e('Search',TEMPLATE_DOMAIN); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</li>

	<?php wp_list_pages('depth=1&title_li=<h2>' . __('Pages') . '</h2>' ); ?>


	<li>
		<h2><?php _e('Archives',TEMPLATE_DOMAIN); ?></h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</li>


	<li>
		<h2><?php _e('Categories',TEMPLATE_DOMAIN); ?></h2>
		<ul>
			<?php wp_list_categories(); ?> 
		</ul>
	</li>


	<li>
		<h2><?php _e('Calendar',TEMPLATE_DOMAIN); ?></h2>
		<div class="text">
			<?php get_calendar(1); ?>
		</div>
	</li>


	<?php wp_list_bookmarks(); ?>
		
	<li>
		<h2><?php _e('Meta',TEMPLATE_DOMAIN); ?></h2>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</li>


</ul>

</div>

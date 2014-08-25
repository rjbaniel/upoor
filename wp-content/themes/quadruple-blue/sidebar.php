		<div id="left_sidebar">
<ul>

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>

	<?php wp_list_pages('depth=3&title_li=<h2>' . __('Pages',TEMPLATE_DOMAIN) . '</h2>'); ?>

	<?php wp_list_bookmarks(); ?>


	<li><h2><?php _e('Meta',TEMPLATE_DOMAIN); ?></h2>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS',TEMPLATE_DOMAIN); ?>" class="feed"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>',TEMPLATE_DOMAIN); ?></a></li>
			<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('Syndicate comments using RSS',TEMPLATE_DOMAIN); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>',TEMPLATE_DOMAIN); ?></a></li>

			<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network',TEMPLATE_DOMAIN);?>"><?php _e("XFN",TEMPLATE_DOMAIN); ?></abbr></a></li>
			<?php wp_meta(); ?>
		</ul>
	</li>

<?php endif; ?>

</ul>
		</div><!-- end sidebar -->

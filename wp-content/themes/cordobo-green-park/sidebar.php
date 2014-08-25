
<!-- begin left sidebar -->
<div id="navibar">
         <div class="links">
		<ul>
			<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Left Navigation') ) : else : ?>
	<li><h2><?php _e('Categories','cordobo');?></h2>
				<ul>
				<?php wp_list_categories(); ?>
				</ul>
	</li>
<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	<li><h2><?php _e('Meta','cordobo'); ?></h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="feed:<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
					<li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
					<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>

					<?php wp_meta(); ?>
				</ul>
	</li>
<?php if (function_exists('wp_theme_switcher')) { ?>
	<li><h2><?php _e('Themes','cordobo'); ?></h2>
					<?php wp_theme_switcher(); ?>
	</li>
<?php } ?>
<?php endif; ?>
</ul>
		</div> <!-- /links -->
	<div id="navi_end_left"> </div>
</div> <!-- /navibar -->
<!-- begin right sidebar -->
<div id="right">
	<div class="links">
		<ul>
			<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Right Sidebar') ) : else : ?>
	<li><h2><?php _e('Last Entries','cordobo'); ?></h2>
		<ul><?php wp_get_archives('postbypost', '10', 'custom', '<li>', '</li>'); ?></ul>
	</li>
	<?php wp_list_bookmarks(); ?>
	<li><h2><?php _e('Archives','cordobo'); ?></h2>
		<ul><?php wp_get_archives('type=monthly'); ?></ul>
	</li>
<?php endif; ?>
</ul>
		</div> <!-- /links -->
	<div id="navi_end_right"> </div>
</div> <!-- end right sidebar -->

	<div id="sidebar">
		<ul>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>			
			<li>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</li>

			<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
			<li><h2><?php // _e('Author'); ?></h2>
			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
			</li>
			-->


    <ul> 
      <li id="calendar"> 
        <?php get_calendar(); ?> 
      </li> 
    </ul> 
	<?php if (function_exists('wp_theme_switcher')) { ?>
<ul><li><h2><?php _e('Themes',TEMPLATE_DOMAIN); ?></h2>
<?php wp_theme_switcher('dropdown'); ?>
</li></ul>
<?php } ?>
			<?php wp_list_pages('title_li=<h2>' . __('Pages') . '</h2>' ); ?>

			<li><h2><?php _e('Archives',TEMPLATE_DOMAIN); ?></h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>

			<li><h2><?php _e('Categories'); ?></h2>
				<ul>
				<?php wp_list_categories(0, '', 'name', 'asc', '', 1, 0, 1, 1, 1, 1, 0,'','','','','') ?>
				</ul>
			</li>

			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>				
				<?php wp_list_bookmarks(); ?>
				
				<li><h2><?php _e('Meta',TEMPLATE_DOMAIN); ?></h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>

					<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>

					<?php wp_meta(); ?>
				</ul>
				</li>
			<?php } ?>
			<?php endif; ?>
		</ul>
	</div>


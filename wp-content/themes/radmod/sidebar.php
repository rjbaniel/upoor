	<div id="sidebar">
		<ul>	<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?><!--
			<li><h2><?php _e('Author'); ?></h2>
			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
			</li>
			-->





			<li><h2><?php _e('Archives',TEMPLATE_DOMAIN); ?></h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>

			<li><h2><?php _e('Categories',TEMPLATE_DOMAIN); ?></h2>
				<ul id="categories">
				<?php wp_list_categories('sort_column=name'); ?>								
				</ul>
			</li>
			<li>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</li>
			<!--			
			Requires Krischan Jodies' Get Recent Comments plug-in, which you can get at:
			http://blog.jodies.de/archiv/2004/11/13/recent-comments/
			-->			
			
			<?php if (function_exists('get_recent_comments')) { ?>
				<li><h2><?php _e('Recent Comments',TEMPLATE_DOMAIN);?></h2>
				<ul id="recentComments">
				<?php get_recent_comments(5,25,'<li><a href="%comment_link"><strong>%comment_author</strong>: %comment_excerpt</a></li>'); ?>
				</ul>
				</li>
			<?php } ?>
			
			<?php /* If this is the frontpage */ if ( is_home() ) { ?>				
				
				<li><h2><?php _e('Links',TEMPLATE_DOMAIN);?></h2><ul id="links"><?php wp_list_bookmarks(); ?></ul></li>

			<?php } ?>
			
			<?php if (function_exists('wp_theme_switcher')) { ?>
				<li><h2><?php _e('Themes',TEMPLATE_DOMAIN); ?></h2>
				<?php wp_theme_switcher(); ?>
				</li>
			<?php } ?>
			

			<?php wp_meta(); ?>
			<br />
			<a href="feed:<?php bloginfo('rss2_url'); ?>">Entries RSS</a><br />
			<a href="feed:<?php bloginfo('comments_rss2_url'); ?>">Comments RSS</a><br /><br />
           <?php if( SHOW_AUTHORS != 'false') { ?>
RadMod theme <?php _e('designed by',TEMPLATE_DOMAIN);?> <a href="http://www.radicalgeorgiamoderate.org/">Rusty</a><br /><?php } ?>
		   <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
			</li>			
<?php endif; ?>		</ul>
<div class="filler"></div>
	</div>
      

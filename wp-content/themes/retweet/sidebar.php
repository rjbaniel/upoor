<div id="side">
<ul>
<?php if (is_single() || is_page() || is_attachment() ) { ?> 
	<li>
		<div id="rssfeed">
		<?php $options = get_option('classic_options'); ?>
		<a title="<?php bloginfo('name'); ?> RSS Feed" type="application/rss+xml" rel="alternate" href="<?php if($options['retweet_rss']) : ?><?php echo($options['retweet_rss']); ?><?php else: ?><?php bloginfo('rss2_url'); ?><?php endif; ?>">RSS feed</a>
		</div>
	</li>
<?php } ?>
	<li>
		<?php include(TEMPLATEPATH . '/searchform.php'); ?>
	</li>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
	<li>
		<h3><?php _e('Categories', 'retweet'); ?></h3>
		<ul>
        	<?php wp_list_categories('sort_column=name&hierarchical=0'); ?>
		</ul>
	</li>
	<li>
		<h3><?php _e('Links', 'retweet'); ?></h3>
		<ul>
			<?php get_bookmarks(2, '<li>', '</li>', '', TRUE, 'url', FALSE); ?>
		</ul>
	</li>
	<li>
		<h3><?php _e('Archives', 'retweet'); ?></h3>
		<ul>
        	<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</li>
<?php endif; ?>

</ul>
</div>

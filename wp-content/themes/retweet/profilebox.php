<div id="profilebox_outer">
	<div id="profilebox" class="clearfix">
		<div id="profilebird">
			<img id="profilebirdimg" height="48" width="48" src="<?php bloginfo('template_directory'); ?>/images/profile_bird.png" alt="Profile_bird"/>
		</div>
		<div id="profiletext">
<?php $options = get_option('classic_options'); ?>
<?php if($options['retweet_notice'] && $options['retweet_notice_content']) : ?>
			<div id="retweet_notice_content"><?php echo($options['retweet_notice_content']); ?></div>
<?php endif; ?>
<?php if($options['retweet_twitter_username'] && $options['retweet_twitter_number']) : ?>
			<div id="twitter_div">
				<h3 class="sidebar-title">Twitter Updates</h3>
				<ul id="twitter_update_list"><li class="loading">Loading...</li></ul>
				<a href="http://twitter.com/<?php echo($options['retweet_twitter_username']); ?>" id="twitter-link" style="display:inline-block;float:right;">follow me on Twitter</a>
			</div>
<?php else: ?>
			<h3><?php _e('Recent Posts','retweet'); ?></h3>
			<ul>
				<?php wp_get_archives('postbypost', '5', 'custom', '<li>', '</li>'); ?>
			</ul>
<?php endif; ?>
		</div>
		<div id="profilebutton">
			<div class="rss_icon"><a rel="external" href="<?php if($options['retweet_rss']) : ?><?php echo($options['retweet_rss']); ?><?php else: ?><?php bloginfo('rss2_url'); ?><?php endif; ?>" title="<?php _e('Subscribe my blog','retweet'); ?>"><?php _e('Subscribe my blog','retweet'); ?></a></div>
			<div id="rss_button">
				<a href="http://fusion.google.com/add?feedurl=<?php if($options['retweet_rss']) : ?><?php echo($options['retweet_rss']); ?><?php else: ?><?php bloginfo('rss2_url'); ?><?php endif; ?>" rel="external nofollow" class="rssbutton greader" title="<?php _e('Subscribe my blog','retweet'); ?> via Google Reader">Google Reader</a>
				<a href="http://www.newsgator.com/ngs/subscriber/subfext.aspx?url=<?php if($options['retweet_rss']) : ?><?php echo($options['retweet_rss']); ?><?php else: ?><?php bloginfo('rss2_url'); ?><?php endif; ?>" rel="external nofollow" class="rssbutton newsgator" title="<?php _e('Subscribe my blog','retweet'); ?> via NewsGator">NewsGator</a>
				<a href="http://www.bloglines.com/sub/<?php if($options['retweet_rss']) : ?><?php echo($options['retweet_rss']); ?><?php else: ?><?php bloginfo('rss2_url'); ?><?php endif; ?>" rel="external nofollow" class="rssbutton bloglines" title="<?php _e('Subscribe my blog','retweet'); ?> via Bloglines">Bloglines</a>
			</div>
			<?php include (TEMPLATEPATH . '/bookmarklet.php'); ?>
		</div>
	</div>
	<div class="closebox"><a href="#" onclick="$('#profilebox_outer').slideUp(500);"><?php _e('Close', 'retweet') ?></a></div>
</div>

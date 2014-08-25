	<div id="footer" class="round">
		<ul>  <li>&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.</li>
<?php if( SHOW_AUTHORS != 'false') { ?>
			<li><a href="http://sivan.in/blog/" title="Retweet Theme by Sivan">Retweet Theme</a></li>
			<li><a href="http://validator.w3.org/check?uri=referer">XHTML 1.0</a></li>
			<li><a href="http://jigsaw.w3.org/css-validator/">CSS 3</a></li><?php } ?>
             <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<li><?php _e('Hosted by', TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a></li>
<?php } ?>
		</ul>
	</div>
</div>
<?php if(isset($_COOKIE["comment_author_" . COOKIEHASH]) && $_COOKIE["comment_author_" . COOKIEHASH]!=""): ?>
	<script type="text/javascript">
		document.title = "<?php printf(__('Welcome back %s,you are reading ', 'retweet'), $_COOKIE["comment_author_" . COOKIEHASH]) ?>" + document.title
	</script>
<?php endif; ?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/all.js"></script>
<?php $options = get_option('classic_options'); ?>
<?php if($options['retweet_reply']==true):?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/comment_reply.js"></script>
<?php endif;?>
<?php if (is_home() ) { ?>
<?php if($options['retweet_twitter_username'] && $options['retweet_twitter_number']) : ?>
	<script type="text/javascript" src="https://twitter.com/javascripts/blogger.js"></script>
	<script type="text/javascript" src="https://twitter.com/statuses/user_timeline/<?php echo($options['retweet_twitter_username']); ?>.json?callback=twitterCallback2&amp;count=<?php echo($options['retweet_twitter_number']); ?>"></script>
<?php endif; ?>
<?php } ?>
<?php wp_footer(); ?>
<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds -->
</body>
</html>

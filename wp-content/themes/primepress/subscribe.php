<div id="pp-subscribe" class="clearfix<?php if ($pp_feed_id) echo ' pp-email-true'; ?>">

	<ul class="clearfix">

	<li id="pp-feed">

		<a href="<?php if ($pp_feed_address) {echo $pp_feed_address;} else {bloginfo('rss2_url');} ?>" title="Subscribe to this Feed via RSS"><?php _e('Subscribe <span class="email-narrow">to our Feed</span> via RSS', 'primepress'); ?></a>

	</li>



	<?php if ($pp_feed_id) { ?>

	<li id="pp-email">

		<a target="_blank" href="http://www.feedburner.com/fb/a/emailverifySubmit?feedId=<?php echo $pp_feed_id; ?>" title="<?php _e('Subscribe via Email', 'primepress'); ?>" ><?php _e('Subscribe via eMail', 'primepress'); ?></a>

	</li>

	<?php } ?>

	</ul>

</div>

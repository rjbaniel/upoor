<hr />
<div id="footer">
	<p>
		
		&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?>
		<a href="http://www.nikynik.com">NikyNik Theme</a><?php } ?><br />
        <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
&nbsp;&nbsp;&nbsp;<?php } ?>
		<a href="feed:<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a>
		and <a href="feed:<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>.
   <br />
   <?php wp_footer(); ?>
  </p>
</div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
<?php /* "Just what do you think you're doing Dave?" */ ?>


</body>
</html>

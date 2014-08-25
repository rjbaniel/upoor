

<div id="footer">
	<p>
	   &copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?> <?php if( SHOW_AUTHORS != 'false') { ?><?php _e('is proudly Provided by'); ?>
		<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><br /><?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
		<br /><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)',TEMPLATE_DOMAIN);?></a>
		<?php _e('and ',TEMPLATE_DOMAIN);?> <a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)',TEMPLATE_DOMAIN);?></a>.<br />
        <?php wp_footer(); ?>
	</p>
</div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
<?php /* "Just what do you think you're doing Dave?" */ ?>



</body>
</html>

</div><!-- //wrapper -->

<div id="footer">&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.<br />
<a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate Entries using RSS 2.0') ?>"><?php _e('Entries XML') ?></a> | <a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('Syndicate Comments using RSS 2.0') ?>"><?php _e('Comments XML') ?></a>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'fauna'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
<br /><?php wp_footer(); ?>
</div>



</body>
</html>

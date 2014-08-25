    <div class="clear"></div>
</div>

<hr />
<div id="footer">
<!-- If you'd like to support WordPress, having the "Provided by" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
	<p>
    &copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.<br />
<a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)');?></a> <?php _e('and');?> <a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)');?></a>.<br />
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><?php _e('Hosted by', TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
		<!-- <?php echo get_num_queries(); ?> <?php _e('queries');?>. <?php timer_stop(1); ?> <?php _e('seconds');?>. -->
	</p>
</div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
<?php /* "Just what do you think you're doing Dave?" */ ?>

		<?php wp_footer(); ?>
</body>
</html>

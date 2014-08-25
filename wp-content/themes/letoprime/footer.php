
<hr />
<div id="footer">
	<p>
		&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;&nbsp;<a href="http://misguidedthoughts.com/">LetoPrime</a> theme.<br />
        <?php } ?>&nbsp;&nbsp;&nbsp;<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
		<br /><a href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)',TEMPLATE_DOMAIN);?></a>
		<?php _e("and",TEMPLATE_DOMAIN); ?> <a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)',TEMPLATE_DOMAIN);?></a>.
		<!-- <?php echo get_num_queries(); ?> <?php _e('queries');?>. <?php timer_stop(1); ?> <?php _e('seconds');?>. -->
	</p>
</div><!-- end footer -->
</div>  <!-- end page -->
<?php ?>
		<?php wp_footer(); ?>
</body> 
</html>

</div>
<div id="footer"><?php echo date('Y');?> &copy; <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?> is proudly using the <a href="http://patrick.bloggles.info">WordPress II Silver</a> theme.<?php } ?><br /><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>&nbsp;&nbsp;<?php } ?> <a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)');?></a> <?php _e('and ',TEMPLATE_DOMAIN);?> <a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)');?></a>.
</div>
<?php wp_footer(); ?>
</body>
</html>


<div id="footer">&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.
<?php if( SHOW_AUTHORS != 'false') { ?><br />With <a href="http://www.azeemazeez.com/stuff/themes/" title="White as Milk theme for Wordpress">White as Milk Theme</a> <?php _e('designed by');?> <a href="http://www.azeemazeez.com">Azeem Azeez</a>.<?php } ?><br />
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries');?></a> <?php _e('and ');?> <a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('comments');?></a> feeds.


</div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
<?php /* "Just what do you think you're doing Dave?" */ ?>

 <?php wp_footer(); ?>

</body>
</html>

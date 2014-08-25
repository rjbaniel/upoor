<div id="footer">&nbsp;&nbsp;
<small>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>&nbsp;&nbsp;&nbsp;<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>&nbsp;&nbsp;&nbsp;<?php _e('Hosted by', TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><?php } ?>
<?php if( SHOW_AUTHORS != 'false') { ?> - <?php _e('Designed by');?> <a href="http://theundersigned.net">the undersigned</a>.<?php } ?></small>
<?php wp_footer(); ?>

</div>

</div>
</body>
</html>

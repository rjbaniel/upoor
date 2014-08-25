<div id="footer">

  <p>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;&nbsp;<?php _e('designed by',TEMPLATE_DOMAIN);?> <a href="http://vaguedream.com/wordpress-themes">Stephen Reinhardt</a><br />
<?php } ?>&nbsp;&nbsp;&nbsp;<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br /><?php wp_footer(); ?></p>
</div>
</div>

</body></html>

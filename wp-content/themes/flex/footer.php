<!-- begin footer -->
<div id="footer">
<p>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;&nbsp;&nbsp;Using the <a href="http://www.ifelse.co.uk/flex">Flex theme</a> <?php _e('designed by');?> Phu Ly.<br />
<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;&nbsp;<?php _e('Hosted by', 'flex'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
</p>
<?php wp_footer(); ?>
</div>
</div>

</body>
</html>

</div><div id="footer">	<p>&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?> <?php if( SHOW_AUTHORS != 'false') { ?>&#8212; <a href="http://www.copyblogger.com">Copyblogger</a> theme design by <a href="http://pearsonified.com">Chris Pearson</a>.<?php } ?><br /> <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;&nbsp;<?php _e('Hosted by', 'copyblogger'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>
<br /><?php wp_footer(); ?>
</p>	</div></body></html>

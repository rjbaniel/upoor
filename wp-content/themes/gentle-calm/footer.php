<!-- begin footer -->
</div>
<div id="footer">
<p>
&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.
<?php if( SHOW_AUTHORS != 'false') { ?><br />
<?php _e('Using the','gentle-calm'); ?> <a href="http://www.ifelse.co.uk/gentle-calm">Gentle Calm theme</a>
&nbsp;<?php _e('designed by','gentle-calm');?> <a href="http://www.ifelse.co.uk">Phu Ly</a>.<br /><?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'gentle-calm'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br />
<?php wp_footer(); ?>

</p>
	</div>


</body>
</html>

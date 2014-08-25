	<div id="footer">
		<p>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><br /><?php if( SHOW_AUTHORS != 'false') { ?>Provided by &nbsp;&mdash;&nbsp;<a href="http://cutline.tubetorial.com/">Cutline</a> by <a href="http://www.tubetorial.com">Chris Pearson</a><br /><?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Hosted by', 'cutline'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br /><?php wp_footer(); ?> 
</p>

	</div>
</div>
    </div>   
</body>
</html>

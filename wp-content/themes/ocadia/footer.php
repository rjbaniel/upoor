<div id="footer">
<p>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>&nbsp;&nbsp;&nbsp;
<?php if( SHOW_AUTHORS != 'false') { ?><br />
<a href="http://beccary.com" rel="designer"><?php _e('Design by Beccary'); ?></a><?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by',TEMPLATE_DOMAIN); ?><a target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>">
<?php echo $current_network_site->site_name; ?></a>
<?php } ?><br />
<?php wp_footer(); ?>
</p>
</div>

</div>



</body>
</html>	

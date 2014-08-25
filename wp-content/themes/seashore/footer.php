</div><?php //closing for #main?>
<div id="footer">
  <?php // Please leave the footer credits intact ?>
	<p><span><a href="<?php bloginfo('url'); ?>/wp-admin/" title="Site Admin">Site Admin</a> </span><strong><?php bloginfo('name');?></strong> Copyright &copy; <?php echo date('Y');?> All Rights Reserved. <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br />
<?php wp_footer();?> 
</p>
</div>

</body>
</html>

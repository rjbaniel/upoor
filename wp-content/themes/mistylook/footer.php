<div id="footer">
<p><strong><?php bloginfo('name');?></strong> &copy; <?php echo date(__('Y','ml'));?> <?php _e('All Rights Reserved.','ml');?></p>
<p class="right">
	<span><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><?php if( SHOW_AUTHORS != 'false') { ?>  <br />
    <a href="http://wpthemes.info/misty-look/" title="<?php _e('MistyLook WordPress Theme by Sadish Bala','ml');?>">Misty Look</a> by Sadish<?php } ?></span>
</p>
<br class="clear" />
</div><!-- end id:footer -->
<?php wp_footer();?>

</body>
</html>

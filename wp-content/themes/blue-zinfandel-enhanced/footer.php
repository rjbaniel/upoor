<!-- begin footer -->





<div style="clear:both;"></div>


<div style="clear:both;"></div>


</div>





<div id="footer">


&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?> <?php if( SHOW_AUTHORS != 'false') { ?>&bull; <?php _e('Using');?> <a href="http://www.briangardner.com/themes/blue-zinfandel-wordpress-theme.htm" >Blue Zinfandel 2.0</a> theme created by <a href="http://www.briangardner.com" >Brian Gardner</a>. <?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
 <?php _e('Hosted by', 'blue-zinfandel'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br />
<?php wp_footer(); ?>

</div>









</div> 

</body>


</html>

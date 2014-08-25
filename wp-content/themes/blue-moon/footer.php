<?php $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>


<div id="footer">
&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.
<?php if( SHOW_AUTHORS != 'false') { ?><br /> 
<?php _e('Designed by');?> <a href="http://vaguedream.com/">Stephen Reinhardt</a>.<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><br />
<?php _e('Hosted by', 'blue-moon'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
<br />
<?php wp_footer(); ?>


</div>


</div>





</body></html>



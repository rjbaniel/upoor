</div>


<div class="clearingdiv">&nbsp;</div>


</div>





<div id="footer">
&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?> &nbsp;&nbsp;&nbsp;<?php _e('Designed by', 'andreas09');?> <a href="http://andreasviklund.com">Andreas Viklund</a>.<br />
<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Hosted by', 'andreas09'); ?>  <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>">
<?php echo $current_network_site->site_name; ?></a>
<?php } ?><br />
<?php wp_footer(); ?>

</div>











</body>





</html>



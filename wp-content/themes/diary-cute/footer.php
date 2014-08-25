<div id="footer-top">

	<div id="footer">



			<p id="footer-left">&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.</p>

			<p id="footer-right"><?php if( SHOW_AUTHORS != 'false') { ?>Designed by <a href="http://pageblogging.net/" title="page">page</a>.<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><?php _e('Hosted by', 'diary-cute'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br /><br /><?php wp_footer(); ?></p>







		<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->

		

	

	</div>

</div>



<?php
$options = get_option('page_options');
if ($options['analytics']) {
echo($options['analytics_content']);
}
?>



</div>

</body>

</html>

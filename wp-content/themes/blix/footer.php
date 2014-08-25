

<hr class="low" />



<!-- footer ................................. -->

<div id="footer">



	<p>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;&nbsp;Theme: Blix by <a href="http://www.kingcosmonaut.de/" rel="designer">Sebastian Schmieg</a>. <?php } ?><br /><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'blix'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?></p>

	<?php wp_footer(); ?>



</div> <!-- /footer -->



</div> <!-- /container -->



</body>



</html>


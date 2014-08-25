


<!-- begin footer -->





<div id="footer">


	<div id="footer_left_bg">
		<p>&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.
 <?php /** Please support the future development of Wordpress and Cordobo Green Park - Leave the credits **/ ?>

<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'cordobo'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>

		</p>


	</div>


	<?php wp_footer(); ?>


</div> <!-- /footer -->





	</div> <!-- /wrapper -->


</div> <!-- /container -->





</body>


</html>



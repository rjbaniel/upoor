<?php include (TEMPLATEPATH . '/right_sidebar.php'); ?>

		</div></div><!-- wide column wrap -->

	</div><!-- end page -->

	<div id="footer">
<p>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?> <?php if( SHOW_AUTHORS != 'false') { ?><a href="http://www.wpdesigner.com" title="WordPress Themes">WPDesigner</a>.<?php } ?> <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
</p>
	</div>

</div>
<?php wp_footer(); ?>
</body>
</html>

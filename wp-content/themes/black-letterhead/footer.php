<hr />
<div id="footer">
	<p class="center">
		&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><br />

       <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by','black-letterhead'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br />

	   
	</p>
</div>
</div>

<!-- Design by Robin Hastings - http://www.rhastings.net/ -->
<!-- Colors modified by Ulysses Ronquillo - http://ulyssesonline.com/ -->

		<?php wp_footer(); ?>

</body>
</html>

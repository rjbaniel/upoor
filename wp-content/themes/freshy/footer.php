
<hr style="display:none"/>

<div id="footer">
	<small class="footer_content">
   &copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><br />
	<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>Theme: Freshy by <a href="http://www.jide.fr/">Jide</a><?php } ?>
	</small>
<?php wp_footer(); ?>
</div>

</div> <!--- end of the <div id="page"> (from header.php) -->

</body>
</html>

		

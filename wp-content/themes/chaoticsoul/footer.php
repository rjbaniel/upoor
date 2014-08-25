</div>

<div class="hr">&nbsp;</div>
<div id="footer">
	<p>
	   &copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;&nbsp;<?php _e('Hosted by', 'chaoticsoul'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><?php } ?><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;&nbsp;Theme: ChaoticSoul by <a href="http://avalonstar.com" rel="designer">Bryan Veloso</a>. <?php } ?><br />
<?php wp_footer(); ?>
	</p>
</div>
</div>


</body>
</html>

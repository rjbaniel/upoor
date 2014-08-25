</div>

<div id="footer">
	<p class="vcard">&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.<?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;&nbsp;&nbsp;The Journalist template by <a href="http://lucianmarin.com/" class="fn url" rel="designer">Lucian E. Marin</a> <?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><br /><?php _e('Hosted by', 'journalist'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?></p>
<?php wp_footer(); ?>  
</div>


</body>
</html>

				<div class="clear"></div>
			</div>
			<div id="footer">
				<p>&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?> <?php if( SHOW_AUTHORS != 'false') { ?>Proudly Provided by . Theme designed by <a href="http://technicalspeech.co.cc">Suhaib Khan</a>.<?php } ?><br /><a href="<?php bloginfo('rss2_url'); ?>">RSS Feed</a> | <a href="<?php bloginfo('atom_url'); ?>">Atom Feed</a>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'technical-speech'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br /><?php wp_footer(); ?>
</p>
			</div>
		</div>

	</body>
</html>

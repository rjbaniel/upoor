	</div>
	
	<div id="footer">
             <div class="rss"><a href="<?php bloginfo('rss2_url'); ?>" id="feed"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.jpg" alt="rss" /></a></div>
        <div id="footer-inner">
		<p>
			&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>
			<a href="<?php bloginfo('rss2_url'); ?>">Entries RSS</a>
			and <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments RSS</a>
		</p>
		<p><?php if( SHOW_AUTHORS != 'false') { ?>Theme Design by <a href="http://blog.gooddesignweb.com">Good Design Web</a><br /><?php } ?>
       <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'japan-stlye'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br /><?php wp_footer(); ?>
        </p>
	</div></div>


</body>
</html>

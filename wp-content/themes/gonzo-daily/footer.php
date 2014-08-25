<?php
	get_sidebar();
?>


	<div id="footer">
		<p>
       &copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><br /><?php if( SHOW_AUTHORS != 'false') { ?><a href="http://greatgonzo.net/projects/gonzodaily">GonzoDaily</a> theme by <a href="http://greatgonzo.net">Gonzo</a>.<br /><?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><?php _e('Hosted by', 'gonzo-daily'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
		</p>

		<p>
		<a href="<?php echo get_bloginfo('rss2_url'); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a>, <a href="<?php echo get_bloginfo('comments_rss2_url'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a>
		<!-- <br /><?php printf('%d queries. %s seconds.', get_num_queries(), timer_stop(0, 3)); ?> -->
            <br />
<?php wp_footer(); ?>
        	</p>
	</div>

    </div>
      </div>   
</body>

</html>

	<hr />
	<div id="footer">
	<!-- If you'd like to support WordPress, having the "Provided by" link someone on your blog is the best way, it's our only promotion or advertising. -->

    <p>
   &copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?><?php _e('Designed by');?> <a href="http://www.adityanaik.com/">Aditya Naik</a>.<br />
    <?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'greenday'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>

			<br /><br /><small><a href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)','greenday');?></a>
			and <a href="feed:<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)','greenday');?></a>.</small>
			<!-- <?php echo get_num_queries(); ?> <?php _e('queries');?>. <?php timer_stop(1); ?> <?php _e('seconds');?>. -->
            <br />	<?php wp_footer(); ?>
		</p>
	</div>
</div>
</div>


		<!-- jaanu mei jaan -->
</body>
</html>

			<div id="footer">
			<?php get_sidebar(); ?>
			<!-- If you'd like to support WordPress, having the "Provided by" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
			<p class="info">
					<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.png" alt="RSS" /></a>&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'monotone'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>.
<?php } ?><br />
<?php wp_footer(); ?>
				<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
			</p>
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</div>
	
		</div>
	</div>
</div>


</body>
</html>

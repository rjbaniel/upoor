
<div id="extra-content">
	
	<?php get_sidebar(); ?>

</div>

<div id="credits">
	
	<p id="site-information">
		<strong><?php _e('Content',TEMPLATE_DOMAIN);?> &copy; <?php bloginfo('name'); ?></strong><br/>
 <?php if( SHOW_AUTHORS != 'false') { ?>
		Theme <?php _e('designed by',TEMPLATE_DOMAIN);?> <a href="http://thedesigncanopy.com/">The Design Canopy</a><br /><?php } ?>
		<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
	</p>
	<p id="rss-feeds">
		<a class="rss-entries" href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)',TEMPLATE_DOMAIN);?></a><br/>
		<a class="rss-comments" href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)',TEMPLATE_DOMAIN);?></a>
	</p>
	<p id="site-run-stats">
		<?php echo get_num_queries(); ?> <?php _e('queries',TEMPLATE_DOMAIN);?>.<br/>
		<?php timer_stop(1); ?> <?php _e('seconds',TEMPLATE_DOMAIN);?>.
	</p>
	<span class="clearer"></span>
     <?php wp_footer(); ?>   
</div>


</div> 
</body>
</html>

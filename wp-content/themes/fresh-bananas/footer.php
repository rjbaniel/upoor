	</div>	<div id="sidebar">		<?php get_sidebar(); ?>	</div>

<div id="footer">		<?php // Note: You are not required to keep this link to me, but it sure is nice. Thank you! ?>		<p>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>&nbsp;&nbsp;&nbsp;<br /><?php if( SHOW_AUTHORS != 'false') { ?>Theme by <a href="http://nokrev.com" title="This theme was written by Jeff Wheeler">Jeff Wheeler</a>. <?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><br /><?php _e('Hosted by', 'fresh-bananas'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
<br /><?php wp_footer(); ?>
</p>

</div></div></body></html>

<div id="footer">
	<p>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><br /><a href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)');?></a>
		and <a href="feed:<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)');?></a>.
        <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
	</p>
</div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
<!-- further Gorgeous-ofied by Praveen Kumar - http://neoalchemist.com/ -->
<?php /* "ok, its too late now" */ ?>

		<?php wp_footer(); ?>

</body>
</html>

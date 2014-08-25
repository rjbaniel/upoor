<br clear="all" />

<div id="footer">
	<p>
   &copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.<br />
    <em><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;&nbsp;
<?php } ?>Theme by <a href="http://themes.star-shaped.org">Aubrey Brown</a><?php } ?> </p>

<p><strong>Feeds:</strong> <a href="<?php bloginfo('rss2_url'); ?>">RSS 2.0</a> . <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments RSS 2.0</a> . <a href="<?php bloginfo('atom_url'); ?>">Atom</a><?php wp_meta(); ?></p>

					
</div>

</div>

<?php /* "Just what do you think you're doing Dave?" */ ?>

<?php wp_footer(); ?>

</body>
</html>

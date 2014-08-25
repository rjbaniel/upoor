<div id="footer">
<p><span class="credits">&copy; <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> - <a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a> - <a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)', 'wp-andreas'); ?></a> - <?php wp_loginout(); ?></span><br /><?php if( SHOW_AUTHORS != 'false') { ?><a href="http://andreasviklund.com/wordpress-themes/">Theme design</a> by <a href="http://andreasviklund.com/" title="Original theme design by Andreas Viklund">Andreas Viklund</a> <?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><br /><?php _e('Hosted by', 'wp-andreas'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br />
<?php wp_footer(); ?></p>
</div>
</div>
</body>
</html>

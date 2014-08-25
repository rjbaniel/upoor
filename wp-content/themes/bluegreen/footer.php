</div>

</div>

<!--<div id="eof"></div>-->

<div id="footer">

<div class="footer">
&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.
<?php if( SHOW_AUTHORS != 'false') { ?>
<br /><?php _e('Designed by');?> <a href="http://www.blogohblog.com">Blog Oh Blog</a><?php } ?>
<br />
<a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)', 'bluegreen');?></a> <?php _e('and ', 'bluegreen');?> <a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)', 'bluegreen');?></a>.<br />

<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?> <?php _e('Hosted by', 'bluegreen'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
<br />
<?php wp_footer(); ?></div>

</div></div></body>

</html>

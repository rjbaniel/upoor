  <hr class="clear" />
</div><!--/page -->
<div id="credits">
<div class="alignleft">
&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.<br />
<?php if( SHOW_AUTHORS != 'false') { ?><a href="http://www.ndesign-studio.com/resources/wp-themes">WordPress Theme</a> &amp; <a href="http://www.ndesign-studio.com/stock-icons/">Icons</a> by <a href="http://www.ndesign-studio.com">N.Design Studio</a>.<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>&nbsp;&nbsp;&nbsp;<?php _e('Hosted by', 'glossyblue'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?> <br />
<?php wp_footer(); ?>

</div>
<div class="alignright"><a href="feed:<?php bloginfo('rss2_url'); ?>" class="rss"><?php _e('Entries RSS','glossyblue'); ?></a> <a href="feed:<?php bloginfo('comments_rss2_url'); ?>" class="rss"><?php _e('Comments RSS','glossyblue'); ?></a> <span class="loginout"><?php wp_loginout(); ?></span></div>
</div>

</body>
</html>

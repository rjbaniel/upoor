<div id="footer" class="g33">
&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?> <?php _e("is proudly Provided by",TEMPLATE_DOMAIN); ?> .
Doc theme by <a href="http://www.wp-content-themes.com/">Theme Museum</a>. <?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>&nbsp;&nbsp;&nbsp;<?php _e('Hosted by', 'doc'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><?php } ?>
<br /><br />
<?php wp_footer(); ?>
</div>

<div class="clear"></div>

</div>

</body>

</html>

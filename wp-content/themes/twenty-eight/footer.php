<div class="clear"></div></div><hr /><div id="footer"><small>
&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.
<?php if( SHOW_AUTHORS != 'false') { ?><br />Theme: 2813 by <a href="http://elifoner.com/">Eli</a>, <a href="http://www.pronetadvertising.com/about">Neil</a>, and <a href="http://paulstamatiou.com/">Paul</a>.<?php } ?>     <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><?php } ?></small></div>
<?php do_action('wp_footer'); ?></body></html>

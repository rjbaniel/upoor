<div id="foot"><div>
 
</div>
<span class="credit">
&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;|&nbsp;theme by <a href="http://www.tonystreet.com" target="_blank">tony</a> modified
by <a href="http://www.kupywrestlingwallpapers.info">mr. kupy</a> | <a href="http://www.pinkseo.info/ituloy-angsulong">Ituloy Angsulong</a><a href="http://www.guitarchic.net">!</a>.<br /><?php } ?> <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
<br />

</span>

<?php wp_footer(); ?>


<!-- End of StatCounter Code -->

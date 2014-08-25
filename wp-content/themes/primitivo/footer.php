<!-- begin footer -->

<!-- Do not deleting the credits, 
this theme is released for free under the GNU General Public License (GPL) requiring that the credits will stay intact.
I'd appreciate the credit being left in unmodified, thanks in advance -->



<!-- Footer -->
	<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
	<p>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;&nbsp;<a href="http://biboz.net/primitivo/">primitivo theme</a>.<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;&nbsp;<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?> </p>
</div>
<?php wp_footer(); ?>
<!-- End Footer -->
</div>  
</body>
</html>

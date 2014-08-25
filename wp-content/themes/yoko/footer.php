<?php
/**
 * @package WordPress
 * @subpackage Yoko
 */
?>

</div><!-- end wrap -->

	<footer id="colophon" class="clearfix">
		<p>Copyright &copy; <?php echo date('Y');?> <span class="sep"> | </span><?php printf( __( 'Theme: %1$s by %2$s', 'yoko' ), 'Yoko', '<a href="http://www.elmastudio.de/wordpress-themes/">Elmastudio</a>' ); ?><br /><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><br /><?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><br />
<?php } ?></p>
		<a href="#page" class="top"><?php _e( 'Top', 'yoko' ); ?></a>
	</footer><!-- end colophon -->
	
</div><!-- end page -->
<?php wp_footer(); ?>

</body>
</html>

<hr />
<div id="footer">
		<p class="footer"> &copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.<br />
        <?php if( SHOW_AUTHORS != 'false') { ?>
        The current theme is based on <A HREF="http://binarybonsai.com/kubrick/">Kubrick</A> and is called <a href="http://theloo.org/2005/02/06/first-1999-crop-circles-in-canada/">Crop Circles (1.5)</a>.<br />These pages validate in <a class="footerLink" href="http://validator.w3.org/check/referer">XHTML</a> and <a class="footerLink" href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> minus plugins.
<br />
By the way, <?php echo $wpdb->num_queries; ?> aliens landed in your backyard <?php timer_stop(1); ?> seconds ago.<br />
<?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php _e('Hosted by', 'cropcircles'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>.
<?php } ?></p>
 </div>
</div>

<?php wp_footer(); ?>

</body>
</html>

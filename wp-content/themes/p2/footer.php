<?php
/**
 * @package WordPress
 * @subpackage P2
 */
?>
	<div class="clear"></div>
	
</div> <!-- // wrapper -->

<div id="footer">
	<p>
	  &copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;&nbsp;<?php printf(__('P2 theme by %s.', 'p2'), '<a href="http://automattic.com/">Automattic</a>'); ?><?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'p2'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><br />
<?php } ?><?php wp_footer() ?>
	</p>
</div>

<div id="notify"></div>

<div id="help">
	<dl class="directions">
		<dt>c</dt><dd><?php _e( 'compose new post', 'p2' ); ?></dd>
		<dt>j</dt><dd><?php _e( 'next post/next comment', 'p2' ); ?></dd>
		<dt>k</dt> <dd><?php _e( 'previous post/previous comment', 'p2' ); ?></dd>
		<dt>r</dt> <dd><?php _e( 'reply', 'p2' ); ?></dd>
		<dt>e</dt> <dd><?php _e( 'edit', 'p2' ); ?></dd>
		<dt>o</dt> <dd><?php _e( 'show/hide comments', 'p2' ); ?></dd>
		<dt>t</dt> <dd><?php _e( 'go to top', 'p2' ); ?></dd>
		<dt>l</dt> <dd><?php _e( 'go to login', 'p2' ); ?></dd>
		<dt>h</dt> <dd><?php _e( 'show/hide help', 'p2' ); ?></dd>
		<dt>esc</dt> <dd><?php _e( 'cancel', 'p2' ); ?></dd>
	</dl>
</div>

<?php wp_footer(); ?>

</body>
</html>

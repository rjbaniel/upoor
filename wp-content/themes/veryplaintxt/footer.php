	<div id="footer">
		<span id="copyright">&copy; <?php echo( date('Y') ); ?> <?php veryplaintxt_admin_hCard(); ?></span>
		<span class="meta-sep">&para;</span><?php if( SHOW_AUTHORS != 'false') { ?>
		<span id="theme-link"><a href="http://www.plaintxt.org/themes/veryplaintxt/" title="veryplaintxt theme for WordPress" rel="follow designer">veryplaintxt</a> <?php _e('theme by', 'veryplaintxt') ?> <span class="vcard"><a class="url fn n" href="http://scottwallick.com/" title="scottwallick.com" rel="follow designer"><span class="given-name">Scott</span><span class="additional-name"> Allan</span><span class="family-name"> Wallick</span></a></span>.<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;&nbsp;<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?></span>
		<span class="meta-sep">&para;</span>
		
	</div><!-- #footer -->

<?php wp_footer() // Do not remove; helps plugins work ?>

</div><!-- #wrapper -->

</body><!-- end trasmission -->
</html>

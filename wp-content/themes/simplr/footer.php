
	<div id="footer">
		<span id="copyright" class="footer-meta">&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.</span>
		<?php if( SHOW_AUTHORS != 'false') { ?>
		<span id="theme-link" class="footer-meta"><a href="http://www.plaintxt.org/themes/simplr/" title="Simplr theme for WordPress" rel="follow designer">Simplr</a> <?php _e('theme by', 'simplr') ?> <span class="vcard"><a class="url fn n" href="http://scottwallick.com/" title="scottwallick.com" rel="follow designer"><span class="given-name">Scott</span><span class="additional-name"> Allan</span><span class="family-name"> Wallick</span></a></span></span><?php } ?>
		<br/>

		<span id="web-standards" class="footer-meta">
        <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
        </span>


		<span id="footer-rss" class="footer-meta"><?php _e('RSS:', 'simplr') ?> <a href="<?php bloginfo('rss2_url') ?>" title="<?php echo esc_html(get_bloginfo('name'), 1) ?> <?php _e('RSS Feed', 'simplr') ?>" rel="alternate" type="application/rss+xml"><?php _e('Posts', 'simplr') ?></a> &amp; <a href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo esc_html(bloginfo('name'), 1) ?> <?php _e('Comments RSS Feed', 'simplr') ?>" rel="alternate" type="application/rss+xml"><?php _e('Comments', 'simplr') ?></a></span>
                      <br />


	</div><!-- #footer -->


	
</div><!-- #wrapper -->
              <?php wp_footer() // Do not remove; helps plugins work ?>
</body><!-- end transmission -->
</html>

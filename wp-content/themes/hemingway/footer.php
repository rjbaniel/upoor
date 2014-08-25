
<hr class="hide" />
	<div id="footer">
		<div class="inside">
			<?php
				// You are not required to keep this link back to Warpspire, but if you wouldn't mind, leaving it in would make my day.
			?>
			<p class="copyright">&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;&nbsp;
  <?php _e("Using",TEMPLATE_DOMAIN); ?> <a href="http://warpspire.com/hemingway" rel="designer">Hemingway</a><?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;&nbsp;<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>

            <br />
           	<?php wp_footer(); ?>
            </p>
			<p class="attributes"><a href="<?php bloginfo('rss2_url'); ?>">Entries RSS</a> <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments RSS</a></p>
		</div>
	</div>
	<!-- [END] #footer -->	


</body>
</html>

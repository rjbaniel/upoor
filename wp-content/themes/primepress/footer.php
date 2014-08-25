	<div id="footer">

		<p class="left">&#169; <?php echo date('Y');?> <strong><?php bloginfo('name'); ?></strong>
		<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?> <?php _e('Hosted by', 'primepress'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>.
<?php } ?></p>

  <?php if( SHOW_AUTHORS != 'false') { ?>		<p class="right">A <strong><a href="http://www.techtrot.com/primepress/" title="PrimePress theme homepage">WordPress theme</a></strong> by <strong><a href="http://www.techtrot.com" title="PrimePress author homepage">Ravi Varma</a></strong></p>   <?php } ?>

	</div><!--#footer-->



</div><!--#container-->	

	

<div class="clear"></div>	

</div><!--#page-->

<?php wp_footer(); ?>

</body>

</html>

	<!-- FOOTER -->

	

<div id="footer"><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp; Theme by <a href="http://www.skimbu.it">Alberto Ziveri</a><br /><?php } ?>
<p class="footer-c">&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>&nbsp;&nbsp;&nbsp;
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<small style="color: #000 !important;"><?php _e('Hosted by', 'skinbu'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a></small>.<br />
<?php } ?><?php wp_footer(); ?></p>    </div>



</div>





</body>



</html>



<!--END FOOTER-->


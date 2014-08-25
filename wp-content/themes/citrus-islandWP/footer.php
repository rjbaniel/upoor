</div>
</div><!-- wrap ends here -->





<!-- footer starts here -->	


	<div id="footer">


		<div id="footer-content">


		           &copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.

              <?php if( SHOW_AUTHORS != 'false') { ?><br />
			Design by: <a href="http://www.styleshout.com/">styleshout</a> and <a href="http://www.exguides.org">Exguides</a>.
                                               <?php } ?>
            <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'citrus'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
            <br />


			 	<?php wp_footer(); ?>  

		


		</div>	





	</div>


<!-- footer ends here -->	


	


</body>


</html>

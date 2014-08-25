
				
			</div>
		</div>
	
		<div id="body_right">
			<div id="body_right_content">
				
				<div id="sidebars">
					<?php get_sidebar(); ?>
				</div>
				
			</div>
		</div>
	
	</div>
</div>


</div>

<div id="footer">
	<div id="footer_inner">
		<div id="footer_text">
			<p>&copy; All Rights Reserved. <a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></p>
			<p class="designed"><?php if( SHOW_AUTHORS != 'false') { ?>Designed by <b><a href="http://www.webdesignlessons.com/">WebDesignLessons.com</a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'nature'); ?> <b><a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a></b>
<?php } ?><br />	<?php wp_footer(); ?>   </p>

		</div>
	</div>


</div>




</body>
</html>

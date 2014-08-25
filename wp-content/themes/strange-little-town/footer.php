



		</div>

    

    </div>

       

        </div>  

<div id="footer">

	<div id="footerimg"> 

	</div>

    		<p>&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
  <?php _e('Hosted by', 'slt'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>&nbsp;
<?php } ?> | <a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a> | <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a><?php if( SHOW_AUTHORS != 'false') { ?> | Theme & Graphic by <a href="http://magical.nu/">Minmin</a><?php } ?> </p>

</div>
   <?php wp_footer(); ?>
	</body>

</html>

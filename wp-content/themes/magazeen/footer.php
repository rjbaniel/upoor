<?php
/**
 * @package WordPress
 * @subpackage Magazeen_Theme
 */
?>
                  </div>
                  
	<div id="footer">
	

	
	</div><!-- End footer -->
	
	<div id="link-back">

		<div class="container clearfix">
		
			<div class="donators">

                 <?php if( SHOW_AUTHORS != 'false') { ?> <p style="width: auto; float:left;">
                     	<a href="http://forum.smashingmagazine.com" class="smashing" title="Brought To You By: www.SmashingMagazine.com">Brought to you By: www.SmashingMagazine.com</a>
				<a href="http://www.wefunction.com" class="function" title="In Partner With: www.WeFunction.com">In Partner with: www.WeFunction.com</a>
                    </p><?php } ?>

			     <p style="padding: 10px 0px 0px 14px; width: auto; float:left;">&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.
			<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><br /><?php _e('Hosted by ', 'magazeen'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?> </p>

			</div><!-- End donators -->
			
			<a href="<?php bloginfo( 'rss2_url' ); ?>" class="rss" title="<?php _e('Subscribe to', 'magazeen'); ?> <?php bloginfo( 'name' ); ?> RSS"><?php _e('Subscribe', 'magazeen'); ?></a>
		
		</div>
	
	</div><!-- End link-back -->
	
      <?php wp_footer(); ?>
	
</body>
</html>

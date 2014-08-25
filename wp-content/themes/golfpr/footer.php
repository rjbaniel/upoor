<?php

/**
 * @package WordPress
 * @subpackage golfPR
 */
?>

<div id="footer">
		<div class="navcontainer">

          <div class="footer-nav" id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='footer-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } else { ?>
<ul id="nav">
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>
</div>

<div class="clear"></div>
		</div>
			<div id="copyright">
&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>&nbsp;&nbsp;&nbsp;<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>&nbsp;&nbsp;&nbsp;<?php _e('Hosted by', 'golfpr'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
			</div>
</div>

		<?php wp_footer(); ?>
</body>
</html>

<?php
/**
 * Footer Template
 *
 * This file is loaded by footer.php and used for content inside the #footer div
 *
 * @package K2
 * @subpackage Templates
 */
?>

<p class="footerpoweredby">
&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>
<?php if( SHOW_AUTHORS != 'false') { ?><br />
       <?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by','k2_domain'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
</p>

<?php if ( get_k2info('style_footer') != '' ): ?>
	<p class="footerstyledwith">
		<?php k2info('style_footer'); ?>
	</p>
<?php endif; ?>

<p class="footerfeedlinks">
	<?php
		printf( _x('%1$s and %2$s', 'k2_footer', 'k2_domain'),
			'<a href="' . get_bloginfo('rss2_url') . '">' . __('Entries Feed','k2_domain') . '</a>',
			'<a href="' . get_bloginfo('comments_rss2_url') . '">' . __('Comments Feed','k2_domain') . '</a>'
		);
	?>
</p>

<p class="footerstats">
	<?php printf( __('%d queries. %s seconds.', 'k2_domain'), get_num_queries(), timer_stop(0, 3) ); ?>
</p>

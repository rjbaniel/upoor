<?php
?>

</div>
<div id="footer">
	<p>
	<br />
	<br />&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.<br />
     <?php if( SHOW_AUTHORS != 'false') { ?>
<a href="http://riseofdesign.de/blog">Color Splash</a> by Mladen<br /><?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><?php _e('Hosted by', 'color-splash'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
</p>
</div>
<?php /* "Just what do you think you're doing Dave?" */ ?>

<?php wp_footer(); ?>

</body>
</html>

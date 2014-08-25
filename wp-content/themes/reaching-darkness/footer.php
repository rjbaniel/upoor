<!-- BEGIN FOOTER.PHP -->

</div><!-- content -->

<div id="sidebar">
<?php get_sidebar(); ?>
</div>

<div id="sidebar2">
<?php include (TEMPLATEPATH . '/sidebar2.php'); ?>
</div>

<div id="sidebar3">
<?php include (TEMPLATEPATH . '/sidebar3.php'); ?>
</div>

<div id="sidebar4">
<?php include (TEMPLATEPATH . '/sidebar4.php'); ?>
</div>

<div id="footer">
<p>
&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>&nbsp;&nbsp;&nbsp;<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><?php if( SHOW_AUTHORS != 'false') { ?>
<br />
Design by <a href="http://justintadlock.com" title="Justin Tadlock's Website"> Justin Tadlock</a>.&nbsp;&nbsp;&nbsp;
<br /><?php } ?><?php wp_footer(); ?>
</p>

</div>

</div><!-- container -->
</div><!-- body-container -->
</body>

</html>

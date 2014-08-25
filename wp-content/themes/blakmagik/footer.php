

</div>
<hr />
<div id="footer">

	<div class="footerwrap">
    <div class="copyright">&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>
    <?php if( SHOW_AUTHORS != 'false') { ?><br /><?php _e('Designed by', 'blakmagik'); ?> <a href="http://www.productivedreams.com/">productivedreams</a>.&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'blakmagik'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>  <br />
		<?php wp_footer(); ?> 
	</div>

</div>

<?php ?>


</body>
</html>

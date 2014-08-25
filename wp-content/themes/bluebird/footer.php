<div style="clear:both;"></div>


<div style="clear:both;"></div>  


<div id="foot">
Copyright &copy; <?php bloginfo('name'); ?>
<?php if( SHOW_AUTHORS != 'false') { ?>
<br /><a href="http://randaclay.com/themes/" title="Bluebird">Bluebird</a> theme by <a href="http://randaclay.com">Randa Clay</a><?php } ?>
<br />

<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'bluebird'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>

<br />

<?php wp_footer(); ?>
</div>

</div>


</body>


</html>

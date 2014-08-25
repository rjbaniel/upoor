<?php get_sidebar(); ?>

</div></div><!-- End pagewrapper and page classes -->

<div id="credits">
Copyright &copy;  <?php bloginfo('name'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if( SHOW_AUTHORS != 'false') { ?><?php _e('Designed by'); ?> <a href="http://wpdesigner.com/" title="page">WPDesigner</a><?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Hosted by','digg-3-col'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br />
<?php wp_footer(); ?>
</div>


</div><!-- End container id -->



</body>
</html>

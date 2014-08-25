<!-- begin footer --></div>
<?php get_sidebar(); ?>
<!-- Please leave current credits intact and on display -->
<div id="footer"> 
  Falling Dreams Theme design by <a href="http://teo.esuper.ro">Razvan Teodorescu</a>. <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'falling-dreams'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br />

</div>
      <?php wp_footer(); ?> 
</body>
</html>

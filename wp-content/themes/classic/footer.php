<!-- begin footer -->

</div>



<?php get_sidebar(); ?>


<p class="credit"><!--<?php echo get_num_queries(); ?> <?php _e('queries');?>. <?php timer_stop(1); ?> <?php _e('seconds');?>. --> <cite>
&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.<?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;Provided by  <?php } ?>
   <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'classic'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
 </cite></p>



</div>



<?php wp_footer(); ?>

</body>

</html>


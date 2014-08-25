<br class="clear" />


</div>


<div id="footer">


<div>


  <hr />


  <p>


  <strong><?php bloginfo('name'); ?></strong> &copy; <?php echo gmdate(__('Y')); ?> All Rights Reserved.

    <br /><span class="rss"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries');?></a></span> and <span class="rss"><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('comments');?></a><span>.


    <!--<?php echo get_num_queries(); ?> <?php _e('queries');?>. <?php timer_stop(1); ?> <?php _e('seconds');?>. -->


  </p>


  <p class="right">
  <span><?php if( SHOW_AUTHORS != 'false') { ?><a href="http://www.jauhari.net/themes/anubis" title="Anubis 1.0">Anubis</a> made by <a href="http://www.jauhari.net/">Nurudin Jauhari</a>. &nbsp;&nbsp;<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'anubis'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?></span> </p>


  <br class="clear" />


</div>


</div>


<?php wp_footer(); ?>


</body></html>

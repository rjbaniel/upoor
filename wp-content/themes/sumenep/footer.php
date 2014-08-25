<br class="clear" />
</div>
<div id="botr">
</div>
<div id="footer">
  <hr />
  <p>
  <strong>&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.</strong><br />
    <!--<?php echo get_num_queries(); ?> <?php _e('queries');?>. <?php timer_stop(1); ?> <?php _e('seconds');?>. -->
  </p>
  <p class="right"><?php if( SHOW_AUTHORS != 'false') { ?><span><a href="http://www.jauhari.net/themes/sumenep" title="sumenep 1.0">sumenep</a> made by <a href="http://www.jauhari.net/">Nurudin Jauhari</a>.<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>&nbsp;&nbsp;<?php _e('Hosted by',TEMPLATE_DOMAIN); ?><a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><?php } ?></span>
      <br /><span class="rss"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries',TEMPLATE_DOMAIN);?></a></span> and <span class="rss"><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('comments',TEMPLATE_DOMAIN);?></a><span>
  </p>
  <br class="clear" />
  <?php wp_footer(); ?>
</div>

</body></html>

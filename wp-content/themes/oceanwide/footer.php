
   
					</div>

	<div id="blog_right">

		<?php get_sidebar_right(); ?>

	</div>

</div>





<div id="footer">

  <p class="left">

 &copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>

    <br /><span class="rss"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries');?></a>

</span> and <span class="rss"><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('comments');?></a><span>

    <!--<?php echo get_num_queries(); ?> <?php _e('queries');?>. <?php timer_stop(1); ?> <?php _e('seconds');?>. -->

  </p>

  <p class="right" style="text-align: right;"><span><?php if( SHOW_AUTHORS != 'false') { ?><a href="http://www.romow.com/blog/free-wordpress-theme-oceanwide/" title="OceanWide WordPress Theme">OceanWide</a> made by <a href="http://www.romow.com/" title="Romow Internet Directory">Romow.com</a>.&nbsp;&nbsp;&nbsp;<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?></span><br /><?php wp_footer(); ?></p>

  <br class="clear" />

</div>





		

</div>

</div>

</body>

</html>


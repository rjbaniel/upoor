	</div>



<div id="footer">
&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>
<?php if( SHOW_AUTHORS != 'false') { ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="footerLink" href="http://www.thoughtmechanics.com/blog/2005/01/03/benevolence/" rel="designer">Benevolence</a> <?php _e('theme by Theron Parlin.','benevolence'); ?><?php } ?>

<br /><?php _e('Syndicate entries using','benevolence'); ?> <a class="footerLink" href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS','benevolence'); ?>">

   <abbr title="Really Simple Syndication">RSS</abbr></a> <?php _e('and','benevolence'); ?> <a class="footerLink" href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)','benevolence'); ?></a>.<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>&nbsp;&nbsp;&nbsp;<?php _e('Hosted by', 'benevolence'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>

<br /><br />

</div>



</div>



<?php wp_footer(); ?>



</body>

</html>


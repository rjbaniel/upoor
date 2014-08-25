<br class="clear" />

</div> <!-- end wrap -->

<div id="footer">

  <hr />

  <p>

  <strong>

&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?> <?php _e('using','dignity'); ?> <a href="http://www.themebox.org/dignity-wordpress-theme/" title="Dignity 1.0 WordPress Theme">Dignity theme by themebox</a>

    </strong>



    <br /><br /><span class="rss"><a href="<?php bloginfo('rss2_url'); ?>">RSS Entries</a></span> and <span class="rss"><a href="<?php bloginfo('comments_rss2_url'); ?>">RSS Comments</a><span>. 

  </p>

  <p class="right">
  <span>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'dignity'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
  </span> </p>

  <br class="clear" />

</div>

</div>

<?php wp_footer(); ?>

</body></html>

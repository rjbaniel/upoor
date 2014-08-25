

<div id="footer">
&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>&nbsp;&nbsp;&nbsp;<?php if( SHOW_AUTHORS != 'false') { ?>
  <a href="http://hyalineskies.com/wordpress/gridlock/" title="Gridlock theme at hyalineskies">Gridlock</a> by <a href="http://hyalineskies.com/" title="hyalineskies">hyalineskies</a>.<?php } ?>
  <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;&nbsp;<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
   <br />
  <?php wp_footer(); ?>
</div>

<?php if(get_option('gridlock_centre_page') == 'true') { ?>
</div>
<?php } ?>

</div> <?php // end the main content wrapper ?>
</div>

</body>
</html>

<?php /* Hey, here I am, and here we go, life's waiting to begin. */ ?>

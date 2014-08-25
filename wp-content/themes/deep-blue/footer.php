<!-- begin footer -->


</div>


<?php get_sidebar(); ?>


<div class="credit">
<cite>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?>&nbsp;&nbsp;&nbsp; <strong>Deep Blue</strong> Theme Provided by .<?php } ?></cite><br />
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'deep-blue'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>.<br />
<?php } ?>

</div>





</div>


<?php wp_footer(); ?>
</body>


</html>

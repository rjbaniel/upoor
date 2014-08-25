<!-- begin footer -->
</div>

<?php get_sidebar(); ?>

<p class="credit"><cite>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?></cite><br /><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'deichnetz'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?> </p>

</div>

<?php wp_footer(); ?>
</div>
</body>
</html>

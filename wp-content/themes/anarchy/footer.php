</div> <!-- #content -->

<?php get_sidebar(); ?>


<div style="clear:both;height:1px;"> </div>


</div><!-- #wrap -->




<p class="credit">&copy;<?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?><br /><?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'anarchy'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
</p>

<div class="centered"><?php wp_footer(); ?></div>





</body>


</html>

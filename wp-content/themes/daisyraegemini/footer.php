<!-- begin footer -->

</div>

</div>



<?php get_sidebar(); ?>



<div id="clearer">&nbsp;</div>

<div id="footer">


<p class="credit">
&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?>
<br />
Daisy Rae Gemini developed by <a href="http://atthe404.com">Root</a>.<?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'daisyrae'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>.
<?php } ?><br />
<?php wp_footer(); ?>
</p>

</div>

</div>

</div>

</div>


</body>

</html>


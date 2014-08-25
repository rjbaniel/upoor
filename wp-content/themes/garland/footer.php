</div><!-- end content -->
<span class="clear"></span>
<div id="footer">
&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?><?php if( SHOW_AUTHORS != 'false') { ?><br />Theme: Garland by <a href="http://acko.net/">Steven Wittens</a> and Stefan Nagtegaal. Updated by <a href="http://www.pross.org.uk">Pross</a>.
<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><br /><?php _e('Hosted by', 'garland'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
<br /><?php wp_footer(); ?>

<?php if ( get_theme_mod( 'show_debug' ) ) {
echo $wpdb->num_queries; ?> <?php _e('queries'); ?> &bull; <?php timer_stop(1); ?> <?php _e('seconds'); echo '<br />'; 
} ?>
<?php if ( get_theme_mod( 'footer' ) ) {
echo get_theme_mod('my_footer_text');
} ?>
<?php if (function_exists('spamcount')) { spamcount(); } ?>
</div>
</div></div></div></div> <!-- /.left-corner, /.right-corner, /#squeeze, /#center -->
<?php include (TEMPLATEPATH . '/sidebar2.php'); ?>
</div> <!-- /container -->
</div>
<!-- /layout -->
</body>
</html>

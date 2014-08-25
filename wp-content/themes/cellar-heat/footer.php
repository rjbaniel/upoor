<div id="footer">&copy;<?php the_time('Y') ?> <a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a><br />
<?php if( SHOW_AUTHORS != 'false') { ?>
<a href="http://www.cellarheat.com">"Cellar Heat"</a> Brought to you by <a href="http://www.evaneckard.com">EvanEckard.com</a> and <a href="http://www.smashingmagazine.com">Smashing Magazine.</a> <br />

Dark version inspired by <a href="http://www.jimmyoh.com">Jimmy Oh.</a> Patterns courtesy of <a href="http://www.dinpattern.com">DinPattern.com</a>.<br />
                                <?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'cellar-heat'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
<br />
<?php wp_footer(); ?>
</div>

</div>

</body>

</html>

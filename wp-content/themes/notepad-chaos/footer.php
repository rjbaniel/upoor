<div id="footer-holder">
  <div class="footer">&copy;<?php the_time('Y') ?> <a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a> <?php if( SHOW_AUTHORS != 'false') { ?>uses the <a href="http://www.notepadchaos.com">"Notepad Chaos v2"</a> theme.<?php } ?>
  <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'notepad-chaos'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br /><?php wp_footer(); ?>
  </div>
  <?php if( SHOW_AUTHORS != 'false') { ?><span class="evaneckard"><a href="http://www.evaneckard.com">Evan Eckard Design</a></span> <span class="smashing"><a href="http://www.smashingmagazine.com">Smashing Magazine</a></span><?php } ?> <span class="rss"><a href="<?php bloginfo('rss2_url'); ?>">RSS</a></span></div>

</div></body></html>

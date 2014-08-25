<div id="footer">
  <p>
    &copy; <?php echo date('Y');?> <?php bloginfo('name')?>. All rights reserved. <br/>
    <?php if( SHOW_AUTHORS != 'false') { ?><a href="http://www.nodethirtythree.com/" title="TerraFirma by nodethirtythree">TerraFirma</a> | <a href="http://wpthemepark.com/themes/terrafirma/" target="_blank" title="WordPress Theme by WP ThemePark">WordPress Theme</a> | <a href="http://www.freehostreview.com/" title="Best Free Hosting" target="_blank">Best Free Hosting</a><?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><?php } ?>


  </p>
</div>
</div> <!--close inner-->
</div><!--close outer-->
<?php wp_footer(); ?>
</body>
</html>

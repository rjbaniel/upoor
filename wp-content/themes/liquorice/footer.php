      </div>

      <div id="secondaryContent">
        <?php get_sidebar(); ?>
      </div>

      <div id="footer">
       <p>Copyright &copy; <?php echo date('Y');?>  <?php bloginfo('name'); ?><br /> <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><br /><?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><br />
<?php } ?></p>
        <?php wp_footer(); ?>
      </div>
      
    </div>

  </body>
</html>

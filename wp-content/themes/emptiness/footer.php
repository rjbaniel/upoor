      <div id="footer">

        <div class="item">

          <div class="side left">

            &nbsp;

          </div>

        <div class="main">

Copyright &copy; <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a><br/><?php if( SHOW_AUTHORS != 'false') { ?><a href="http://code.google.com/p/bitpress/wiki/Emptiness">Emptiness</a> Theme by <a href="http://cliffano.com">Studio Cliffano</a>.<?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'emptiness'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><br />
<?php } ?>

  <?php wp_footer(); ?>
          </div>

          <div class="side right">

            &nbsp;

          </div>

        </div>

      </div>

    </div>



  </body>

</html>

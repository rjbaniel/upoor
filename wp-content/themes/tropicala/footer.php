

    
      </div>

    </div>

    <ul id="footer" class="foot">
      <li>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</li>
<li><?php _e('RSS','tropicala'); ?>: <a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries','tropicala'); ?></a>/<a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments','tropicala'); ?></a></li>
      <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'tropicala'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>.&nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?></li>
      <?php if( SHOW_AUTHORS != 'false') { ?><li>
        Theme:
        <a href="http://wordpress.org/extend/themes/tropicala">Tropicala</a> by
        <a href="http://goroharumi.com">Goro</a>
      </li> <?php } ?>
       <br />
     <?php wp_footer(); ?>
    </ul>

</body>
</html>

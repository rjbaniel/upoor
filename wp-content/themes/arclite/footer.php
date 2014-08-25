<?php /* Arclite/digitalnature */ ?>



 <!-- footer -->

 <div id="footer">



  <!-- page block -->

  <div class="block-content">





    <?php $footer_on = get_option('arclite_footer_status'); if($footer_on == 'enable') { ?>

    <?php include(TEMPLATEPATH . '/footer-widgets.php'); ?>

    <?php } ?>





    <?php if(get_option('arclite_footer')<>'') { ?>

    <div class="add-content">

      <?php print get_option('arclite_footer'); ?>

    </div>

     <?php } ?>



    <div class="copyright">



<p>
&copy;<?php echo gmdate(__('Y')); ?> <a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a>
<?php if( SHOW_AUTHORS != 'false') { ?>
<?php $footer_copyright_on = get_option('arclite_footer_copyright_status'); if($footer_copyright_on == 'enable') { // default enable ?>
&nbsp;&nbsp;&nbsp;<!-- please do not remove this. respect the authors :) -->
<?php printf(__('Arclite theme by %s', 'arclite'), '<a href="http://digitalnature.ro/projects/arclite">digitalnature</a>'); ?>
<?php } }?>
</p>

<p>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><?php _e('Hosted by', 'arclite'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a> <?php } ?>
</p>

<br />
<?php wp_footer(); ?>
</div>



  </div>

  <!-- /page block -->



 </div>

 <!-- /footer -->



</div>

<!-- /page -->



</body>

</html>

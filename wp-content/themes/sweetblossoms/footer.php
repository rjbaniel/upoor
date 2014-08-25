<!-- footer ................................. -->
<div id="copyright">

<p>
&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.<br />
<?php if( SHOW_AUTHORS != 'false') { ?>Theme: Sweet Blossoms by <a href="http://talkxhtml.com/" rel="designer">TalkXHTML</a>.<br /><?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
<br />
<?php wp_footer(); ?> 
</p>



</div> <!-- /footer -->

<div style="clear:both; background-color:#FFFFFF; font-size:1px; line-height:0px;">&nbsp;</div>

</div> <!-- /container -->

</body>

</html>

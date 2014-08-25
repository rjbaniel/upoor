
<div id="footer-widget">
<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>
<?php endif; ?>
</ul>
</div>




<div id="footer">

All content is &copy; <?php echo gmdate('Y'); ?> <?php bloginfo('name'); ?>&nbsp;&nbsp;&nbsp;All rights reserved.


<p id="footer-credit">
<?php if( SHOW_AUTHORS != 'false') { ?>

<span id="theme-link">
<a href="http://www.plaintxt.org/themes/sandbox/"><?php _e('Sandbox', 'sandbox'); ?></a>
</span>

<span class="meta-sep">|</span>

<a href="http://www.allancole.com/wordpress/themes/autofocus"><?php _e('Autofocus', 'sandbox'); ?></a>
<?php } ?>

<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<span class="meta-sep">|</span>
<?php _e('Hosted by', 'sandbox'); ?> <a href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>


</p>



</div><!-- #footer -->
</div><!-- #wrapper .hfeed -->


<?php wp_footer(); ?> 
</body>
</html>

</div><!-- end content -->
</div><!-- end container -->

<div id="footer">

<div class="fleft">
&copy;<?php echo gmdate('Y'); ?> <a href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a><br />
<?php if( function_exists('wp_network_footer') ) { echo wp_network_footer(); } ?>
</div>

<div class="fright">
<a href="#wrapper"><?php _e('Go back to top &uarr;', TEMPLATE_DOMAIN); ?></a>
</div>

</div>

<?php wp_footer(); ?>

<div id="footer-end"></div>

</div><!-- end wrapper -->

</body>
</html>
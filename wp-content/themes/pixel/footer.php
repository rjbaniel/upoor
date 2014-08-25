<div id="morefoot">

<div class="col1">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_left') ) : ?>
<h3>Looking for something?</h3>
<p>Use the form below to search the site:</p>
<?php include (TEMPLATEPATH . '/searchform.php'); ?>
<p>Still not finding what you're looking for? Drop a comment on a post or contact us so we can take care of it!</p>
<?php endif; ?>
</div>

<div class="col2">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_middle') ) : ?>
<h3>Visit our friends!</h3><p>A few highly recommended friends...</p><ul><?php wp_list_bookmarks('title_li=&categorize=0'); ?></ul>
<?php endif; ?>
</div>

<div class="col3">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_right') ) : ?>
<h3>Archives</h3><p>All entries, chronologically...</p><ul><?php wp_get_archives('type=monthly&limit=12'); ?> </ul>
<?php endif; ?>
</div>

<div class="cleared"></div>
</div><!-- Closes morefoot -->



<div id="footer">
<div id="footerleft">
<p>&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>. <?php if( SHOW_AUTHORS != 'false') { ?><a href="http://samk.ca/freebies/" title="Pixel">pixel</a>. Sweet icons by <a href="http://famfamfam.com/">famfamfam</a>.<?php } ?> <a href="#main">Back to top &uarr;</a>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<br /><?php _e('Hosted by', 'pixel'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a><br />
<?php } ?><?php wp_footer(); ?>
</p>
<!-- If you want to remove the credits, please consider making a donation. Thanks! -->
</div>



<div class="cleared"></div>

</div><!-- Closes footer -->

</div><!-- Closes wrapper -->

</body>
</html>

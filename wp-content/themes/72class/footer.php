<!-- open -->

<!-- close page --></div>

<!-- open footer-wrapper --><div id="footer-wrapper">

<!-- open footer --><div id="footer">

<!-- open about --><div id="about">
<h2><?php _e('About');?></h2>
<?php query_posts('pagename=about'); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php the_excerpt(); ?>
<?php edit_post_link(__('Edit', '72class'), '<p>', '</p>'); ?>
<?php endwhile; ?>
<?php endif; ?>
<!-- close about --></div>

<p>&copy; <?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?>.<br />
<?php 
if (!defined('SHOW_AUTHORS')) {
	define('SHOW_AUTHORS', 'true');
}
if( SHOW_AUTHORS != 'false') {
?>
<small><?php _e('Created by', '72class'); ?> <a href="http://alanwho.com">Alan Who?</a>.<br /><?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', '72class'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?></small>
</p>
<?php wp_footer(); ?>
<!-- close footer --></div>

</body>

</html>

<?php get_header(); ?>

	<div class="entry">
		<h2><?php _e('Error 404', TEMPLATE_DOMAIN);?>- <?php _e('Page not found', TEMPLATE_DOMAIN)?></h2>
<p><?php _e("Oops!  This page either has been moved or does not exist.  Feel free to navigate using the sidebar or return to",TEMPLATE_DOMAIN); ?> <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> <?php _e("to start over.",TEMPLATE_DOMAIN); ?></p>

	</div>
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>

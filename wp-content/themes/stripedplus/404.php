<?php get_header(); ?>


	<div class="post">
		<h3 class="posth3"><?php _e('Error 404 - Not Found', TEMPLATE_DOMAIN) ?></h3>
		<p><?php _e("The requested URL is not found, try to do a search or go back to the",TEMPLATE_DOMAIN); ?>  <a href="<?php bloginfo('url'); ?>"><?php _e("front page",TEMPLATE_DOMAIN); ?></a> <?php _e("to look for it.",TEMPLATE_DOMAIN); ?></p>
		</div>

<?php get_footer(); ?>

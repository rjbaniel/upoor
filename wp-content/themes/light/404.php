<?php get_header();?>

<div id="content">
<h1>Error 404</h1>
  <h2 class="entrytitle"><?php _e("The page you requested is no longer here!",TEMPLATE_DOMAIN); ?></h2>
  <p><?php _e("Visit the",TEMPLATE_DOMAIN); ?> <a href="<?php bloginfo('url');?>"><?php _e("Home Page",TEMPLATE_DOMAIN); ?></a></p>
  <p><?php _e("In order to improve our service, can you inform us that someone else has an incorrect link to our site?",TEMPLATE_DOMAIN); ?></p>
  <p><a href="/contact"><?php _e("Report broken link",TEMPLATE_DOMAIN); ?></a> </p>
  <p>&nbsp;</p>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

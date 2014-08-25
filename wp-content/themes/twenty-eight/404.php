<?php get_header(); ?>
<div class="content"><div class="primary"><div class="pagetitle">
<h2><?php _e("404 - Not Found",TEMPLATE_DOMAIN); ?></h2></div>

<p style="font-size:1.1em;line-height:1.1em;"><?php _e("You seem to be a little lost or have followed a broken link. Perhaps what you are looking for can be found by searching:",TEMPLATE_DOMAIN); ?></p>


<?php include (TEMPLATEPATH . '/searchform.php'); ?>

</div><?php get_sidebar(); ?></div>

<?php get_footer(); ?>

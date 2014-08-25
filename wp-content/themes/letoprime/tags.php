<?php /*
Template Name: Tag Archive
This is an example tag archive page.  If you add this to your theme,  and create a page using the "Tag Archive" template (it'll be there in the list)
you'll get a tag cloud displaying on a page.

You might need to tinker with the header/sidebar/footer to match your theme!
*/ ?>

<?php get_header(); ?>

<div id="content" class="narrowcolumn">
<h2><?php _e("Tags",TEMPLATE_DOMAIN); ?></h2>
<?php if(function_exists("wp_tag_cloud")) { ?>
<?php wp_tag_cloud('smallest=8&largest=21&'); ?>
<?php } ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

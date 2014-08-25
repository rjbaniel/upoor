<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>

<div id="content" class="widecolumn">

<h2><?php _e('Links:', TEMPLATE_DOMAIN);?></h2>
<ul>
<?php wp_list_bookmarks(); ?>
</ul>

</div>	

<?php get_footer(); ?>

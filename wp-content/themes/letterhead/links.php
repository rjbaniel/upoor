<?php
/*
Template Name: Links - taken directly from Kubrick
*/
?>

<?php get_header(); ?>

<div id="content" class="widecolumn">

<h2><?php _e('Links:','black-letterhead');?></h2>
<ul>
<?php wp_list_bookmarks(); ?>
</ul>

</div>	

<?php get_footer(); ?>

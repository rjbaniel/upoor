<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>


<?php get_sidebar(); ?> 

<div id="contentwrapper">

<div id="content" class="widecolumn">

<div class="posttitle"><?php _e('Links','borderline'); ?></div>
<P>
<ul>
<?php wp_list_bookmarks('id'); ?>
</ul>
</div>	
</div>

<?php get_footer(); ?>

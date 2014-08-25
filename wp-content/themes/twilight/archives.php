<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div class="entry">

<h2><?php _e('Archives', TEMPLATE_DOMAIN);?></h2>
<ul>
<?php wp_get_archives('monthly', '', 'html', '', '', TRUE); ?>
</ul>

</div>	

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

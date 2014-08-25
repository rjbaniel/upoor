<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="content" class="widecolumn">

<h2><?php _e('Archives by Month:','greenday');?></h2>
  <ul>
    <?php wp_get_archives('type=monthly'); ?>
  </ul>

<h2><?php _e('Archives by Subject:','greenday');?></h2>
  <ul>
     <?php wp_list_categories(); ?>
  </ul>

</div>

<?php get_footer(); ?>

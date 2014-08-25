<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>
<div id="headerimg">
		<a href="<?php echo get_option('home'); ?>"><img src="<?php header_image() ?>" width="480" height="200" /></a>
	</div>

<div id="content" class="widecolumn">

<?php include (TEMPLATEPATH . '/searchform.php'); ?>

<h2><?php _e('Archives by Month:',TEMPLATE_DOMAIN);?></h2>
  <ul>
    <?php wp_get_archives('type=monthly'); ?>
  </ul>

<h2><?php _e('Archives by Subject:',TEMPLATE_DOMAIN);?></h2>
  <ul>
     <?php wp_list_categories(); ?>
  </ul>

</div>	

<?php get_footer(); ?>

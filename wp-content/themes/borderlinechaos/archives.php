<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>


  <?php get_sidebar(); ?> 

<div id="contentwrapper">



<div id="content" class="widecolumn">


<div class="posttitle"><?php _e('Archives', 'borderline'); ?></div>
<P>
<ul>

<?php wp_get_archives('postbypost', '10000', 'custom', '', '<br />'); ?>

  </ul>
	<div class="navigation">

			<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php _e('&laquo; Return Home', 'borderline'); ?></a></div>
</div>	


</div>

<?php get_footer(); ?>


<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="contentwrapper">

	<div id="content" class="widecolumn">
      <?php if('' != get_header_image() ) { ?>
<div id="custom-img-header">
<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
</div>
<?php } ?>


	<br /><br />



 <div class="post">
  <?php if (have_posts()) : ?>
	<br />
   <div class="title"><?php _e('Search Results:', 'borderline');?></div><P></p>
         <?php while (have_posts()) : the_post(); ?>

     <a class="posttitle" href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'borderline');?> <?php the_title(); ?>"><?php the_title(); ?></a>
     <?php _e("("); ?> <?php the_category(' and', 'borderline') ?> <?php _e(")"); ?>

      <?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>


       <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'borderline');?> <?php the_title(); ?>"><?php _e('( more )', 'borderline'); ?></a>
<br /><br /><br />
  <?php endwhile; ?>
<?php else : ?>
 <?php _e('Search Request Not Found!', 'borderline');?>
<?php endif; ?>
</div>

<div class="right"><?php posts_nav_link('','','previous &raquo;') ?></div>
 <div class="left"><?php posts_nav_link('','&laquo; newer ','') ?></div>
 
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 </div></div>
<br /><br />

<?php include "footer.php"; ?>

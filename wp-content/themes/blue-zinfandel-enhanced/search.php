<?php get_header(); ?>





<div id="content">

<?php if('' != get_header_image() ) { ?>
<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
<?php } ?>



<?php include(TEMPLATEPATH."/l_sidebar.php");?>





<div id="contentmiddle">


<?php if (have_posts()) : ?>


<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php if (is_category()) { ?>
<h2 class='archives'><?php _e('Archive for the','blue-zinfandel');?> '<?php echo single_cat_title(); ?>' <?php _e('Category','blue-zinfandel');?></h2>
<?php } elseif (is_day()) { ?>
<h2 class='archives'><?php _e('Archive for','blue-zinfandel');?>
<?php the_time(__('F jS, Y')); ?>
</h2>

<?php } elseif (is_month()) { ?>
<h2 class='archives'><?php _e('Archive for','blue-zinfandel');?>
<?php the_time('F, Y'); ?>
</h2>
<?php } elseif (is_year()) { ?>

<h2 class='archives'><?php _e('Archive for','blue-zinfandel');?>
<?php the_time('Y'); ?>
</h2>

<?php } elseif (is_author()) { ?>

<h2 class='archives'><?php _e('Author Archive','blue-zinfandel');?></h2>

<?php } elseif (is_search()) { ?>

<h2 class='archives'><?php _e('Search result','blue-zinfandel');?></h2>

<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

<h2><?php _e('Blog Archives','blue-zinfandel');?></h2>

<?php } ?>



<?php while (have_posts()) : the_post(); ?>





<div class="contentdate">


	<h3><?php the_time('M'); ?></h3>


	<h4><?php the_time('j'); ?></h4>


	</div>


	


<div class="contenttitle">


	<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>


	<p><?php the_time('F j, Y'); ?> | <?php comments_popup_link(__('Leave a Comment', 'blue-zinfandel'), __('1 Comment', 'blue-zinfandel'), __('% Comments', 'blue-zinfandel')); ?></p>


	</div>


	   <?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
	<?php the_excerpt(__('Read more', 'blue-zinfandel'));?>


	


	<div class="postspace">


	</div>


	


	<!--


	<?php trackback_rdf(); ?>


	-->





	<?php endwhile; else: ?>


	<p><?php _e('Sorry, no posts matched your criteria.', 'blue-zinfandel'); ?></p><?php endif; ?>


	<?php posts_nav_link(' &#8212; ', __('&laquo; go back', 'blue-zinfandel'), __('keep looking &raquo;', 'blue-zinfandel')); ?>


	</div>


	


<?php include(TEMPLATEPATH."/r_sidebar.php");?>





</div>





<!-- The main column ends  -->





<?php get_footer(); ?>

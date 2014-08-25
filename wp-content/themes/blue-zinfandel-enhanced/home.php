<?php get_header(); ?>





<div id="content">

<?php if('' != get_header_image() ) { ?>
<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
<?php } ?>



<?php include(TEMPLATEPATH."/l_sidebar.php");?>





<div id="contentmiddle">


<?php if (have_posts()) : ?>




<?php while (have_posts()) : the_post(); ?>





<div class="contentdate">


	<h3><?php the_time('M'); ?></h3>


	<h4><?php the_time('j'); ?></h4>


	</div>


	


<div class="contenttitle">


	<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>


	<p><?php the_time('F j, Y'); ?> | <?php the_category(', '); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php comments_popup_link(__('Leave a Comment', 'blue-zinfandel'), __('1 Comment', 'blue-zinfandel'), __('% Comments', 'blue-zinfandel')); ?></p>


	</div>

   <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?> 
	<?php the_content(__('Click Here To Read More', 'blue-zinfandel'));?>


	


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

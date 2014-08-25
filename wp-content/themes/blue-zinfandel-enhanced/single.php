<?php get_header(); ?>





<div id="content">


<?php if('' != get_header_image() ) { ?>
<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
<?php } ?>


<?php include(TEMPLATEPATH."/l_sidebar.php");?>





<div id="contentmiddle">


	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>





<div class="contentdate">


	<h3><?php the_time('M'); ?></h3>


	<h4><?php the_time('j'); ?></h4>


	</div>


	


<div class="contenttitle">


	<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>


	<p><?php the_time('F j, Y'); ?> | <?php comments_popup_link(__('Leave a Comment', 'blue-zinfandel'), __('1 Comment', 'blue-zinfandel'), __('% Comments', 'blue-zinfandel')); ?></p>


	</div>

     <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?> 
	<?php the_content();?>


	


	<div class="postspace">


	</div>


	


	<!--


	<?php trackback_rdf(); ?>


	-->





	<?php endwhile; ?>

  <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

    <?php else: ?>


	<p><?php _e('Sorry, no posts matched your criteria.', 'blue-zinfandel'); ?></p><?php endif; ?>


<div id="post-navigator-single">
<div class="alignleft"><?php previous_post_link('&laquo;%link') ?></div>
<div class="alignright"><?php next_post_link('%link&raquo;') ?></div>
</div>


	</div>


	


<?php include(TEMPLATEPATH."/r_sidebar.php");?>





</div>





<!-- The main column ends  -->





<?php get_footer(); ?>

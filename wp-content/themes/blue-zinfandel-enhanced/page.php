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


	</div>

     <div class="post-content"><?php the_content();?> </div>



	


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

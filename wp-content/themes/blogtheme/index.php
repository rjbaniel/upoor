<?php get_header(); ?>

<div id="contentcontainer" class="grid_9 alpha">
<div id="content">

<?php $counter = 0; ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php $counter++; ?>

				

<div class="post">
<div class="meta grid_2 alpha">

<ul>
<li class="auth"><em><?php _e('By', 'blogtheme'); ?></em> <?php the_author_posts_link(); ?></li>
<li class="date"><?php the_time('d/m/y'); ?> <?php _e('at', 'blogtheme'); ?> <?php the_time('H:i'); ?></li>
<li class="comms"><a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?> <?php _e('Comments', 'blogtheme'); ?></a></li>
</ul>

</div><!--grid_2-->

<div class="postbody grid_7 omega <?php if ( $counter == 1 ) { ?>first<?php } ?>">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

<div class="entry">

<?php if ( get_option('woo_the_content') ) { ?>
<?php the_content(); ?>
<?php } else { ?>
<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt(); ?>
<p><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php _e('Continue Reading...', 'blogtheme'); ?></a></p>
<?php } ?>


<p><small><?php _e('Category:', 'blogtheme'); ?> <?php the_category(', ') ?></small></p>
</div><!--entry-->

					

</div><!--grid_7-->


<div class="clearfix"></div>


</div>

			
<?php endwhile; ?>


<?php endif; ?>

	

</div><!--content-->



<div class="clearfix"></div>

<div id="postnav">


<div class="fl"><?php next_posts_link(__('&laquo; Older Entries', 'blogtheme')) ?></div>

<div class="fr"><?php previous_posts_link(__('Newer Entries &raquo;', 'blogtheme')) ?></div>

				
<div class="clearfix"></div>


</div><!--postnav-->

	

</div><!--contentcontainer-->



<?php get_sidebar(); ?>

<?php get_footer(); ?>

<?php

/* 

Template Name: Archives

*/

?>



<?php get_header(); ?>



<!-- content ................................. -->

<div id="content" class="archive">



<?php if (have_posts()) : ?>



	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

	<?php /* If this is a category archive */ if (is_category()) { ?>

	<h2><?php _e('Posts filed under', 'blix'); ?> '<?php echo single_cat_title(); ?>'</h2>



	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>

	<h2><?php _e('Archive for', 'blix'); ?> <?php the_time(__('F jS, Y')); ?></h2>



	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

	<h2><?php _e('Archive for', 'blix');?>
    <?php the_time('F, Y'); ?></h2>



	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

	<h2><?php _e('Archive for', 'blix');?>
    <?php the_time('Y'); ?></h2>



	<?php /* If this is a search */ } elseif (is_search()) { ?>

	<h2><?php _e('Search Results', 'blix');?></h2>



	<?php /* If this is an author archive */ } elseif (is_author()) { ?>

	<h2><?php _e('Author Archive', 'blix');?></h2>



	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

	<h2><?php _e('Blog Archives', 'blix');?></h2>



<?php } ?>



<?php while (have_posts()) : the_post(); ?>



	<div class="entry">



		<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>


        <?php if(function_exists('the_post_thumbnail')) { ?><div class="alignleft"><?php the_post_thumbnail(); ?></div><?php } ?> 
		<?php the_excerpt(); ?>



		<p class="info"><a href="<?php the_permalink() ?>" class="more"><?php _e('Continue Reading', 'blix');?></a>

<?php comments_popup_link(__('Add comment', 'blix'), __('1 comment', 'blix'), __('% comments', 'blix'), __('commentlink', 'blix'), ''); ?>

   		<em class="date"><?php the_time(__('F jS, Y')) ?><!-- at <?php the_time('h:ia')  ?>--></em>

   		<!--<em class="author"><?php the_author(); ?></em>-->

   		<?php edit_post_link(__('Edit', 'blix'), '<span class="editlink">','</span>'); ?>

   		</p>



	</div>





<?php endwhile; ?>



	<p><!-- this is ugly -->

	<span class="next"><?php previous_posts_link(__('Next Posts', 'blix')) ?></span>

	<span class="previous"><?php next_posts_link(__('Previous Posts', 'blix')) ?></span>

	</p>



<?php else : ?>



	<h2><?php _e('Not Found', 'blix');?></h2>

	<p><?php _e("Sorry, but you are looking for something that isn't here.", 'blix');?></p>



<?php endif; ?>



</div> <!-- /content -->



<?php get_sidebar(); ?>



<?php get_footer(); ?>




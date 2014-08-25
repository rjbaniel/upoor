<?php

/**
 * @package WordPress
 * @subpackage golfPR
 */

get_header();
?>

<div id="content_wrapper">
	<div id="content_area">
		<div id="content">
		<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
		<div class="post">	
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'golfpr'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a> : <small><?php the_time('Y-m-d') ?></small></h1>
					<?php the_content(__('...read more', 'golfpr')) ?>
				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> <?php _e('Posted in', 'golfpr'); ?> <?php the_category(', ') ?> | <?php edit_post_link(__('Edit', 'golfpr'), '', ' | '); ?>  <?php comments_popup_link(__('No Comments &#187;', 'golfpr'), __('1 Comment &#187;', 'golfpr'), __('% Comments &#187;', 'golfpr')); ?></p>

			</div>

		<?php endwhile; ?>

         <?php comments_template('',true); ?>


		<div class="post">	
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'golfpr')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'golfpr')) ?></div>
		</div>
		</div>
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf(__("<div class='post'><h1>Sorry, but there aren't any posts in the %s category yet.</h1></div>", 'golfpr'), single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo(__("<div class='post'><h1>Sorry, but there aren't any posts with this date.</h1></div>", 'golfpr'));
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf(__("<div class='post'><h1>Sorry, but there aren't any posts by %s yet.</h1></div>", 'golfpr'), $userdata->display_name);
		} else {
			echo(__("<div class='post'><h1>No posts found.</h1></div>", 'golfpr'));
		}
	

	endif;
?>

	</div>

<?php get_sidebar(); ?>

	<div class="clear"></div>
</div><br />
</div>
<?php get_footer(); ?>

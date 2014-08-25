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
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'golfpr'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					<?php the_content() ?>

                        <?php wp_link_pages('before=<p>&after=</p>'); ?>



			</div>

		<?php endwhile; ?>

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
      <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
	</div>

<?php get_sidebar(); ?>

	<div class="clear"></div>
</div><br />
</div>
<?php get_footer(); ?>

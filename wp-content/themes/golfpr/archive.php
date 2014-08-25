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
		<div class="post">
 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h1><?php _e('Archive for the', 'golfpr'); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category', 'golfpr'); ?></h1>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h1><?php _e('Posts Tagged', 'golfpr'); ?> &#8216;<?php single_tag_title(); ?>&#8217;</h1>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h1 class="pagetitle"><?php _e('Archive for', 'golfpr'); ?> <?php the_time('F jS, Y'); ?></h1>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h1 class="pagetitle"><?php _e('Archive for', 'golfpr'); ?> <?php the_time('F, Y'); ?></h1>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h1 class="pagetitle"><?php _e('Archive for', 'golfpr'); ?> <?php the_time('Y'); ?></h1>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h1 class="pagetitle"><?php _e('Author Archive', 'golfpr'); ?></h1>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1 class="pagetitle"><?php _e('Blog Archives', 'golfpr'); ?></h1>
 	  <?php } ?>

</div>
		<?php while (have_posts()) : the_post(); ?>
		<div class="post">	
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'golfpr'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a> : <small><?php the_time('Y-m-d') ?></small></h1>



<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content( __('<p>Click here to read more</p>', 'blue-moon') ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>



				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> <?php _e('Posted in', 'golfpr'); ?> <?php the_category(', ') ?> | <?php edit_post_link(__('Edit', 'golfpr'), '', ' | '); ?>  <?php comments_popup_link(__('No Comments &#187;', 'golfpr'), __('1 Comment &#187;', 'golfpr'), __('% Comments &#187;', 'golfpr')); ?></p>

			</div>

		<?php endwhile; ?>
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

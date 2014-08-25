<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

	<div id="content" class="narrowcolumn">

		<?php if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle"><?php _e('Categories', 'color-splash'); ?> &#8216;<?php single_cat_title(); ?>&#8217; &raquo; <?php _e('Archive', 'color-splash'); ?></h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="pagetitle"><?php _e('Tag', 'color-splash'); ?> &#8216;<?php single_tag_title(); ?>&#8217; &raquo; <?php _e('Archive', 'color-splash'); ?></h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle"><?php the_time('j, F'); ?> &raquo; <?php _e('Archive', 'color-splash'); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle"><?php the_time('F, Y'); ?> &raquo; <?php _e('Archive', 'color-splash'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle"><?php the_time('Y'); ?> &raquo; <?php _e('Archive', 'color-splash'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle"><?php _e('Author Archive', 'color-splash'); ?></h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle"><?php _e('Blog Archives', 'color-splash'); ?></h2>
 	  <?php } ?>
<hr />
		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<p id="gettocomment"><?php comments_popup_link('0', '1', '%'); ?></p>
				
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'color-splash'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<small id="thetime">	


			
			<span style="color:white"><?php the_time(' F ') ?></span><br />
			<span><?php the_time(' j ') ?></span>
			</small>
				
				
				


				<div class="entry">
				<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt(__('read more... &raquo;', 'color-splash')); ?>
				</div>
<p id="gettocategory"><?php the_category(', ') ?></p>
				<p class="metadata">
					
				<img src="<?php bloginfo('template_directory'); ?>/Icons/Tag1.gif" />
				<small>
				<?php the_tags(' ', ' ', ''); ?>
				</small>
				
				
				




				</p>
			</div>
<hr />
		<?php endwhile; ?>

		<div class="navigation">
			<div class="navileft"><?php next_posts_link(__('&laquo; older Entries', 'color-splash')) ?></div>
			<div class="navileft"><?php previous_posts_link(__('newer Entries &raquo;', 'color-splash')) ?></div>
		</div>
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf(__("<h2 class='center'>Sorry, no %s Categories</h2>", 'color-splash'), single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo(__("<h2>Sorry,not found</h2>", 'color-splash'));
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf(__("<h2 class='center'>Sorry, nothing of %.</h2>", 'color-splash'), $userdata->display_name);
		} else {
			echo(__("<h2 class='center'>No posts found.</h2>", 'color-splash'));
		}

	endif;
?>

	</div>


<?php get_footer(); ?>

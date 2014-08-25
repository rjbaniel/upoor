<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

		<?php if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for the', 'blakmagik'); ?> &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="pagetitle"><?php _e('Posts Tagged', 'blakmagik'); ?> &#8216;<?php single_tag_title(); ?>&#8217;</h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', 'blakmagik'); ?> <?php the_time('F jS, Y'); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', 'blakmagik'); ?> <?php the_time('F, Y'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', 'blakmagik'); ?> <?php the_time('Y'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle"><?php _e('Author Archive', 'blakmagik'); ?></h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle"><?php _e('Blog Archives', 'blakmagik'); ?></h2>
 	  <?php } ?>




		<?php while (have_posts()) : the_post(); ?>
		<div class="post">
	<div class="comments"><?php comments_popup_link(__('NO COMMENTS', 'blakmagik'), __('<span> 1 </span> COMMENTS', 'blakmagik'), __('<span> % </span> COMMENTS', 'blakmagik')); ?></div>
				<div class="PostHead">

<div class="PostTime"><?php the_time('<b>j</b> M Y') ?> </div>
<h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<small class="PostDet"><?php edit_post_link('Edit', '', ' | '); ?> <?php _e('Author:', 'blakmagik'); ?> <?php the_author() ?> | <?php _e('Filed under:', 'blakmagik'); ?> <?php the_category(', ') ?></small>

</div>

			

			</div>
	<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?></p>
		<?php endwhile; ?>

	
	<?php else : ?>

		<h2 class="center"><?php _e('Not Found', 'blakmagik'); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

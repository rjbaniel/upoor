<?php get_header(); ?>



	<div id="content">

	

	<div id="maincontent">

	<div class="topcorner"></div>

		<div class="contentpadding">

	<?php if (have_posts()) : ?>

	 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

 	  <?php /* If this is a category archive */ if (is_category()) { ?>

		<h2 class="pagetitle"><?php _e('Archive for the', 'diary-cute'); ?> <?php single_cat_title(); ?> <?php _e('Category', 'diary-cute'); ?></h2>

 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>

		<h2 class="pagetitle"><?php _e('Posts Tagged', 'diary-cute'); ?> <?php single_tag_title(); ?></h2>

 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>

		<h2 class="pagetitle"><?php _e('Archive for', 'diary-cute'); ?> <?php the_time('F jS, Y'); ?></h2>

 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

		<h2 class="pagetitle"><?php _e('Archive for', 'diary-cute'); ?> <?php the_time('F, Y'); ?></h2>

 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

		<h2 class="pagetitle"><?php _e('Archive for', 'diary-cute'); ?> <?php the_time('Y'); ?></h2>

	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>

		<h2 class="pagetitle"><?php _e('Author Archive', 'diary-cute'); ?></h2>

 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

		<h2 class="pagetitle"><?php _e('Blog Archives', 'diary-cute'); ?></h2>

 	  <?php } ?>

<?php $postnumber = '1' ?>

                <br /><br />

		<?php while (have_posts()) : the_post(); ?>



			<div class="post" id="post-<?php the_ID(); ?>">

				<div class="postdate"><?php the_time('j') ?><br /><span><?php the_time('M') ?></span></div>

				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'diary-cute'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<small> <!-- by <?php the_author() ?> -->Posted in <?php the_category(', ') ?> | <?php edit_post_link(__('Edit', 'diary-cute'), '', ' | '); ?>  <?php comments_popup_link(__('No Comments &#187;', 'diary-cute'), __('1 Comment &#187;', 'diary-cute'), __('% Comments &#187;', 'diary-cute')); ?></small>



				<div class="entry">

 <?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

				</div>



				<p class="postmetadata"><?php the_tags(__('Tags: ', 'diary-cute'), ', '); ?></p>

			</div>



		<?php endwhile; ?>



		<div class="navigation">

			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'diary-cute')) ?></div>

			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'diary-cute')) ?></div>

		</div>



	<?php else : ?>



		<h2 class="center"><?php _e('Not Found', 'diary-cute'); ?></h2>

		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.", 'diary-cute'); ?></p>

		<?php include (TEMPLATEPATH . "/searchform.php"); ?>



	<?php endif; ?>
    <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?> 
	<div class="clear"></div>

		</div>

	<div class="bottomcorner"></div>

	</div>

<?php get_sidebar(); ?>

<div class="clear"></div>

	</div>

<?php get_footer(); ?>


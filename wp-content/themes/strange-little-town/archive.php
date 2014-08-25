<?php get_header(); ?>



		<?php if (have_posts()) : ?>



		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

		<?php /* If this is a category archive */ if (is_category()) { ?>

		<h2><?php _e('Archive for the', 'slt'); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category', 'slt'); ?></h2>

		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>

		<h2><?php _e('Posts Tagged', 'slt'); ?> &#8216;<?php single_tag_title(); ?>&#8217;</h2>

		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>

		<h2><?php _e('Archive for', 'slt'); ?> <?php the_time('F jS, Y'); ?></h2>

		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

		<h2><?php _e('Archive for', 'slt'); ?> <?php the_time('F, Y'); ?></h2>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

		<h2><?php _e('Archive for', 'slt'); ?> <?php the_time('Y'); ?></h2>

		<?php /* If this is an author archive */ } elseif (is_author()) { ?>

		<h2><?php _e('Author Archive', 'slt'); ?></h2>

		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

		<h2><?php _e('Blog Archives', 'slt'); ?></h2>

		<?php } ?>



		<?php while (have_posts()) : the_post(); ?>

				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'slt'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

                

				<div class="time">

                <span class="edit"><?php comments_popup_link(__('No Comments &#187;', 'slt'), __('1 Comment &#187;', 'slt'), __('% Comments &#187;', 'slt')); ?><?php edit_post_link(__('Edit', 'slt'), '|', ''); ?></span>

                <p><?php the_time('F jS, Y') ?> <span class="gray"><?php _e('Posted', 'slt'); ?> <?php the_time() ?></span></p>

                </div>

                

				<?php the_excerpt() ?>



					<div class="details">

                    <p><?php the_tags('Tags: ', ', ', '<br />'); ?> <?php _e('Posted in', 'slt'); ?> <?php the_category(', ') ?></p>

                    </div>



		<?php endwhile; ?>



            <div class="navigation"><p><?php posts_nav_link(); ?></p></div>



	<?php else : ?>



		<h2><?php _e('Not Found', 'slt'); ?></h2>

		<?php include (TEMPLATEPATH . '/searchform.php'); ?>



	<?php endif; ?>

    

        </div>



<?php get_sidebar(); ?>



<?php get_footer(); ?>


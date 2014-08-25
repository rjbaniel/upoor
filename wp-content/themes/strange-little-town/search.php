<?php get_header(); ?>



	<?php if (have_posts()) : ?>



		<h2><?php _e('Search Results', 'slt'); ?></h2>



		<?php while (have_posts()) : the_post(); ?>



			<div class="post">

				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'slt'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

					<div class="time">

                    <span class="edit"><?php comments_popup_link(__('No Comments &#187;', 'slt'), __('1 Comment &#187;', 'slt'), __('% Comments &#187;', 'slt') ); ?><?php edit_post_link(__('Edit', 'slt'), '|', ''); ?></span>

                    <p><?php the_time('F jS, Y') ?> <span class="gray"><?php _e('Posted', 'slt'); ?> <?php the_time() ?></span></p>

                    </div>

					<div class="details">

                    <p><?php the_tags('Tags: ', ', ', '<br />'); ?> <?php _e('Posted in', 'slt'); ?> <?php the_category(', ') ?></p>

                    </div>

			</div>



		<?php endwhile; ?>



            <div class="navigation"><p><?php posts_nav_link(); ?></p></div>



	<?php else : ?>



		<h2><?php _e('No posts found. Try a different search?', 'slt'); ?></h2>

		<?php include (TEMPLATEPATH . '/searchform.php'); ?>



	<?php endif; ?>



        </div>

                    



<?php get_sidebar(); ?>





<?php get_footer(); ?>

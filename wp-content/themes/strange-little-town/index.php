<?php get_header(); ?>



			<?php if (have_posts()) : ?>



				<?php while (have_posts()) : the_post(); ?>



				<div class="post" id="post-<?php the_ID(); ?>">

					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

					<div class="time">

                    <span class="edit"><?php comments_popup_link(__('No Comments &#187;', 'slt'), __('1 Comment &#187;', 'slt'), __('% Comments &#187;', 'slt')); ?><?php edit_post_link(__('Edit', 'slt'), '|', ''); ?></span>

                    <p><?php the_time('F jS, Y') ?> <span class="gray"><?php _e('Posted', 'slt'); ?> <?php the_time() ?></span></p>

                    </div>



					<?php the_content(__('Read the rest of this entry &raquo;', 'slt')); ?>



					<div class="details">

                    <p><?php the_tags('Tags: ', ', ', '<br />'); ?> <?php _e('Posted in', 'slt'); ?> <?php the_category(', ') ?></p>

                    </div>



                </div>



			<?php endwhile; ?>

            

            <div class="navigation"><p><?php posts_nav_link(); ?></p></div>

		

			<?php else : ?>



				<h2><?php _e('Not Found', 'slt'); ?></h2>

				<p><?php _e("Sorry, but you are looking for something that isn't here.", 'slt'); ?></p>

				<?php include (TEMPLATEPATH . "/searchform.php"); ?>



			<?php endif; ?>



        </div>

                    



<?php get_sidebar(); ?>





<?php get_footer(); ?>

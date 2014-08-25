<?php get_header(); ?>



	<div id="content">

	

	<div id="maincontent">

	<div class="topcorner"></div>

		<div class="contentpadding">

	<?php if (have_posts()) : ?>

	 	 

<?php $postnumber = '1' ?>



		<?php while (have_posts()) : the_post(); ?>



			<div class="post" id="post-<?php the_ID(); ?>">

				<div class="postdate"><?php the_time('j') ?><br /><span><?php the_time('M') ?></span></div>

				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'diary-cute'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<small> <!-- by <?php the_author() ?> -->Posted in <?php the_category(', ') ?> | <?php edit_post_link(__('Edit', 'diary-cute'), '', ' | '); ?>  <?php comments_popup_link(__('No Comments &#187;', 'diary-cute'), __('1 Comment &#187;', 'diary-cute'), __('% Comments &#187;', 'diary-cute')); ?></small>



				<div class="entry">

					<?php the_content(__('Read the rest of this entry &raquo;', 'diary-cute')); ?>

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


        <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

	<div class="clear"></div>

		</div>

	<div class="bottomcorner"></div>

	</div>

<?php get_sidebar(); ?>

<div class="clear"></div>

	</div>

<?php get_footer(); ?>


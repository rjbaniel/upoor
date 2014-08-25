<?php get_header(); ?>





	<div id="content" class="narrowcolumn">


<!--<div id="headerimg"></div>-->


	<?php if (have_posts()) : ?>





		<h2 class="pagetitle"><?php _e('Search Results', 'batavia');?></h2>


		


		<div class="navigation">


			<div class="alignleft"><?php posts_nav_link('','',__('&laquo; Previous Entries', 'batavia')) ?></div>


			<div class="alignright"><?php posts_nav_link('',__('Next Entries &raquo;', 'batavia'),'') ?></div>


		</div>








		<?php while (have_posts()) : the_post(); ?>


				


			<div class="post">


				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'batavia');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>


				<small><?php the_time('l, F jS, Y') ?></small>


				


				<div class="entry">


					<?php the_excerpt() ?>


				</div>


		


				<p class="postmetadata"><?php _e('Posted in ', 'batavia');?> <?php the_category(', ') ?> <strong>|<strong><?php the_tags( '&nbsp;' . __( 'Tagged' , 'batavia') . ' ', ', ', ''); ?></strong>|</strong> <?php edit_post_link(__('Edit', 'batavia'), '','<strong>|</strong>'); ?>  <?php comments_popup_link(__('No Comments &#187;', 'batavia'), __('1 Comment &#187;', 'batavia'), __('% Comments &#187;', 'batavia')); ?></p>


				


				<!--


				<?php trackback_rdf(); ?>


				-->


			</div>


	


		<?php endwhile; ?>





        <div class="navigation">
			<div class="alignleft"><?php posts_nav_link('','',__('&laquo; Previous Entries', 'batavia')) ?></div>
			<div class="alignright"><?php posts_nav_link('',__('Next Entries &raquo;', 'batavia'),'') ?></div>
		</div>


	


	<?php else : ?>





		<h2 class="center"><?php _e('Not Found', 'batavia');?></h2>


		<?php include (TEMPLATEPATH . '/searchform.php'); ?>





	<?php endif; ?>


		


	</div>





<?php get_sidebar(); ?>





<?php get_footer(); ?>

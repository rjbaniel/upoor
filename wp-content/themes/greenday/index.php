<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<h3 class="cdate">
					<div id="date"><?php the_time('d') ?></div>
					<div id="mon"><?php the_time('M') ?></div>
					<div id="year"><?php the_time('Y') ?></div>
				</h3>
				<div class="post" id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','greenday');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<small><?php _e('by','greenday'); ?> <?php the_author_posts_link(); ?>&nbsp;<?php the_tags( '&nbsp;' . __( 'and tagged','greenday' ) . ' ', ', ', ''); ?></small>

				<div class="entry">

                  <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content(__('Read the rest of this entry &raquo;','greenday')); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>


				</div>

				<p class="postmetadata"><?php _e('Posted in ','greenday');?> <?php the_category(', ') ?> | <?php edit_post_link(__('Edit','greenday'), '', ' | '); ?>  <?php comments_popup_link(__('No Comments &#187;','greenday'), __('1 Comment &#187;','greenday'), __('% Comments &#187;','greenday')); ?></p>
			</div>

		<?php endwhile; ?>



		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','greenday')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','greenday')) ?></div>
		</div>



	<?php else : ?>

		<h2 class="center"><?php _e('Not Found','greenday');?></h2>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.",'greenday');?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

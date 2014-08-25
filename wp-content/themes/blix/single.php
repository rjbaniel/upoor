<?php get_header(); ?>

<!-- content ................................. -->
<div id="content">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

	<div class="entry single">

		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

		<p class="info">
		<?php if ($post->comment_status == "open") ?>
   		<em class="date"><?php the_time(get_option('date_format')) ?><!-- at <?php the_time()  ?>--></em>
   		<!--<em class="author"><?php the_author(); ?></em>-->
   		<?php edit_post_link(__('Edit', 'blix'), '<span class="editlink">','</span>'); ?>
   		</p>

		<?php the_content();?>

		<p id="filedunder"><?php _e('Entry Filed under:', 'blix'); ?> <?php the_category(','); ?>.  <?php _e("Posted in", 'blix'); ?>&nbsp; <?php the_category(' ,'); ?> <?php the_tags( __( 'Tags' ) . ': ', ', ', ''); ?>.</p>

   </div>

<?php endwhile; ?>

<?php else : ?>

	<h2><?php _e('Not Found', 'blix');?></h2>
	<p><?php _e("Sorry, but you are looking for something that isn't here.", 'blix'); ?></p>

<?php endif; ?>

<?php comments_template('',true); ?>

</div> <!-- /content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

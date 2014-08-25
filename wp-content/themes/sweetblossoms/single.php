<?php get_header(); ?>

<!-- content ................................. -->
<div id="main">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

	<div class="main">

		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

		<p class="info">
		<?php if ($post->comment_status == "open") ?>
   		<em class="date"><?php the_time(get_option('date_format')) ?><!-- at <?php the_time()  ?>--></em>
   		<em class="author"><?php the_author(); ?></em>
   		<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN),'<span class="editlink">','</span>'); ?>
		<br />
		<?php the_tags( '<p>' . __('Tags: ',TEMPLATE_DOMAIN), ', ', '</p>'); ?>
   		</p>

		<?php the_content();?>

		<p id="filedunder"><?php _e("Entry Filed under:",TEMPLATE_DOMAIN); ?> <?php the_category(','); ?></p>

<?php endwhile; ?>

<?php else : ?>

	<h2><?php _e("Not Found",TEMPLATE_DOMAIN); ?></h2>
	<p><?php _e("Sorry, but you are looking for something that isn't here.",TEMPLATE_DOMAIN); ?></p>

<?php endif; ?>

<?php comments_template('',true); ?>

</div> <!-- /content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

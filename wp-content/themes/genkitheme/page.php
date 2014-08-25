<?php get_header(); ?>
<div id="contentwrapper">
<div id="content">
 <div id="custom-img-header">
<h1><a title="<?php _e('back to','genki'); ?> <?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
<p><?php bloginfo('description'); ?></p>
</div>

	<?php if (have_posts()) :?>
		<?php $postCount=0; ?>
		<?php while (have_posts()) : the_post();?>
			<?php $postCount++;?>
	<div class="entry entry-<?php echo $postCount ;?>">
		<div class="entrytitle">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','genki');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		</div>

		<div class="entrybody">
			<?php the_content(); ?>

            <?php wp_link_pages('before=<p>&after=</p>'); ?>

			<?php edit_post_link(__('&raquo; Edit this page','genki')); ?>
		</div>

	</div>

	<div class="commentsblock">
	  <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
	</div>

	<?php endwhile; ?>

	<?php else : ?>

		<h2><?php _e('Not Found','genki');?></h2>
		<div class="entrybody"><?php _e("Sorry, but you are looking for something that isn't here.",'genki');?></div>

	<?php endif; ?>

</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

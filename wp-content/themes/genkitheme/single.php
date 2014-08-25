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
			<h3><?php the_category(', ') ?> <?php the_time(__('F jS, Y')) ?> </h3>
		</div>

		<div class="entrybody">

			
			       <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

			<?php the_content(); ?>

             <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

		</div>
		
		<br />
		
		<div class="entrymeta">
		<div class="postinfo">

			<a class="commentmeta" href="#respond"><?php _e('Leave a Comment','genki');?></a>
			<a class="commentrss" href="<?php echo get_post_comments_feed_link(); ?>" rel="nofollow"><?php _e('Comment RSS','genki'); ?></a> <?php edit_post_link(__('Edit','genki'), ' | ', ' | '); ?> <?php the_tags( '&nbsp;' . __( 'Tagged' ,'genki') . ' ', ', ', ''); ?>
			
		</div>
		</div>

		<br />

		<div class="navigation">
			<?php previous_post_link('Previous: %link', '', 'yes'); ?>
			<br />
			<?php next_post_link('Next: %link', '', 'yes'); ?>
		</div>

	</div>		

	<div class="commentsblock">
		<?php comments_template('',true); ?>
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

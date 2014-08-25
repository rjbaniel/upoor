<?php get_header(); ?>

<div id="content">

<?php if (have_posts()) : ?>
	<!-- first pass: show only the latest post -->
	<?php query_posts("showposts=1"); ?>
	<?php while (have_posts()) : the_post(); ?>
	<div class="homeTop" id="post-<?php the_ID(); ?>">
		<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e("Permanent Link to",TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h1>
	
	<div class="post-date">
	<span class="post-month"><?php the_time('M') ?></span> 
	<span class="post-day"><?php the_time('d') ?></span>
	<span class="post-year"><?php the_time('Y') ?></span>
	</div>
	<small><?php _e("By",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link() ?> <?php edit_post_link(__('(edit)',TEMPLATE_DOMAIN)); ?></small>

			<div class="entry">
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink() ?>" class="readmore" rel="bookmark" title="<?php _e("Permanent Link to",TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php _e("Continue Reading&rarr;",TEMPLATE_DOMAIN); ?></a>
			</div>

		<p class="postmetadata">
			<?php _e("Filed under:",TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?>. |
				<?php the_tags(__('Tags: ',TEMPLATE_DOMAIN), ', '); ?><br />
				<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN),'',''); ?> | <?php comments_popup_link(__('No Comments &#187;',TEMPLATE_DOMAIN), __('1 Comment &#187;',TEMPLATE_DOMAIN), __('% Comments &#187;',TEMPLATE_DOMAIN)); ?></p>


		</div>
	<?php endwhile; ?>
	
	<!-- second pass: show remaining posts -->
	<?php query_posts("showposts=4&offset=1"); ?>
	<?php while (have_posts()) : the_post(); ?>
	<div class="homeOther" id="post-<?php the_ID(); ?>">
		<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e("Permanent Link to",TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h1>
		
	<div class="post-date">
	<span class="post-month"><?php the_time('M') ?></span> 
	<span class="post-day"><?php the_time('d') ?></span>
	<span class="post-year"><?php the_time('Y') ?></span>
	</div>
		<small><?php _e("By",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link() ?> <?php edit_post_link(__('(edit)',TEMPLATE_DOMAIN)); ?></small>

			<div class="entry">
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink() ?>" class="readmore" rel="bookmark" title="<?php _e("Permanent Link to",TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php _e("Continue Reading&rarr;",TEMPLATE_DOMAIN); ?></a>
			</div>

		<p class="postmetadata">
			<?php _e("Filed under:",TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?>. |
				<?php the_tags(__('Tags: ',TEMPLATE_DOMAIN), ', '); ?><br />
				<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN),'',''); ?> | <?php comments_popup_link(__('No Comments &#187;',TEMPLATE_DOMAIN), __('1 Comment &#187;',TEMPLATE_DOMAIN), __('% Comments &#187;',TEMPLATE_DOMAIN)); ?></p>
		</div> 
	<?php endwhile; ?>

<?php else: ?>
	<p><?php _e("Sorry, there was an error reading posts.",TEMPLATE_DOMAIN); ?></p>
<?php endif; ?>


<div class="navigation">
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
</div>
			
</div><!-- end content -->

<?php include(TEMPLATEPATH."/left.php");?>
<?php include(TEMPLATEPATH."/right.php");?>

<?php get_footer(); ?>

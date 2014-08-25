<?php get_header(); ?>

<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="post hentry<?php if (function_exists('sticky_class')) { sticky_class(); } ?>">
<h2 id="post-<?php the_ID(); ?>" class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<?php if ( comments_open() ) { ?><p class="comments"><a href="<?php comments_link(); ?>"><?php comments_number(__('leave a comment', 'journalist'),__('one comment', 'journalist'),__('% comments', 'journalist')); ?></a></p><?php } ?>

<div class="main entry-content">
	<?php the_content(__('Read the rest of this entry &raquo;', 'journalist')); ?>
</div>


</div><!-- END .hentry -->

<?php if ( comments_open() ) comments_template('',true); ?>

<?php endwhile; else: ?>
<div class="warning">
	<p><?php _e("Sorry, but you are looking for something that isn't here.", 'journalist'); ?></p>
</div>
<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

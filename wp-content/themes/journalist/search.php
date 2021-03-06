<?php get_header(); ?>

<div id="content">
<?php if (have_posts()) : ?>

<h2 class="archive">Search Results</h2>

<?php while (have_posts()) : the_post(); ?>
<div class="post hentry<?php if (function_exists('sticky_class')) { sticky_class(); } ?>">
<h2 id="post-<?php the_ID(); ?>" class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<p class="comments"><a href="<?php comments_link(); ?>"><?php comments_number(__('leave a comment', 'journalist'),__('one comment', 'journalist'),__('% comments', 'journalist')); ?></a></p>

<div class="main entry-content">
	<?php the_content(__('Read the rest of this entry &raquo;', 'journalist')); ?>
</div>

<div class="meta group">
<div class="signature">
    <p class="author vcard"><?php _e('Written by', 'journalist'); ?> <span class="fn"><?php the_author() ?></span> <span class="edit"><?php edit_post_link(__('Edit', 'journalist')); ?></span></p>
    <p><abbr class="updated" title="<?php the_time('Y-m-d\TH:i:s')?>"><?php the_time('F jS, Y'); ?> <?php _e("at", 'journalist'); ?> <?php the_time('g:i a'); ?></abbr></p>
</div>
<div class="tags">
    <p><?php _e('Posted in', 'journalist'); ?> <?php the_category(',') ?></p>
    <?php if ( the_tags('<p>Tagged with ', ', ', '</p>') ) ?>
</div>
</div>
</div><!-- END .hentry -->

<?php if ( comments_open() ) comments_template(); ?>

<?php endwhile; ?>
<div class="navigation">
    	<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'journalist')) ?></div>
	<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'journalist')) ?></div>
</div>
<?php else : ?>
	<h2><?php _e('No posts found.', 'journalist'); ?></h2>
	<div class="warning">
		<p><?php _e('Apologies, but we were unable to find what you were looking for. Try a different search?', 'journalist'); ?></p>
	</div>
<?php endif; ?>

</div> 

<?php get_sidebar(); ?>

<?php get_footer(); ?>

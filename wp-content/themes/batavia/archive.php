<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

		<?php if (have_posts()) : ?>

		 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>				
		<h2 class="pagetitle"><?php _e('Archive for the', 'batavia');?> '<?php echo single_cat_title(); ?>' <?php _e('Category', 'batavia');?></h2>
		
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', 'batavia');?>
    <?php the_time(__('F jS, Y')); ?></h2>
		
	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', 'batavia');?>
    <?php the_time('F, Y'); ?></h2>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', 'batavia');?>
    <?php the_time('Y'); ?></h2>
		
	  <?php /* If this is a search */ } elseif (is_search()) { ?>
		<h2 class="pagetitle"><?php _e('Search Results', 'batavia');?></h2>
		
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle"><?php _e('Author Archive', 'batavia');?></h2>

		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle"><?php _e('Blog Archives', 'batavia');?></h2>

		<?php } ?>


		<div class="navigation">
			<div class="alignleft"><?php posts_nav_link('','',__('&laquo; Previous Entries', 'batavia')) ?></div>
			<div class="alignright"><?php posts_nav_link('',__('Next Entries &raquo;', 'batavia'),'') ?></div>
		</div>

		<?php while (have_posts()) : the_post(); ?>
		<div class="post">
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'batavia');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<small><?php the_time('l, F jS, Y') ?></small>
				
				<div class="entry"><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280shadow"); } ?>
					<?php the_excerpt() ?><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280shadow"); } ?>
				</div>
		
				<p class="postmetadata"><?php _e('Posted in ', 'batavia');?> <?php the_category(', ') ?> <strong>|</strong> <?php edit_post_link(__('Edit', 'batavia'), '','<strong>|</strong>'); ?>  <?php comments_popup_link(__('No Comments &#187;', 'batavia'), __('1 Comment &#187;', 'batavia'), __('% Comments &#187;', 'batavia')); ?></p>

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

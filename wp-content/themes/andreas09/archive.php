<?php get_header(); ?>
<?php get_sidebar(); ?>
<?php include (TEMPLATEPATH . '/right-sidebar.php'); ?>

<div id="content">
	<?php if (have_posts()) : ?>
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>				
			<h1 class="pagetitle"><?php _e('Archive for the','andreas09'); ?> '<?php echo single_cat_title(); ?>' <?php _e('Category','andreas09'); ?></h1>
			<p><strong><em><?php echo category_description(); ?></em></strong></p>
 		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h1 class="pagetitle"><?php _e('Archive for','andreas09'); ?> <?php the_time(__('F jS, Y')); ?></h1>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h1 class="pagetitle"><?php _e('Archive for','andreas09'); ?> <?php the_time('F, Y'); ?></h1>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h1 class="pagetitle"><?php _e('Archive for','andreas09'); ?> <?php the_time('Y'); ?></h1>
		<?php /* If this is a search */ } elseif (is_search()) { ?>
			<h1 class="pagetitle"><?php _e('Search Results','andreas09'); ?></h1>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h1 class="pagetitle"><?php _e('Author Archive','andreas09'); ?></h1>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h1 class="pagetitle"><?php _e('Blog Archives','andreas09'); ?></h1>
	<?php } ?>

	<div class="navigation">
		<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','andreas09')) ?></div>
		<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','andreas09')) ?></div>
	</div>
		
	<?php while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>"><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("46860nocolor"); } ?>
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','andreas09'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>

			<p class="date"><?php _e('Posted by','andreas09') ?> <?php if (get_the_author_meta('url')) { ?><a href="<?php the_author_meta('url'); ?>"><?php the_author(); ?></a><?php } else { the_author(); } ?> <?php _e('on','andreas09') ?> <?php the_time(__('jS F Y','andreas09')) ?></p>
                   
				<div class="entry">

<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php } else { ?>

<?php the_content(__('Read the rest of this entry &raquo;','andreas09')); ?>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>






				</div>
                    
			<p class="category"><?php _e('Posted in','andreas09'); ?> <?php the_category(', ') ?> | <?php edit_post_link(__('Edit','andreas09'), '', ' | '); ?>  <?php comments_popup_link(__('No Comments &#187;','andreas09'), __('1 Comment &#187;','andreas09'), __('% Comments &#187;','andreas09')); ?></p>
		</div>
	
	<?php endwhile; ?>
	
	<div class="bottomnavigation">
		<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','andreas09')) ?></div>
		<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','andreas09')) ?></div>
	</div>
		
	<?php else : ?>
	<div id="page">
		<h1 class="center"><?php _e('Not Found','andreas09'); ?></h1>
		<p class="center"><?php _e('Sorry, but you are looking for something that isn\'t here.','andreas09'); ?></p>
		<p class="center"><?php _e('Perhaps you would like to try a search or select from one of the links on the menu.','andreas09'); ?></p>
	</div>
	<?php endif; ?>

</div>

<?php get_footer(); ?>

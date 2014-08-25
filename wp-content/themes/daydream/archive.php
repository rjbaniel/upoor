<?php get_header(); ?>

	<div id="content" class="sanda">

		<?php if (have_posts()) : ?>

			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			
			<?php /* If this is a category archive */ if (is_category()) { ?>				
				<h2 class="pagetitle"><?php _e('Archive for the','daydream');?> '<?php echo single_cat_title(); ?>' <?php _e('Category','daydream');?></h2>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h2 class="pagetitle"><?php _e('Archive for','daydream');?>
    <?php the_time(__('F jS, Y')); ?></h2>
			
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h2 class="pagetitle"><?php _e('Archive for','daydream');?>
    <?php the_time('F, Y'); ?></h2>
	
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h2 class="pagetitle"><?php _e('Archive for','daydream');?>
    <?php the_time('Y'); ?></h2>
			
			<?php /* If this is a search */ } elseif (is_search()) { ?>
				<h2 class="pagetitle"><?php _e('Search Results for','daydream'); ?> '<?php echo $s; ?>'</h2>
			
			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h2 class="pagetitle"><?php _e('Author Archive','daydream');?></h2>
	
			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h2 class="pagetitle"><?php _e('Blog Archives','daydream');?></h2>
	
			<?php } ?>
	

<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','daydream');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<div class="data"><?php the_time(get_option('date_format')) ?> - <?php comments_popup_link(__('No Responses','daydream'), __('One Response','daydream'), __('% Responses','daydream')); ?></div>

<div class="entry">

<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content( __('...more &raquo;', 'daydream') ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>


</div>

<p class="postmetadata">
<?php _e('Categorised in','daydream'); ?> <?php the_category(', '); ?> <?php edit_post_link(__('Edit','daydream'), '&nbsp;&nbsp;|&nbsp;&nbsp;', ''); ?>
<br /><?php the_tags(__('Tags: ','daydream'), ', ', ''); ?></p>

</div>
			
<?php endwhile; ?>
	
	
<?php
			
				// This young snippet fixes the problem of a grey navigation bar
				// when there is nothing to fill it, a bit pointless having it sitting
				// there all empty and unfufilled
				
				$numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'");
				$perpage = $wpdb->get_var("SELECT option_value FROM $wpdb->options WHERE option_name = 'posts_per_page'");
	
				if ($numposts > $perpage) {
				
			?>
					
					<div class="navigation">
						<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','daydream')) ?></div>
						<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','daydream')) ?></div>
					</div>
					
			<?php }	?>
	
		<?php else : ?>

			<h2><?php _e('No Data Found','daydream'); ?></h2>
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>

		<?php endif; ?>
		
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

<?php get_header(); ?>

<?php include (TEMPLATEPATH . "/sidebar1.php"); ?>	

		<div id="content">

		<?php if (have_posts()) : ?>

		 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>

<h2 class="sectionhead"><a href="<?php echo get_category_link($cat); ?>feed"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.gif" alt="RSS Feed for <?php echo single_cat_title(); ?>" title="<?php _e("RSS Feed for the",TEMPLATE_DOMAIN); ?> '<?php echo single_cat_title(); ?>' <?php _e("Category",TEMPLATE_DOMAIN); ?>" style="float:right;margin: 2px 0 0 5px;" /></a><?php _e("Category:",TEMPLATE_DOMAIN); ?> <?php echo single_cat_title(); ?></h2>
		
<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
<h2 class="sectionhead"><?php _e('Archive for',TEMPLATE_PATH);?>
    <?php the_time(__('F jS, Y')); ?></h2>
		
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<h2 class="sectionhead"><?php _e('Archive for',TEMPLATE_PATH);?>
    <?php the_time('F, Y'); ?></h2>

<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<h2 class="sectionhead"><?php _e('Archive for',TEMPLATE_PATH);?>
    <?php the_time('Y'); ?></h2>
		
<?php /* If this is a search */ } elseif (is_search()) { ?>
<h2 class="sectionhead"><?php _e('Search Results',TEMPLATE_PATH);?></h2>
		
<?php /* If this is an author archive */ } elseif (is_author()) { ?>
<h2 class="sectionhead"><?php _e('Author Archive',TEMPLATE_PATH);?></h2>

<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<h2 class="sectionhead"><?php _e('Blog Archives',TEMPLATE_PATH);?></h2>

		<?php } ?>

<?php while (have_posts()) : the_post(); ?>

			
				<div class="post" id="post-<?php the_ID(); ?>">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_PATH);?> <?php the_title(); ?>"><?php the_title(); ?> &raquo;</a></h2>

<p class="postinfo"><?php _e("By",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e('on',TEMPLATE_PATH);?> <?php the_time('M j, Y') ?> <?php _e('in',TEMPLATE_PATH);?> <?php the_category(', ') ?> | <?php comments_popup_link(__('0 Comments',TEMPLATE_PATH), __('1 Comment',TEMPLATE_PATH), __('% Comments',TEMPLATE_PATH)); ?><?php edit_post_link(__('Edit',TEMPLATE_PATH), ' | ', ''); ?></p>
			
					<div class="entry">

<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content( __('<p>Click here to read more</p>',TEMPLATE_DOMAIN) ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php } ?>


					</div>
				</div>        

<?php endwhile; endif; ?>

				<div class="navigation">
					<div class="alignleft">
						<?php next_posts_link(__('&laquo; Previous Posts',TEMPLATE_PATH)) ?>
					</div>
					<div class="alignright">
						<?php previous_posts_link(__('Next Posts  &raquo;',TEMPLATE_PATH)) ?>
					</div>
	               		</div>

                </div>

		</div>

<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>

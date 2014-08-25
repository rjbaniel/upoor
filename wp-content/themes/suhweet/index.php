<?php get_header(); ?>

<?php if ( $paged < 2 ) { // Do stuff specific to first page?>

<?php $my_query = new WP_Query('category_name=featured&showposts=1');
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID; ?>

<h2 class="sectionhead"><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.gif" alt="<?php _e("Main Content RSS Feed",TEMPLATE_DOMAIN); ?>" title="<?php _e("Main Content RSS Feed",TEMPLATE_DOMAIN); ?>" style="float:right;margin: 2px 0 0 5px;" /></a><?php _e("Feature Article",TEMPLATE_DOMAIN); ?></h2>

<div class="featurepost" id="post-<?php the_ID(); ?>">

  <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_PATH);?> <?php the_title(); ?>"><?php the_title(); ?> &raquo;</a></h2>

 <p class="postinfo"><?php _e("By",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e('on',TEMPLATE_PATH);?> <?php the_time('M j, Y') ?> <?php _e('in',TEMPLATE_PATH);?> <?php the_category(', ') ?><?php the_tags( '&nbsp;' . __( 'and tagged',TEMPLATE_PATH ) . ' ', ', ', ''); ?> | <?php comments_popup_link(__('0 Comments',TEMPLATE_PATH), __('1 Comment',TEMPLATE_PATH), __('% Comments',TEMPLATE_PATH)); ?><?php edit_post_link(__('Edit',TEMPLATE_PATH), ' | ', ''); ?></p>

<div class="entry">
<?php the_content( __('Read the rest',TEMPLATE_PATH) ); ?>
</div>

</div>
  	
<?php endwhile; ?>

<?php include (TEMPLATEPATH . "/sidebar1.php"); ?>

<div id="content">

<h2 class="sectionhead"><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.gif" alt="<?php _e("Main Content RSS Feed",TEMPLATE_DOMAIN); ?>" title="<?php _e("Main Content RSS Feed",TEMPLATE_DOMAIN); ?>" style="float:right;margin: 2px 0 0 5px;" /></a><?php _e("Recent Articles",TEMPLATE_DOMAIN); ?></h2>

<?php if (have_posts()) : while (have_posts()) : the_post();
$do_not_duplicate = isset($do_not_duplicate)?$do_not_duplicate:'';
if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); ?>

<div class="post" id="post-<?php the_ID(); ?>">

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_PATH);?> <?php the_title(); ?>"><?php the_title(); ?> &raquo;</a></h2>

<p class="postinfo"><?php _e("By",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e('on',TEMPLATE_PATH);?> <?php the_time('M j, Y') ?> <?php _e('in',TEMPLATE_PATH);?> <?php the_category(', ') ?> | <?php comments_popup_link(__('0 Comments',TEMPLATE_PATH), __('1 Comment',TEMPLATE_PATH), __('% Comments',TEMPLATE_PATH)); ?><?php edit_post_link(__('Edit',TEMPLATE_PATH), ' | ', ''); ?></p>

<div class="entry">
<?php the_content(__('Read the rest',TEMPLATE_PATH)); ?>
</div>

</div>

<?php endwhile; endif; ?>

<?php } else { // Do stuff specific to non-first page ?>

<?php include (TEMPLATEPATH . "/sidebar1.php"); ?>

<div id="content">
	
<h2 class="sectionhead"><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.gif" alt="<?php _e("Main Content RSS Feed",TEMPLATE_DOMAIN); ?>" title="<?php _e("Main Content RSS Feed",TEMPLATE_DOMAIN); ?>" style="float:right;margin: 2px 0 0 5px;" /></a><?php _e("Recent Articles",TEMPLATE_DOMAIN); ?></h2>

<?php if (have_posts()) : while (have_posts()) : the_post();
$do_not_duplicate = isset($do_not_duplicate)?$do_not_duplicate:'';
if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); ?>

<div class="post" id="post-<?php the_ID(); ?>">

 <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_PATH);?> <?php the_title(); ?>"><?php the_title(); ?> &raquo;</a></h2>

<p class="postinfo"><?php _e("By",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e('on',TEMPLATE_PATH);?> <?php the_time('M j, Y') ?> <?php _e('in',TEMPLATE_PATH);?> <?php the_category(', ') ?> | <?php comments_popup_link(__('0 Comments',TEMPLATE_PATH), __('1 Comment',TEMPLATE_PATH), __('% Comments',TEMPLATE_PATH)); ?><?php edit_post_link(__('Edit',TEMPLATE_PATH), ' | ', ''); ?></p>

					<div class="entry">
						<?php the_content(__('Read the rest',TEMPLATE_PATH)); ?>
					</div>

				</div>

<?php endwhile; endif; ?>

<?php } ?>

				<div class="navigation">

					<div class="alignleft">
						<?php next_posts_link(__('&laquo; Previous Entries',TEMPLATE_PATH)) ?>
					</div>

					<div class="alignright">
						<?php previous_posts_link(__('Next Entries &raquo;',TEMPLATE_PATH)) ?>
					</div>

</div>

</div>

</div>

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while(have_posts()) : the_post(); ?>

	<div class="post">
		<h2 class="posth2"><?php the_date(); ?></h2>
		<h3 class="posth3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>



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


		<p class="postdata"><?php _e("Filed by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e('at', TEMPLATE_DOMAIN);?> <?php the_time(__('F jS, Y')) ?> <?php _e("under",TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?><br /><a href="<?php the_permalink(); ?>"><?php comments_number(__('No comments on this post yet', TEMPLATE_DOMAIN), __('1 person have commented this post', TEMPLATE_DOMAIN), __('% persons have commented this post', TEMPLATE_DOMAIN)); ?></a></p>
		</div>
		
		
<?php endwhile; endif; ?>

	<div class="postsnav"><?php posts_nav_link(); ?></div>

<?php get_footer(); ?>

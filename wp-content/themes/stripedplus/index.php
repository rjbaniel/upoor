<?php get_header(); ?>

<?php if (have_posts()) : while(have_posts()) : the_post(); ?>

	<div class="post">
		<h2 class="posth2"><?php the_date(); ?></h2>
		<h3 class="posth3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        
        <?php the_content(''); ?>

		<p class="postdata"><?php _e("Filed by",TEMPLATE_DOMAIN); ?> <?php the_author(); ?> <?php _e('at',TEMPLATE_DOMAIN);?> <?php the_time(__('F jS, Y')) ?> <?php _e("under",TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?><?php the_tags( '&nbsp;' . __( 'and tagged',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?><br /><a href="<?php the_permalink(); ?>"><?php comments_number(__('No comments on this post yet', TEMPLATE_DOMAIN), __('1 person have commented this post', TEMPLATE_DOMAIN), __('% persons have commented this post', TEMPLATE_DOMAIN)); ?></a></p>
		</div>

<?php endwhile; endif; ?>

	<div class="postsnav"><?php posts_nav_link(); ?></div>

<?php get_footer(); ?>

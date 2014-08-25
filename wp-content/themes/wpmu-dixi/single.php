<?php get_header(); ?>

<div id="post-entry">

<div id="blog-content">

<?php if (have_posts()) : ?>

<?php locate_template ( array('/lib/templates/headline.php'), true ); ?>

<?php while (have_posts()) : the_post(); ?>

<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="post"<?php endif; ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title"><?php the_title(); ?></h1>

<?php $postmeta_status = get_option('tn_wpmu_dixi_postmeta_status'); if ($postmeta_status != 'disable') { ?>
<div class="post-author"><?php _e('Posted by', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_author_posts_link(); ?>&nbsp;<?php _e('on', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_time('l, F jS Y') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php edit_post_link(__('edit', TEMPLATE_DOMAIN)); ?></div>
<?php } ?>

<?php do_action('bp_before_post_content'); ?>

<div class="post-content">
<?php $facebook_like_status = get_option('tn_wpmu_dixi_facebook_like_status'); if ($facebook_like_status == 'enable') { ?>
	<div class="fb-like" data-href="<?php echo esc_attr(get_permalink($post->ID)); ?>" data-send="false" data-width="450" data-show-faces="false"></div>
<?php } ?>
<?php the_content(); ?>
</div>

<?php do_action('bp_after_post_content'); ?>

<?php locate_template ( array('/lib/templates/social.php'), false ); ?>

</div>

<?php endwhile; ?>

<?php if ( comments_open() ) { ?><?php comments_template('', true); ?><?php } ?>

<?php locate_template ( array('/lib/templates/paginate.php'), true ); ?>

<?php else: ?>

<?php locate_template ( array('/lib/templates/result.php'), true ); ?>

<?php endif; ?>

</div>

<?php get_sidebar('right'); ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
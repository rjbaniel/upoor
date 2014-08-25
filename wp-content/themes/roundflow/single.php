<?php get_header(); ?>

<div id="maincontent">
<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
    <div class="post">
        <h2 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="postinfo"><a href="<?php the_permalink(); ?>"><?php comments_number(__('Comments: 0',TEMPLATE_DOMAIN), __('Comments: 1',TEMPLATE_DOMAIN), __('Comments: %',TEMPLATE_DOMAIN)); ?></a> - Date: <?php the_time(__('F jS, Y')) ?> - <?php _e("Categories:",TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?><?php the_tags( '&nbsp;' . __( 'Tagged:',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?> </p>
        <div class="postcontent">

        <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

        <?php the_content(); ?>

        <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

        </div>
    </div>
    <?php endwhile; endif; ?>
</div>

<div id="comments">
<?php comments_template('',true); ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

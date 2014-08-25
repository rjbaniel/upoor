<?php get_header(); ?>

<div id="maincontent">
<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
    <div class="post">
        <h2 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="postinfo"><?php _e("Author:",TEMPLATE_DOMAIN); ?> <?php the_author(); ?> - <?php _e("Date:",TEMPLATE_DOMAIN); ?> <?php the_time(__('F jS, Y')) ?></p>
        <div class="postcontent">
        <?php the_content(); ?>
        </div>
    </div>
    <?php endwhile; ?>

   <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
   
 <?php  endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

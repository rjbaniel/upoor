<?php get_header(); ?>

<?php if (have_posts()) : while(have_posts()) : the_post(); ?>

	<div class="post">
		<h3 class="posth3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php the_content(''); ?>
		<!--<p class="postdata">Filed by <?php the_author(); ?> <?php _e('at');?> <?php the_time(__('F jS, Y')) ?> under <?php the_category(', ') ?></p> -->
    </div>

	
	<div id="commentwrapper">
   <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>  
	</div>
		
<?php endwhile; endif; ?>

<?php get_footer(); ?>

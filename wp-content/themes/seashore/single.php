<?php get_header();?>
<div id="main">
	<div id="content">

	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	        <div class="post" id="post-<?php the_ID(); ?>">
            <p class="date">
              <span class="month">
                <?php the_time('M') ?>
              </span>
              <span class="day">
                <?php the_time('d') ?>
              </span>
              <span class="year">
                <?php the_time('Y') ?>
              </span>
              </p>
            <h2 class="title"><?php the_title(); ?></h2>
            <div class="meta">
				      <p><?php _e("Published by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link() ?>  <?php _e("under",TEMPLATE_DOMAIN); ?> <?php the_category(',') ?><?php the_tags( '&nbsp;' . __( 'and tagged:',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?> <?php edit_post_link(); ?></p>
			      </div>
			      <div class="entry">
              <?php the_content(__('Continue Reading &#187;',TEMPLATE_DOMAIN)); ?>
              <?php wp_link_pages(); ?>
      			</div>
            <p class="comments">
              <?php comments_popup_link(__('No responses yet',TEMPLATE_DOMAIN), __('One response so far',TEMPLATE_DOMAIN), __('% responses so far',TEMPLATE_DOMAIN)); ?>
            </p>
	        </div>
      <?php endwhile; ?>

           <?php comments_template('',true); ?>

      <?php else: ?>
          <p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?></p>
      <?php endif; ?>
      <p align="center"><?php posts_nav_link(' - ',__('&#171; Prev',TEMPLATE_DOMAIN),__('Next &#187;',TEMPLATE_DOMAIN)) ?></p>
	</div>
  <?php get_sidebar();?>
  <?php get_footer();?>

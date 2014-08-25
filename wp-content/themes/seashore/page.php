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
            <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <div class="meta">
				      <p><?php _e("Published by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link() ?> <?php edit_post_link(); ?></p>
			      </div>
			      <div class="entry">
              <?php the_content(); ?>
              <?php wp_link_pages(); ?>
              <?php $sub_pages = wp_list_pages( 'sort_column=menu_order&depth=1&title_li=&echo=0&child_of=' . $id );?>
              <?php if ($sub_pages <> "" ){?>
              <p class="meta"><?php _e("This page has the following sub pages.",TEMPLATE_DOMAIN); ?></p>
              <ul>
                <?php echo $sub_pages; ?>
              </ul>
              <?php }?>
            </div>





<?php if ( comments_open() ) { ?>
<p class="comments">
<?php comments_popup_link(__('No responses yet',TEMPLATE_DOMAIN), __('One response so far',TEMPLATE_DOMAIN), __('% responses so far',TEMPLATE_DOMAIN)); ?>
</p>
<?php comments_template('',true); ?>
<?php } ?>

	        </div>
      <?php endwhile; else: ?>
          <p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?></p>
      <?php endif; ?>

	</div>
  <?php get_sidebar();?>
  <?php get_footer();?>

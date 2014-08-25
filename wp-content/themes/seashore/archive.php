<?php get_header();?>
<div id="main">
	<div id="content">

      <?php if(have_posts()) : ?>
        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
        <?php /* If this is a category archive */ if (is_category()) { ?>
        <h2 class="post-title">
          <?php _e('Archive for the',TEMPLATE_DOMAIN);?> '<?php echo single_cat_title(); ?>' <?php _e('Category',TEMPLATE_DOMAIN);?></h2>

        <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
        <h2 class="post-title">
          <?php _e('Archive for',TEMPLATE_DOMAIN);?>
    <?php the_time(__('F jS, Y')); ?>
        </h2>

        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
        <h2 class="post-title">
          <?php _e('Archive for',TEMPLATE_DOMAIN);?>
    <?php the_time('F, Y'); ?>
        </h2>

        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
        <h2 class="post-title">
          <?php _e('Archive for',TEMPLATE_DOMAIN);?>
    <?php the_time('Y'); ?>
        </h2>

        <?php /* If this is a search */ } elseif (is_search()) { ?>
        <h2 class="post-title"><?php _e('Search Results',TEMPLATE_DOMAIN);?></h2>

        <?php /* If this is an author archive */ } elseif (is_author()) { ?>
        <h2 class="post-title"><?php _e('Author Archive',TEMPLATE_DOMAIN);?></h2>

        <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
        <h2 class="post-title"><?php _e('Blog Archives',TEMPLATE_DOMAIN);?></h2>

        <?php } ?>
      <?php endif; ?>
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
				      <p><?php _e("Published by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link() ?> <?php _e("under",TEMPLATE_DOMAIN); ?> <?php the_category(',') ?> <?php edit_post_link(); ?></p>
			      </div>
			      <div class="entry">


             <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content(__('Continue Reading &#187;',TEMPLATE_DOMAIN)); ?>

<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>




              <?php wp_link_pages(); ?>
      			</div>
            <p class="comments">
              <?php comments_popup_link(__('No responses yet',TEMPLATE_DOMAIN), __('One response so far',TEMPLATE_DOMAIN), __('% responses so far',TEMPLATE_DOMAIN)); ?>
            </p>	          
	        </div>
      <?php endwhile; else: ?>
          <p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?></p>
      <?php endif; ?>
      <p align="center"><?php posts_nav_link(' - ',__('&#171; Prev',TEMPLATE_DOMAIN),__('Next &#187;',TEMPLATE_DOMAIN)) ?></p>
	</div>
  <?php get_sidebar();?>
  <?php get_footer();?>

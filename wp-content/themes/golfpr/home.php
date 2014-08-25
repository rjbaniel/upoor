<?php

/**
 * @package WordPress
 * @subpackage golfPR
 */
get_header(); ?>

<div id="content_wrapper">
	<div id="strap_wrapper">


<?php if('' != get_header_image() ) { ?>
<div id="strap_image">
<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
</div>
<?php } ?>






<div id="strap_text">
<h2><?php _e('Featured News', 'golfpr'); ?></h2>
<?php $feat = 'Featured'; if ( term_exists( $feat , 'category' ) ) { ?>

<?php query_posts('caller_get_posts=1&posts_per_page=5&category_name=Featured'); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
<?php endwhile; endif;
//Reset Query
wp_reset_query();
?>
<?php } else { ?>

<p><?php _e('you have to create a category', 'golfpr'); ?> "<?php echo $feat; ?>" <?php _e('so post with featured category will show here', 'golfpr'); ?></p>

<?php } ?>

</div>




<div class="clear"></div>
</div>
<div id="call_actions">

<div class="clear"></div>
	</div>
	<div id="content_area">
		<div id="content">
			<div class="post">
				<h1><?php _e('Latest News', 'golfpr'); ?></h1>
			</div>
			<?php if( have_posts() ): ?>
			<?php while ( have_posts()) : the_post(); ?>
			<div style="margin-bottom: 20px; width: 95%;" class="post">
			<?php custom_get_post_img ($the_post_id=$post->ID, $width='150', $height='130', $size='medium'); ?>

    <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
            <p><small><?php the_time('Y-m-d') ?></small></p>
            <?php the_excerpt_feature($excerpt_length=35); ?>

            <p style="margin-top: 20px;" class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> <?php _e('Posted in', 'golfpr'); ?> <?php the_category(', ') ?> | <?php edit_post_link(__('Edit', 'golfpr'), '', ' | '); ?>  <?php comments_popup_link(__('No Comments &#187;', 'golfpr'), __('1 Comment &#187;', 'golfpr'), __('% Comments &#187;', 'golfpr')); ?></p>
			</div>
			<?php endwhile; ?>
            <?php endif; ?>
			</div>
                        	<div id="sidebar">

                <?php /*$user_tweet = '';*/ ?>
      <!--  <script src="http://widgets.twimg.com/j/2/widget.js"></script>
					<script>
					new TWTR.Widget({
					  version: 2,
					  type: 'profile',
					  rpp: 3,
					  interval: 6000,
					  width: 220,
					  height: 300,
					  theme: {
					    shell: {
					      background: '#dee9cb',
					      color: '#ffffff'
					    },
					    tweets: {
					      background: '#ffffff',
					      color: '#000000',
					      links: '#78a300'
					    }
					  },
					  features: {
					    scrollbar: false,
					    loop: false,
					    live: false,
					    hashtags: true,
					    timestamp: true,
					    avatars: false,
					    behavior: 'all'
					  }
					}).render().setUser('<?php echo "$user_tweet"; ?>').start();
					</script>-->
                        <br /><br />

                      	<?php
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>

<li>
<h2 class="widgettitle"><?php _e('Categories','golfpr'); ?></h2>
<ul>
<?php wp_list_categories(0, '', 'name', 'asc', '', 1, 0, 1, 1, 1, 1, 0,'','','','','') ?>
</ul>
</li>

    <li id="archives">
      <h2 class="widgettitle">
        <?php _e('Monthly','golfpr'); ?>
      </h2>
      <ul>
        <?php wp_get_archives('type=monthly&limit=10'); ?>
      </ul>
    </li>

    <?php endif; ?>
                    </div>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>

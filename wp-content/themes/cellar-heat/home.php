<?php get_header(); ?>

<div id="container">

 <?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
      <?php if ( has_nav_menu( 'main-nav' ) ) { ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } ?>
<?php } else { ?>
<ul id="nav">
<li id="<?php if (is_home() || is_single()) { ?>home<?php } else { ?>page_item<?php } ?>"><a href="<?php bloginfo('url'); ?>" title="Home"><?php _e('Home'); ?></a></li>
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>


    <br clear="all" />

    <div id="search"><form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">

    <input type="submit" id="searchsubmit" class="btnSearch" value="&nbsp;" />

    <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="txtField" />

    </form></div>

    <div id="site-name"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a><br />

    <span class="description"><?php bloginfo('description'); ?></span></div>


    <?php if('' != get_header_image() ) { ?>
    <div id="custom-img-header">
    <a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
   </div>
      <?php } ?>



    <span class="rss"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Syndication feeds available', 'cellar-heat'); ?></a></span>






    <div id="post-one">



<?php if (have_posts()) : ?>

 <?php query_posts("showposts=1"); ?>

  <?php while (have_posts()) : the_post(); ?>

  		<div class="main-post" id="post-<?php the_ID(); ?>">

    	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

        <span class="meta"><?php the_time('F') ?> <?php the_time('jS') ?> <?php the_time('Y') ?> <?php _e('in', 'cellar-heat'); ?> <?php the_category(', ') ?></span>

          <?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft"><?php the_post_thumbnail(); ?></div><?php } } ?>          

        <?php the_excerpt(__('Read the rest of this entry &raquo;', 'cellar-heat') ); ?>

        <span class="btn-first-readon"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'cellar-heat'); ?> <?php the_title(); ?>"><?php _e('Read On', 'cellar-heat'); ?></a></span>

        <span class="comments"><?php comments_popup_link(__('No Comments', 'cellar-heat'), __('1 Comment', 'cellar-heat'), __('% Comments', 'cellar-heat') ); ?></span>

        <br clear="all" />

        </div>

        <?php endwhile; ?>

    </div>

    <div id="recent-posts">



    <!-- post begin -->

<?php query_posts("showposts=8&offset=1"); ?>

  <?php while (have_posts()) : the_post(); ?>

    	<div class="home-post" id="post-<?php the_ID(); ?>">

        	<div class="upper">

            <div class="fade"></div>

            <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'cellar-heat'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>

            <span class="meta"><?php the_time('F') ?> <?php the_time('jS') ?> <?php the_time('Y') ?></span>


            <?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft"><?php the_post_thumbnail(); ?></div><?php } } ?>

            <?php the_excerpt(__('Read the rest of this entry &raquo;', 'cellar-heat')); ?>

            </div>

            <span class="btn-readon"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php _e('Read On', 'cellar-heat'); ?></a></span>

            <span class="lower-meta"><?php comments_popup_link(__('No Comments', 'cellar-heat'), __('1 Comment', 'cellar-heat'), __('% Comments', 'cellar-heat') ); ?></span>

        </div>

<?php endwhile; ?>

<br clear="all" />

<?php else: ?>

 <!-- Error message when no post published -->

<?php endif; ?>

    <!-- post end -->



    <br clear="all" />

    </div>

    <div class="spacer"></div>

</div>

<div class="lower-outer">

	<div id="lower">

    <?php get_sidebar(); ?>

    </div>

<?php get_footer(); ?>

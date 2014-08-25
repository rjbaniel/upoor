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

      
    <div class="column01">

    <div id="post-one">

    
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

  		<div class="main-post" id="post-<?php the_ID(); ?>">

    	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

        <span class="meta"><?php the_time('F') ?> <?php the_time('jS') ?> <?php the_time('Y') ?> in <?php the_category(', ') ?></span>

        <?php the_content(__('Read the rest of this entry &raquo;', 'cellar-heat')); ?>

        <br clear="all" />

        </div>

        <?php comments_template('',true); ?>

<?php endwhile; ?>

<?php else: ?>

 <!-- Error message when no post published -->

<?php endif; ?>         

    </div></div>

<div id="column02">



            <?php
			$in_same_cat = isset($in_same_cat)?$in_same_cat:'';
			$excluded_categories = isset($excluded_categories)?$excluded_categories:'';
			$previouspost = get_previous_posts_link($in_same_cat, $excluded_categories);

			if ($previouspost != null) {



			echo '<div class="side-post"><div class="upper"><div class="fade"></div><h3>';

			previous_post_link('%link');

			echo '</h3>';

			previous_post_excerpt();

			echo '</div><span class="btn-readon">';

			previous_post_link('%link');

			echo '</span><span class="sub-txt">Previous Entry</span></div>';

        } ?>



            <?php
			$in_same_cat = isset($in_same_cat)?$in_same_cat:'';
			$excluded_categories = isset($excluded_categories)?$excluded_categories:'';
			$nextpost = get_next_posts_link($in_same_cat, $excluded_categories);

			if ($nextpost != null) {



			echo '<div class="side-post"><div class="upper"><div class="fade"></div><h3>';

			next_post_link('%link');

			echo '</h3>';

			next_post_excerpt();

			echo '</div><span class="btn-readon">';

			next_post_link('%link');

			echo '</span><span class="sub-txt">Next Entry</span></div>';

        } ?>



</div>

    <br clear="all" />

    </div>

    <div class="spacer"></div>

</div>

<div class="lower-outer">

	<div id="lower">

    <?php get_sidebar(); ?>

    </div>

<?php get_footer(); ?>

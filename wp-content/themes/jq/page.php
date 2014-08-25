<?php get_header(); ?>
<div id="content" class="clearfix">
<?php include (TEMPLATEPATH . "/sidebar2.php"); ?>
<div id="left">
<p id="sidebar_show"><a href="#" id="show_s">&larr; <?php _e('Sidebar', 'jq'); ?></a></p>
<div class="single_content">
<!-- page content -->
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<h1 class="page_headline"><?php the_title(); ?></h1>
<div class="clearfix"></div>
<?php the_content(); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php endwhile; ?>


<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
<?php else : ?>
<?php _e('Sorry, no posts matched your criteria.', 'jq'); ?>
<?php include (TEMPLATEPATH . "/searchform.php"); ?>
<?php endif; ?>
</div>
</div>
</div>
<?php get_footer(); ?>

<?php get_header(); ?>

			<div class="narrow_column">

<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
<div class="post" id="post-<?php the_ID(); ?>">

	<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<div class="entry">

		<?php the_content(); ?>

		<?php wp_link_pages('<p><strong>'.__('Pages',TEMPLATE_DOMAIN).':</strong> ', '</p>', 'number'); ?>

		<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), '<p>', '</p>'); ?>

		<!--
		<?php trackback_rdf(); ?>
		-->
       <?php if ( comments_open() ) { ?><div class="comments-template"> <?php comments_template('',true); ?></div><?php } ?>


	</div><!-- end entry -->

</div><!-- end post -->
<?php endwhile; ?>

<?php include (TEMPLATEPATH . '/browse.php'); ?>

<?php else : ?>

<div class="post">

	<h2><?php _e('Not Found',TEMPLATE_DOMAIN); ?></h2>
	<div class="entry">
<p class="notfound"><?php _e('Sorry, but you are looking for something that isn&#39;t here.',TEMPLATE_DOMAIN); ?></p>
	</div>

</div>

<?php endif; ?>

			</div><!-- end narrow column -->

<?php get_footer(); ?>

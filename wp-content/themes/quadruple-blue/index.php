<?php get_header(); ?>

			<div class="narrow_column">

<?php function post_style() {
	static $post_count;
	$post_count++;
		if ($post_count % 2) {
			echo "post";
		}
		else {
			echo "post_alt";
		}
}
?>

<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
<div class="<?php post_style(); ?>" id="post-<?php the_ID(); ?>">

	<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<div class="postdate"><?php _e('Posted on',TEMPLATE_DOMAIN); ?> <?php the_time(__('F jS, Y')) ?> <?php _e('by',TEMPLATE_DOMAIN); ?> <?php the_author_posts_link() ?></div>
	<div class="entry">

		<?php the_content('...read more',TEMPLATE_DOMAIN); ?>

		<p class="postinfo">
<?php comments_popup_link(__('No Comments &#187;',TEMPLATE_DOMAIN), __('1 Comment &#187;',TEMPLATE_DOMAIN), __('% Comments &#187;',TEMPLATE_DOMAIN)); ?><br />
<?php _e('Filed under&#58;',TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?> <?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), ' &#124; ', ''); ?>
		</p>

		<!--
		<?php trackback_rdf(); ?>
		-->

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

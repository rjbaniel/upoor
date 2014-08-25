<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
				
			<div class="post">
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<small><?php the_time(__('F jS, Y')) ?> <!-- by <?php the_author() ?> --></small>
				
				<div class="entry">
					<?php the_content(__('Read the rest of this entry &raquo;', TEMPLATE_DOMAIN)); ?>
				</div>
		
				<p class="postmetadata"><?php _e('Posted in ', TEMPLATE_DOMAIN);?> <?php the_category(', ') ?> <strong>|</strong> <?php the_tags( '&nbsp;' . __( 'Tagged', TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?> <?php edit_post_link(__('Edit', TEMPLATE_DOMAIN), '','<strong>|</strong>'); ?>  <?php comments_popup_link(__('No Comments &#187;', TEMPLATE_DOMAIN), __('1 Comment &#187;', TEMPLATE_DOMAIN), __('% Comments &#187;', TEMPLATE_DOMAIN)); ?></p>

				<!--
				<?php trackback_rdf(); ?>
				-->
			</div>
	
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php posts_nav_link('','',__('&laquo; Previous Entries', TEMPLATE_DOMAIN)) ?></div>
			<div class="alignright"><?php posts_nav_link('',__('Next Entries &raquo;', TEMPLATE_DOMAIN),'') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e('Not Found', TEMPLATE_DOMAIN);?></h2>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.", TEMPLATE_DOMAIN); ?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

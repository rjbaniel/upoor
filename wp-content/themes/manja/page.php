<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post">
		<font face="Verdana" size="3"><b><?php the_time(__('F jS, Y')) ?> <!-- by <?php the_author() ?> --></b></font>
		<h2 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>
			<div class="entrytext">
			<?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>',TEMPLATE_DOMAIN)); ?>

				<?php wp_link_pages(__('<p><strong>Pages:</strong> '), '</p>', 'number'); ?>
                	<?php edit_post_link(__('Edit this entry.',TEMPLATE_DOMAIN), '<p>', '</p>'); ?>
			</div>
		</div>
	  <?php endwhile; endif; ?>

        <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>


	</div>



<?php get_sidebar(); ?>
<?php get_footer(); ?>

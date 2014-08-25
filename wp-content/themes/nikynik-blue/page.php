<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post">
		<h2 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>
			<div class="entrytext">
				<?php the_content(__('Read the rest of this entry &raquo;','nikynik')); ?>
<?php wp_link_pages(__('<p><strong>Pages:</strong> ','nikynik'), '</p>', __('number','nikynik')); ?>
	
			</div>
		</div>
	  <?php endwhile; ?>

       <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>   

      <?php endif; ?>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

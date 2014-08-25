<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
				
			<div class="post">
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','cropcircles');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<small>
 <?php the_time(__('F jS, Y')) ?> <?php the_time(__('F jS, Y')) ?> <!-- by <?php the_author() ?> --></br /><?php _e('Posted in ','cropcircles');?> <?php the_category(', ') ?><br /><?php comments_popup_link(__('No Comments','cropcircles'), __('1 Comment','cropcircles'), __('% Comments','cropcircles')); ?></small>

				<div class="entry">
					<?php the_content(__('Read the rest of this entry &raquo;','cropcircles')); ?>
				</div>


				<!--
				<?php trackback_rdf(); ?>
				-->
			</div>
	
		<?php endwhile; ?>

	  <div class="navigation">
	   <div class="alignleft"><?php posts_nav_link('','',__('&laquo; Previous Entries','cropcircles')) ?></div>
			<div class="alignright"><?php posts_nav_link('',__('Next Entries &raquo;','cropcircles'),'') ?></div>
		</div>
		
	<?php else : ?>

		<h2 class="center"><?php _e('Not Found','cropcircles');?></h2>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.",'cropcircles'); ?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

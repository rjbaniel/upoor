<?php get_header(); ?>
<body id="blog">

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle"><?php _e('Search Results','cropcircles');?></h2>
		
	  <div class="navigation">
	   <div class="alignleft"><?php posts_nav_link('','',__('&laquo; Previous Entries','cropcircles')) ?></div>
			<div class="alignright"><?php posts_nav_link('',__('Next Entries &raquo;','cropcircles'),'') ?></div>
		</div>


		<?php while (have_posts()) : the_post(); ?>
				
			<div class="post">
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','cropcircles');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<small>
 <?php the_time(__('F jS, Y')) ?> <?php the_time(__('F jS, Y')) ?> <!-- by <?php the_author() ?> --></br /><?php _e('Posted in ','cropcircles');?> <?php the_category(', ') ?><br /><?php comments_popup_link(__('No Comments','cropcircles'), __('1 Comment','cropcircles'), __('% Comments','cropcircles')); ?></small>

				<div class="entry">
<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
					<?php the_excerpt(); ?>
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

		<h2 class="center"><?php _e('Not Found','cropcircles');?>!</h2>



	<?php endif; ?>
		
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

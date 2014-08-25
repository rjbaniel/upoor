<?php get_header(); ?>


<?php get_sidebar(); ?>


	<div id="main">





		<?php if (have_posts()) : ?>





		 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>


<?php /* If this is a category archive */ if (is_category()) { ?>


		<h1><?php _e('Archive for the','citrus');?> '<?php echo single_cat_title(); ?>' <?php _e('Category','citrus');?></h1>





 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>


		<h1><?php _e('Archive for','citrus');?>
    <?php the_time(__('F jS, Y')); ?></h1>





	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>


		<h1><?php _e('Archive for','citrus');?>
    <?php the_time('F, Y'); ?></h1>





		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>


		<h1><?php _e('Archive for','citrus');?>
    <?php the_time('Y'); ?></h1>





	  <?php /* If this is a search */ } elseif (is_search()) { ?>


		<h1><?php _e('Search Results','citrus');?></h1>





	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>


		<h1><?php _e('Author Archive','citrus');?></h1>





		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>


		<h1><?php _e('Blog Archives','citrus');?></h1>





		<?php } ?>








		<div class="navigation">


			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','citrus')) ?></div>


			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','citrus')) ?></div>


		</div>





		<?php while (have_posts()) : the_post(); ?>





				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','citrus');?> <?php the_title(); ?>"><?php the_title(); ?></a></h1>





                    <?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
					<?php the_excerpt(); ?>

                       <p class="post-footer align-right">


					 <?php _e('Posted in ');?> <?php the_category(', ') ?> on <span class="date"><?php the_time(__('F jS, Y')) ?></span> <!-- by <?php the_author() ?> --> <strong>|</strong>


				<?php edit_post_link(__('Edit','citrus'), '','<strong> |</strong>'); ?>  <?php comments_popup_link(__('No Comments &#187;','citrus'), __('1 Comment &#187;','citrus'), __('% Comments &#187;','citrus')); ?></p>
					<!--


						<?php trackback_rdf(); ?>


					-->


				</p>





			   











		<?php endwhile; ?>





		<div class="navigation">


			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','citrus')) ?></div>


			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','citrus')) ?></div>


		</div>





	<?php else : ?>





		<h1 class="center"><?php _e('Not Found','citrus');?></h1>


		<?php include (TEMPLATEPATH . '/searchform.php'); ?>





	<?php endif; ?>





	</div>


<?php include (TEMPLATEPATH . '/rbar.php'); ?>


<?php get_footer(); ?>

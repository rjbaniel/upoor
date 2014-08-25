<?php get_header(); ?>

	<?php if (have_posts()) : ?> 

			<div id="page-title">

				<div class="page-title-content">

					<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

					<?php /* If this is a category archive */ if (is_category()) { ?>

						<h3 class="page-title"><?php _e('Archive for the', 'colorpaper'); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category', 'colorpaper'); ?></h3>

					<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>

						<h3 class="page-title"><?php _e('Posts Tagged', 'colorpaper'); ?> &#8216;<?php single_tag_title(); ?>&#8217;</h3>

					<?php /* If this is a daily archive */ } elseif (is_day()) { ?>

						<h3 class="page-title"><?php _e('Archive for', 'colorpaper'); ?> <?php the_time('F jS, Y'); ?></h3>

					<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

						<h3 class="page-title"><?php _e('Archive for', 'colorpaper'); ?> <?php the_time('F, Y'); ?></h3>

					<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

						<h3 class="page-title"><?php _e('Archive for', 'colorpaper'); ?> <?php the_time('Y'); ?></h3>

					<?php /* If this is an author archive */ } elseif (is_author()) { ?>

						<h3 class="page-title"><?php _e('Author Archive', 'colorpaper'); ?></h3>

					<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

						<h3 class="page-title"><?php _e('Blog Archives', 'colorpaper'); ?></h3>

					<?php } ?>

					<div class="post-meta-single">

						<div class="small">

							<p class="small verdana"><?php _e('You can use the search form below to go through the content and find a specific post or page:', 'colorpaper'); ?></p>

							<?php include (TEMPLATEPATH . '/searchform.php'); ?>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="left-content">

			<?php while (have_posts()) : the_post(); ?>

			<div class="post">

				<div class="post-date"><span class="month block"><?php the_time('M'); ?> </span><span class="day"><?php the_time('d'); ?> </span></div>

				<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                <?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
				<?php the_excerpt(''); ?>

			</div>

			<?php endwhile; ?>

			

				<h5 class="small <?php echo $style; ?>"><?php posts_nav_link(' | ',__('&laquo; Newer Posts', 'colorpaper'),  __('Older Posts &raquo;', 'colorpaper')); ?></h5>

			

		</div>

	</div>

	<div id="right-col">

		<?php get_sidebar(); ?>

	</div>

</div></div>

	<?php  endif; ?>

<?php get_footer(); ?>

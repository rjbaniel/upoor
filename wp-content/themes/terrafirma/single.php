<?php get_header();?>

		<div id="content">
		
			<!-- primary content start -->
			<?php if (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="header">
					<div class="date"><em class="user"><?php the_author() ?></em> <br/><em class="postdate"><?php the_time('M jS, Y') ?></em></div>
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e("Permanent Link to",TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<div class="entry">

                     <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

					<?php the_content(); ?>
					<?php wp_link_pages(); ?>


                   <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
          <p class="post-tags">
            <?php if (function_exists('the_tags')) the_tags(__('Tags: ',TEMPLATE_DOMAIN), ', ', '<br/>'); ?>
          </p>
				</div>
				<div class="footer">
					<ul>
<li class="comments"><?php comments_number(__('No Comments yet',TEMPLATE_DOMAIN), __('One Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></li>
						<li class="readmore"><?php the_category(' , ') ?> <?php edit_post_link(__('Edit',TEMPLATE_DOMAIN)); ?></li>
					</ul>
				</div>
				<?php comments_template('',true); ?>
			</div>	
		<?php endwhile; ?>
		<p align="center"><?php posts_nav_link(' - ', __('&#171; Prev',TEMPLATE_DOMAIN), __('Next &#187;',TEMPLATE_DOMAIN)) ?></p>
	<?php else : ?>

		<h2 class="center"><?php _e("Not Found",TEMPLATE_DOMAIN); ?></h2>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.",TEMPLATE_DOMAIN); ?></p>
	<?php endif; ?>
			<!-- primary content end -->	
		</div>		
	<?php get_sidebar();?>	
<?php get_footer();?>

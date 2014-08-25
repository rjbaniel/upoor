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
					<?php the_content(); ?>
          <?php wp_link_pages(); ?>
          <?php $sub_pages = wp_list_pages( 'sort_column=menu_order&depth=1&title_li=&echo=0&child_of=' . $id );?>
          <?php if ($sub_pages <> "" ){?>
          <h3><?php _e("Sub Pages List",TEMPLATE_DOMAIN); ?></h3>
          <ul>
            <?php echo $sub_pages; ?>
          </ul>
          <?php }?>
        </div>
				<div class="footer">
					<ul>
                     <?php if ( comments_open() ) { ?>
						<li class="comments"><?php comments_number(__('No Comments yet',TEMPLATE_DOMAIN), __('One Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></li>   <?php } ?>
						<?php edit_post_link('<li class="readmore">' . __('Edit',TEMPLATE_DOMAIN) . '</li>'); ?>
					</ul>
				</div>

			  <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

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

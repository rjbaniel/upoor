<?php get_header(); ?>
<?php get_sidebar(); ?>


<div id="content">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="entry<?php if(is_home() && $post==$posts[0] && !is_paged()) echo '_firstpost';?>">
					<div class="latest<?php if(is_home() && $post==$posts[0] && !is_paged()) echo '_firstpost';?>">

				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>	

<?php /** To remove the lines with meta information, delete the following 3 lines (switch off wrapping of long lines) **/ ?>

				<div class="meta<?php if(is_home() && $post==$posts[0] && !is_paged()) echo ' firstpost';?>">
					<?php _e("Posted on ", 'cordobo'); ?> <?php the_time(__('F jS, Y')) ?> <?php _e('in', 'cordobo');?> <?php the_category(',') ?> <?php _e('by', 'cordobo');?> <?php the_author() ?> <?php the_tags( '&nbsp;' . __( 'Tagged' ) . ' ', ', ', ''); ?><?php edit_post_link(__('Edit', 'cordobo'), ' | ', ''); ?>
				</div>

<?php /** Stop deleting here **/ ?>				

				<div class="main">

					
		                 <?php if( is_archive() || is_search() || is_category() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content( __('<p>Click here to read more</p>', 'cordobo') ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>

<ul class="readmore">
  <li><?php if (strpos(get_the_content('^&^&'), '^&^&') > 0) : ?><a href="<?php the_permalink() ?>#more-<?php the_ID(); ?>"><?php _e('Continue reading', 'cordobo');?></a><?php endif; if ('open' == $post->comment_status) : ?><?php if (strpos(get_the_content('^&^&'), '^&^&') > 0) { echo _e(" or ", 'cordobo'); } ?><a href="<?php the_permalink() ?>#comments"><?php _e("Leave a comment...", 'cordobo'); ?></a><?php elseif (get_comments_number() > 0) : ?><?php if (strpos(get_the_content('^&^&'), '^&^&') > 0) { _e(" or "); } ?><a href="<?php the_permalink() ?>#reply"><?php _e("Read comments...", 'cordobo'); ?></a><?php endif; ?> <?php if ( comments_open() ) { ?><?php comments_popup_link(__('(0)'), __('(1)'), __('(%)')); ?><?php } ?></li>
			</ul>
					
					

				</div>


				<!--
					<?php trackback_rdf(); ?>
				-->

		</div>
	</div>


    <?php if(is_page()) { ?>
    <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
    <?php } else { ?>
	<?php comments_template('',true); ?>
    <?php } ?>



	<?php endwhile; else: ?>

		<div class="warning">
			<p><?php _e('Sorry, no posts matched your criteria, please try and search again.', 'cordobo'); ?>
				
<?php include (TEMPLATEPATH . '/searchform.php'); ?>
				
			</p>
		</div>



	<?php endif; ?>

		<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page', 'cordobo'), __('Next Page &raquo;', 'cordobo')); ?>


</div> <!-- /content -->


<?php get_footer(); ?>

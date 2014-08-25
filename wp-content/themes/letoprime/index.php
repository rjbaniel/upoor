<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
				
			<div class="post">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="metaright"><div class="articlemeta"><span class="editentry"><?php edit_post_link('<img src="'.get_bloginfo('template_directory').'/images/pencil.png" alt="'.__("Edit Link").'" />','<span class="editlink">','</span>'); ?></span>	<li class="date"><?php the_author_posts_link(); ?>&nbsp;&nbsp;<?php the_time('M jS, Y') ?></li> | <li class="cat"><?php the_category(', ') ?></li> | <li class="comm"> <?php comments_popup_link(__('No Comments',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN)); ?></li> <br/></div></div>
		<div class="metaright"><?php the_tags(__('Tags: '), ', ', ''); ?></div>


				<div class="entrytext">



                  <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content( __('...read more',TEMPLATE_DOMAIN) ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>

</div>

</div> <!-- end post -->
	
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('Previous Entries')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries')) ?></div>
		</div>
		
	<?php else : ?>

		<h2 class="center"><?php _e('Not Found');?></h2>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.");?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div> <!-- end content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

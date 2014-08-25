<?php get_header(); ?>
				
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="entry" id="post-<?php the_ID(); ?>">
<div class="date"><span class="day"><?php the_time('j') ?></span><br /><span class="month"><?php the_time('F') ?></span><br /><span class="year"><?php the_time('Y') ?></span></div>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a><span class="comments"><?php comments_popup_link('0', '1', '%'); ?></span></h2>
	

              <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
 <?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>',TEMPLATE_DOMAIN)); ?>
              <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?> 
				<?php wp_link_pages('<p><strong>'.__('Pages',TEMPLATE_DOMAIN).':</strong> ', '</p>', 'number'); ?>
<p class="entrymeta"><?php _e("Posted under:",TEMPLATE_DOMAIN); ?> <?php the_category(', '); ?> <?php edit_post_link(__('Edit this entry',TEMPLATE_DOMAIN), '. ', ''); ?> </p>
</div>

<div class="navigation">
			<div class="alignleft"><?php previous_post_link('%link',__('&laquo; Previous post',TEMPLATE_DOMAIN), 'no'); ?></div>
			<div class="alignright"><?php next_post_link('%link',__('Next post &raquo;',TEMPLATE_DOMAIN), 'no'); ?></div>
<br style="clear: all;" />
		</div>

	<?php comments_template('',true); ?>
	
	<?php endwhile; else: ?>
	
		<p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN);?></p>
	
<?php endif; ?>
	
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

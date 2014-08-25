<?php get_header(); ?>

<!-- content ................................. -->
<div id="main">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

	<?php $custom_fields = get_post_custom(); //custom fields ?>

	<?php if (isset($custom_fields["BX_post_type"]) && $custom_fields["BX_post_type"][0] == "mini") { ?>

	<div class="minientry">

		<p>
		<?php echo BX_remove_p($post->post_content); ?>
		<?php comments_popup_link('(0)', '(1)', '(%)', 'commentlink', ''); ?>
		<a href="<?php the_permalink(); ?>" class="permalink"><?php the_time(get_option('date_format')) ?><!--, <?php the_time()  ?>--></a>
		<!--<em class="author"><?php the_author() ?></em>-->
   		<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN),'<span class="editlink">','</span>'); ?>
   		</p>

	</div>

	<?php } else { ?>

	<div class="main">

		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

		<?php ($post->post_excerpt != "")? the_excerpt() : the_content(); ?>

<p class="info"><?php if ($post->post_excerpt != "") { ?><a href="<?php the_permalink() ?>" class="more"><?php _e("Continue Reading",TEMPLATE_DOMAIN); ?></a><?php } ?>
   		<?php comments_popup_link(__('Add comment',TEMPLATE_DOMAIN), __('1 comment',TEMPLATE_DOMAIN), __('% comments',TEMPLATE_DOMAIN), 'commentlink', ''); ?>
   		<em class="date"><?php the_time(get_option('date_format')) ?><!-- at <?php the_time()  ?>--></em>
   		<em class="author"><?php the_author_posts_link(); ?></em>
   		<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN),'<span class="editlink">','</span>'); ?>
		<br /> <?php the_tags(__('Tags: ',TEMPLATE_DOMAIN), ', ', '<br />'); ?>
   		</p>

		<div style="padding:20px 0px 0px 0px;"></div>
		
		<img src="<?php bloginfo('stylesheet_directory'); ?>/images/divider.gif" alt="" />
		
		<div style="padding:20px 0px 0px 0px;"></div>
		
	</div>
	<?php } ?>

<?php endwhile; ?>

	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td width="120" align="left"><?php next_posts_link(__('Previous Posts',TEMPLATE_DOMAIN)) ?></td>
			<td width="60"></td>
			<td width="120" align="right"><?php previous_posts_link(__('Next Posts',TEMPLATE_DOMAIN)) ?></td>
</tr>
	</table>

<?php else : ?>

	<h2><?php _e("Not Found",TEMPLATE_DOMAIN); ?></h2>
	<p><?php _e("Sorry, but you are looking for something that isn't here.",TEMPLATE_DOMAIN); ?></p>

<?php endif; ?>

</div> 

<!-- /content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

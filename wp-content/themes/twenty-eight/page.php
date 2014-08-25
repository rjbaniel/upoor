<?php get_header(); ?>
<div class="content">
	<div class="primary">
		<?php if (have_posts()) { while (have_posts()) { the_post(); ?>
			<div class="item">
				<div class="pagetitle">
					<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
					<?php edit_post_link('<img src="'.get_bloginfo('template_directory').'/images/pencil.png" alt="'.__("Edit Link",TEMPLATE_DOMAIN).'"  />', '<span class="editlink">', '</span>'); ?>
				</div>
				<div class="itemtext">
					<?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>',TEMPLATE_DOMAIN)); ?><?php wp_link_pages('<p><strong>'.__('Pages',TEMPLATE_DOMAIN).':</strong> ', '</p>', 'number'); ?>
				</div>
			</div>
		<?php } ?>

        <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>   


		<?php } else { $notfound = '1'; ?>
		<h2><?php _e('Not Found',TEMPLATE_DOMAIN);?></h2>
		<div class="item">
			<div class="itemtext">
				<p><?php _e("Oh no! You're looking for something which just isn't here.",TEMPLATE_DOMAIN);?></p>
			</div>
		</div>
		<?php } ?>
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>

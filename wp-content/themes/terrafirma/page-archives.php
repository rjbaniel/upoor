<?php
/*
Template Name: Archives
*/
?>
<?php get_header();?>
		<div id="content">
			<!-- primary content start -->
      <div class="post">
				<div class="header">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e("Permanent Link to",TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<div class="entry">
				  <h3><?php _e('by Categories',TEMPLATE_DOMAIN); ?></h3>
					<ul>
						<?php wp_list_categories('title_li=')    ?>
					</ul>
					
					<h3><?php _e('by Month',TEMPLATE_DOMAIN); ?></h3>
					<ul><?php wp_get_archives('type=monthly'); ?></ul>
				<h3><?php _e("Last 50 Entries",TEMPLATE_DOMAIN); ?></h3>
					<ul id="postslist">
					<?php $posts = query_posts('showposts=50');?>			
					<?php if (have_posts()) :while (have_posts()) : the_post(); ?>
						<li><em><?php the_time('d M Y'); ?></em><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e("Permanent Link:",TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?></p>
					<?php endif; ?>		
					</ul>					
				</div>
			</div>
			<!-- primary content end -->	
		</div>		
	<?php get_sidebar();?>	
<?php get_footer();?>

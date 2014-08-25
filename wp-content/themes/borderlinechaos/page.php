<?php get_header(); ?>
<?php get_sidebar(); ?> 

<div id="contentwrapper">

<div id="content">
<?php if('' != get_header_image() ) { ?>
<div id="custom-img-header">
<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
</div>
<?php } ?>
<br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post">
		<h2 class="posttitle" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>
			<div class="entrytext">
			
				<?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>')); ?>
			
	<br />
				<?php wp_link_pages('<p><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>
		<div class="navigation">

			<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">« <?php _e('Return Home', 'borderline');?></a></div>
			</div>
		</div>
	  <?php endwhile; ?>

      <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

     <?php endif; ?>
	<?php edit_post_link(__('Edit this entry.', 'borderline'), '<p>', '</p>'); ?>

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div></div>

<?php get_footer(); ?>

<?php get_header(); ?>

<div id="recent">
<div class="container">

<div class="recent-post">

<?php
$posts = get_posts('numberposts=1');
foreach($posts as $post) :
setup_postdata($post);
 ?>
<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php _e('Permanent Link to','cleantidy');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<small><?php the_time(__('F jS, Y')) ?> | <?php the_category(', ') ?> | <?php comments_popup_link(__('No comments','cleantidy'), __('1 comment','cleantidy'), __('% comments','cleantidy'), __('Comments are off for this post','cleantidy') ); ?>&nbsp;&nbsp;&nbsp; <?php edit_post_link(__('Edit this post','cleantidy')); ?> </small>
<div class="post-body"><br />
<?php the_content(__('Continue reading','cleantidy')); ?>
</div>
<?php endforeach; ?>

</div>

<div class="aboutbox">
<ul class="widgets">


				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('MostRecent sidebar') ) : ?>
				<?php wp_list_categories('hierarchical=0&title_li=<h2>'.__('Categories').'</h2>'); ?>
				<?php endif; ?>			
</ul>
</div>
<div class="clear"></div>
</div>
</div>


<div id="posts">
	<div class="container">
	<div class="recent-post">
<?php
$posts = get_posts('numberposts=5&offset=1');
foreach($posts as $post) :
setup_postdata($post);
 ?>
<div class="post" id="post-<?php the_ID(); ?>">
<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php _e('Permanent Link to','cleantidy');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<small><?php the_time(__('F jS, Y')) ?> | <?php the_category(', ') ?> | <?php comments_popup_link(__('No comments','cleantidy'), __('1 comment','cleantidy'), __('% comments','cleantidy'), __('Comments are off for this post','cleantidy') ); ?>&nbsp;&nbsp;&nbsp; <?php edit_post_link(__('Edit this post','cleantidy')); ?> </small>
<div class="post-body">
<?php the_content(__('Continue reading','cleantidy')); ?>
</div>
</div>
<?php endforeach; ?>
	

	</div>
	
	<?php get_sidebar(); ?>
	</div>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>

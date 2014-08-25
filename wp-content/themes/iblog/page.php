<?php get_header(); ?>



	<?php if($post->post_parent || wp_list_pages("title_li=&child_of=".$post->ID."&echo=0")):?>

	<div id="subnav" class="fix">

		<ul>

			<?php

			if($post->post_parent) $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");

			else 	$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&sort_column=menu_order");

			if ($children) { echo $children;} 

			?>

		</ul>

	</div><!-- /sub nav -->

	<?php endif;?>



  <div id="content">

    

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  

    <div class="post fix" id="post-<?php the_ID(); ?>">

        <h2 class="posttitle"><?php the_title(); ?></h2>

		

		<div class="entry">

		<?php the_content(__('<p>Continue reading &raquo;</p>', 'iblog') ); ?>

		<?php wp_link_pages(__('<p><strong>Pages:</strong> ', 'iblog'), '</p>', 'number'); ?>

		<?php edit_post_link(__('Edit', 'iblog'), '<p>', '</p>'); ?>

		</div><!--/entry -->

	

	</div><!--/post -->

	

		<?php endwhile; ?>

<?php if ( comments_open() ) comments_template('',true); // Get comments.php template ?>

        <?php endif; ?>

</div></div><?php get_sidebar(); ?></div>

<?php echo iblog_footer_link(); ?>

</div><?php get_footer(); ?>

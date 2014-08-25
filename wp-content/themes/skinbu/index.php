<?php get_header(); ?>

		<!-- LEFTBAR -->

		<div id="leftbar">

		<?php while (have_posts()) : the_post(); ?>

			<div id="post">

				<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>

				<h2><?php _e('By', 'skinbu'); ?> <span style="color:#0066FF"><?php the_author() ?>  <?php if(function_exists('the_views')) { the_views(); } ?></span></h2>

				<div id="postcontent"><p> <?php the_content(''); ?> </p></div>

				<div id="tagsbar">

					<span id="tbarelement"><img alt="categoria" src="<?php bloginfo('template_directory'); ?>/images/categoria.png" /><?php the_category(', '); ?></span>

					<span id="tbarelement"><img alt="commento" src="<?php bloginfo('template_directory'); ?>/images/comment.png" /><?php comments_popup_link(__('No Comments', 'skinbu'), __('1 Comment', 'skinbu'), __('% Comments', 'skinbu')); ?></span>

					<span id="tbarelement"><img alt="data" src="<?php bloginfo('template_directory'); ?>/images/data.png" /><?php the_time('F jS, Y') ?></span>

					<div id="readmore"><a href="<?php the_permalink() ?>#more-<?php the_ID(); ?>"><img alt="<?php _e('Read All', 'skinbu'); ?>" src="<?php bloginfo('template_directory'); ?>/images/readmore1.png" onmouseover="this.src='<?php bloginfo('template_directory'); ?>/images/readmore2.png'" onmouseout="this.src='<?php bloginfo('template_directory'); ?>/images/readmore1.png'" /></a></div>

				</div>

			</div>

		<?php endwhile; ?>



		<div id="links"><?php if(function_exists('wp_page_numbers')) { wp_page_numbers(); } else  posts_nav_link(' &#183; ', __('Next Page ', 'skinbu'), __(' Previous Page', 'skinbu'))  ?></div>

		</div>

		<!-- END LEFTBAR -->

		

<?php get_sidebar(); ?>

<?php get_footer(); ?>


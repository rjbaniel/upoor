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

			<div id="authorbox"><h3><?php _e('About... ', 'skinbu'); ?><?php the_author_posts_link(); ?></h3> <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' ); }?><em><?php _e('This author published', 'skinbu'); ?>  <?php the_author_posts(); ?> <?php _e('posts in this site.', 'skinbu'); ?></em><br /> <?php the_author_meta('description'); ?></div>

			<h1>Share</h1><div id="share"><?php if(function_exists('wp_print')) { print_link(); } ?><a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>&t=<?php the_title(); ?>"><img alt="Facebook"  src="<?php bloginfo('template_directory'); ?>/images/facebook.png"  /></a><a href="http://twitter.com/home?status=<?php the_title(); ?>-<?php the_permalink() ?>"><img alt="Twitter" height="32" src="<?php bloginfo('template_directory'); ?>/images/twitter.png" width="32" /></a><a href="mailto:?subject=<?php the_title() ?>&body=<?php the_permalink() ?>"><img alt="Email" height="32" src="<?php bloginfo('template_directory'); ?>/images/email.png" width="32" /></a><a href="https://skydrive.live.com/sharefavorite.aspx%2f.SharedFavorites??marklet=1&amp;url=<?php the_permalink() ?>&title=<?php the_title(); ?>"><img alt="Windows Live" height="32" src="<?php bloginfo('template_directory'); ?>/images/windows.png" width="32" /></a><a href="http://technorati.com/faves?add=<?php the_permalink() ?>"><img alt="Technorati" height="32" src="<?php bloginfo('template_directory'); ?>/images/technorati.png" width="32" /></a><a href="http://delicious.com/post?url=<?php the_permalink() ?>"><img alt="Delicious" height="32" src="<?php bloginfo('template_directory'); ?>/images/delicious.png" width="32" /></a><a href="http://digg.com/submit?phase=2&url=<?php the_permalink() ?>&title=<?php the_title(); ?>&bodytext=<?php the_permalink() ?>"><img alt="Digg" height="32" src="<?php bloginfo('template_directory'); ?>/images/digg.png" width="32" /></a><a href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>"><img alt="Stumblepon" height="32" src="<?php bloginfo('template_directory'); ?>/images/stumbleupon.png" width="32" /></a><a href="http://www.myspace.com/Modules/PostTo/Pages/?u=<?php the_permalink() ?>&t=<?php the_title(); ?>"><img alt="Myspace" height="32" src="<?php bloginfo('template_directory'); ?>/images/myspace.png" width="32" /></a><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>;&amp;summary="><img alt="Likedin" height="32" src="<?php bloginfo('template_directory'); ?>/images/linkedin.png" width="32" /></a></div>	



				<?php comments_template('',true); ?>

		<div id="links"><?php previous_post_link('%link', __('Previous post', 'skinbu')) ?><?php next_post_link('%link', __(' - Next post', 'skinbu')) ?></div>

		<?php endwhile; ?>

		

		</div>

		<!-- END LEFTBAR -->

		

<?php get_sidebar(); ?>

<?php get_footer(); ?>


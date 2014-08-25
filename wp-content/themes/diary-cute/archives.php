<?php

/*

Template Name: Archives

*/

?>



<?php get_header(); ?>







	<div id="content">

	<div id="maincontent">

<div class="topcorner"></div>

		<div class="contentpadding">

 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>



	<h2><?php the_title(); ?></h2>	

	

				<p><strong><a href="<?php bloginfo('url'); ?>" alt="<?php bloginfo('name'); ?>"><?php _e('Home', 'diary-cute'); ?></a></strong></p>

				<h3><?php _e('All internal pages:', 'diary-cute'); ?></h3>

				<ul>

					<?php wp_list_pages('title_li='); ?>

				</ul>

				<h3><?php _e('All internal blog posts:', 'diary-cute'); ?></h3>

				<ul>

					<?php $archive_query = new WP_Query('showposts=1000');

						while ($archive_query->have_posts()) : $archive_query->the_post(); ?>

					<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'diary-cute'); ?> <?php the_title(); ?>"><?php the_title(); ?></a> (<?php comments_number('0', '1', '%'); ?>)</li>

					<?php endwhile; ?>

				</ul>

				<h3><?php _e('Topical archive pages:', 'diary-cute'); ?></h3>

				<ul>

					<?php wp_list_categories('title_li=0'); ?>

				</ul>

				<h3><?php _e('Monthly archive pages:', 'diary-cute'); ?></h3>

				<ul>

					<?php wp_get_archives('type=monthly'); ?>

				</ul>



				<h3><?php _e('Available RSS Feeds:', 'diary-cute'); ?></h3>

				<ul>

					<li><a href="<?php bloginfo('rdf_url'); ?>" alt="RDF/RSS 1.0 feed"><acronym title="Resource Description Framework">RDF</acronym>/<acronym title="Really Simple Syndication">RSS</acronym> 1.0 feed</a></li>

					<li><a href="<?php bloginfo('rss_url'); ?>" alt="RSS 0.92 feed"><acronym title="Really Simple Syndication">RSS</acronym> 0.92 feed</a></li>

					<li><a href="<?php bloginfo('rss2_url'); ?>" alt="RSS 2.0 feed"><acronym title="Really Simple Syndication">RSS</acronym> 2.0 feed</a></li>

					<li><a href="<?php bloginfo('atom_url'); ?>" alt="Atom feed">Atom feed</a></li>

				</ul>

			



   <?php endwhile; endif; ?>

			</div>

	<div class="bottomcorner"></div>

	</div>

<?php get_sidebar(); ?>

<div class="clear"></div>

	</div>



<?php get_footer(); ?>


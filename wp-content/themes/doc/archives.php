<?php

/* 

Template Name: Archives Page

 */

 ?>



<?php get_header(); ?>

<div id="main" class="g25">

<?php while (have_posts()) : the_post(); ?>

<div class="post">

<div class="pt"><h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent link to <?php the_title(); ?>"><?php the_title(); ?></a></h1></div>

<div class="text">

<table>

<tr><th><?php _e('Archives by category', 'doc'); ?></th>

<th><?php _e('Archives by month', 'doc'); ?></th></tr><tr>

<td><ul><?php wp_list_categories('sort_column=name&optioncount=1') ?></ul></td>

<td><ul><?php wp_get_archives('type=monthly&show_post_count=1') ?></ul></td></tr></table>

<p><strong><?php _e('Topics', 'doc'); ?></strong>:  <?php wp_tag_cloud('smallest=8&largest=8&number=0') ?></p>

<br />

<h3><?php _e('TOC', 'doc'); ?></h3>

<ul>

<?php wp_get_archives('postbypost','10000', 'html'); ?>

</ul>

</div>

<?php wp_link_pages () ?>

<br />

</div>

<div class="clear"></div>

<!--

 <?php trackback_rdf(); ?>

 -->

<?php endwhile; ?>

</div>

<?php include(TEMPLATEPATH."/sidebar.php");?>

</div>

<div class="clear"></div>

<?php get_footer(); ?>

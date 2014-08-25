<?php get_header(); ?>

<div id="main" class="g25">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

<div class="pt"><h2>&para; <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent link to', 'doc'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2></div>

<div class="text">

<?php the_content(__('...read more', 'doc') ); ?>

<div class="meta">&sect;<?php the_ID(); ?> &middot; <?php the_time('F j, Y'); ?> &middot; <?php the_category(', ') ?> &middot; <?php comments_popup_link(__('(No comments)', 'doc'), __('(1 comment)', 'doc'), __('(% comments)', 'doc') ); ?> &middot; <?php the_tags('Tags: ', ', ', ' '); ?></div>

<div class="social">

<ul>

<li><a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink() ?>">[E-mail this post]</a></li>

<li><a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>">Save on Delicious</a></li>

<li><a href="http://reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>">Submit to Reddit</a></li>

<li><a href="http://www.digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>">Digg it</a></li>

<li><a href="http://furl.net/storeIt.jsp?t=<?php the_title() ?>&amp;u=<?php the_permalink() ?>">Store on Furl</a></li>

<li><a href="http://technorati.com/faves?add=<?php the_permalink() ?>">Fave on Technorati</a></li>

</ul>

</div>

</div>

<?php wp_link_pages () ?>

<br /><hr />

</div>

<div class="clear"></div>

<!--

 <?php trackback_rdf(); ?>

 -->

<?php endwhile; ?>

<?php comments_template('', true); ?>

<div class="navigation">

<div class="alignleft"><?php next_posts_link(__('&larr; Older entries', 'doc') ) ?></div>

<div class="alignright"><?php previous_posts_link(__('Newer entries &rarr;', 'doc')) ?></div>

</div>

<div class="clear"></div>

<?php else : ?>

<?php include(TEMPLATEPATH."/notfound.php");?>

<?php endif; ?>

</div>

<?php include(TEMPLATEPATH."/sidebar.php");?>

<div class="clear"></div>

</div>

<div class="clear"></div>

<?php get_footer(); ?>

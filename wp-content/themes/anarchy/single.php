<?php
/* Don't remove this line. */
load_template(TEMPLATEPATH . '/header.php');
?>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336x280-anarchy-top"); } ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php the_date('','<h2 class="the-date">','</h2>'); ?>

<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="post"<?php endif; ?> id="post-<?php the_ID(); ?>">   
<h3 class="storytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:', 'anarchy');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
<div class="meta">
<?php _e("Filed under:", 'anarchy'); ?> <?php the_category(',') ?> &#8212;<?php the_tags( '' . __( 'Tagged' , 'anarchy') . ' ', ', ', ''); ?>&#8212; <?php the_author() ?> @ <?php the_time() ?> <?php edit_post_link(__('Edit This', 'anarchy')); ?>
</div>
	
<div class="storycontent">
<?php the_content(__('Read the rest of this entry &raquo;', 'anarchy')); ?>
</div>

<div class="feedback">
<?php wp_link_pages(); ?>
<?php comments_popup_link(__('Comments (0)', 'anarchy'), __('Comments (1)', 'anarchy'), __('Comments (%)', 'anarchy')); ?>
</div>

<!-- <?php trackback_rdf(); ?> -->

</div>

<?php comments_template('',true); ?>

<div id="post-navigator">
<div class="alignleft"><?php previous_post_link('&laquo;%link') ?></div>
<div class="alignright"><?php next_post_link('%link&raquo;') ?></div>
</div>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.', 'anarchy'); ?></p>
<?php endif; ?>




<?php load_template(TEMPLATEPATH . '/footer.php'); ?>

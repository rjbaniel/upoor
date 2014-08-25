<div id="front-content">
<?php include (TEMPLATEPATH . '/lib/includes/options.php'); ?>

<ul class="list">

<?php if($tn_wpmu_dixi_intro_header_on != 'disable') { ?>
<li>
<h3 id="intro-header">
<?php if($tn_wpmu_dixi_intro_header == '') { ?>
<?php _e('This is intro header', TEMPLATE_DOMAIN); ?>
<?php } else { ?>
<?php echo stripslashes($tn_wpmu_dixi_intro_header); ?>
<?php } ?>
</h3>
<ul>
<li id="intro-header-text">
<?php if($tn_wpmu_dixi_intro_header_text == '') { ?>
<?php _e('You can replace area on this page with a new text in <a href="wp-admin/themes.php?page=site-intro.php">your theme options</a>', TEMPLATE_DOMAIN); ?>
<?php } else { ?>
<?php echo stripslashes($tn_wpmu_dixi_intro_header_text); ?>
<?php } ?>
</li>
</ul>
</li>
<?php } ?>


<?php
$tn_wpmu_dixi_featured_vid = get_option('tn_wpmu_dixi_featured_vid');
if($tn_wpmu_dixi_featured_vid == ''){ ?>
<?php } else { ?>
<li>
<h3><?php _e('Featured Videos', TEMPLATE_DOMAIN); ?></h3><ul>
<li><?php $tn_wpmu_dixi_featured_vid = stripcslashes($tn_wpmu_dixi_featured_vid); echo $tn_wpmu_dixi_featured_vid; ?> </li>
</ul></li>
<?php } ?>



<!-- custom -->
<li>
<h3><?php _e('Recent Site Articles', TEMPLATE_DOMAIN); ?></h3>
<ul>
<?php
$featured_cat_option = get_option('tn_wpmu_dixi_featured_cat');
$featured_cat_count_option = get_option('tn_wpmu_dixi_featured_cat_count');
if($featured_cat_count_option == '') { $featured_cat_count_option = '10'; }
$category_id = get_cat_ID($featured_cat_option);
//insert your category name
$my_query = new WP_Query('cat=' . $featured_cat_option . '&showposts=' . $featured_cat_count_option);
while ($my_query->have_posts()) : $my_query->the_post();
$the_post_ids = $post->ID;
$do_not_duplicate = $post->ID;
?>

<li class="feat-img">
<?php if(function_exists('the_post_thumbnail')) { ?>
<?php if(get_the_post_thumbnail() != "") { ?>
<div class="alignleft"><?php the_post_thumbnail(array(180,150), array('class' => '')); ?></div>
<?php } else { ?>
<?php custom_get_post_img ($the_post_id=$the_post_ids, $width='150', $height='120', $size='thumbnail'); ?>
<?php } ?>
<?php } else { ?>
<?php custom_get_post_img ($the_post_id=$the_post_ids, $width='150', $height='120', $size='thumbnail'); ?>
<?php } ?>

<strong class="feat-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></strong><br />
<?php _e('by', TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e('on', TEMPLATE_DOMAIN); ?> <?php the_time('jS F Y') ?>
<p><?php the_excerpt_feature($excerpt_length=20); ?></p>
</li>

<?php endwhile;?>

</ul>

</li>
<!-- end custom -->

</ul>



<?php include (TEMPLATEPATH . '/lib/templates/tab-content.php'); ?>



<?php if ( is_active_sidebar( 'frontpage' ) ) : ?>
<ul class="list">
<?php dynamic_sidebar( 'frontpage' ); ?>
</ul>
<?php endif; ?>



</div>
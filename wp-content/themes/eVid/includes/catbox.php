<?php $cat_one_id = (int) get_catId(get_option('evid_home_cat_one'));
      $cat_two_id = (int) get_catId(get_option('evid_home_cat_two')); ?>
<!--Category Box 1-->

<div class="home-post-wrap-box"> <span class="headings"><?php esc_html_e('Recent From','eVid') ?> <?php echo esc_html(get_option('evid_home_cat_one_title')); ?></span>
    <div class="cat-box-items">
        <ul>
            <?php $evid_home_cat_one_number = (int) get_option('evid_home_cat_one_number');
            $my_query = new WP_Query("cat=$cat_one_id&posts_per_page=$evid_home_cat_one_number");
  while ($my_query->have_posts()) : $my_query->the_post();
   ?>
            <li>

                <?php $width = 25;
                      $height = 25;

                      $classtext = 'catbox-image';
                      $titletext = get_the_title();

                      $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
                      $thumb = $thumbnail["thumb"]; ?>

                <?php // if there's a thumbnail
if($thumb != '') { ?>
                    <a href="<?php the_permalink() ?>" title="<?php printf(esc_attr__('Permanent Link to %s','eVid'), get_the_title()) ?>">
                        <?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
                    </a>
                <?php }; ?>
                <span class="titles-boxes"><a href="<?php the_permalink(); ?>">
                <?php truncate_title(29) ?>
                </a></span> </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>
<!--Category Box 1-->
<!--Category Box 2-->
<div class="home-post-wrap-box"> <span class="headings"><?php esc_html_e('Recent From','eVid') ?> <?php echo esc_html(get_option('evid_home_cat_two_title')); ?></span>
    <div class="cat-box-items">
        <ul>
            <?php $evid_home_cat_two_number = (int) get_option('evid_home_cat_two_number');
            $my_query = new WP_Query("cat=$cat_two_id&posts_per_page=$evid_home_cat_two_number");
  while ($my_query->have_posts()) : $my_query->the_post();
   ?>
            <li>

               <?php $width = 25;
                     $height = 25;

                     $classtext = 'catbox-image';
                     $titletext = get_the_title();

                     $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
                     $thumb = $thumbnail["thumb"]; ?>

                <?php // if there's a thumbnail
if($thumb != '') { ?>
                    <a href="<?php the_permalink() ?>" title="<?php printf(esc_attr__('Permanent Link to %s','eVid'), get_the_title()) ?>">
                        <?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
                    </a>
                <?php }; ?>

                <span class="titles-boxes"><a href="<?php the_permalink(); ?>">
                <?php truncate_title(29) ?>
                </a></span> </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>
<!--Category Box 2-->
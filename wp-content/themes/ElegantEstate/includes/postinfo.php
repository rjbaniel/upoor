<?php if (!is_single() && get_option('elegantestate_postinfo1') ) { ?>
	<p class="postinfo"><?php esc_html_e('Posted','ElegantEstate'); ?> <?php if (in_array('author', get_option('elegantestate_postinfo1'))) { ?> <?php esc_html_e('by','ElegantEstate'); ?> <?php the_author_posts_link(); ?><?php }; ?><?php if (in_array('date', get_option('elegantestate_postinfo1'))) { ?> <?php esc_html_e('on','ElegantEstate'); ?> <?php the_time(get_option('elegantestate_date_format')) ?><?php }; ?><?php if (in_array('categories', get_option('elegantestate_postinfo1'))) { ?> <?php esc_html_e('in','ElegantEstate'); ?> <?php the_category(', ') ?><?php }; ?><?php if (in_array('comments', get_option('elegantestate_postinfo1'))) { ?> | <?php comments_popup_link(esc_html__('0 comments','ElegantEstate'), esc_html__('1 comment','ElegantEstate'), '% '.esc_html__('comments','ElegantEstate')); ?><?php }; ?></p>
<?php } elseif (is_single() && get_option('elegantestate_postinfo2') ) { ?>
	<p class="postinfo"><?php esc_html_e('Posted','ElegantEstate'); ?> <?php if (in_array('author', get_option('elegantestate_postinfo2'))) { ?> <?php esc_html_e('by','ElegantEstate'); ?> <?php the_author_posts_link(); ?><?php }; ?><?php if (in_array('date', get_option('elegantestate_postinfo2'))) { ?> <?php esc_html_e('on','ElegantEstate'); ?> <?php the_time(get_option('elegantestate_date_format')) ?><?php }; ?><?php if (in_array('categories', get_option('elegantestate_postinfo2'))) { ?> <?php esc_html_e('in','ElegantEstate'); ?> <?php the_category(', ') ?><?php }; ?><?php if (in_array('comments', get_option('elegantestate_postinfo2'))) { ?> | <?php comments_popup_link(esc_html__('0 comments','ElegantEstate'), esc_html__('1 comment','ElegantEstate'), '% '.esc_html__('comments','ElegantEstate')); ?><?php }; ?></p>
<?php }; ?>
<?php if (!is_single() && get_option('envisioned_postinfo1') ) { ?>
	<p class="meta-info"><?php esc_html_e('Posted','Envisioned'); ?> <?php if (in_array('author', get_option('envisioned_postinfo1'))) { ?> <?php esc_html_e('by','Envisioned'); ?> <?php the_author_posts_link(); ?><?php }; ?><?php if (in_array('date', get_option('envisioned_postinfo1'))) { ?> <?php esc_html_e('on','Envisioned'); ?> <?php the_time(get_option('envisioned_date_format')) ?><?php }; ?><?php if (in_array('categories', get_option('envisioned_postinfo1'))) { ?> <?php esc_html_e('in','Envisioned'); ?> <?php the_category(', ') ?><?php }; ?><?php if (in_array('comments', get_option('envisioned_postinfo1'))) { ?> | <?php comments_popup_link(esc_html__('0 comments','Envisioned'), esc_html__('1 comment','Envisioned'), '% '.esc_html__('comments','Envisioned')); ?><?php }; ?></p>
<?php } elseif (is_single() && get_option('envisioned_postinfo2') ) { ?>
	<p class="meta-info">
		<?php esc_html_e('Posted','Envisioned'); ?> <?php if (in_array('author', get_option('envisioned_postinfo2'))) { ?> <?php esc_html_e('by','Envisioned'); ?> <?php the_author_posts_link(); ?><?php }; ?><?php if (in_array('date', get_option('envisioned_postinfo2'))) { ?> <?php esc_html_e('on','Envisioned'); ?> <?php the_time(get_option('envisioned_date_format')) ?><?php }; ?><?php if (in_array('categories', get_option('envisioned_postinfo2'))) { ?> <?php esc_html_e('in','Envisioned'); ?> <?php the_category(', ') ?><?php }; ?><?php if (in_array('comments', get_option('envisioned_postinfo2'))) { ?> | <?php comments_popup_link(esc_html__('0 comments','Envisioned'), esc_html__('1 comment','Envisioned'), '% '.esc_html__('comments','Envisioned')); ?><?php }; ?>
	</p>
<?php }; ?>
<?php if(get_option('grungemag_postinfo1') || get_option('grungemag_postinfo2') ) { ?>
	<div class="post-info">

		<?php if (!is_single() && get_option('grungemag_postinfo1') ) { ?>

			<?php esc_html_e('Posted','GrungeMag'); ?> <?php if (in_array('author', get_option('grungemag_postinfo1'))) { ?> <?php esc_html_e('by','GrungeMag'); ?> <?php the_author_posts_link(); ?><?php }; ?><?php if (in_array('date', get_option('grungemag_postinfo1'))) { ?> <?php esc_html_e('on','GrungeMag'); ?> <?php the_time(get_option('grungemag_date_format')) ?><?php }; ?><?php if (in_array('categories', get_option('grungemag_postinfo1'))) { ?> <?php esc_html_e('in','GrungeMag'); ?> <?php the_category(', ') ?><?php }; ?><?php if (in_array('comments', get_option('grungemag_postinfo1'))) { ?> | <?php comments_popup_link(esc_html__('0 comments','GrungeMag'), esc_html__('1 comment','GrungeMag'), '% '.esc_html__('comments','GrungeMag')); ?><?php }; ?>

		<?php } elseif (is_single() && get_option('grungemag_postinfo2') ) { ?>

			<?php esc_html_e('Posted','GrungeMag'); ?> <?php if (in_array('author', get_option('grungemag_postinfo2'))) { ?> <?php esc_html_e('by','GrungeMag'); ?> <?php the_author_posts_link(); ?><?php }; ?><?php if (in_array('date', get_option('grungemag_postinfo2'))) { ?> <?php esc_html_e('on','GrungeMag'); ?> <?php the_time(get_option('grungemag_date_format')) ?><?php }; ?><?php if (in_array('categories', get_option('grungemag_postinfo2'))) { ?> <?php esc_html_e('in','GrungeMag'); ?> <?php the_category(', ') ?><?php }; ?><?php if (in_array('comments', get_option('grungemag_postinfo2'))) { ?> | <?php comments_popup_link(esc_html__('0 comments','GrungeMag'), esc_html__('1 comment','GrungeMag'), '% '.esc_html__('comments','GrungeMag')); ?><?php }; ?>

		<?php }; ?>
	</div><!-- end .post-info -->

	<div style="clear: both;"></div>
<?php }; ?>
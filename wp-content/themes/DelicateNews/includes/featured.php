<!-- Start Featured -->
<div id="featured" class="clearfix">

	<?php
	$arr = array();
	$i=1;

	$width = 249;
	$height = 158;
	$width_small = 104;
	$height_small = 104;

	$featured_cat = get_option('delicatenews_feat_cat');
	$featured_num = (int) get_option('delicatenews_featured_num');

	if (get_option('delicatenews_use_pages') == 'false') query_posts("posts_per_page=$featured_num&cat=".get_catId($featured_cat));
	else {
		global $pages_number;

		if (get_option('delicatenews_feat_pages') <> '') (int) $featured_num = count(get_option('delicatenews_feat_pages'));
		else $featured_num = (int) $pages_number;

		if ($featured_num > 5) $featured_num = 5;

		$et_featured_pages_args = array(
			'post_type' => 'page',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => (int) $featured_num,
		);

		if ( is_array( et_get_option( 'delicatenews_feat_pages', '', 'page' ) ) )
			$et_featured_pages_args['post__in'] = (array) array_map( 'intval', et_get_option( 'delicatenews_feat_pages', '', 'page' ) );

		query_posts( $et_featured_pages_args );
	};

	while (have_posts()) : the_post();
		global $post;
		$arr[$i]["title"] = truncate_title(50,false);
		$arr[$i]["fulltitle"] = truncate_title(250,false);

		$arr[$i]["excerpt"] = truncate_post(330,false);

		$arr[$i]["permalink"] = get_permalink();

		$arr[$i]["postinfo"] = esc_html__("Posted by", "DelicateNews")." ". get_the_author_meta('display_name') . esc_html__(' on ','DelicateNews') . get_the_time(get_option('delicatenews_date_format')) . ' | ' . '<a href="'. esc_attr( $arr[$i]["permalink"] ) . '#comments' . '">' . esc_html($post->comment_count) . ' ' . esc_html__('comments','DelicateNews') . '</a>';
		$arr[$i]["date"] = get_the_time('M d, y');

		if ($i < 3) $arr[$i]["thumbnail"] = get_thumbnail($width,$height,'',$arr[$i]["fulltitle"],$arr[$i]["fulltitle"]);
		else $arr[$i]["thumbnail"] = get_thumbnail($width_small,$height_small,'',$arr[$i]["fulltitle"],$arr[$i]["fulltitle"]);

		$arr[$i]["thumb"] = $arr[$i]["thumbnail"]["thumb"];
		$arr[$i]["use_timthumb"] = $arr[$i]["thumbnail"]["use_timthumb"];

		$arr[$i]['post_id'] = (int) get_the_ID();

		$i++;
	endwhile; wp_reset_query();	?>

	<div id="description">

		<?php for ($i = 1; $i <= $featured_num; $i++) { ?>

			<div class="slide">
				<h2 class="title"><a href="<?php echo esc_url($arr[$i]["permalink"]); ?>"><?php echo($arr[$i]["title"]); ?></a></h2>
				<p><?php echo ($arr[$i]["excerpt"]); ?></p>

				<a href="<?php echo esc_url($arr[$i]["permalink"]); ?>" class="readmore"><span><?php esc_html_e('read more','DelicateNews'); ?></span></a>
				<div class="clear"></div>

				<p class="meta"><?php echo($arr[$i]["postinfo"]); ?></p>
			</div> <!-- end .slide -->

		<?php }; ?>

	</div> <!-- end #description -->

	<div id="controllers">
		<div class="alignleft">
			<?php for ($i = 1; $i <= 2; $i++) { ?>
				<a href="#" <?php if ($i==1) echo('class="active"'); if ($i==2) echo('class="second"'); ?> rel="<?php echo esc_attr( $i ); ?>">
					<?php print_thumbnail( array(
						'thumbnail' 	=> $arr[$i]["thumbnail"]["thumb"],
						'use_timthumb' 	=> $arr[$i]["thumbnail"]["use_timthumb"],
						'alttext'		=> $arr[$i]["fulltitle"],
						'width'			=> (int) $width,
						'height'		=> (int) $height,
						'et_post_id'	=> $arr[$i]['post_id'],
					) ); ?>

					<span class="overlay"></span>
					<span class="date"><?php echo $arr[$i]["date"]; ?></span>
				</a>
			<?php }; ?>
		</div>

		<div class="alignright">
			<?php for ($i = 3; $i <= 5; $i++) { ?>
				<?php if ($i <= $featured_num) { ?>
					<a href="#" rel="<?php echo esc_attr( $i ); ?>">
						<?php print_thumbnail( array(
							'thumbnail' 	=> $arr[$i]["thumbnail"]["thumb"],
							'use_timthumb' 	=> $arr[$i]["thumbnail"]["use_timthumb"],
							'alttext'		=> $arr[$i]["fulltitle"],
							'width'			=> (int) $width_small,
							'height'		=> (int) $height_small,
							'et_post_id'	=> $arr[$i]['post_id'],
						) ); ?>

						<span class="overlay"></span>
						<span class="date"><?php echo $arr[$i]["date"]; ?></span>
					</a>
				<?php }; ?>
			<?php }; ?>
		</div>
	</div> <!-- end #controllers -->

</div> <!-- end #featured -->
<!-- End Featured -->
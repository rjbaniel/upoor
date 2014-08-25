<!-- Featured Slider -->
<div id="featured-slider">
	<div id="s1" class="pics">
		<?php
		$arr = array(); $i=1;
		$featured_cat = get_option('lumin_feat_cat');
		query_posts("posts_per_page=3&cat=".get_catId($featured_cat));
		while (have_posts()) : the_post(); ?>

			<?php $titletext = get_the_title();

				  $thumbnail = get_thumbnail(571,348,'',$titletext,$titletext);
				  $thumb = $thumbnail["thumb"];

				  $thumbnail2 = get_thumbnail(80,80,'',$titletext,$titletext);
				  $thumb2 = $thumbnail2["thumb"]; ?>

			<div>
				<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, 571, 348, ''); ?>
				<a href="<?php the_permalink() ?>" title="<?php printf(esc_attr__ ('Permanent Link to %s', 'Lumin'), get_the_title()) ?>"><span class="feat-overlay"></span></a>
			</div>

			<?php $arr[$i]["thumb"] = $thumb2;
			      $arr[$i]["use_timthumb"] = $thumbnail2["use_timthumb"];
		    $arr[$i]["title"] = truncate_title(21,false);
		    $arr[$i]["fulltitle"] = truncate_title(250,false);
		    $arr[$i]["excerpt"] = truncate_post(100,false);
		    $arr[$i]['post_id'] = (int) get_the_ID();
		    $i++; ?>

		<?php endwhile; wp_reset_query(); ?>
	</div> <!-- end .pics -->

	<div id="slider-control">
		<?php for ($i = 1; $i <= 3; $i++) {
			if ($arr[$i]["thumb"] <> '' ) { ?>

				<div class="featitem<?php if ($i==1) echo(" active"); if ($i==3) echo(" last");?>">
					<div class="item-content">
					<?php
						print_thumbnail( array(
							'thumbnail' 	=> $arr[$i]["thumb"],
							'use_timthumb' 	=> $arr[$i]["use_timthumb"],
							'alttext'		=> $arr[$i]["fulltitle"],
							'width'			=> 80,
							'height'		=> 80,
							'et_post_id'	=> $arr[$i]['post_id'],
						) );
					?>
						<div class="description">
							<h2><?php echo esc_html($arr[$i]["title"]);?></h2>
							<p class="excerpt"><?php echo($arr[$i]["excerpt"]); ?></p>
						</div> <!-- end .description -->
					</div> <!-- end .item-content -->
					<span class="order"><?php echo esc_html( $i ); ?></span>
				</div> <!-- end .featitem -->

			<?php } else { break; }
		} ?>
	</div> <!-- end slider-control div -->

	<div class="clear"></div>
</div> <!-- div featured-slider -->
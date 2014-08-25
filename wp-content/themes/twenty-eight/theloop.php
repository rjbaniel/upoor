<?php /* Initialize The Loop */ if (have_posts()) { $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

<?php is_tag(); ?>
	<?php // Headlines for archives
	if (!is_single() && !is_home() or is_paged()) { ?>
	<div class="pagetitle">
		<h2>
		<?php /* If this is a category archive */ if (is_category()) { ?>				
		<?php _e("Archive for the",TEMPLATE_DOMAIN); ?> '<?php echo single_cat_title(); ?>' <?php _e("Category",TEMPLATE_DOMAIN); ?>

		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
        <h2 class="pagetitle"><?php _e('Posts Tagged',TEMPLATE_DOMAIN);?> &#8216;<?php single_tag_title(); ?>&#8217;</h2>

		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<?php _e('Archive for',TEMPLATE_DOMAIN);?> <?php the_time(__('F jS, Y')); ?>

		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<?php _e('Archive for',TEMPLATE_DOMAIN);?> <?php the_time('F, Y'); ?>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<?php _e('Archive for',TEMPLATE_DOMAIN);?> <?php the_time('Y'); ?>

		<?php /* If this is a search */ } elseif (is_search()) { ?>
		<?php _e("Search Results for",TEMPLATE_DOMAIN); ?> '<?php echo $s; ?>'

		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<?php _e('Author Archive for',TEMPLATE_DOMAIN);?> <?php $post = $wp_query->post;
			$the_author = $wpdb->get_var("SELECT meta_value FROM $wpdb->usermeta WHERE user_id = '$post->post_author' AND meta_key = 'nickname'"); echo $the_author; ?>
		
		<?php /* If this is a paged archive */ } elseif (is_paged()) { ?>
		<?php _e('Archive Page',TEMPLATE_DOMAIN);?> <?php echo $paged; ?>
		
		<?php } ?>
		</h2>
	</div>

	<?php } ?>

	<?php while (have_posts()) { the_post(); ?>
			<div id="post-<?php the_ID(); ?>" class="item entry">
				<div class="itemhead">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title='<?php strip_tags(the_title()); ?>'><?php the_title(); ?></a></h3>

					<?php edit_post_link('<img src="'.get_bloginfo('template_directory').'/images/pencil.png" alt="'.__("Edit Link",TEMPLATE_DOMAIN).'"  />','<span class="editlink">','</span>'); ?>
						
				<p class="metadata"><?php the_time(get_option('date_format')) ?> <?php _e('in');?> <?php { the_category(', '); }?><?php if ( (is_home()) && !(is_page()) && !(is_single()) && !(is_search()) && !(is_archive()) && !(is_author()) && !(is_category()) && !(is_paged()) OR is_search() ) { ?>&nbsp;<?php _e("with",TEMPLATE_DOMAIN); ?>&nbsp;<?php comments_popup_link('0&nbsp;<span>Comments</span>', '1&nbsp;<span>Comment</span>', '%&nbsp;<span>Comments</span>', 'commentslink', '<span class="commentslink">Closed</span>'); ?><?php } ?><br /><?php the_tags(__('Tags: ',TEMPLATE_DOMAIN), ', ', '<br />'); ?></p>
						
				</div>

				<div class="itemtext">
					<?php if (is_archive() or is_search()) { 
						the_excerpt();
					} else {
						the_content(__("Continue Reading &raquo;",TEMPLATE_DOMAIN));
					} ?>
	
					<?php wp_link_pages('<p><strong>'.__('Pages',TEMPLATE_DOMAIN).':</strong> ', '</p>', 'number'); ?>
				</div>

			</div>


<?php	/* End The Loop */ }

	/* Insert Paged Navigation */ if (!is_single()) { include (TEMPLATEPATH . '/navigation.php'); } ?>

<?php /* If there is nothing to loop */  } else { $notfound = '1'; /* So we can tell the sidebar what to do */ ?>

<h2><?php _e("Oops, I Did Not Find Anything",TEMPLATE_DOMAIN); ?></h2><div class="item"><div class="itemtext"><p><?php _e("What you were searching for could not be found. Maybe what you are looking for can be found by trying an alternate search query or browsing through the archives.",TEMPLATE_DOMAIN); ?></p></div></div>

<?php /* End Loop Init */ } ?>

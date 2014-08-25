<?php ob_start(); ?>

<?php get_header(); ?>
<?php is_tag(); ?>

	<div id="content">
	
	<!-- pages -->
	<?php if (is_page() and (!isset($notfound) || $notfound != '1')) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
				
			<div class="post" id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Read',TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				
				<div class="entry">


                        <?php if( is_archive() || is_search() || is_category() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content('<span class="readmore">'.__('Read the rest of this entry &raquo;',TEMPLATE_DOMAIN).'</span>'); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>


				</div>
			</div>
			
		<?php if ($user_ID) : ?>			
			<h3><?php _e('Actions',TEMPLATE_DOMAIN); ?></h3>
			<ul class="postmetadata">
				<li class="with_icon"><img class="icon" src="<?php echo get_bloginfo('stylesheet_directory') ?>/images/icons/edit-icon-16x16.gif" alt="edit" />&nbsp;<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN),'',''); ?></li>
			</ul>
		<?php endif; ?>


        <?php if(!is_page()) { ?>
		<?php comments_template('',true); ?>
	    <?php } else { ?>
        <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?> 
        <?php } ?>


		<?php endwhile; ?>
	
	<!-- blog -->
	<?php elseif (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
				
			<div class="post" id="post-<?php the_ID(); ?>">
				
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Read',TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<small class="date">
					<span class="date_day"><?php the_time('j') ?></span>
					<span class="date_month"><?php the_time('m') ?></span>
					<span class="date_year"><?php the_time('Y') ?></span>
				</small>
				
				<div class="entry">
					<?php the_content('<span class="readmore">'.__('Read the rest of this entry &raquo;',TEMPLATE_DOMAIN).'</span>'); ?>
				</div>
				
				<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), '<small class="postmetadata">'.__('Edit',TEMPLATE_DOMAIN).' : ', '</small><br/>'); ?>
				
				<small class="postmetadata"><?php _e('Comments',TEMPLATE_DOMAIN); ?> : <?php comments_popup_link(__('No Comments &#187;',TEMPLATE_DOMAIN), __('1 Comment &#187;',TEMPLATE_DOMAIN), __('% Comments &#187;',TEMPLATE_DOMAIN)); ?></small>
				<br/>
				<small class="postmetadata"><?php if (is_callable('the_tags')) the_tags(__('Tags : ', TEMPLATE_DOMAIN), ', '); ?></small>
				<br/>
				<small class="postmetadata"><?php _e('Categories',TEMPLATE_DOMAIN); ?> : <?php the_category(', ') ?></small>
			<?php if(function_exists('the_bunny_tags')) : ?>
				<br/>
				<small class="postmetadata technorati_tags">
					<?php the_bunny_tags('<span class="technorati_tags">Tags&nbsp;:&nbsp;</span>', '', ', '); ?>
				</small>
			<?php endif; ?>
			
			</div>
				
		<hr style="display:none;"/>
			
		<?php endwhile; ?>

		<p class="navigation">
			<span class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries',TEMPLATE_DOMAIN)) ?></span>
			<span class="alignright"><?php previous_posts_link(__('Next Entries &raquo;',TEMPLATE_DOMAIN)) ?></span>
		</p>
	
	<!-- nothing found -->
	<?php else : ?>
		<div class="post" id="post-none">
			<h2 class="center"><?php _e('Not found',TEMPLATE_DOMAIN); ?></h2>
			<p class="center"><?php _e("Sorry, but you are looking for something that is not here",TEMPLATE_DOMAIN); ?></p>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?>
		</div>
	<?php endif; ?>
	
	<!-- homepage -->

	<?php if(function_exists('yy_is_home')) : ?>
		
		<?php if(yy_get_lang()=="fr_FR") : ?>
			<?php if(yy_is_home()==true) : ?>
				<hr/>
			
				<?php if(function_exists('c2c_get_recent_posts')) : ?>	
					<div class="highlight_box" id="post-last-works">
						<h2><?php _e('Last works',TEMPLATE_DOMAIN); ?></h2>
						<ul>
							<?php c2c_get_recent_posts(3, '<li>%post_URL%<br />%post_excerpt_short%</li>', '5'); ?>
						</ul>
					</div>
				<?php endif; ?>
	
				<?php if(function_exists('c2c_get_recent_posts')) : ?>	
					<div class="highlight_box" id="post-last-news">
						<h2><?php _e('Last news',TEMPLATE_DOMAIN); ?></h2>
						<ul>
							<?php c2c_get_recent_posts(3, '<li>%post_URL%<br />%post_excerpt_short%</li>', '4 21'); ?>
						</ul>
					</div>
				<?php endif; ?>
	
		<?php endif; ?>
		
		<?php else : ?> 
			<?php if(yy_is_home()) : ?>
				<hr/>
			
				<?php if(function_exists('c2c_get_recent_posts')) : ?>	
					<div class="highlight_box" id="post-last-works">
						<h2><?php _e('Last works',TEMPLATE_DOMAIN); ?></h2>
						<ul>
							<?php c2c_get_recent_posts(3, '<li>%post_URL%<br />%post_excerpt_short%</li>', '23'); ?>
						</ul>
					</div>
				<?php endif; ?>
				
				<?php if(function_exists('c2c_get_recent_posts')) : ?>	
					<div class="highlight_box" id="post-last-news">
						<h2><?php _e('Last news',TEMPLATE_DOMAIN); ?></h2>
						<ul>
							<?php c2c_get_recent_posts(3, '<li>%post_URL%<br />%post_excerpt_short%</li>', '9 24'); ?>
						</ul>
					</div>
				<?php endif; ?>
			
			<?php endif; ?>
				
		<?php endif; ?>
		
	<?php endif; ?>
	
	</div>
	
	<hr/>
	
	<!-- sidebar -->
	<?php get_sidebar(); ?>

	<br style="clear:both" /><!-- without this little <br /> NS6 and IE5PC do not stretch the frame div down to encopass the content DIVs -->
</div>
				
<!-- footer -->
<?php get_footer(); ?>

<? ob_end_flush();?>

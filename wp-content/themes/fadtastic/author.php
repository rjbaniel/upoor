<?php get_header(); ?>

		<div id="content_wrapper">
			<div id="content">
			
			 <?php
			if(isset($_GET['author_name'])) :
			$curauth = get_userdatabylogin($author_name);
			else :
			$curauth = get_userdata(intval($author));
			endif;
			?>
			
			<h1><?php _e('About','fadtastic');?> <?php echo $curauth->user_firstname; ?> <?php echo $curauth->user_lastname; ?></h1>
			
			<p><strong><?php _e('Profile:','fadtastic'); ?></strong> <?php echo $curauth->user_description; ?></p>
			<p><strong><?php _e('Website:','fadtastic'); ?></strong> <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>
			

			<h2 class="top_border"><?php _e('Latest posts by','fadtastic');?> <?php echo $curauth->user_firstname; ?> <?php echo $curauth->user_lastname; ?>:</h2>
			
			<!-- The Loop -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			 <p><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','fadtastic');?> <?php the_title(); ?>">
			<?php the_title(); ?></a><br />
			<small><?php the_time(get_option('date_format')); ?> <?php _e('in','fadtastic');?> <?php the_category(', ') ?></small></p>
			  
			  <?php endwhile; else: ?>
				 <p><?php _e('No posts by this author.','fadtastic'); ?></p>
			
				<?php endif; ?>
				
			</div>
		</div>
			
	
	<?php include("sidebar.php") ?>

<?php get_footer(); ?>

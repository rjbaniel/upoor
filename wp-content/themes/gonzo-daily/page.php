<?php get_header(); ?>

	<?php if (have_posts()) : ?>
		<div id="content" class="single">

			<?php the_post(); ?>

			<div class="post">

				<h1><?php the_title(); ?></h1>

				<?php the_content(); ?>

				<p><?php the_tags('Tags: ', ', ', '<br />'); ?></p>

				<?php wp_link_pages(array('before' => '<p><strong>Страници:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				

				<?php 

				$subpages =  wp_list_pages('echo=0&depth=1&child_of='.get_the_ID().'&title_li='); 

				if($subpages != ''){

				?>

				<h2><?php echo __('Pages'); ?></h2>

				<ul>

				<?php echo $subpages; ?>

				</ul>

				<?php

				}

				?>

				

			</div>

            <div class="comments">
		   <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

			<?php if ('open' == $post->comment_status) : ?>
            <div id="respond">
				<h2 id="respond"><?php _e("Leave a comment", 'gonzo-daily'); ?></h2>

                 <div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>


				<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

					<p><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">Login</a></p>

				<?php else : ?>

					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

						<?php if ( $user_ID ) : ?>

							<p><?php _e('Logged in as', 'gonzo-daily'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'gonzo-daily') ?>"><?php _e('Logout', 'gonzo-daily'); ?></a></p>

						<?php else : ?>

							<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />

							<label for="author"><?php _e('Name', 'gonzo-daily'); ?>: <?php if ($req) _e('(required)'); ?></label></p>

							<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />

							<label for="email"><?php _e('Mail (will not be published)', 'gonzo-daily');?>: <?php if ($req) _e('(required)'); ?></label></p>

							<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />

							<label for="url"><?php _e('Website', 'gonzo-daily'); ?></label></p>

						<?php endif; ?>

						<p class="allowed-tags"><strong>XHTML:</strong>  <?php _e('Allowed tags:'); ?> <?php echo allowed_tags(); ?></p>

						<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

						<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e("Leave a comment", 'gonzo-daily'); ?>"/>

						<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>

                     <?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

					</form>

                        </div>

				<?php endif; ?>

			<?php else : ?>

			   

			<?php endif; ?>
			</div>

		</div>

	<?php else : ?>

		<?php include (TEMPLATEPATH . '/not_found.php'); ?>

	<?php endif; ?>

<?php get_footer(); ?>


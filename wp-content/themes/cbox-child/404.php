<?php
	infinity_get_header();
?>
	<div id="content" role="main" class="<?php do_action( 'content_class' ); ?>">
		<?php
			do_action( 'open_404' );
		?>
		<article id="post-0" class="post error404 not-found">
			<header>
			<h1 class="entry-title">
				<?php _e( 'Darn it.. Nothing found. Are you logged in?', infinity_text_domain ); ?>
			</h1>
			</header>
			<div class="entry-content">
				<p>
						<?php
							_e( 'Sorry, either the page you\'re looking for no longer exists, has moved, or is at a different URL. Check for typos in the URL bar and/or use the search box below to try to find what you\'re looking for. If you got to this page by clicking on a link that was sent to you in an email, then try logging in using the button at the top-left and then clicking the link again. If you try to access a page that only members can see without being logged in, you\'ll sometimes be re-directed here.', infinity_text_domain );
						?>
					</p>
					<?php
						infinity_get_search_form();
					?>
					
					<div id="search-recent-posts" class="eight columns">

					<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>	
					
					</div>		
					
					<div id="search-categories-widget" class="eight columns">

						<h2 class="widgettitle">
						<?php _e( 'Most Used Categories', infinity_text_domain ); ?>
						</h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div>	
					<div style="clear: both;"></div>
					<?php
					/* translators: %1$s: smilie */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', infinity_text_domain ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 1 ), array( 'after_title' => '</h2>'.$archive_content ) );
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
			</div>
		</article>
		<?php
			do_action( 'close_404' );
		?>
	</div>
	<?php
		infinity_get_sidebar();
	?>
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>
<?php
	infinity_get_footer();
?>

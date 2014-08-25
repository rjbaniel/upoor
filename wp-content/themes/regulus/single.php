<?php
	get_header();
	$pageDisplay = bm_getProperty( 'excerpt' );
	$authorDisplay = bm_getProperty( 'author' );
?>

<div id="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2><?php the_title(); ?>
	<em><?php the_time(__('F j, Y','regulus')); ?></em></h2>
	<em class="info"><?php printf(__('Posted by %1$s in : %2$s','regulus'), get_the_author(), get_the_category_list(', ')) ?>
	<?php if( !is_single() ) {

		echo ", ";
		// comments are open so display a link to them
		if ( comments_open() ) {
			comments_popup_link( __('add a comment','regulus'), __('1 comment so far','regulus'),'%' . __(' comments','regulus'), __(' comments','regulus'));

		// otherwise comments are closed
		} else {
			?> <a href="<?php the_permalink() ?>" class="comments"><?php _e('comments closed','regulus'); ?></a> <?php
		}

	} else {

	    // trackback links
	    ?>
	    , <a href="<?php trackback_url(display); ?>" title="trackback url"><?php _e('trackback','regulus'); ?></a>
		<?php
	        
	        
	}
	
	edit_post_link( __('edit post','regulus'), ' , ', ' ' );
	
	?>
	</em>
			  
	<?php
   	
   	$usePassword = !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password;

	// single page
	// -----------
	if( !is_single() ) {

		if ( $usePassword ) { echo "<div class=\"passwordPost\">"; }
		
	    if ( $pageDisplay == 0 ) {
			the_content();
		} else {
			the_excerpt();
		}
		
		if ( $usePassword ) { echo "</div>"; }
		
 	} else {
 	
 		if ( $usePassword ) { echo "<div class=\"passwordPost\">"; }
 	
		the_content();
		
		if ( $usePassword ) { echo "</div>"; }
	} 

	wp_link_pages();



		if( function_exists( the_tags ) ) {
			the_tags('<div class="tags">Tags:', ', ', '</div>');
		}
	
	  if ( comments_open() ) { ?> <?php comments_template('', true); ?><?php }



	endwhile; else: ?>

	<p><?php _e('Sorry, no posts matched your criteria.','regulus'); ?></p>

<?php endif;

if ( !is_single() ) {

	echo "<div id=\"pageNav\">";
	posts_nav_link( '', '&laquo; '.__('newer posts','regulus'), __('older posts','regulus').' &raquo;' );
	echo "</div>";

} ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

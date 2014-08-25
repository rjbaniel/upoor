<?php
/**
 * Template Name: UPoor Library
 */
?>
<?php infinity_get_header() ?>

<div id="content" role="main" class="<?php do_action( 'content_class' ); ?>">
	<?php
		do_action( 'open_content' );
		do_action( 'open_page' );
	?>	

	<!-- The actual library content -->
	<?php
		/*if ( is_user_logged_in() ) {
			$documents = get_documents();
		} else {
			$args = array ('access_state' => 'Publicly Accessible');
			$documents = get_documents($args);
		}
	?>
	<header>
		<h1>The University of the Poor Resource Library</h1>
	</header>
	<?php
		echo ( get_post_type( $documents[0] ) . " " );
		echo ( get_post_type( get_post( $documents[0]->post_content ) ) . " " );
		var_dump ( wp_get_post_terms($documents[0]->post_content, 'access_state', array( "fields" => "names" ) ) );
		$terms = wp_get_post_terms($documents[0]->ID, 'access_state', array( "fields" => "names" ) );
		$access_state = $terms[0];
		if ( $access_state == "UPoor Members Only" ) {
			echo "Works here!";
		}
	?>
	<ul class="document-list">
	<?php
		foreach ($documents as $document) { ?>
			<li class="document document-<?php echo $document->ID; ?>">
				<a href="<?php echo get_permalink( $document->ID ); ?>">
					<?php echo get_the_title( $document->ID ); ?>
				</a>
				<?php
					$terms = wp_get_post_terms($document->ID, 'access_state', array( "fields" => "names" ) );
					print_r($terms);
				?>
			</li>
		<?php } ?>
	</ul>  <!-- document-list -->
	<!-- End actual library content -->

	<?php
		do_action( 'close_page' );
		do_action( 'close_content' );
	*/?>
</div> <!-- content -->

<?php
	infinity_get_sidebar();
	infinity_get_footer();
?>

<?php if ( ! function_exists( 'et_custom_comments_display' ) ) :
function et_custom_comments_display($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div id="comment-<?php comment_ID(); ?>" class="comment-body">
		<?php echo get_avatar($comment,$size='73'); ?>
		<div class="comment-wrap">
			<div class="comment-author vcard">
				<?php printf('<span class="fn">%s</span>', get_comment_author_link()) ?><br/>
				<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(esc_html__('%1$s at %2$s','Lumin'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(esc_html__('(Edit)','Lumin'),'  ','') ?></div>
			</div>
			<?php if ($comment->comment_approved == '0') : ?>
				<em class="moderation"><?php esc_html_e('Your comment is awaiting moderation.','Lumin') ?></em>
				<br />
			<?php endif; ?>

		    <div class="comment-content"><?php comment_text() ?></div> <!-- end comment-content-->
		    <div class="reply-container"><?php comment_reply_link(array_merge( $args, array('reply_text' => esc_html__('reply','Lumin'),'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
		</div> <!-- end comment-wrap-->
	</div> <!-- end comment-body-->
<?php }
endif; ?>
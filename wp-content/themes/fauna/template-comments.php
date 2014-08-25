<?php /*
	Comments Template
	This page holds the code used by comments.php for showing comments.
	It's separated out here for ease of use, because the comments.php file is already pretty cluttered.
	*/
?>
<h2 id="comments"><?php _e('Comments', 'fauna') ?></h2>
<?php
	$even = "comment-even";
	$odd = "comment-odd";
	$author = "comment-author";
	$bgcolor = $even;
?>

<?php if ( ! empty($comments_by_type['comment']) ) : ?>

<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<ol id="comments" class="commentlist">
<?php wp_list_comments('type=comment&callback=list_comments'); ?>
</ol>


<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<?php endif; ?>



<br />

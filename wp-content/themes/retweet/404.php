<?php get_header(); ?>
<table class="content_table columns" cellspacing="0">
	<tbody class="content_tbody">
		<tr class="content_tr">
<td id="content" class="content_td column round-left">
	<div class="wrapper">
		<div class="section">
			<div class="entry" id="404">
				<h2 class="posttitle"><a href="javascript:history.back();" title="<?php _e('Not Found', 'retweet') ?>" rel="bookmark"><?php _e('Not Found', 'retweet') ?></a></h2>
				<div class="post">
				<?php _e('Sorry, but you are searching for something that is not here.', 'retweet') ?>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>
				</div>
			</div>
		</div>
	</div>
</td>
<td id="side_base" class="content_td column round-right">
	<?php get_sidebar(); ?>
</td>
		</tr>
	</tbody>
</table>
<?php get_footer(); ?>


















<?php get_header(); ?>

<div id="content">
	<div class="entry" id="404">
		<div class="posttitle">
			<h2><a href="javascript:history.back();" title="<?php _e('Not Found', 'retweet') ?>" rel="bookmark"><?php _e('Not Found', 'retweet') ?></a></h2>
			<em>&infin;<sup>&infin;</sup></em>
		</div>  <!--end of posttitle-->

	</div>  <!--end of entry-->
	<div class="clear"></div>
</div>  <!--end of content-->

<?php get_footer(); ?>

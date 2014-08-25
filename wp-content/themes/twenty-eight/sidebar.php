<hr/>
<div class="secondary">
	<div class="left">

	<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>
<h2>Categories</h2>
<?php wp_list_categories('orderby=id&show_count=0&use_desc_for_title=0&title_li='); ?>
<?php endif; ?>
</ul>
	</div>
	<div class="right">
	<div class="search"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?>
<?php endif; ?>
</ul>
	</div> <!-- close right -->

</div>
<div class="clear"></div>

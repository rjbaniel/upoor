<?php 
global $options;
foreach ($options as $value) {
    if (isset($value['id']) && isset($value['std']) && get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } 
      else if (isset($value['id']) && isset($value['std'])) { $$value['id'] = get_option( $value['id'] ); } 
} ?>
<div id="secondary">

<?php include(TEMPLATEPATH . '/subscribe.php'); ?>

<div id="pp-sidebars" class="clearfix">

<?php if ($pp_sidebar_option != '2 sidebars') {
	include(TEMPLATEPATH . '/sidebar-wide.php');
} ?>

<?php if ($pp_sidebar_option != '1 sidebar') {
	include(TEMPLATEPATH . '/sidebar-one.php');
	include(TEMPLATEPATH . '/sidebar-two.php');
} ?>

</div><!--#pp-sidebars-->

</div><!--#secondary-->

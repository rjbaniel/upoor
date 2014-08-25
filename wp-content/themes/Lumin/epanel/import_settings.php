<?php
add_action( 'admin_enqueue_scripts', 'import_epanel_javascript' );
function import_epanel_javascript( $hook_suffix ) {
	if ( 'admin.php' == $hook_suffix && isset( $_GET['import'] ) && isset( $_GET['step'] ) && 'wordpress' == $_GET['import'] && '1' == $_GET['step'] )
		add_action( 'admin_head', 'admin_headhook' );
}

function admin_headhook(){ ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$("p.submit").before("<p><input type='checkbox' id='importepanel' name='importepanel' value='1' style='margin-right: 5px;'><label for='importepanel'>Replace ePanel settings with sample data values</label></p>");
		});
	</script>
<?php }

add_action('import_end','importend');
function importend(){
	global $wpdb, $shortname;

	#make custom fields image paths point to sampledata/sample_images folder
	$sample_images_postmeta = $wpdb->get_results(
		$wpdb->prepare( "SELECT meta_id, meta_value FROM $wpdb->postmeta WHERE meta_value REGEXP %s", 'http://et_sample_images.com' )
	);
	if ( $sample_images_postmeta ) {
		foreach ( $sample_images_postmeta as $postmeta ){
			$template_dir = get_template_directory_uri();
			if ( is_multisite() ){
				switch_to_blog(1);
				$main_siteurl = site_url();
				restore_current_blog();

				$template_dir = $main_siteurl . '/wp-content/themes/' . get_template();
			}
			preg_match( '/http:\/\/et_sample_images.com\/([^.]+).jpg/', $postmeta->meta_value, $matches );
			$image_path = $matches[1];

			$local_image = preg_replace( '/http:\/\/et_sample_images.com\/([^.]+).jpg/', $template_dir . '/sampledata/sample_images/$1.jpg', $postmeta->meta_value );

			$local_image = preg_replace( '/s:55:/', 's:' . strlen( $template_dir . '/sampledata/sample_images/' . $image_path . '.jpg' ) . ':', $local_image );

			$wpdb->update( $wpdb->postmeta, array( 'meta_value' => esc_url_raw( $local_image ) ), array( 'meta_id' => $postmeta->meta_id ), array( '%s' ) );
		}
	}

	if ( !isset($_POST['importepanel']) )
		return;

	$importOptions = 'YToxMDU6e3M6MDoiIjtOO3M6MTA6Imx1bWluX2xvZ28iO3M6MDoiIjtzOjEzOiJsdW1pbl9mYXZpY29uIjtzOjA6IiI7czoxODoibHVtaW5fY29sb3Jfc2NoZW1lIjtzOjQ6IkJsdWUiO3M6MTY6Imx1bWluX2Jsb2dfc3R5bGUiO047czoxNjoibHVtaW5fZ3JhYl9pbWFnZSI7TjtzOjEzOiJsdW1pbl90YWdsaW5lIjtzOjMwOiJVbHRyaWNlcyBldCA8c3Bhbj5pcHN1bTwvc3Bhbj4iO3M6MTQ6Imx1bWluX2Jsb2dfY2F0IjtzOjQ6IkJsb2ciO3M6MTg6Imx1bWluX3Byb2plY3RzX2NhdCI7czo5OiJQb3J0Zm9saW8iO3M6MTg6Imx1bWluX2NhdG51bV9wb3N0cyI7czoxOiI2IjtzOjIwOiJsdW1pbl9nYWxsZXJ5X2NhdG51bSI7czoyOiIxMiI7czoyMjoibHVtaW5fYXJjaGl2ZW51bV9wb3N0cyI7czoxOiI1IjtzOjIxOiJsdW1pbl9zZWFyY2hudW1fcG9zdHMiO3M6MToiNSI7czoxODoibHVtaW5fdGFnbnVtX3Bvc3RzIjtzOjE6IjUiO3M6MTc6Imx1bWluX2RhdGVfZm9ybWF0IjtzOjY6Ik0gaiwgWSI7czoxNzoibHVtaW5fdXNlX2V4Y2VycHQiO047czoxNDoibHVtaW5faG9tZWRlc2MiO3M6MTMwOiI8c3Bhbj5cIkN1cmFiaXR1ciBsZWN0dXMgZmVsaXMsIGRhcGlidXMgbm9uLCBjb25ndWUgZXQgdWx0cmljZXMgZXQgaXBzdW08L3NwYW4+CnVsdHJpY2VzIGV0IGlwc3VtIEludGVnZXIgbGlndWxhIHNlZCBkb2xvciBwdXJ1c1wiIjtzOjE3OiJsdW1pbl9ob21lX3BhZ2VfMSI7czo5OiJXaGF0IEkgRG8iO3M6MTc6Imx1bWluX2hvbWVfcGFnZV8yIjtzOjg6IldobyBJIEFtIjtzOjIzOiJsdW1pbl9wb3N0aW5mb19mcm9tYmxvZyI7YToyOntpOjA7czo2OiJhdXRob3IiO2k6MTtzOjg6ImNvbW1lbnRzIjt9czoyMToibHVtaW5fZnJvbWJsb2dfcmVjZW50IjtzOjE6IjMiO3M6MjI6Imx1bWluX2Zyb21ibG9nX3BvcHVsYXIiO3M6MToiMyI7czoyMToibHVtaW5fZnJvbWJsb2dfcmFuZG9tIjtzOjE6IjMiO3M6MjI6Imx1bWluX2hvbWVfcHJvamVjdHNudW0iO3M6MjoiMTIiO3M6MjA6Imx1bWluX2hvbWVwYWdlX3Bvc3RzIjtzOjE6IjciO3M6MjA6Imx1bWluX2V4bGNhdHNfcmVjZW50IjtOO3M6MTQ6Imx1bWluX2ZlYXR1cmVkIjtzOjI6Im9uIjtzOjE1OiJsdW1pbl9kdXBsaWNhdGUiO047czoxNDoibHVtaW5fZmVhdF9jYXQiO3M6ODoiRmVhdHVyZWQiO3M6MTk6Imx1bWluX3NsaWRlcl9lZmZlY3QiO3M6NDoiZmFkZSI7czoxNzoibHVtaW5fc2xpZGVyX2F1dG8iO047czoxNzoibHVtaW5fcGF1c2VfaG92ZXIiO047czoyMjoibHVtaW5fc2xpZGVyX2F1dG9zcGVlZCI7czo0OiIzMDAwIjtzOjE1OiJsdW1pbl9tZW51cGFnZXMiO2E6Mjp7aTowO3M6MzoiMjM1IjtpOjE7czozOiI2NjgiO31zOjIyOiJsdW1pbl9lbmFibGVfZHJvcGRvd25zIjtzOjI6Im9uIjtzOjE1OiJsdW1pbl9ob21lX2xpbmsiO3M6Mjoib24iO3M6MTY6Imx1bWluX3NvcnRfcGFnZXMiO3M6MTA6InBvc3RfdGl0bGUiO3M6MTY6Imx1bWluX29yZGVyX3BhZ2UiO3M6MzoiYXNjIjtzOjIzOiJsdW1pbl90aWVyc19zaG93bl9wYWdlcyI7czoxOiIzIjtzOjE0OiJsdW1pbl9tZW51Y2F0cyI7YTozOntpOjA7czoxOiI0IjtpOjE7czoxOiI1IjtpOjI7czoxOiIxIjt9czozMzoibHVtaW5fZW5hYmxlX2Ryb3Bkb3duc19jYXRlZ29yaWVzIjtzOjI6Im9uIjtzOjIyOiJsdW1pbl9jYXRlZ29yaWVzX2VtcHR5IjtzOjI6Im9uIjtzOjI4OiJsdW1pbl90aWVyc19zaG93bl9jYXRlZ29yaWVzIjtzOjE6IjMiO3M6MTQ6Imx1bWluX3NvcnRfY2F0IjtzOjQ6Im5hbWUiO3M6MTU6Imx1bWluX29yZGVyX2NhdCI7czozOiJhc2MiO3M6MTc6Imx1bWluX3N3YXBfbmF2YmFyIjtOO3M6MjE6Imx1bWluX2Rpc2FibGVfdG9wdGllciI7TjtzOjE1OiJsdW1pbl9wb3N0aW5mbzIiO2E6NDp7aTowO3M6NjoiYXV0aG9yIjtpOjE7czo0OiJkYXRlIjtpOjI7czoxMDoiY2F0ZWdvcmllcyI7aTozO3M6ODoiY29tbWVudHMiO31zOjE2OiJsdW1pbl90aHVtYm5haWxzIjtzOjI6Im9uIjtzOjIxOiJsdW1pbl90aHVtYm5haWxzX3Bvc3QiO3M6Mjoib24iO3M6MjM6Imx1bWluX3Nob3dfcG9zdGNvbW1lbnRzIjtzOjI6Im9uIjtzOjI3OiJsdW1pbl90aHVtYm5haWxfd2lkdGhfcG9zdHMiO3M6MzoiMTg1IjtzOjI4OiJsdW1pbl90aHVtYm5haWxfaGVpZ2h0X3Bvc3RzIjtzOjM6IjE4NSI7czoyMToibHVtaW5fcGFnZV90aHVtYm5haWxzIjtOO3M6MjQ6Imx1bWluX3Nob3dfcGFnZXNjb21tZW50cyI7TjtzOjI3OiJsdW1pbl90aHVtYm5haWxfd2lkdGhfcGFnZXMiO3M6MzoiMTg1IjtzOjI4OiJsdW1pbl90aHVtYm5haWxfaGVpZ2h0X3BhZ2VzIjtzOjM6IjE4NSI7czoxNToibHVtaW5fcG9zdGluZm8xIjthOjQ6e2k6MDtzOjY6ImF1dGhvciI7aToxO3M6NDoiZGF0ZSI7aToyO3M6MTA6ImNhdGVnb3JpZXMiO2k6MztzOjg6ImNvbW1lbnRzIjt9czoyNzoibHVtaW5fdGh1bWJuYWlsX3dpZHRoX3VzdWFsIjtzOjM6IjE1NSI7czoyODoibHVtaW5fdGh1bWJuYWlsX2hlaWdodF91c3VhbCI7czozOiIxNTUiO3M6MTk6Imx1bWluX2N1c3RvbV9jb2xvcnMiO047czoxNToibHVtaW5fY2hpbGRfY3NzIjtOO3M6MTg6Imx1bWluX2NoaWxkX2Nzc3VybCI7czowOiIiO3M6MTk6Imx1bWluX2NvbG9yX2JnY29sb3IiO3M6MDoiIjtzOjIwOiJsdW1pbl9jb2xvcl9tYWluZm9udCI7czowOiIiO3M6MjA6Imx1bWluX2NvbG9yX21haW5saW5rIjtzOjA6IiI7czoyMDoibHVtaW5fY29sb3JfcGFnZWxpbmsiO3M6MDoiIjtzOjI2OiJsdW1pbl9jb2xvcl9zaWRlYmFyX3RpdGxlcyI7czowOiIiO3M6MjU6Imx1bWluX2NvbG9yX3NpZGViYXJfbGlua3MiO3M6MDoiIjtzOjIxOiJsdW1pbl9mb290ZXJfaGVhZGluZ3MiO3M6MDoiIjtzOjIzOiJsdW1pbl9jb2xvcl9mb290ZXJsaW5rcyI7czowOiIiO3M6MTk6Imx1bWluX2NvbG9yX2hlYWRpbmciO3M6MDoiIjtzOjIwOiJsdW1pbl9zZW9faG9tZV90aXRsZSI7TjtzOjI2OiJsdW1pbl9zZW9faG9tZV9kZXNjcmlwdGlvbiI7TjtzOjIzOiJsdW1pbl9zZW9faG9tZV9rZXl3b3JkcyI7TjtzOjI0OiJsdW1pbl9zZW9faG9tZV9jYW5vbmljYWwiO047czoyNDoibHVtaW5fc2VvX2hvbWVfdGl0bGV0ZXh0IjtzOjA6IiI7czozMDoibHVtaW5fc2VvX2hvbWVfZGVzY3JpcHRpb250ZXh0IjtzOjA6IiI7czoyNzoibHVtaW5fc2VvX2hvbWVfa2V5d29yZHN0ZXh0IjtzOjA6IiI7czoxOToibHVtaW5fc2VvX2hvbWVfdHlwZSI7czoyNzoiQmxvZ05hbWUgfCBCbG9nIGRlc2NyaXB0aW9uIjtzOjIzOiJsdW1pbl9zZW9faG9tZV9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MjI6Imx1bWluX3Nlb19zaW5nbGVfdGl0bGUiO047czoyODoibHVtaW5fc2VvX3NpbmdsZV9kZXNjcmlwdGlvbiI7TjtzOjI1OiJsdW1pbl9zZW9fc2luZ2xlX2tleXdvcmRzIjtOO3M6MjY6Imx1bWluX3Nlb19zaW5nbGVfY2Fub25pY2FsIjtOO3M6Mjg6Imx1bWluX3Nlb19zaW5nbGVfZmllbGRfdGl0bGUiO3M6OToic2VvX3RpdGxlIjtzOjM0OiJsdW1pbl9zZW9fc2luZ2xlX2ZpZWxkX2Rlc2NyaXB0aW9uIjtzOjE1OiJzZW9fZGVzY3JpcHRpb24iO3M6MzE6Imx1bWluX3Nlb19zaW5nbGVfZmllbGRfa2V5d29yZHMiO3M6MTI6InNlb19rZXl3b3JkcyI7czoyMToibHVtaW5fc2VvX3NpbmdsZV90eXBlIjtzOjIxOiJQb3N0IHRpdGxlIHwgQmxvZ05hbWUiO3M6MjU6Imx1bWluX3Nlb19zaW5nbGVfc2VwYXJhdGUiO3M6MzoiIHwgIjtzOjI1OiJsdW1pbl9zZW9faW5kZXhfY2Fub25pY2FsIjtOO3M6Mjc6Imx1bWluX3Nlb19pbmRleF9kZXNjcmlwdGlvbiI7TjtzOjIwOiJsdW1pbl9zZW9faW5kZXhfdHlwZSI7czoyNDoiQ2F0ZWdvcnkgbmFtZSB8IEJsb2dOYW1lIjtzOjI0OiJsdW1pbl9zZW9faW5kZXhfc2VwYXJhdGUiO3M6MzoiIHwgIjtzOjI5OiJsdW1pbl9pbnRlZ3JhdGVfaGVhZGVyX2VuYWJsZSI7czoyOiJvbiI7czoyNzoibHVtaW5faW50ZWdyYXRlX2JvZHlfZW5hYmxlIjtzOjI6Im9uIjtzOjMyOiJsdW1pbl9pbnRlZ3JhdGVfc2luZ2xldG9wX2VuYWJsZSI7czoyOiJvbiI7czozNToibHVtaW5faW50ZWdyYXRlX3NpbmdsZWJvdHRvbV9lbmFibGUiO3M6Mjoib24iO3M6MjI6Imx1bWluX2ludGVncmF0aW9uX2hlYWQiO3M6MDoiIjtzOjIyOiJsdW1pbl9pbnRlZ3JhdGlvbl9ib2R5IjtzOjA6IiI7czoyODoibHVtaW5faW50ZWdyYXRpb25fc2luZ2xlX3RvcCI7czowOiIiO3M6MzE6Imx1bWluX2ludGVncmF0aW9uX3NpbmdsZV9ib3R0b20iO3M6MDoiIjtzOjE2OiJsdW1pbl80NjhfZW5hYmxlIjtOO3M6MTU6Imx1bWluXzQ2OF9pbWFnZSI7czowOiIiO3M6MTM6Imx1bWluXzQ2OF91cmwiO3M6MDoiIjt9';

	/*global $options;

	foreach ($options as $value) {
		if( isset( $value['id'] ) ) {
			update_option( $value['id'], $value['std'] );
		}
	}*/

	$importedOptions = unserialize(base64_decode($importOptions));

	foreach ($importedOptions as $key=>$value) {
		if ($value != '') update_option( $key, $value );
	}
} ?>
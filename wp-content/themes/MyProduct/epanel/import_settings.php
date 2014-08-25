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

	$importOptions = 'YToxMDE6e3M6MDoiIjtOO3M6MTQ6Im15cHJvZHVjdF9sb2dvIjtzOjA6IiI7czoxNzoibXlwcm9kdWN0X2Zhdmljb24iO3M6MDoiIjtzOjIyOiJteXByb2R1Y3RfY29sb3Jfc2NoZW1lIjtzOjQ6IkJsdWUiO3M6MjA6Im15cHJvZHVjdF9ibG9nX3N0eWxlIjtOO3M6MjA6Im15cHJvZHVjdF9ncmFiX2ltYWdlIjtOO3M6MjI6Im15cHJvZHVjdF9jYXRudW1fcG9zdHMiO3M6MToiNiI7czoyNjoibXlwcm9kdWN0X2FyY2hpdmVudW1fcG9zdHMiO3M6MToiNSI7czoyNToibXlwcm9kdWN0X3NlYXJjaG51bV9wb3N0cyI7czoxOiI1IjtzOjIyOiJteXByb2R1Y3RfdGFnbnVtX3Bvc3RzIjtzOjE6IjUiO3M6MjE6Im15cHJvZHVjdF9kYXRlX2Zvcm1hdCI7czo2OiJNIGosIFkiO3M6MjE6Im15cHJvZHVjdF91c2VfZXhjZXJwdCI7TjtzOjE4OiJteXByb2R1Y3RfYmxvZ19jYXQiO3M6NDoiQmxvZyI7czoxODoibXlwcm9kdWN0X3NlcnZpY2VzIjtzOjI6Im9uIjtzOjI2OiJteXByb2R1Y3RfaG9tZXBhZ2Vfd2lkZ2V0cyI7TjtzOjIyOiJteXByb2R1Y3Rfd2VsY29tZV9wYWdlIjtzOjk6IldoYXQgSSBEbyI7czoxOToibXlwcm9kdWN0X3NlcnZpY2VfMSI7czo5OiJXaGF0IEkgRG8iO3M6MTk6Im15cHJvZHVjdF9zZXJ2aWNlXzIiO3M6ODoiV2hvIEkgQW0iO3M6MTk6Im15cHJvZHVjdF9zZXJ2aWNlXzMiO3M6OToiV2hhdCBJIERvIjtzOjE5OiJteXByb2R1Y3Rfc2VydmljZV80IjtzOjg6IldobyBJIEFtIjtzOjI0OiJteXByb2R1Y3RfZXhsY2F0c19yZWNlbnQiO047czoxODoibXlwcm9kdWN0X2ZlYXR1cmVkIjtzOjI6Im9uIjtzOjE5OiJteXByb2R1Y3RfZHVwbGljYXRlIjtzOjI6Im9uIjtzOjE4OiJteXByb2R1Y3RfZmVhdF9jYXQiO3M6ODoiRmVhdHVyZWQiO3M6MjI6Im15cHJvZHVjdF9mZWF0dXJlZF9udW0iO3M6MToiMyI7czoxOToibXlwcm9kdWN0X3VzZV9wYWdlcyI7TjtzOjIwOiJteXByb2R1Y3RfZmVhdF9wYWdlcyI7TjtzOjMxOiJteXByb2R1Y3RfcHJvZHVjdF9pbWFnZXNfbnVtYmVyIjtzOjE6IjMiO3M6MjU6Im15cHJvZHVjdF9wcm9kdWN0X2ltYWdlXzEiO3M6ODc6Imh0dHA6Ly93d3cuZWxlZ2FudHRoZW1lcy5jb20vcHJldmlldy9NeVByb2R1Y3Qvd3AtY29udGVudC91cGxvYWRzLzIwMTAvMDIvcHJvZHVjdC0xLmpwZyI7czoyNToibXlwcm9kdWN0X3Byb2R1Y3RfaW1hZ2VfMiI7czo4NzoiaHR0cDovL3d3dy5lbGVnYW50dGhlbWVzLmNvbS9wcmV2aWV3L015UHJvZHVjdC93cC1jb250ZW50L3VwbG9hZHMvMjAxMC8wMi9wcm9kdWN0LTIuanBnIjtzOjI1OiJteXByb2R1Y3RfcHJvZHVjdF9pbWFnZV8zIjtzOjg3OiJodHRwOi8vd3d3LmVsZWdhbnR0aGVtZXMuY29tL3ByZXZpZXcvTXlQcm9kdWN0L3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDEwLzAyL3Byb2R1Y3QtMy5qcGciO3M6MjU6Im15cHJvZHVjdF9wcm9kdWN0X2ltYWdlXzQiO3M6MDoiIjtzOjI1OiJteXByb2R1Y3RfcHJvZHVjdF9pbWFnZV81IjtzOjA6IiI7czoyNToibXlwcm9kdWN0X3Byb2R1Y3RfaW1hZ2VfNiI7czowOiIiO3M6MjU6Im15cHJvZHVjdF9wcm9kdWN0X2ltYWdlXzciO3M6MDoiIjtzOjI1OiJteXByb2R1Y3RfcHJvZHVjdF9pbWFnZV84IjtzOjA6IiI7czoxOToibXlwcm9kdWN0X21lbnVwYWdlcyI7TjtzOjI2OiJteXByb2R1Y3RfZW5hYmxlX2Ryb3Bkb3ducyI7czoyOiJvbiI7czoxOToibXlwcm9kdWN0X2hvbWVfbGluayI7czoyOiJvbiI7czoyMDoibXlwcm9kdWN0X3NvcnRfcGFnZXMiO3M6MTA6InBvc3RfdGl0bGUiO3M6MjA6Im15cHJvZHVjdF9vcmRlcl9wYWdlIjtzOjM6ImFzYyI7czoyNzoibXlwcm9kdWN0X3RpZXJzX3Nob3duX3BhZ2VzIjtzOjE6IjMiO3M6MTg6Im15cHJvZHVjdF9tZW51Y2F0cyI7TjtzOjM3OiJteXByb2R1Y3RfZW5hYmxlX2Ryb3Bkb3duc19jYXRlZ29yaWVzIjtzOjI6Im9uIjtzOjI2OiJteXByb2R1Y3RfY2F0ZWdvcmllc19lbXB0eSI7czoyOiJvbiI7czozMjoibXlwcm9kdWN0X3RpZXJzX3Nob3duX2NhdGVnb3JpZXMiO3M6MToiMyI7czoxODoibXlwcm9kdWN0X3NvcnRfY2F0IjtzOjQ6Im5hbWUiO3M6MTk6Im15cHJvZHVjdF9vcmRlcl9jYXQiO3M6MzoiYXNjIjtzOjI1OiJteXByb2R1Y3RfZGlzYWJsZV90b3B0aWVyIjtOO3M6MTk6Im15cHJvZHVjdF9wb3N0aW5mbzIiO2E6NDp7aTowO3M6NjoiYXV0aG9yIjtpOjE7czo0OiJkYXRlIjtpOjI7czoxMDoiY2F0ZWdvcmllcyI7aTozO3M6ODoiY29tbWVudHMiO31zOjIwOiJteXByb2R1Y3RfdGh1bWJuYWlscyI7czoyOiJvbiI7czoyNzoibXlwcm9kdWN0X3Nob3dfcG9zdGNvbW1lbnRzIjtzOjI6Im9uIjtzOjI1OiJteXByb2R1Y3RfcGFnZV90aHVtYm5haWxzIjtOO3M6Mjg6Im15cHJvZHVjdF9zaG93X3BhZ2VzY29tbWVudHMiO047czoxOToibXlwcm9kdWN0X3Bvc3RpbmZvMSI7YTo0OntpOjA7czo2OiJhdXRob3IiO2k6MTtzOjQ6ImRhdGUiO2k6MjtzOjEwOiJjYXRlZ29yaWVzIjtpOjM7czo4OiJjb21tZW50cyI7fXM6MjY6Im15cHJvZHVjdF90aHVtYm5haWxzX2luZGV4IjtzOjI6Im9uIjtzOjIzOiJteXByb2R1Y3RfY3VzdG9tX2NvbG9ycyI7TjtzOjE5OiJteXByb2R1Y3RfY2hpbGRfY3NzIjtOO3M6MjI6Im15cHJvZHVjdF9jaGlsZF9jc3N1cmwiO3M6MDoiIjtzOjI0OiJteXByb2R1Y3RfY29sb3JfbWFpbmZvbnQiO3M6MDoiIjtzOjI0OiJteXByb2R1Y3RfY29sb3JfbWFpbmxpbmsiO3M6MDoiIjtzOjI0OiJteXByb2R1Y3RfY29sb3JfcGFnZWxpbmsiO3M6MDoiIjtzOjMxOiJteXByb2R1Y3RfY29sb3JfcGFnZWxpbmtfYWN0aXZlIjtzOjA6IiI7czoyNDoibXlwcm9kdWN0X2NvbG9yX2hlYWRpbmdzIjtzOjA6IiI7czoyOToibXlwcm9kdWN0X2NvbG9yX3NpZGViYXJfbGlua3MiO3M6MDoiIjtzOjIxOiJteXByb2R1Y3RfZm9vdGVyX3RleHQiO3M6MDoiIjtzOjI3OiJteXByb2R1Y3RfY29sb3JfZm9vdGVybGlua3MiO3M6MDoiIjtzOjI0OiJteXByb2R1Y3Rfc2VvX2hvbWVfdGl0bGUiO047czozMDoibXlwcm9kdWN0X3Nlb19ob21lX2Rlc2NyaXB0aW9uIjtOO3M6Mjc6Im15cHJvZHVjdF9zZW9faG9tZV9rZXl3b3JkcyI7TjtzOjI4OiJteXByb2R1Y3Rfc2VvX2hvbWVfY2Fub25pY2FsIjtOO3M6Mjg6Im15cHJvZHVjdF9zZW9faG9tZV90aXRsZXRleHQiO3M6MDoiIjtzOjM0OiJteXByb2R1Y3Rfc2VvX2hvbWVfZGVzY3JpcHRpb250ZXh0IjtzOjA6IiI7czozMToibXlwcm9kdWN0X3Nlb19ob21lX2tleXdvcmRzdGV4dCI7czowOiIiO3M6MjM6Im15cHJvZHVjdF9zZW9faG9tZV90eXBlIjtzOjI3OiJCbG9nTmFtZSB8IEJsb2cgZGVzY3JpcHRpb24iO3M6Mjc6Im15cHJvZHVjdF9zZW9faG9tZV9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MjY6Im15cHJvZHVjdF9zZW9fc2luZ2xlX3RpdGxlIjtOO3M6MzI6Im15cHJvZHVjdF9zZW9fc2luZ2xlX2Rlc2NyaXB0aW9uIjtOO3M6Mjk6Im15cHJvZHVjdF9zZW9fc2luZ2xlX2tleXdvcmRzIjtOO3M6MzA6Im15cHJvZHVjdF9zZW9fc2luZ2xlX2Nhbm9uaWNhbCI7TjtzOjMyOiJteXByb2R1Y3Rfc2VvX3NpbmdsZV9maWVsZF90aXRsZSI7czo5OiJzZW9fdGl0bGUiO3M6Mzg6Im15cHJvZHVjdF9zZW9fc2luZ2xlX2ZpZWxkX2Rlc2NyaXB0aW9uIjtzOjE1OiJzZW9fZGVzY3JpcHRpb24iO3M6MzU6Im15cHJvZHVjdF9zZW9fc2luZ2xlX2ZpZWxkX2tleXdvcmRzIjtzOjEyOiJzZW9fa2V5d29yZHMiO3M6MjU6Im15cHJvZHVjdF9zZW9fc2luZ2xlX3R5cGUiO3M6MjE6IlBvc3QgdGl0bGUgfCBCbG9nTmFtZSI7czoyOToibXlwcm9kdWN0X3Nlb19zaW5nbGVfc2VwYXJhdGUiO3M6MzoiIHwgIjtzOjI5OiJteXByb2R1Y3Rfc2VvX2luZGV4X2Nhbm9uaWNhbCI7TjtzOjMxOiJteXByb2R1Y3Rfc2VvX2luZGV4X2Rlc2NyaXB0aW9uIjtOO3M6MjQ6Im15cHJvZHVjdF9zZW9faW5kZXhfdHlwZSI7czoyNDoiQ2F0ZWdvcnkgbmFtZSB8IEJsb2dOYW1lIjtzOjI4OiJteXByb2R1Y3Rfc2VvX2luZGV4X3NlcGFyYXRlIjtzOjM6IiB8ICI7czozMzoibXlwcm9kdWN0X2ludGVncmF0ZV9oZWFkZXJfZW5hYmxlIjtzOjI6Im9uIjtzOjMxOiJteXByb2R1Y3RfaW50ZWdyYXRlX2JvZHlfZW5hYmxlIjtzOjI6Im9uIjtzOjM2OiJteXByb2R1Y3RfaW50ZWdyYXRlX3NpbmdsZXRvcF9lbmFibGUiO3M6Mjoib24iO3M6Mzk6Im15cHJvZHVjdF9pbnRlZ3JhdGVfc2luZ2xlYm90dG9tX2VuYWJsZSI7czoyOiJvbiI7czoyNjoibXlwcm9kdWN0X2ludGVncmF0aW9uX2hlYWQiO3M6MDoiIjtzOjI2OiJteXByb2R1Y3RfaW50ZWdyYXRpb25fYm9keSI7czowOiIiO3M6MzI6Im15cHJvZHVjdF9pbnRlZ3JhdGlvbl9zaW5nbGVfdG9wIjtzOjA6IiI7czozNToibXlwcm9kdWN0X2ludGVncmF0aW9uX3NpbmdsZV9ib3R0b20iO3M6MDoiIjtzOjIwOiJteXByb2R1Y3RfNDY4X2VuYWJsZSI7TjtzOjE5OiJteXByb2R1Y3RfNDY4X2ltYWdlIjtzOjA6IiI7czoxNzoibXlwcm9kdWN0XzQ2OF91cmwiO3M6MDoiIjtzOjIxOiJteXByb2R1Y3RfNDY4X2Fkc2Vuc2UiO3M6MDoiIjt9';

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
	update_option( $shortname . '_use_pages', 'false' );
} ?>
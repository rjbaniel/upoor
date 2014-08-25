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

	$importOptions = 'YToxMDA6e3M6MDoiIjtOO3M6MTU6InRpZGFsZm9yY2VfbG9nbyI7czowOiIiO3M6MTg6InRpZGFsZm9yY2VfZmF2aWNvbiI7czowOiIiO3M6MjE6InRpZGFsZm9yY2VfZ3JhYl9pbWFnZSI7TjtzOjI3OiJ0aWRhbGZvcmNlX3Nob3dfc2lkZWJhcmRhcmsiO3M6Mjoib24iO3M6MjM6InRpZGFsZm9yY2VfY2F0bnVtX3Bvc3RzIjtzOjE6IjYiO3M6Mjc6InRpZGFsZm9yY2VfYXJjaGl2ZW51bV9wb3N0cyI7czoxOiI1IjtzOjI2OiJ0aWRhbGZvcmNlX3NlYXJjaG51bV9wb3N0cyI7czoxOiI1IjtzOjIzOiJ0aWRhbGZvcmNlX3RhZ251bV9wb3N0cyI7czoxOiI1IjtzOjMwOiJ0aWRhbGZvcmNlX2ZlYXRfY2F0X2Zvb290ZXJudW0iO3M6MToiNSI7czoyMjoidGlkYWxmb3JjZV9kYXRlX2Zvcm1hdCI7czo2OiJNIGosIFkiO3M6MTU6InRpZGFsZm9yY2VfZmVlZCI7czowOiIiO3M6MjI6InRpZGFsZm9yY2VfdXNlX2V4Y2VycHQiO047czoyODoidGlkYWxmb3JjZV9zaG93X2hvbWVfdGFiYXJlYSI7czoyOiJvbiI7czozMjoidGlkYWxmb3JjZV9zaG93X3RhYmFyZWFfZmVhdHVyZWQiO3M6Mjoib24iO3M6MzE6InRpZGFsZm9yY2Vfc2hvd190YWJhcmVhX3BvcHVsYXIiO3M6Mjoib24iO3M6Mzg6InRpZGFsZm9yY2Vfc2hvd190YWJhcmVhX3JlY2VudGNvbW1lbnRzIjtzOjI6Im9uIjtzOjM3OiJ0aWRhbGZvcmNlX3Nob3dfdGFiYXJlYV9yZWNlbnRlbnRyaWVzIjtzOjI6Im9uIjtzOjM4OiJ0aWRhbGZvcmNlX3Nob3dfdGFiYXJlYV9yYW5kb21hcnRpY2xlcyI7czoyOiJvbiI7czoyNToidGlkYWxmb3JjZV9zaG93X2Fib3V0X2JveCI7czoyOiJvbiI7czoyODoidGlkYWxmb3JjZV9wb3B1bGFyX3Bvc3RzX251bSI7czoxOiI2IjtzOjI2OiJ0aWRhbGZvcmNlX3JlY2VudHBvc3RzX251bSI7czoxOiI2IjtzOjI2OiJ0aWRhbGZvcmNlX3JhbmRvbXBvc3RzX251bSI7czoxOiI2IjtzOjI5OiJ0aWRhbGZvcmNlX3JlY2VudGNvbW1lbnRzX251bSI7czoxOiI2IjtzOjIwOiJ0aWRhbGZvcmNlX2Fib3V0dGV4dCI7czoyMzoiQWJvdXQgdXMgdGV4dCBnb2VzIGhlcmUiO3M6MjU6InRpZGFsZm9yY2VfaG9tZXBhZ2VfcG9zdHMiO3M6MjoiMTAiO3M6MjU6InRpZGFsZm9yY2VfZXhsY2F0c19yZWNlbnQiO047czoyMDoidGlkYWxmb3JjZV9kdXBsaWNhdGUiO3M6Mjoib24iO3M6MTk6InRpZGFsZm9yY2VfZmVhdF9jYXQiO3M6ODoiRmVhdHVyZWQiO3M6MjA6InRpZGFsZm9yY2VfbWVudXBhZ2VzIjtOO3M6Mjc6InRpZGFsZm9yY2VfZW5hYmxlX2Ryb3Bkb3ducyI7czoyOiJvbiI7czoyMDoidGlkYWxmb3JjZV9ob21lX2xpbmsiO3M6Mjoib24iO3M6MjE6InRpZGFsZm9yY2Vfc29ydF9wYWdlcyI7czoxMDoicG9zdF90aXRsZSI7czoyMToidGlkYWxmb3JjZV9vcmRlcl9wYWdlIjtzOjM6ImFzYyI7czoyODoidGlkYWxmb3JjZV90aWVyc19zaG93bl9wYWdlcyI7czoxOiIzIjtzOjE5OiJ0aWRhbGZvcmNlX21lbnVjYXRzIjtOO3M6Mzg6InRpZGFsZm9yY2VfZW5hYmxlX2Ryb3Bkb3duc19jYXRlZ29yaWVzIjtzOjI6Im9uIjtzOjI3OiJ0aWRhbGZvcmNlX2NhdGVnb3JpZXNfZW1wdHkiO3M6Mjoib24iO3M6MzM6InRpZGFsZm9yY2VfdGllcnNfc2hvd25fY2F0ZWdvcmllcyI7czoxOiIzIjtzOjE5OiJ0aWRhbGZvcmNlX3NvcnRfY2F0IjtzOjQ6Im5hbWUiO3M6MjA6InRpZGFsZm9yY2Vfb3JkZXJfY2F0IjtzOjM6ImFzYyI7czoyMjoidGlkYWxmb3JjZV9zd2FwX25hdmJhciI7TjtzOjI2OiJ0aWRhbGZvcmNlX2Rpc2FibGVfdG9wdGllciI7TjtzOjIwOiJ0aWRhbGZvcmNlX3Bvc3RpbmZvMiI7YTo0OntpOjA7czo2OiJhdXRob3IiO2k6MTtzOjQ6ImRhdGUiO2k6MjtzOjEwOiJjYXRlZ29yaWVzIjtpOjM7czo4OiJjb21tZW50cyI7fXM6MjE6InRpZGFsZm9yY2VfdGh1bWJuYWlscyI7czoyOiJvbiI7czoyODoidGlkYWxmb3JjZV9zaG93X3Bvc3Rjb21tZW50cyI7czoyOiJvbiI7czozMjoidGlkYWxmb3JjZV90aHVtYm5haWxfd2lkdGhfcG9zdHMiO3M6MjoiODQiO3M6MzM6InRpZGFsZm9yY2VfdGh1bWJuYWlsX2hlaWdodF9wb3N0cyI7czoyOiI4NCI7czoyNjoidGlkYWxmb3JjZV9wYWdlX3RodW1ibmFpbHMiO047czoyOToidGlkYWxmb3JjZV9zaG93X3BhZ2VzY29tbWVudHMiO047czozMjoidGlkYWxmb3JjZV90aHVtYm5haWxfd2lkdGhfcGFnZXMiO3M6MjoiODQiO3M6MzM6InRpZGFsZm9yY2VfdGh1bWJuYWlsX2hlaWdodF9wYWdlcyI7czoyOiI4NCI7czoyNzoidGlkYWxmb3JjZV90aHVtYm5haWxzX2luZGV4IjtzOjI6Im9uIjtzOjIxOiJ0aWRhbGZvcmNlX3Nob3dfc2hhcmUiO3M6Mjoib24iO3M6MzI6InRpZGFsZm9yY2VfdGh1bWJuYWlsX3dpZHRoX3VzdWFsIjtzOjI6Ijg0IjtzOjMzOiJ0aWRhbGZvcmNlX3RodW1ibmFpbF9oZWlnaHRfdXN1YWwiO3M6MjoiODQiO3M6MjQ6InRpZGFsZm9yY2VfY3VzdG9tX2NvbG9ycyI7TjtzOjIwOiJ0aWRhbGZvcmNlX2NoaWxkX2NzcyI7TjtzOjIzOiJ0aWRhbGZvcmNlX2NoaWxkX2Nzc3VybCI7czowOiIiO3M6MjU6InRpZGFsZm9yY2VfY29sb3JfbWFpbmZvbnQiO3M6MDoiIjtzOjI1OiJ0aWRhbGZvcmNlX2NvbG9yX21haW5saW5rIjtzOjA6IiI7czoyNToidGlkYWxmb3JjZV9jb2xvcl9wYWdlbGluayI7czowOiIiO3M6MzI6InRpZGFsZm9yY2VfY29sb3JfcGFnZWxpbmtfYWN0aXZlIjtzOjA6IiI7czoyNToidGlkYWxmb3JjZV9jb2xvcl9oZWFkaW5ncyI7czowOiIiO3M6MzA6InRpZGFsZm9yY2VfY29sb3Jfc2lkZWJhcl9saW5rcyI7czowOiIiO3M6MjI6InRpZGFsZm9yY2VfZm9vdGVyX3RleHQiO3M6MDoiIjtzOjI4OiJ0aWRhbGZvcmNlX2NvbG9yX2Zvb3RlcmxpbmtzIjtzOjA6IiI7czoyNToidGlkYWxmb3JjZV9zZW9faG9tZV90aXRsZSI7TjtzOjMxOiJ0aWRhbGZvcmNlX3Nlb19ob21lX2Rlc2NyaXB0aW9uIjtOO3M6Mjg6InRpZGFsZm9yY2Vfc2VvX2hvbWVfa2V5d29yZHMiO047czoyOToidGlkYWxmb3JjZV9zZW9faG9tZV9jYW5vbmljYWwiO047czoyOToidGlkYWxmb3JjZV9zZW9faG9tZV90aXRsZXRleHQiO3M6MDoiIjtzOjM1OiJ0aWRhbGZvcmNlX3Nlb19ob21lX2Rlc2NyaXB0aW9udGV4dCI7czowOiIiO3M6MzI6InRpZGFsZm9yY2Vfc2VvX2hvbWVfa2V5d29yZHN0ZXh0IjtzOjA6IiI7czoyNDoidGlkYWxmb3JjZV9zZW9faG9tZV90eXBlIjtzOjI3OiJCbG9nTmFtZSB8IEJsb2cgZGVzY3JpcHRpb24iO3M6Mjg6InRpZGFsZm9yY2Vfc2VvX2hvbWVfc2VwYXJhdGUiO3M6MzoiIHwgIjtzOjI3OiJ0aWRhbGZvcmNlX3Nlb19zaW5nbGVfdGl0bGUiO047czozMzoidGlkYWxmb3JjZV9zZW9fc2luZ2xlX2Rlc2NyaXB0aW9uIjtOO3M6MzA6InRpZGFsZm9yY2Vfc2VvX3NpbmdsZV9rZXl3b3JkcyI7TjtzOjMxOiJ0aWRhbGZvcmNlX3Nlb19zaW5nbGVfY2Fub25pY2FsIjtOO3M6MzM6InRpZGFsZm9yY2Vfc2VvX3NpbmdsZV9maWVsZF90aXRsZSI7czo5OiJzZW9fdGl0bGUiO3M6Mzk6InRpZGFsZm9yY2Vfc2VvX3NpbmdsZV9maWVsZF9kZXNjcmlwdGlvbiI7czoxNToic2VvX2Rlc2NyaXB0aW9uIjtzOjM2OiJ0aWRhbGZvcmNlX3Nlb19zaW5nbGVfZmllbGRfa2V5d29yZHMiO3M6MTI6InNlb19rZXl3b3JkcyI7czoyNjoidGlkYWxmb3JjZV9zZW9fc2luZ2xlX3R5cGUiO3M6MjE6IlBvc3QgdGl0bGUgfCBCbG9nTmFtZSI7czozMDoidGlkYWxmb3JjZV9zZW9fc2luZ2xlX3NlcGFyYXRlIjtzOjM6IiB8ICI7czozMDoidGlkYWxmb3JjZV9zZW9faW5kZXhfY2Fub25pY2FsIjtOO3M6MzI6InRpZGFsZm9yY2Vfc2VvX2luZGV4X2Rlc2NyaXB0aW9uIjtOO3M6MjU6InRpZGFsZm9yY2Vfc2VvX2luZGV4X3R5cGUiO3M6MjQ6IkNhdGVnb3J5IG5hbWUgfCBCbG9nTmFtZSI7czoyOToidGlkYWxmb3JjZV9zZW9faW5kZXhfc2VwYXJhdGUiO3M6MzoiIHwgIjtzOjM0OiJ0aWRhbGZvcmNlX2ludGVncmF0ZV9oZWFkZXJfZW5hYmxlIjtzOjI6Im9uIjtzOjMyOiJ0aWRhbGZvcmNlX2ludGVncmF0ZV9ib2R5X2VuYWJsZSI7czoyOiJvbiI7czozNzoidGlkYWxmb3JjZV9pbnRlZ3JhdGVfc2luZ2xldG9wX2VuYWJsZSI7czoyOiJvbiI7czo0MDoidGlkYWxmb3JjZV9pbnRlZ3JhdGVfc2luZ2xlYm90dG9tX2VuYWJsZSI7czoyOiJvbiI7czoyNzoidGlkYWxmb3JjZV9pbnRlZ3JhdGlvbl9oZWFkIjtzOjA6IiI7czoyNzoidGlkYWxmb3JjZV9pbnRlZ3JhdGlvbl9ib2R5IjtzOjA6IiI7czozMzoidGlkYWxmb3JjZV9pbnRlZ3JhdGlvbl9zaW5nbGVfdG9wIjtzOjA6IiI7czozNjoidGlkYWxmb3JjZV9pbnRlZ3JhdGlvbl9zaW5nbGVfYm90dG9tIjtzOjA6IiI7czoyMToidGlkYWxmb3JjZV80NjhfZW5hYmxlIjtOO3M6MjA6InRpZGFsZm9yY2VfNDY4X2ltYWdlIjtzOjA6IiI7czoxODoidGlkYWxmb3JjZV80NjhfdXJsIjtzOjA6IiI7fQ==';

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
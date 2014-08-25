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

	$importOptions = 'YToxMDE6e3M6MDoiIjtOO3M6OToiY2lvbl9sb2dvIjtzOjA6IiI7czoxMjoiY2lvbl9mYXZpY29uIjtzOjA6IiI7czoxNzoiY2lvbl9jb2xvcl9zY2hlbWUiO3M6NjoiUHVycGxlIjtzOjE1OiJjaW9uX2Jsb2dfc3R5bGUiO047czoxNToiY2lvbl9ncmFiX2ltYWdlIjtOO3M6MTY6ImNpb25fZGF0ZV9mb3JtYXQiO3M6NjoiTSBqLCBZIjtzOjE3OiJjaW9uX2NhdG51bV9wb3N0cyI7czoxOiI1IjtzOjIxOiJjaW9uX2FyY2hpdmVudW1fcG9zdHMiO3M6MToiNSI7czoyMDoiY2lvbl9zZWFyY2hudW1fcG9zdHMiO3M6MToiNSI7czoxNzoiY2lvbl90YWdudW1fcG9zdHMiO3M6MToiNSI7czoxNjoiY2lvbl91c2VfZXhjZXJwdCI7TjtzOjE5OiJjaW9uX2hvbWVwYWdlX3Bvc3RzIjtzOjE6IjUiO3M6MTc6ImNpb25fcmFuZG9tX2NvdW50IjtzOjE6IjUiO3M6MTg6ImNpb25fcG9wdWxhcl9jb3VudCI7czoxOiI1IjtzOjE4OiJjaW9uX2NvbW1lbnRfY291bnQiO3M6MToiNSI7czoxNzoiY2lvbl9yZWNlbnRfY291bnQiO3M6MToiNSI7czoxMDoiY2lvbl9hYm91dCI7czozMTU6IkNvbnNlY3RldHVlciBydXRydW0gdXJuYSBpbiwgYSBtb2xlc3RpZSBhbGlxdWFtIGdyYXZpZGEsIHF1YW0gdmVzdGlidWx1bSBhYy4gQ29uc2VxdWFcJ3QgdXQgbGFjdXMgdGVtcHVzIGEgaXBzdW0sIHNvY2lpcyB1cm5hIHNlZCwgdmVsIHRlbGx1cyBtYWVjZW5hcyBuZWMsIGxvcmVtIG1hZWNlbmFcJ3MgdG9ydG9yLiBBdCBvZGlvIHBsYXRlYSBldGlhbS4gRXVpc21vZCBsaWJlcm8gcHJldGl1bSBhY2N1bXNhbiBwZWxsZW50ZXNxdWUgYWMuIFF1YW0gc2VtcGVyIGluIHZpdGFlIGRpY3R1bSBlZ2V0LCBpcHN1bSBtYWduYSBvcmNpIG9kaW8gbGVjdHVzLiI7czoxNjoiY2lvbl9hYm91dF9pbWFnZSI7czo2NToiaHR0cDovL2Zhcm01LnN0YXRpYy5mbGlja3IuY29tLzQxNTQvNTA0MDMxMjMyOV80ZTQ4MWJjMGUwX21fZC5qcGciO3M6MTk6ImNpb25fZXhsY2F0c19yZWNlbnQiO047czoxMzoiY2lvbl9mZWF0dXJlZCI7czoyOiJvbiI7czoxNDoiY2lvbl9kdXBsaWNhdGUiO047czoxMzoiY2lvbl9mZWF0X2NhdCI7czo4OiJGZWF0dXJlZCI7czoyMjoiY2lvbl9ob21lcGFnZV9mZWF0dXJlZCI7czoxOiI0IjtzOjE0OiJjaW9uX21lbnVwYWdlcyI7TjtzOjIxOiJjaW9uX2VuYWJsZV9kcm9wZG93bnMiO3M6Mjoib24iO3M6MTQ6ImNpb25faG9tZV9saW5rIjtzOjI6Im9uIjtzOjE1OiJjaW9uX29yZGVyX3BhZ2UiO3M6MzoiYXNjIjtzOjE1OiJjaW9uX3NvcnRfcGFnZXMiO3M6MTA6InBvc3RfdGl0bGUiO3M6MjI6ImNpb25fdGllcnNfc2hvd25fcGFnZXMiO3M6MToiMyI7czoxMzoiY2lvbl9tZW51Y2F0cyI7TjtzOjMyOiJjaW9uX2VuYWJsZV9kcm9wZG93bnNfY2F0ZWdvcmllcyI7czoyOiJvbiI7czoyNzoiY2lvbl90aWVyc19zaG93bl9jYXRlZ29yaWVzIjtzOjE6IjMiO3M6MTM6ImNpb25fc29ydF9jYXQiO3M6NDoibmFtZSI7czoxNDoiY2lvbl9vcmRlcl9jYXQiO3M6MzoiYXNjIjtzOjE2OiJjaW9uX3N3YXBfbmF2YmFyIjtOO3M6MjA6ImNpb25fZGlzYWJsZV90b3B0aWVyIjtOO3M6MTQ6ImNpb25fcG9zdGluZm8xIjthOjQ6e2k6MDtzOjY6ImF1dGhvciI7aToxO3M6NDoiZGF0ZSI7aToyO3M6MTA6ImNhdGVnb3JpZXMiO2k6MztzOjg6ImNvbW1lbnRzIjt9czoxNToiY2lvbl90aHVtYm5haWxzIjtzOjI6Im9uIjtzOjIyOiJjaW9uX3Nob3dfcG9zdGNvbW1lbnRzIjtzOjI6Im9uIjtzOjE1OiJjaW9uX3NoYXJlX3RoaXMiO3M6Mjoib24iO3M6MjY6ImNpb25fdGh1bWJuYWlsX3dpZHRoX3Bvc3RzIjtzOjM6IjIwMCI7czoyNzoiY2lvbl90aHVtYm5haWxfaGVpZ2h0X3Bvc3RzIjtzOjM6IjIwMCI7czoyMDoiY2lvbl9wYWdlX3RodW1ibmFpbHMiO047czoyMzoiY2lvbl9zaG93X3BhZ2VzY29tbWVudHMiO047czoyMToiY2lvbl9zaGFyZV90aGlzX3BhZ2VzIjtzOjI6Im9uIjtzOjI2OiJjaW9uX3RodW1ibmFpbF93aWR0aF9wYWdlcyI7czozOiIyMDAiO3M6Mjc6ImNpb25fdGh1bWJuYWlsX2hlaWdodF9wYWdlcyI7czozOiIyMDAiO3M6MTQ6ImNpb25fcG9zdGluZm8yIjthOjQ6e2k6MDtzOjY6ImF1dGhvciI7aToxO3M6NDoiZGF0ZSI7aToyO3M6MTA6ImNhdGVnb3JpZXMiO2k6MztzOjg6ImNvbW1lbnRzIjt9czoyMToiY2lvbl9pbmRleF90aHVtYm5haWxzIjtzOjI6Im9uIjtzOjI2OiJjaW9uX3RodW1ibmFpbF93aWR0aF9pbmRleCI7czozOiIxNTAiO3M6Mjc6ImNpb25fdGh1bWJuYWlsX2hlaWdodF9pbmRleCI7czozOiIxNTAiO3M6MTQ6ImNpb25fcG9zdGluZm8zIjthOjQ6e2k6MDtzOjY6ImF1dGhvciI7aToxO3M6NDoiZGF0ZSI7aToyO3M6MTA6ImNhdGVnb3JpZXMiO2k6MztzOjg6ImNvbW1lbnRzIjt9czoxODoiY2lvbl9jdXN0b21fY29sb3JzIjtOO3M6MTQ6ImNpb25fY2hpbGRfY3NzIjtOO3M6MTc6ImNpb25fY2hpbGRfY3NzdXJsIjtzOjA6IiI7czoxOToiY2lvbl9jb2xvcl9tYWluZm9udCI7czowOiIiO3M6MTk6ImNpb25fY29sb3JfbWFpbmxpbmsiO3M6MDoiIjtzOjE5OiJjaW9uX2NvbG9yX3BhZ2VsaW5rIjtzOjA6IiI7czoyNToiY2lvbl9jb2xvcl9wYWdlbGlua19ob3ZlciI7czowOiIiO3M6MjU6ImNpb25fY29sb3JfcmVjZW50aGVhZGluZ3MiO3M6MDoiIjtzOjI1OiJjaW9uX2NvbG9yX3NpZGViYXJfdGl0bGVzIjtzOjA6IiI7czoyNDoiY2lvbl9jb2xvcl9zaWRlYmFyX2xpbmtzIjtzOjA6IiI7czoxOToiY2lvbl9jb2xvcl9wb3N0aW5mbyI7czowOiIiO3M6MTk6ImNpb25fY29sb3JfcmVhZG1vcmUiO3M6MDoiIjtzOjE5OiJjaW9uX3Nlb19ob21lX3RpdGxlIjtOO3M6MjU6ImNpb25fc2VvX2hvbWVfZGVzY3JpcHRpb24iO047czoyMjoiY2lvbl9zZW9faG9tZV9rZXl3b3JkcyI7TjtzOjIzOiJjaW9uX3Nlb19ob21lX2Nhbm9uaWNhbCI7TjtzOjIzOiJjaW9uX3Nlb19ob21lX3RpdGxldGV4dCI7czowOiIiO3M6Mjk6ImNpb25fc2VvX2hvbWVfZGVzY3JpcHRpb250ZXh0IjtzOjA6IiI7czoyNjoiY2lvbl9zZW9faG9tZV9rZXl3b3Jkc3RleHQiO3M6MDoiIjtzOjE4OiJjaW9uX3Nlb19ob21lX3R5cGUiO3M6Mjc6IkJsb2dOYW1lIHwgQmxvZyBkZXNjcmlwdGlvbiI7czoyMjoiY2lvbl9zZW9faG9tZV9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MjE6ImNpb25fc2VvX3NpbmdsZV90aXRsZSI7TjtzOjI3OiJjaW9uX3Nlb19zaW5nbGVfZGVzY3JpcHRpb24iO047czoyNDoiY2lvbl9zZW9fc2luZ2xlX2tleXdvcmRzIjtOO3M6MjU6ImNpb25fc2VvX3NpbmdsZV9jYW5vbmljYWwiO047czoyNzoiY2lvbl9zZW9fc2luZ2xlX2ZpZWxkX3RpdGxlIjtzOjk6InNlb190aXRsZSI7czozMzoiY2lvbl9zZW9fc2luZ2xlX2ZpZWxkX2Rlc2NyaXB0aW9uIjtzOjE1OiJzZW9fZGVzY3JpcHRpb24iO3M6MzA6ImNpb25fc2VvX3NpbmdsZV9maWVsZF9rZXl3b3JkcyI7czoxMjoic2VvX2tleXdvcmRzIjtzOjIwOiJjaW9uX3Nlb19zaW5nbGVfdHlwZSI7czoyMToiUG9zdCB0aXRsZSB8IEJsb2dOYW1lIjtzOjI0OiJjaW9uX3Nlb19zaW5nbGVfc2VwYXJhdGUiO3M6MzoiIHwgIjtzOjI0OiJjaW9uX3Nlb19pbmRleF9jYW5vbmljYWwiO047czoyNjoiY2lvbl9zZW9faW5kZXhfZGVzY3JpcHRpb24iO047czoxOToiY2lvbl9zZW9faW5kZXhfdHlwZSI7czoyNDoiQ2F0ZWdvcnkgbmFtZSB8IEJsb2dOYW1lIjtzOjIzOiJjaW9uX3Nlb19pbmRleF9zZXBhcmF0ZSI7czozOiIgfCAiO3M6Mjg6ImNpb25faW50ZWdyYXRlX2hlYWRlcl9lbmFibGUiO3M6Mjoib24iO3M6MjY6ImNpb25faW50ZWdyYXRlX2JvZHlfZW5hYmxlIjtzOjI6Im9uIjtzOjMxOiJjaW9uX2ludGVncmF0ZV9zaW5nbGV0b3BfZW5hYmxlIjtzOjI6Im9uIjtzOjM0OiJjaW9uX2ludGVncmF0ZV9zaW5nbGVib3R0b21fZW5hYmxlIjtzOjI6Im9uIjtzOjIxOiJjaW9uX2ludGVncmF0aW9uX2hlYWQiO3M6MDoiIjtzOjIxOiJjaW9uX2ludGVncmF0aW9uX2JvZHkiO3M6MDoiIjtzOjI3OiJjaW9uX2ludGVncmF0aW9uX3NpbmdsZV90b3AiO3M6MDoiIjtzOjMwOiJjaW9uX2ludGVncmF0aW9uX3NpbmdsZV9ib3R0b20iO3M6MDoiIjtzOjE4OiJjaW9uX2xlYWRlcl9lbmFibGUiO047czoxNToiY2lvbl80NjhfZW5hYmxlIjtOO3M6MTc6ImNpb25fbGVhZGVyX2ltYWdlIjtzOjA6IiI7czoxNToiY2lvbl9sZWFkZXJfdXJsIjtzOjA6IiI7czoxNDoiY2lvbl80NjhfaW1hZ2UiO3M6MDoiIjtzOjEyOiJjaW9uXzQ2OF91cmwiO3M6MDoiIjt9';

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
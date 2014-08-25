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

	$importOptions = 'YTo5Njp7czowOiIiO047czoxNToic3R1ZGlvYmx1ZV9sb2dvIjtzOjA6IiI7czoxODoic3R1ZGlvYmx1ZV9mYXZpY29uIjtzOjA6IiI7czoyMzoic3R1ZGlvYmx1ZV9jb2xvcl9zY2hlbWUiO3M6NDoiQmx1ZSI7czoyMToic3R1ZGlvYmx1ZV9ibG9nX3N0eWxlIjtOO3M6MjE6InN0dWRpb2JsdWVfZ3JhYl9pbWFnZSI7TjtzOjIzOiJzdHVkaW9ibHVlX2NhdG51bV9wb3N0cyI7czoxOiI2IjtzOjI3OiJzdHVkaW9ibHVlX2FyY2hpdmVudW1fcG9zdHMiO3M6MToiNSI7czoyNjoic3R1ZGlvYmx1ZV9zZWFyY2hudW1fcG9zdHMiO3M6MToiNSI7czoyMzoic3R1ZGlvYmx1ZV90YWdudW1fcG9zdHMiO3M6MToiNSI7czoyMjoic3R1ZGlvYmx1ZV9kYXRlX2Zvcm1hdCI7czo2OiJNIGosIFkiO3M6MjI6InN0dWRpb2JsdWVfdXNlX2V4Y2VycHQiO047czoyNDoic3R1ZGlvYmx1ZV9zaG93X2NhdGJveGVzIjtzOjI6Im9uIjtzOjIzOiJzdHVkaW9ibHVlX3Nob3dfcG9wdWxhciI7czoyOiJvbiI7czoyMjoic3R1ZGlvYmx1ZV9zaG93X3JhbmRvbSI7czoyOiJvbiI7czoyMzoic3R1ZGlvYmx1ZV9ob21lX2NhdF9vbmUiO3M6OToiUG9ydGZvbGlvIjtzOjIzOiJzdHVkaW9ibHVlX2hvbWVfY2F0X3R3byI7czo0OiJCbG9nIjtzOjI0OiJzdHVkaW9ibHVlX3Bvc3RzX2NhdGJveDEiO3M6MToiNiI7czoyNDoic3R1ZGlvYmx1ZV9wb3N0c19jYXRib3gyIjtzOjE6IjYiO3M6MjI6InN0dWRpb2JsdWVfcG9wdWxhcl9udW0iO3M6MToiNiI7czoyMToic3R1ZGlvYmx1ZV9yYW5kb21fbnVtIjtzOjE6IjYiO3M6MjU6InN0dWRpb2JsdWVfaG9tZXBhZ2VfcG9zdHMiO3M6MToiNiI7czoyNToic3R1ZGlvYmx1ZV9leGxjYXRzX3JlY2VudCI7TjtzOjMxOiJzdHVkaW9ibHVlX3Bvc3RpbmZvX2hvbWVkZWZhdWx0IjthOjM6e2k6MDtzOjY6ImF1dGhvciI7aToxO3M6NDoiZGF0ZSI7aToyO3M6ODoiY29tbWVudHMiO31zOjE5OiJzdHVkaW9ibHVlX2ZlYXR1cmVkIjtzOjI6Im9uIjtzOjIwOiJzdHVkaW9ibHVlX2R1cGxpY2F0ZSI7czoyOiJvbiI7czoxOToic3R1ZGlvYmx1ZV9mZWF0X2NhdCI7czo4OiJGZWF0dXJlZCI7czoyMzoic3R1ZGlvYmx1ZV9mZWF0dXJlZF9udW0iO3M6MToiNCI7czoyMDoic3R1ZGlvYmx1ZV9tZW51cGFnZXMiO047czoyMDoic3R1ZGlvYmx1ZV9ob21lX2xpbmsiO047czoyMToic3R1ZGlvYmx1ZV9zb3J0X3BhZ2VzIjtzOjEwOiJtZW51X29yZGVyIjtzOjIxOiJzdHVkaW9ibHVlX29yZGVyX3BhZ2UiO3M6MzoiYXNjIjtzOjE5OiJzdHVkaW9ibHVlX21lbnVjYXRzIjtOO3M6Mzg6InN0dWRpb2JsdWVfZW5hYmxlX2Ryb3Bkb3duc19jYXRlZ29yaWVzIjtzOjI6Im9uIjtzOjI3OiJzdHVkaW9ibHVlX2NhdGVnb3JpZXNfZW1wdHkiO3M6Mjoib24iO3M6MzM6InN0dWRpb2JsdWVfdGllcnNfc2hvd25fY2F0ZWdvcmllcyI7czoxOiIzIjtzOjE5OiJzdHVkaW9ibHVlX3NvcnRfY2F0IjtzOjQ6Im5hbWUiO3M6MjA6InN0dWRpb2JsdWVfb3JkZXJfY2F0IjtzOjM6ImFzYyI7czoyMDoic3R1ZGlvYmx1ZV9wb3N0aW5mbzIiO2E6NDp7aTowO3M6NjoiYXV0aG9yIjtpOjE7czo0OiJkYXRlIjtpOjI7czoxMDoiY2F0ZWdvcmllcyI7aTozO3M6ODoiY29tbWVudHMiO31zOjIxOiJzdHVkaW9ibHVlX3RodW1ibmFpbHMiO3M6Mjoib24iO3M6Mjg6InN0dWRpb2JsdWVfc2hvd19wb3N0Y29tbWVudHMiO3M6Mjoib24iO3M6MTk6InN0dWRpb2JsdWVfcG9zdHRhYnMiO047czoyNjoic3R1ZGlvYmx1ZV9wYWdlX3RodW1ibmFpbHMiO047czoyOToic3R1ZGlvYmx1ZV9zaG93X3BhZ2VzY29tbWVudHMiO047czozMjoic3R1ZGlvYmx1ZV90aHVtYm5haWxfd2lkdGhfcGFnZXMiO3M6MzoiMTg1IjtzOjMzOiJzdHVkaW9ibHVlX3RodW1ibmFpbF9oZWlnaHRfcGFnZXMiO3M6MzoiMTg1IjtzOjIwOiJzdHVkaW9ibHVlX3Bvc3RpbmZvMSI7YTo0OntpOjA7czo2OiJhdXRob3IiO2k6MTtzOjQ6ImRhdGUiO2k6MjtzOjEwOiJjYXRlZ29yaWVzIjtpOjM7czo4OiJjb21tZW50cyI7fXM6MjQ6InN0dWRpb2JsdWVfY3VzdG9tX2NvbG9ycyI7TjtzOjIwOiJzdHVkaW9ibHVlX2NoaWxkX2NzcyI7TjtzOjIzOiJzdHVkaW9ibHVlX2NoaWxkX2Nzc3VybCI7czowOiIiO3M6MjU6InN0dWRpb2JsdWVfY29sb3JfbWFpbmZvbnQiO3M6MDoiIjtzOjI1OiJzdHVkaW9ibHVlX2NvbG9yX21haW5saW5rIjtzOjA6IiI7czoyNToic3R1ZGlvYmx1ZV9jb2xvcl9wYWdlbGluayI7czowOiIiO3M6MzI6InN0dWRpb2JsdWVfY29sb3JfcGFnZWxpbmtfYWN0aXZlIjtzOjA6IiI7czoyNToic3R1ZGlvYmx1ZV9jb2xvcl9oZWFkaW5ncyI7czowOiIiO3M6MzA6InN0dWRpb2JsdWVfY29sb3Jfc2lkZWJhcl9saW5rcyI7czowOiIiO3M6MjY6InN0dWRpb2JsdWVfZm9vdGVyX2hlYWRpbmdzIjtzOjA6IiI7czoyODoic3R1ZGlvYmx1ZV9jb2xvcl9mb290ZXJsaW5rcyI7czowOiIiO3M6MjU6InN0dWRpb2JsdWVfc2VvX2hvbWVfdGl0bGUiO047czozMToic3R1ZGlvYmx1ZV9zZW9faG9tZV9kZXNjcmlwdGlvbiI7TjtzOjI4OiJzdHVkaW9ibHVlX3Nlb19ob21lX2tleXdvcmRzIjtOO3M6Mjk6InN0dWRpb2JsdWVfc2VvX2hvbWVfY2Fub25pY2FsIjtOO3M6Mjk6InN0dWRpb2JsdWVfc2VvX2hvbWVfdGl0bGV0ZXh0IjtzOjA6IiI7czozNToic3R1ZGlvYmx1ZV9zZW9faG9tZV9kZXNjcmlwdGlvbnRleHQiO3M6MDoiIjtzOjMyOiJzdHVkaW9ibHVlX3Nlb19ob21lX2tleXdvcmRzdGV4dCI7czowOiIiO3M6MjQ6InN0dWRpb2JsdWVfc2VvX2hvbWVfdHlwZSI7czoyNzoiQmxvZ05hbWUgfCBCbG9nIGRlc2NyaXB0aW9uIjtzOjI4OiJzdHVkaW9ibHVlX3Nlb19ob21lX3NlcGFyYXRlIjtzOjM6IiB8ICI7czoyNzoic3R1ZGlvYmx1ZV9zZW9fc2luZ2xlX3RpdGxlIjtOO3M6MzM6InN0dWRpb2JsdWVfc2VvX3NpbmdsZV9kZXNjcmlwdGlvbiI7TjtzOjMwOiJzdHVkaW9ibHVlX3Nlb19zaW5nbGVfa2V5d29yZHMiO047czozMToic3R1ZGlvYmx1ZV9zZW9fc2luZ2xlX2Nhbm9uaWNhbCI7TjtzOjMzOiJzdHVkaW9ibHVlX3Nlb19zaW5nbGVfZmllbGRfdGl0bGUiO3M6OToic2VvX3RpdGxlIjtzOjM5OiJzdHVkaW9ibHVlX3Nlb19zaW5nbGVfZmllbGRfZGVzY3JpcHRpb24iO3M6MTU6InNlb19kZXNjcmlwdGlvbiI7czozNjoic3R1ZGlvYmx1ZV9zZW9fc2luZ2xlX2ZpZWxkX2tleXdvcmRzIjtzOjEyOiJzZW9fa2V5d29yZHMiO3M6MjY6InN0dWRpb2JsdWVfc2VvX3NpbmdsZV90eXBlIjtzOjIxOiJQb3N0IHRpdGxlIHwgQmxvZ05hbWUiO3M6MzA6InN0dWRpb2JsdWVfc2VvX3NpbmdsZV9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MzA6InN0dWRpb2JsdWVfc2VvX2luZGV4X2Nhbm9uaWNhbCI7TjtzOjMyOiJzdHVkaW9ibHVlX3Nlb19pbmRleF9kZXNjcmlwdGlvbiI7TjtzOjI1OiJzdHVkaW9ibHVlX3Nlb19pbmRleF90eXBlIjtzOjI0OiJDYXRlZ29yeSBuYW1lIHwgQmxvZ05hbWUiO3M6Mjk6InN0dWRpb2JsdWVfc2VvX2luZGV4X3NlcGFyYXRlIjtzOjM6IiB8ICI7czozNDoic3R1ZGlvYmx1ZV9pbnRlZ3JhdGVfaGVhZGVyX2VuYWJsZSI7czoyOiJvbiI7czozMjoic3R1ZGlvYmx1ZV9pbnRlZ3JhdGVfYm9keV9lbmFibGUiO3M6Mjoib24iO3M6Mzc6InN0dWRpb2JsdWVfaW50ZWdyYXRlX3NpbmdsZXRvcF9lbmFibGUiO3M6Mjoib24iO3M6NDA6InN0dWRpb2JsdWVfaW50ZWdyYXRlX3NpbmdsZWJvdHRvbV9lbmFibGUiO3M6Mjoib24iO3M6Mjc6InN0dWRpb2JsdWVfaW50ZWdyYXRpb25faGVhZCI7czowOiIiO3M6Mjc6InN0dWRpb2JsdWVfaW50ZWdyYXRpb25fYm9keSI7czowOiIiO3M6MzM6InN0dWRpb2JsdWVfaW50ZWdyYXRpb25fc2luZ2xlX3RvcCI7czowOiIiO3M6MzY6InN0dWRpb2JsdWVfaW50ZWdyYXRpb25fc2luZ2xlX2JvdHRvbSI7czowOiIiO3M6MjE6InN0dWRpb2JsdWVfNDY4X2VuYWJsZSI7TjtzOjIxOiJzdHVkaW9ibHVlXzcyOF9lbmFibGUiO047czoyMDoic3R1ZGlvYmx1ZV80NjhfaW1hZ2UiO3M6MDoiIjtzOjE4OiJzdHVkaW9ibHVlXzQ2OF91cmwiO3M6MDoiIjtzOjIyOiJzdHVkaW9ibHVlXzQ2OF9hZHNlbnNlIjtzOjA6IiI7czoyMDoic3R1ZGlvYmx1ZV83MjhfaW1hZ2UiO3M6MDoiIjtzOjE4OiJzdHVkaW9ibHVlXzcyOF91cmwiO3M6MDoiIjtzOjIyOiJzdHVkaW9ibHVlXzcyOF9hZHNlbnNlIjtzOjA6IiI7fQ==';

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
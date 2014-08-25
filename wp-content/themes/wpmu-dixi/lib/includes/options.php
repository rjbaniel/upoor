<?php
global $options, $options1,$bp_existed, $bp_front_is_activity, $multi_site_on;

foreach ($options as $value) {
if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); } }

foreach ($options1 as $value) {
if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); } }


?>
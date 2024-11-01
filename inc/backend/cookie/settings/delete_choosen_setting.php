<?php defined('ABSPATH') or die('No scripts for you!!');
global $wpdb;
$table = $wpdb->prefix . "tgdprc_settings";
$id = intval($_GET['id']);

$status = $wpdb->query( 
	$wpdb->prepare( 
		"DELETE FROM $table WHERE id = %d",
	        $id 
        )
);

$selected_cookie = get_option('tgdprc_selected_cookie_option');

if ($selected_cookie['cookie-bar'] == $id) {
	$selected_cookie['status'] = null;
	update_option('tgdprc_selected_cookie_option',$selected_cookie);
}

if ($status) {
	wp_redirect(admin_url('admin.php') . "?page=tgdprcl-manage-cookie-settings&message=1&delete_message=1");
	die();
}
else{
	wp_redirect(admin_url('admin.php') . "?page=tgdprcl-manage-cookie-settings&message=1&delete_message=0");
	die();
}
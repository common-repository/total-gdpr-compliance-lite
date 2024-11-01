<?php defined('ABSPATH') or die('No scripts for you!!');
global $wpdb;
$table = $wpdb->prefix . "tgdprc_settings";
$id = intval($_GET['id']);
$copied_cookie_info = $wpdb->get_row("SELECT * FROM $table WHERE id=$id");

$paste_name = esc_attr($copied_cookie_info->name) . " Copy";
echo $paste_name;
$general_settings = maybe_unserialize($copied_cookie_info->general_settings);
$display_settings = maybe_unserialize($copied_cookie_info->display_settings);
$extra_settings = maybe_unserialize($copied_cookie_info->extra_settings);

$status = $wpdb->insert(
	$table,
	array(
		'name' => $paste_name,
		'general_settings'=>maybe_serialize($general_settings),
		'display_settings'=>maybe_serialize($display_settings),
		'extra_settings'=>maybe_serialize($extra_settings)
	),
	array(
		'%s',
		'%s',
		'%s',
		'%s'
	)
);

$copied_id = $wpdb->insert_id;

if ($status) {
	wp_redirect(admin_url('admin.php') . "?page=tgdprcl-manage-cookie-settings&message=1&action=edit&id=$copied_id");
	die();
}
else{
	wp_redirect(admin_url('admin.php') . "?page=tgdprcl-manage-cookie-settings&message=1&copyFailed=1");
	die();
}
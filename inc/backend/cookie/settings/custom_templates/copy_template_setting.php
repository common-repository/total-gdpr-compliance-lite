<?php

defined('ABSPATH') or die('No scripts for you!!');
global $wpdb;
$table = $wpdb->prefix . "tgdprc_custom_template";
$id = intval($_GET['id']);
$copied_custom_template = $wpdb->get_row("SELECT * FROM $table WHERE id=$id");

$paste_name = esc_attr($copied_custom_template->template_name) . " Copy";
echo $paste_name;
$template_details = maybe_unserialize($copied_custom_template->template_details);

$status = $wpdb->insert(
        $table, array(
    'template_name' => $paste_name,
    'template_details' => maybe_serialize($template_details),
    'public_id' => str_pad(dechex(mt_rand(0, pow(16, 5))), 2, '0', STR_PAD_LEFT),
        ), array(
    '%s',
    '%s',
    '%s',
        )
);

$copied_id = $wpdb->insert_id;

if ($status) {
    wp_redirect(admin_url('admin.php') . "?page=tgdprcl-cookie-custom-template&message=1&copyFailed=0&action=edit&id=$copied_id");
    die();
} else {
    wp_redirect(admin_url('admin.php') . "?page=tgdprcl-cookie-custom-template&message=1&copyFailed=1");
    die();
}
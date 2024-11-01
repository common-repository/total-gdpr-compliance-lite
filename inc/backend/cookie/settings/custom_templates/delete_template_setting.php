<?php

defined('ABSPATH') or die('No scripts for you!!');
global $wpdb;
$table = $wpdb->prefix . "tgdprc_custom_template";
$id = intval($_GET['id']);

$status = $wpdb->query(
        $wpdb->prepare(
                "DELETE FROM $table WHERE id = %d", $id
        )
);

if ($status) {
    wp_redirect(admin_url('admin.php') . "?page=tgdprcl-cookie-custom-template&message=1&delete_message=1");
    die();
} else {
    wp_redirect(admin_url('admin.php') . "?page=tgdprcl-cookie-custom-template&message=1&delete_message=0");
    die();
}
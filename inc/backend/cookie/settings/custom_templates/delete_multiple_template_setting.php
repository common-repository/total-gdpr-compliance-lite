<?php

defined('ABSPATH') or die('No scripts for you');
global $wpdb;
$table = $wpdb->prefix . "tgdprc_custom_template";
$overall_status = 0;
foreach ($_POST['selected_elements'] as $index => $id) {
    $id = intval($id);
    $status = $wpdb->query(
            $wpdb->prepare(
                    "DELETE FROM $table WHERE id = %d", $id
            )
    );
    if ($status) {
        $overall_status++;
    }
}

if ($overall_status > 0) {
    echo esc_attr_e("$overall_status rows affected", TGDPRCL_DOMAIN);
} else {
    echo esc_attr_e("Fatal Error", TGDPRCL_DOMAIN);
}
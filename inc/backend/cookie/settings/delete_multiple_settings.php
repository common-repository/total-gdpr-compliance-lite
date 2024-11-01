<?php

defined('ABSPATH') or die('No scripts for you');
global $wpdb;
$table = $wpdb->prefix . "tgdprc_settings";
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

    $selected_cookie = get_option('tgdprc_selected_cookie_option');
    if ($selected_cookie['cookie-bar'] == $id) {
        $selected_cookie['status'] = null;
        update_option('tgdprc_selected_cookie_option', $selected_cookie);
    }
}

if ($overall_status > 0) {
    echo esc_attr_e("$overall_status rows affected", TGDPRCL_DOMAIN);
} else {
    echo esc_attr_e("Fatal Error", TGDPRCL_DOMAIN);
}
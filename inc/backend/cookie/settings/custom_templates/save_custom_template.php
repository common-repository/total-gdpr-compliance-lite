<?php

defined('ABSPATH') or die('No scripts for you!!');
$data = array();
foreach ($_POST['custom_template'] as $index => $value) {
    $data[$index] = sanitize_text_field($value);
}
global $wpdb;
$table_name = $wpdb->prefix . 'tgdprc_custom_template';
if (isset($_POST['id'])) {
    $edit_id = intval($_POST['id']);
    $status = $wpdb->replace(
            $table_name, array(
        'id' => $edit_id,
        'template_name' => sanitize_text_field($_POST['template_name']),
        'template_details' => maybe_serialize($data),
        'public_id' => (isset($_POST['p_id']) && !empty($_POST['p_id'])) ? esc_attr($_POST['p_id']) : str_pad(dechex(mt_rand(0, pow(16, 5))), 2, '0', STR_PAD_LEFT)
            ), array(
        '%d',
        '%s',
        '%s',
        '%s'
            )
    );
    if ($status) {
        wp_redirect(admin_url('admin.php') . "?page=tgdprcl-cookie-custom-template&action=edit&id=$edit_id&message=1&template_message=edited");
        die();
    } else {
        wp_redirect(admin_url('admin.php') . '?page=tgdprcl-cookie-custom-template&action=edit&id=$edit_id&message=1&template_message=notedited');
        die();
    }
} else {
    // Add
    $status = $wpdb->replace(
            $table_name, array(
        'template_name' => sanitize_text_field($_POST['template_name']),
        'template_details' => maybe_serialize($data),
        'public_id' => str_pad(dechex(mt_rand(0, pow(16, 5))), 2, '0', STR_PAD_LEFT)
            ), array(
        '%s',
        '%s',
        '%s'
            )
    );
    if ($status) {
        $added_id = $wpdb->insert_id;
        wp_redirect(admin_url('admin.php') . "?page=tgdprcl-cookie-custom-template&message=1&template_message=added&action=edit&id=$added_id");
        die();
    } else {
        wp_redirect(admin_url('admin.php') . '?page=tgdprcl-cookie-custom-template&message=1&template_message=notadded&action=add');
        die();
    }
}
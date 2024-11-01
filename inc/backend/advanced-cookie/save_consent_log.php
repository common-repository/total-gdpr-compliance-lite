<?php

defined('ABSPATH') or die('No scripts for you!!');

global $wpdb;
$table_name = $wpdb->prefix . 'tgdprc_consent_log';

/**
 * Data pulled from the front 
 */
$tgdprc_browser_ip = $this->sanitize_array($_POST['tgdprc_browser_ip']);
$tgdprc_user_agent = sanitize_text_field($_POST['tgdprc_user_agent']);
$tgdprc_browser_header = sanitize_text_field($_POST['tgdprc_browser_header']);
$tgdprc_consent_id = sanitize_text_field($_POST['tgdprc_consent_id']);

$consent_values = $this->sanitize_array($_POST['consent_value']);
$consent_value = array_map(sanitize_text_field, $consent_values);

$consent_date = date("Y-m-d H:i:s");

$user_content_additional_detail = array(
    'tgdprc_user_agent' => $tgdprc_user_agent,
    'tgdprc_browser_header' => $tgdprc_browser_header,
    'consent_values' => $consent_value
);

$whitelist = array(
    '127.0.0.1',
    '::1'
);

if (isset($tgdprc_consent_id) && !empty($tgdprc_consent_id) && $tgdprc_consent_id != 'none') {
// Edit Current Consent Log Row
    $update = $wpdb->update(
            $table_name, array(
        'browser_ip' => $tgdprc_browser_ip,
        'consent_log_details' => maybe_serialize($user_content_additional_detail),
        'consent_last_edit_date' => $consent_date
            ), array(
        'id' => $tgdprc_consent_id
            )
    );
    if ($update) {
        $message = 'message=success&id=' . $tgdprc_consent_id;
        $this->tgdprc_block_cookie_action($tgdprc_consent_id);
        echo $message;
    } else {
        $message = 'message=failed&id=none';
        echo $message;
    }
} else {
    // Add New Consent Log Row
    $insert = $wpdb->insert(
            $table_name, array(
        'browser_ip' => $tgdprc_browser_ip,
        'consent_date' => $consent_date,
        'consent_log_details' => maybe_serialize($user_content_additional_detail),
            )
    );
    $wpdb_consent_id = $wpdb->insert_id;
    if ($insert) {
        $message = 'message=success&id=' . $wpdb_consent_id;
        $this->tgdprc_block_cookie_action($wpdb_consent_id);
        echo $message;
    } else {
        $message = 'message=failed&id=none';
        echo $message;
    }
}
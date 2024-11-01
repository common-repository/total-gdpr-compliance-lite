<?php

global $wpdb;
$userdata_setting = get_option('user-data-settings');

$tgdprc_data_access_request_data = get_option('tgdprc-data-access-request');
$tgdprc_data_access_request = $tgdprc_data_access_request_data != false ? $tgdprc_data_access_request_data : array();
$tgdprc_data_rectify_request_data = get_option('tgdprc-data-rectification-request');
$tgdprc_data_rectify_request = $tgdprc_data_rectify_request_data != false ? $tgdprc_data_rectify_request_data : array();

$mail_array_to_push = array();

if (isset($userdata_setting['data_breach']['pull_email_from_services']['data_access_request']) && $userdata_setting['data_breach']['pull_email_from_services']['data_access_request'] == 'access-data') {
    if (count($tgdprc_data_access_request) > 0) {
        foreach ($tgdprc_data_access_request as $user_email_address):
            if (!in_array($user_email_address, $mail_array_to_push)):
                array_push($mail_array_to_push, $user_email_address);
                $this->tgdprc_send_breach_mail($user_email_address);
            endif;
        endforeach;
    }
}

if (isset($userdata_setting['data_breach']['pull_email_from_services']['data_rectification_request']) && $userdata_setting['data_breach']['pull_email_from_services']['data_rectification_request'] == 'rectify-data') {
    if (count($tgdprc_data_rectify_request) > 0) {
        foreach ($tgdprc_data_rectify_request as $user_email_address):
            if (!in_array($user_email_address, $mail_array_to_push)):
                array_push($mail_array_to_push, $user_email_address);
                $this->tgdprc_send_breach_mail($user_email_address);
            endif;
        endforeach;
    }
}

if (isset($userdata_setting['data_breach']['pull_email_from_services']['wp_user_data']) && $userdata_setting['data_breach']['pull_email_from_services']['wp_user_data'] == 'wp-user-data') {

    $results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "users");
    if (!empty($results)) {
        foreach ($results as $key => $user_email_address) {
            if ($key == 'user_email'):
                if (!in_array($user_email_address, $mail_array_to_push)):
                    array_push($mail_array_to_push, $user_email_address);
                    $this->tgdprc_send_breach_mail($user_email_address);
                endif;
            endif;
        }
    }
}
if (isset($userdata_setting['data_breach']['pull_email_from_services']['woo_data']) && $userdata_setting['data_breach']['pull_email_from_services']['woo_data'] == 'woo-data') {
    $results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "usermeta WHERE meta_key = 'billing_email'");
    if (!empty($results)) {
        foreach ($results as $key => $user_email_address) {
            if ($key == 'meta_value'):
                if (!in_array($user_email_address, $mail_array_to_push)):
                    array_push($mail_array_to_push, $user_email_address);
                    $this->tgdprc_send_breach_mail($user_email_address);
                endif;
            endif;
        }
    }
}

wp_redirect(admin_url() . 'admin.php?page=tgdprcl-userdata&message_type=userdatabreach&message=1');
die();

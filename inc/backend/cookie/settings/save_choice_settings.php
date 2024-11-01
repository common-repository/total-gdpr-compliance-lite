<?php

defined('ABSPATH') or die('No scripts for you!!');

foreach ($_POST as $key => $value) {
    $$key = $value;
}

$selected_cookie = (is_numeric($selected_cookie)) ? intval($selected_cookie) : false;
$displayed_pages = sanitize_text_field($displayed_pages);

//First update the database with the displayable pages
global $wpdb;
$table = $wpdb->prefix . 'tgdprc_settings';
$database_result = $wpdb->update($table, array(
    'displayed_pages' => $displayed_pages
        ), array(
    'id' => $selected_cookie
        ), array(
    '%s'
        ), array(
    '%d'
        )
);

$wpdb->show_errors(); //Displays errors in wpdb in this place despite the source of error of wpdb
$specific_term = isset($specific_term) && !empty($specific_term) ? $specific_term : '';
if (isset($selected_cookie)) {
    if (isset($status) && $status == true) {
        $data = array(
            'status' => $status,
            'mobile_mode' => (isset($mobile_mode) && $mobile_mode == true) ? intval($mobile_mode) : 0,
            'cookie-bar' => $selected_cookie,
            'displayed_pages' => $displayed_pages,
            'specific_page' => ($displayed_pages == 'specific page') ? sanitize_text_field($specific_page) : '-1',
            'default_page' => (($displayed_pages == 'specific page') && isset($default_page)) ? maybe_serialize($default_page) : '-1',
            'specific_term' => ($displayed_pages == 'specific page') ? maybe_serialize($specific_term) : '-1',
            'eu_region_mode' => (isset($eu_region_mode) && $eu_region_mode == true) ? intval($eu_region_mode) : 0,
        );
        $option_result = update_option('tgdprc_selected_cookie_option', $data);
        if ($database_result || $option_result) {
            wp_redirect(admin_url('admin.php') . '?page=tgdprcl-cookie-settings&message=1');
            die();
        } else {
            wp_redirect(admin_url('admin.php') . '?page=tgdprcl-cookie-settings&message=2');
            die();
        }
    } else {

        //checking previous state for choice_message notices
        $previousStatus = 'disabled';
        if ($tgdprc_selected_cookie_options = get_option('tgdprc_selected_cookie_option')) {
            if ($tgdprc_selected_cookie_options['status']) {
                $previousStatus = 'enabled';
            } else {
                $previousStatus = 'disabled';
            }
        }

        $data = array(
            'status' => $status,
            'mobile_mode' => (isset($mobile_mode) && $mobile_mode == true) ? intval($mobile_mode) : 0,
            'cookie-bar' => $selected_cookie,
            'displayed_pages' => $displayed_pages,
            'specific_page' => ($displayed_pages == 'specific page') ? $specific_page : '-1',
            'specific_term' => ($displayed_pages == 'specific page') ? $specific_term : '-1'
        );
        $option_result = update_option('tgdprc_selected_cookie_option', $data);

        if ($option_result && $previousStatus == 'enabled') {
            wp_redirect(admin_url('admin.php') . '?page=tgdprcl-cookie-settings&message=1');
            die();
        } else {
            wp_redirect(admin_url('admin.php') . '?page=tgdprcl-cookie-settings&message=2');
            die();
        }
    }
}
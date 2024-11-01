<?php

defined('ABSPATH') or die('No scripts for you!!');

$previouslyEmpty = false;

$data = array();

$general_settings = $_POST['general_settings'];
$display_settings = $_POST['display_settings'];
$extra_settings = $_POST['extra_settings'];
$title = sanitize_text_field($_POST['title']);

// Sanitizing all values

foreach ($general_settings as $main_index => $first_dim) {
    foreach ($first_dim as $category_index => $second_dim) {
        foreach ($second_dim as $valued_index => $value) {
            if (($valued_index == 'general_text') || ($valued_index == 'slide_text')) {
                $allowed_html = wp_kses_allowed_html('post');
                $general_settings[$main_index][$category_index][$valued_index] = wp_kses($value, $allowed_html);
            } else {
                $general_settings[$main_index][$category_index][$valued_index] = sanitize_text_field($value);
            }
        }
    }
}

foreach ($display_settings as $main_index => $first_dim) {
    foreach ($first_dim as $valued_index => $value) {
        $display_settings[$main_index][$valued_index] = sanitize_text_field($value);
    }
}

foreach ($extra_settings as $main_index => $first_dim) {
    foreach ($first_dim as $valued_index => $value) {
        $extra_settings[$main_index][$valued_index] = sanitize_text_field($value);
    }
}

// End of Sanitization

setcookie('tgdprc_cookie_expiry', '', time() - (86400 * 365 * 3), '/'); //worst case 3 years

global $wpdb;

$wpdb->show_errors(); //Displays errors in wpdb in this place despite the source of error of wpdb

$table = $wpdb->prefix . 'tgdprc_settings';

//For Activation on initial choice
$prev = $wpdb->get_row("SELECT * FROM $table");

// if (count($prev) == 0) {
//     $previouslyEmpty = true;
// }
//Will enable created cookie as active cookie if previouslyEmpty is true
//Updating or inserting on database
$status = '';
$replaced_id = 0;

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $status = $wpdb->replace(
            $table, array(
        'id' => $id,
        'name' => $title,
        'general_settings' => maybe_serialize($general_settings),
        'display_settings' => maybe_serialize($display_settings),
        'extra_settings' => maybe_serialize($extra_settings)
            ), array(
        '%s',
        '%s',
        '%s',
        '%s'
            )
    );
    $replaced_id = $id;
} else {
    $status = $wpdb->replace(
            $table, array(
        'name' => $title,
        'general_settings' => maybe_serialize($general_settings),
        'display_settings' => maybe_serialize($display_settings),
        'extra_settings' => maybe_serialize($extra_settings)
            ), array(
        '%s',
        '%s',
        '%s',
        '%s'
            )
    );
    $replaced_id = $wpdb->insert_id;
}

if ($previouslyEmpty) {
    $option = array(
        'status' => 1,
        'mobile_mode' => 1,
        'cookie-bar' => intval($wpdb->insert_id),
        'displayed_pages' => 'show on Home page',
        'specific_page' => '-1',
        'specific_term' => '-1',
    );
    update_option('tgdprc_selected_cookie_option', $option);
}

if ($status) {
    wp_redirect(admin_url('admin.php') . "?page=tgdprcl-manage-cookie-settings&action=edit&message=1&replaced=$replaced_id");
    die();
} else {
    wp_redirect(admin_url('admin.php') . "?page=tgdprcl-manage-cookie-settings&message=0");
    die();
}
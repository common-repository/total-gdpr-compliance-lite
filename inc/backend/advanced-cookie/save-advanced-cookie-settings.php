<?php

$allowedposttags = array(
    'a' => array(
        'href' => array(),
        'title' => array()),
    'br' => array(),
    'p' => array(
        'style' => array()),
    'hr' => array(),
    'abbr' => array(
        'title' => array()),
    'b' => array(),
    'ul' => array(),
    'li' => array(),
    'ol' => array(),
    'h1' => array(
        'style' => array()),
    'h2' => array(
        'style' => array()),
    'h3' => array(
        'style' => array()),
    'h4' => array(
        'style' => array()),
    'h5' => array(
        'style' => array()),
    'h6' => array(
        'style' => array()),
    'span' => array(
        'style' => array()),
    'blockquote' => array(
        'cite' => array()),
    'cite' => array(),
    'code' => array(),
    'del' => array(
        'datetime' => array()),
    'em' => array(),
    'i' => array(),
    'q' => array(
        'cite' => array()),
    'strike' => array(),
    'strong' => array(),
    'quotes' => array(),
);

$allowediframetags = array(
    'iframe' => array(
        'quotes' => array(),
        'br' => array(),
        'src' => array(),
        'width' => array(),
        'height' => array(),
        'frameborder' => array(),
        'style' => array(),
        'allowfullscreen' => array()
    ),
    'quotes' => array(),
);

$_POST = array_map('stripslashes_deep', $_POST);

/**
 * Sanitizing each form fields for consent fields 
 */
$advance_cookie_settings_temp = array();
foreach ($_POST['advanced_cookie_settings'] as $key => $val) {
    $advance_cookie_settings_temp[$key] = array();
    if (!is_array($val)) {
        if ($key == 'header_info_text') {
            $advance_cookie_settings_temp[$key][$k] = wp_kses($val, $allowedposttags);
        } else {
            $advance_cookie_settings_temp[$key] = sanitize_text_field($val);
        }
    } else {
        foreach ($val as $k => $v) {
            if (!is_array($v)) {
                if ($k == 'basic_info_text' || $k == 'what_it_wont_store' || $k == 'what_it_store') {
                    $advance_cookie_settings_temp[$key][$k] = wp_kses($v, $allowedposttags);
                } else {
                    $advance_cookie_settings_temp[$key][$k] = sanitize_text_field($v);
                }
            } else {
                if ($k == 'basic_info_text' || $k == 'what_it_wont_store' || $k == 'what_it_store') {
                    $advance_cookie_settings_temp[$key][$k] = array_map(wp_kses($v), $allowedposttags);
                } else {
                    $advance_cookie_settings_temp[$key][$k] = array_map('sanitize_text_field', $v);
                }
            }
        }
    }
}

$plugin_advanced_cookie_setting_val = $advance_cookie_settings_temp;
//var_dump($plugin_advanced_cookie_setting_val);
//die();
update_option('tgdprc-advanced-cookie-settings', $plugin_advanced_cookie_setting_val);
wp_redirect(admin_url('admin.php?page=tgdprcl-advance-cookies&message=1'));
exit();

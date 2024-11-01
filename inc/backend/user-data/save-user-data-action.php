<?php

$allowed_html = array(
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
$userdata_setting_temp = array();
foreach ($_POST['userdata_setting'] as $key => $val) {
    $userdata_setting_temp[$key] = array();
    if (!is_array($val)) {
        $userdata_setting_temp[$key] = sanitize_text_field($val);
    } else {
        foreach ($val as $k => $v) {
            if ($k != 'pull_email_from_services') {
                if (!is_array($v)) {
                    if ($k == 'email_info_text' || 'user_email_info_text') {
                        $userdata_setting_temp[$key][$k] = wp_kses($v, $allowed_html);
                    } else {
                        $userdata_setting_temp[$key][$k] = sanitize_text_field($v);
                    }
                } else {
                    if ($k == 'email_info_text' || 'user_email_info_text') {
                        $userdata_setting_temp[$key][$k] = array_map('wp_kses', $v, $allowed_html);
                    } else {
                        $userdata_setting_temp[$key][$k] = array_map('sanitize_text_field', $v);
                    }
                }
            }else{
                $userdata_setting_temp[$key][$k]  = $v;
            }
        }
    }
}

$userdata_setting = $userdata_setting_temp;

$update_option = update_option('user-data-settings', $userdata_setting_temp);
if ($update_option) {
    wp_redirect(admin_url('admin.php?page=tgdprcl-userdata&message_type=userdata-setting&message=1'));
} else {
    wp_redirect(admin_url('admin.php?page=tgdprcl-userdata&message_type=userdata-setting&message=0'));
}
exit();

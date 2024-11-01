<?php

foreach ($_POST as $key => $val) {
    if ($key == 'plugin_consent_settings') {
        $$key = $val;
    } else {
        $$key = sanitize_text_field($val);
    }
}

/**
 * Sanitizing each form fields for consent fields 
 */
$plugin_consent_settings_temp = array();
foreach ($plugin_consent_settings as $key => $val) {
    $plugin_consent_settings_temp[$key] = array();
    if (!is_array($val)) {
        $plugin_consent_settings_temp[$key] = sanitize_text_field($val);
    } else {
        foreach ($val as $k => $v) {
            if (!is_array($v)) {
                $plugin_consent_settings_temp[$key][$k] = sanitize_text_field($v);
            } else {
                $plugin_consent_settings_temp[$key][$k] = array_map('sanitize_text_field', $v);
            }
        }
    }
}

$plugin_consent_setting = $plugin_consent_settings_temp;
update_option('tgdprc-consent-settings', $plugin_consent_settings_temp);
wp_redirect(admin_url('admin.php?page=tgdprcl-consents&message=1'));
exit();

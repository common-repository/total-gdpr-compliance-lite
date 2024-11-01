<?php

foreach ($_POST as $key => $val) {
    if ($key == 'terms_and_condition_settings' || $key == 'policies_settings') {
        $$key = $val;
    } else {
        $$key = sanitize_text_field($val);
    }
}
/** Sanitizing each form fields for Menu field added */
$terms_and_condition_settings_temp = array();
$terms_and_condition_settings_temp = array_map('sanitize_text_field', $terms_and_condition_settings);

$policies_settings_temp = array();
$policies_settings_temp = array_map('sanitize_text_field', $policies_settings);

update_option('tgdprc-terms-settings', $terms_and_condition_settings_temp);
update_option('tgdprc-policies-settings', $policies_settings_temp);
wp_redirect(admin_url('admin.php?page=tgdprcl-policies-and-conditions&message=1'));
exit();

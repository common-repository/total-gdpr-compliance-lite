<?php

foreach ($_POST as $key => $val) {
    if ($key == 'tgdprc_service_setting') {
        $$key = $val;
    } else {
        $$key = sanitize_text_field($val);
    }
}
/** Sanitizing each form fields for Menu field added */
$tgdprc_service_setting_temp = array();
$tgdprc_service_setting_temp = array_map('sanitize_text_field', $tgdprc_service_setting);

update_option('tgdprc-services-settings', $tgdprc_service_setting_temp);
wp_redirect(admin_url('admin.php?page=tgdprcl-services-settings&message=1'));
exit();

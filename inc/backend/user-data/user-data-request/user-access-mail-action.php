<?php

$tgdprc_data_access_request_data = get_option('tgdprc-data-access-request');
$tgdprc_data_access_request = $tgdprc_data_access_request_data != false ? $tgdprc_data_access_request_data : array();

if (isset($userdata_setting['data_request']['enable']) && $userdata_setting['data_request']['enable'] == 1) {
    $site_name = 'no-repy@' . esc_attr(get_option('blogname'));
    if (isset($tgdprc_data_access_request['data_request']['reciever_email']) && !empty($tgdprc_data_access_request['data_request']['reciever_email'])) {
        $to = $tgdprc_data_access_request['data_request']['reciever_email'];
    } else {
        $to = get_option('admin_email');
    }
    $email_message_from_backend = isset($tgdprc_data_access_request['data_request']['email_info_text']) && !empty($tgdprc_data_access_request['data_request']['email_info_text']) ? nl2br(html_entity_decode($tgdprc_data_access_request['data_request']['email_info_text'])) : __('
Hi there,\r\n You got Data Access Request at your site #sitename. Please visit site to view additional details.\r\nThank you', TGDPRCL_DOMAIN);
    $orginalstr = array("#email", '#sitename');
    $replacestr = array($name, $email, esc_attr(get_option('blogname')));
    $message = str_replace($orginalstr, $replacestr, $email_message_from_backend);
    $email_subject_from_backend = isset($tgdprc_data_access_request['data_request']['email_header']) && !empty($tgdprc_data_access_request['data_request']['email_header']) ? esc_attr($tgdprc_data_access_request['data_request']['email_header']) : __('Data Access Request [', TGDPRCL_DOMAIN) . get_option('blogname') . ']';
    
    $subject_header = str_replace($orginalstr, $replacestr, $email_subject_from_backend);

    $from = 'From:' . $site_name . ' <' . $site_name . '>' . "\r\n";
    $subject = $subject_header;

    $headers = "X-Mailer: php\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    /* @var $from_site_url type */
    $headers .= 'From: ' . $from_site_url . ' ' . "\r\n\\";
    $headers .= 'Reply-To: ' . $site_name . ' ' . "\r\n\\";
    $headers .= 'X-Mailer: PHP/' . phpversion();

    $mail = wp_mail($to, $subject, $message, $headers);
}

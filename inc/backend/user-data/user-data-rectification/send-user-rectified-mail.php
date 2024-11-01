<?php

global $wpdb;

$userdata_setting = get_option('user-data-settings');
$email_address = isset($_POST['email_address']) ? sanitize_email($_POST['email_address']) : '';
$current_page = isset($_POST['subpage']) ? sanitize_text_field($_POST['subpage']) : '';
$older_data_to_rectify_db = isset($_POST['old_data_to_rectify']) ? stripslashes_deep($_POST['old_data_to_rectify']) : ''; //Raw Data from DB for Original Data 
$older_data_to_rectify = isset($older_data_to_rectify_db) ? json_decode($older_data_to_rectify_db) : ''; //Decoded Rectify Data Original
$new_data_rectify_db = isset($_POST['new_data_rectify']) ? stripslashes_deep($_POST['new_data_rectify']) : ''; //Raw Data from DB for New 
$new_data_rectify = isset($new_data_rectify_db) ? json_decode($new_data_rectify_db) : ''; //Decoded Rectify Data New
$data_type_to_rectify = isset($_POST['data_type_to_rectify']) ? sanitize_text_field($_POST['data_type_to_rectify']) : '';
//var_dump($email_address, $current_page, $data_type_to_rectify);

/*
 * Mail Function starts from here 
 */

$site_name = 'no-repy@' . esc_attr(get_option('blogname'));
$to = isset($email_address) ? $email_address : '';
$email_message_from_backend = isset($userdata_setting['data_rectification']['user_email_info_text']) && !empty($userdata_setting['data_rectification']['user_email_info_text']) ? nl2br(html_entity_decode($userdata_setting['data_rectification']['user_email_info_text'])) :
        __('Hi there,

This mail is to inform you that your data in the site has been successfully rectified.

Please contact us for additional details.

Thanks
', TGDPRCL_DOMAIN);
$orginalstr = array('#sitename');
$replacestr = array(esc_attr(get_option('blogname')));
$message = str_replace($orginalstr, $replacestr, $email_message_from_backend);
$subject_header = isset($userdata_setting['data_rectification']['user_email_header']) && !empty($userdata_setting['data_rectification']['user_email_header']) ? esc_attr($userdata_setting['data_rectification']['user_email_header']) : __('Data Forget Results', TGDPRCL_DOMAIN) . ' [' . get_option('blogname') . ']';
$hash = md5(uniqid(time()));

/**
 * User Rectified Json File
 */
$json_Data_title = __('Rectified Json Data');
$all_rectified_output = $new_data_rectify_db;
$mail_attachments = $this->tgdprc_generate_json_attachment_file($json_Data_title, 'json');
file_put_contents($mail_attachments, $all_rectified_output, FILE_APPEND);
$mail_attachment = $mail_attachments;

/** Mail Format */
$from = 'From:' . $site_name . ' <' . $site_name . '>' . "\r\n";
$subject = $subject_header;
/** strip out all whitespace */
$somesitename_preg_replace = preg_replace('/\s*/', '', $site_name);
/** convert the string to all lowercase */
$somesitename = strtolower($somesitename_preg_replace);

$headers = 'X-Mailer: PHP/' . phpversion();
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"" . $hash . "\"\r\n\r\n";
$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
$headers .= 'From: ' . $somesitename . ' ' . "\r\n\\";
$headers .= 'Reply-To: ' . $somesitename . ' ' . "\r\n\\";

$mail = wp_mail($to, $subject, $message, $headers, $mail_attachment);

if ($mail) {

    $tgdprc_date = date('Y-m-d H:i:s');
    $tgdprc_data_rectification_additional_data = get_option('tgdprc-rectify-form-json-data');
    $tgdprc_data_rectification_additional_requested_data = $tgdprc_data_rectification_additional_data != false ? $tgdprc_data_rectification_additional_data : array();
    if (!empty($tgdprc_data_rectification_additional_requested_data)) {
        foreach ($tgdprc_data_rectification_additional_requested_data as $key => $value) {
            if (!empty($value['email_addresss']) && $value['email_addresss'] == $email_address) {
                $tgdprc_data_rectification_additional_requested_data[$key]['status'] = 'email-sent';
                $tgdprc_data_rectification_additional_requested_data[$key]['email_sent_date'] = $tgdprc_date;
            }
        }
    }
    update_option('tgdprc-rectify-form-json-data', $tgdprc_data_rectification_additional_requested_data);

    if (!empty($current_page)) {
        wp_redirect(admin_url() . 'admin.php?page=tgdprcl-userdata&subpage=' . $current_page . '&message_type=rectifydata&email_address=' . $to . '&message=1');
        die();
    } else {
        wp_redirect(admin_url() . 'admin.php?page=tgdprcl-userdata&message_type=rectifydata&email_address=' . $to . '&message=1');
        die();
    }
} else {
    if (!empty($current_page)) {
        wp_redirect(admin_url() . 'admin.php?page=tgdprcl-userdata&subpage=' . $current_page . '&message_type=rectifydata&email_address=' . $to . '&message=0');
        die();
    } else {
        wp_redirect(admin_url() . 'admin.php?page=tgdprcl-userdata&message_type=rectifydata&email_address=' . $to . '&message=0');
        die();
    }
}    
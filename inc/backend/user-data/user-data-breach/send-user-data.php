<?php

global $wpdb;
$userdata_setting = get_option('user-data-settings');
$email_address = isset($_GET['email_address']) ? sanitize_email($_GET['email_address']) : '';
$download_data = isset($_POST['wpcui_json_data']) ? stripslashes($_POST['wpcui_json_data']) : '';
$json_status = $this->is_json($download_data);
$current_page = isset($_GET['subpage']) ? sanitize_text_field($_GET['subpage']) : '';

/**
 * User Comment Meta Data Json File
 */
if (email_exists($email_address)) {
    $comment_meta_args = array(
        'author_email' => $email_address
    );
    $all_comment_meta_array = get_comments($comment_meta_args);
    if (!empty($all_comment_meta_array)) {
        $json_Data_title_1 = __('WP Comment Data', TGDPRCL_DOMAIN);

        $all_comments_meta_output = json_encode($all_comment_meta_array);
        $mail_attachment_1 = $this->tgdprc_generate_json_attachment_file($json_Data_title_1, 'json');
        file_put_contents($mail_attachment_1, $all_comments_meta_output, FILE_APPEND);
        $mail_attachment[] = $mail_attachment_1;
    }
}

/**
 * User Meta Data Json File
 */
if (email_exists($email_address)) {
    $user_Array = get_user_by("email", $email_address);
    if (!empty($user_Array)) {
        $json_Data_title_2 = __('WP User Data', TGDPRCL_DOMAIN);

        $all_user_meta_output = json_encode($user_Array);
        $mail_attachment_2 = $this->tgdprc_generate_json_attachment_file($json_Data_title_2, 'json');
        file_put_contents($mail_attachment_2, $all_user_meta_output, FILE_APPEND);
        $mail_attachment[] = $mail_attachment_2;
    }
}

/**
 * User Post Meta Data Json File
 */
if (email_exists($email_address)) {
    $all_post_meta_results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "postmeta WHERE meta_value = '$email_address' ");
    if ($all_post_meta_results) {
        $json_Data_title_3 = __('Post Meta Data', TGDPRCL_DOMAIN);

        $all_post_meta_output = json_encode($all_post_meta_results);
        $mail_attachment_3 = $this->tgdprc_generate_json_attachment_file($json_Data_title_3, 'json');
        file_put_contents($mail_attachment_3, $all_post_meta_output, FILE_APPEND);
        $mail_attachment[] = $mail_attachment_3;
    }
}

/**
 * User Woo Commerce Data Json File
 */
if (email_exists($email_address)) {
    $results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "usermeta WHERE meta_key = 'billing_email' AND meta_value = '$email_address' ");
    $user_data_woo_details = get_user_meta($results->user_id);
    if (!empty($user_data_woo_details)) {
        $json_Data_title_4 = __('Woo Commerce User Data', TGDPRCL_DOMAIN);

        $all_woocommerce_user_meta_output = json_encode($user_data_woo_details);
        $mail_attachment_4 = $this->tgdprc_generate_json_attachment_file($json_Data_title_4, 'json');
        file_put_contents($mail_attachment_4, $all_woocommerce_user_meta_output, FILE_APPEND);
        $mail_attachment[] = $mail_attachment_4;
    }
}

/*
 * Mail Function starts from here 
 */

$site_name = 'no-repy@' . esc_attr(get_option('blogname'));
$to = isset($email_address) ? $email_address : '';
$email_message_from_backend = isset($userdata_setting['data_request']['user_email_info_text']) && !empty($userdata_setting['data_request']['user_email_info_text']) ? nl2br(html_entity_decode($userdata_setting['data_request']['user_email_info_text'])) :
        __('Hi there,

Here is your data as per requested as requested from #sitename. 

Please contact us to view additional details.

', TGDPRCL_DOMAIN);
$orginalstr = array('#sitename');
$replacestr = array(esc_attr(get_option('blogname')));
$message = str_replace($orginalstr, $replacestr, $email_message_from_backend);
$subject_header = isset($userdata_setting['data_request']['user_email_header']) && !empty($userdata_setting['data_request']['user_email_header']) ? esc_attr($userdata_setting['data_request']['user_email_header']) : __('Data Request Results [', TGDPRCL_DOMAIN) . get_option('blogname') . ']';
$hash = md5(uniqid(time()));
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
    if (!empty($current_page)) {
        wp_redirect(admin_url() . 'admin.php?page=tgdprcl-userdata&subpage=' . $current_page . '&message_type=userdata&email_address=' . $to . '&message=1');
        die();
    } else {
        wp_redirect(admin_url() . 'admin.php?page=tgdprcl-userdata&message_type=userdata&email_address=' . $to . '&message=1');
        die();
    }
} else {
    if (!empty($current_page)) {
        wp_redirect(admin_url() . 'admin.php?page=tgdprcl-userdata&subpage=' . $current_page . '&message_type=userdata&email_address=' . $to . '&message=0');
        die();
    } else {
        wp_redirect(admin_url() . 'admin.php?page=tgdprcl-userdata&message_type=userdata&email_address=' . $to . '&message=0');
        die();
    }
}
<?php

global $wpdb;
$userdata_setting = get_option('user-data-settings');
$email_address = isset($_GET['email_address']) ? sanitize_email($_GET['email_address']) : '';
$current_page = isset($_GET['subpage']) ? sanitize_text_field($_GET['subpage']) : '';


if (email_exists($email_address)) {
    /**
     * User Comment Meta Data forget action
     */
    $comment_meta_args = array(
        'author_email' => $email_address
    );
    $all_comment_meta_array = get_comments($comment_meta_args);
    if (!empty($all_comment_meta_array)) {
        foreach ($all_comment_meta_array as $key => $val) {
            wp_delete_comment($val->comment_ID);
        }
    }

    /**
     * User Meta Data forget action
     */
    $user_Array = get_user_by("email", $email_address);
    if (!empty($user_Array)) {
        wp_delete_user($user_Array->data->ID);
    }

    /**
     * User Post Meta Data forget action
     */
    $all_post_meta_results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "postmeta WHERE meta_value = '$email_address' ");
    if ($all_post_meta_results) {
        delete_post_meta($all_post_meta_results->post_id, $all_post_meta_results->meta_key);
    }

    /**
     * User Woo Commerce Data forget action
     */
    $user_data_woo_results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "usermeta WHERE meta_key = 'billing_email' AND meta_value = '$email_address' ");
    if (!empty($user_data_woo_results)) {
        $user_id = $user_data_woo_results->user_id;
        $user_data_woo_detailss = get_user_meta($user_id);
        if (!empty($user_data_woo_detailss)) {
            foreach ($user_data_woo_detailss as $key => $val) {
                delete_user_meta($user_id, $key,$val[0]);
            }
        }
    }
}

/*
 * Mail Function starts from here 
 */

$site_name = 'no-repy@' . esc_attr(get_option('blogname'));
$to = isset($email_address) ? $email_address : '';
$email_message_from_backend = isset($userdata_setting['data_forget']['user_email_info_text']) && !empty($userdata_setting['data_forget']['user_email_info_text']) ? nl2br(html_entity_decode($userdata_setting['data_forget']['user_email_info_text'])) :
        __('Hi there,

This mail is to inform you that your data in the site has been succesfully forgotten.

Please contact us for additional details.

Thanks
', TGDPRCL_DOMAIN);
$orginalstr = array('#sitename');
$replacestr = array(esc_attr(get_option('blogname')));
$message = str_replace($orginalstr, $replacestr, $email_message_from_backend);
$subject_header = isset($userdata_setting['data_forget']['user_email_header']) && !empty($userdata_setting['data_forget']['user_email_header']) ? esc_attr($userdata_setting['data_forget']['user_email_header']) : __('Data Forget Results', TGDPRCL_DOMAIN) . ' [' . get_option('blogname') . ']';
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
    $tgdprc_forget_additional_data_array = get_option('tgdprc-forget-form-additional-data');
    $tgdprc_forget_additional_data = $tgdprc_forget_additional_data_array != false ? $tgdprc_forget_additional_data_array : array();

    $tgdprc_date = date('Y-m-d H:i:s');
    if (!empty($tgdprc_forget_additional_data)) {
        foreach ($tgdprc_forget_additional_data as $key => $value) {
            if ($value['email_addresss'] == $email_address) {
                $tgdprc_forget_additional_data[$key]['status'] = 'email-sent';
                $tgdprc_forget_additional_data[$key]['email_sent_date'] = $tgdprc_date;
            }
        }
    }

    update_option('tgdprc-forget-form-additional-data', $tgdprc_forget_additional_data);
    
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
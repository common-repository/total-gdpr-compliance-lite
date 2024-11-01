<?php

$userdata_setting = get_option('user-data-settings');

$email_address_value = sanitize_email($_POST['email_address_value']);
$user_data_submit_type = sanitize_text_field($_POST['user_data_submit_type']);

$old_data_to_rectify = $_POST['old_data_to_rectify'];

$new_data_rectify = $_POST['new_data_rectify'];

if ($user_data_submit_type == 'data-access') {
    $tgdprc_data_access_request_data = get_option('tgdprc-data-access-request');
    $tgdprc_data_access_request = $tgdprc_data_access_request_data != false ? $tgdprc_data_access_request_data : array();
    if (in_array($email_address_value, $tgdprc_data_access_request)) {
        if (isset($userdata_setting['data_request']['already_submitted_message']) && !empty($userdata_setting['data_request']['already_submitted_message'])) {
            $email_already_message = esc_attr($userdata_setting['data_request']['already_submitted_message']);
        } else if (!isset($userdata_setting['data_request']['already_submitted_message'])) {
            $email_already_message = __('Email already entered for query.', TGDPRCL_DOMAIN);
        } else {
            $email_already_message = '';
        }

        echo $message = 'message_type=failed&message=' . $email_already_message;
    } else if (!in_array($email_address_value, $tgdprc_data_access_request)) {
        array_push($tgdprc_data_access_request, $email_address_value);

        if (isset($userdata_setting['data_request']['submission_message']) && !empty($userdata_setting['data_request']['submission_message'])) {
            $email_success_message = esc_attr($userdata_setting['data_request']['submission_message']);
        } else if (!isset($userdata_setting['data_request']['submission_message'])) {
            $email_success_message = __('Thank you. You will be Notified soon through email.', TGDPRCL_DOMAIN);
        } else {
            $email_success_message = '';
        }

        if (isset($userdata_setting['data_request']['error_message']) && !empty($userdata_setting['data_request']['error_message'])) {
            $email_failure_message = esc_attr($userdata_setting['data_request']['error_message']);
        } else if (!isset($userdata_setting['data_request']['error_message'])) {
            $email_failure_message = __('Something wrong. Please try again', TGDPRCL_DOMAIN);
        } else {
            $email_failure_message = '';
        }
        $update = update_option('tgdprc-data-access-request', $tgdprc_data_access_request);
        if ($update) {

            /**
             *  Update option table that store to access request other hidden data as well 
             */
            $tgdprc_date = date('Y-m-d H:i:s');
            $tgdprc_access_additional_data_array = get_option('tgdprc-access-additional-data');
            $tgdprc_access_additional_data = $tgdprc_access_additional_data_array != false ? $tgdprc_access_additional_data_array : array();
            $tgdprc_access_additional_data_entry = array(
                'email_addresss' => $email_address_value,
                'access_request_date' => $tgdprc_date,
                'status' => 'email-not-send',
                'email_sent_date' => '',
            );
            array_push($tgdprc_access_additional_data, $tgdprc_access_additional_data_entry);
            update_option('tgdprc-access-additional-data', $tgdprc_access_additional_data);

            /**
             * Update option table that store to access request other hidden data as well ends here
             */
            /** send Admin mail after the form is sumitted */
            if (isset($userdata_setting['data_request']['enable']) && $userdata_setting['data_request']['enable'] == 1) {
                $site_name = 'no-repy@' . esc_attr(get_option('blogname'));
                if (isset($userdata_setting['data_request']['reciever_email']) && !empty($userdata_setting['data_request']['reciever_email'])) {
                    $to = $userdata_setting['data_request']['reciever_email'];
                } else {
                    $to = get_option('admin_email');
                }
                $email_message_from_backend = isset($userdata_setting['data_request']['email_info_text']) && !empty($userdata_setting['data_request']['email_info_text']) ? nl2br(html_entity_decode($userdata_setting['data_request']['email_info_text'])) :
                        __('Hi there,

You got Data Access Request at your site #sitename from #email. 

Please visit site to view additional details.

Thank you', TGDPRCL_DOMAIN);
                $orginalstr = array("#email", '#sitename');
                $replacestr = array($email_address_value, esc_attr(get_option('blogname')));
                $message = str_replace($orginalstr, $replacestr, $email_message_from_backend);
                $subject_header = isset($userdata_setting['data_request']['email_header']) && !empty($userdata_setting['data_request']['email_header']) ? esc_attr($userdata_setting['data_request']['email_header']) : __('Data Access Request [', TGDPRCL_DOMAIN) . get_option('blogname') . ']';

                /** Mail Format */
                $from = 'From:' . $site_name . ' <' . $site_name . '>' . "\r\n";
                $subject = $subject_header;
                // strip out all whitespace
                $somesitename_preg_replace = preg_replace('/\s*/', '', $site_name);
// convert the string to all lowercase
                $somesitename = strtolower($somesitename_preg_replace);
                $headers = "X-Mailer: php\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                /* @var $from_site_url type */
                $headers .= 'From: ' . $somesitename . ' ' . "\r\n\\";
                $headers .= 'Reply-To: ' . $somesitename . ' ' . "\r\n\\";
                $headers .= 'X-Mailer: PHP/' . phpversion();

                $mail = wp_mail($to, $subject, $message, $headers);
                if ($mail) {
                    echo $message = 'message_type=success&message=' . $email_success_message;
                } else {
                    //var_dump($to, $subject, $message, $headers);
                    echo $message = 'message_type=success&message=' . $email_success_message;
                }
            } else {
                echo $message = 'message_type=success&message=' . $email_success_message;
            }
        } else {
            echo $message = 'message_type=failed&message=' . $email_failure_message;
        }
    } else {
        echo $message = 'message_type=failed&message=' . __("Oh Snap! Please Try Again.", TGDPRCL_DOMAIN);
    }
} else if ($user_data_submit_type == 'data-forget') {
    $tgdprc_data_forget_request_data = get_option('tgdprc-data-forget-request');
    $tgdprc_data_forget_request = $tgdprc_data_forget_request_data != false ? $tgdprc_data_forget_request_data : array();
    if (in_array($email_address_value, $tgdprc_data_forget_request)) {
        if (isset($userdata_setting['data_forget']['already_submitted_message']) && !empty($userdata_setting['data_forget']['already_submitted_message'])) {
            $email_already_message = esc_attr($userdata_setting['data_forget']['already_submitted_message']);
        } else if (!isset($userdata_setting['data_forget']['already_submitted_message'])) {
            $email_already_message = __('Email already entered for query.', TGDPRCL_DOMAIN);
        } else {
            $email_already_message = '';
        }

        echo $message = 'message_type=failed&message=' . $email_already_message;
    } else if (!in_array($email_address_value, $tgdprc_data_forget_request)) {
        array_push($tgdprc_data_forget_request, $email_address_value);

        if (isset($userdata_setting['data_forget']['submission_message']) && !empty($userdata_setting['data_forget']['submission_message'])) {
            $email_success_message = esc_attr($userdata_setting['data_forget']['submission_message']);
        } else if (!isset($userdata_setting['data_forget']['submission_message'])) {
            $email_success_message = __('Thank you. You will be Notified soon through email.', TGDPRCL_DOMAIN);
        } else {
            $email_success_message = '';
        }

        if (isset($userdata_setting['data_forget']['error_message']) && !empty($userdata_setting['data_forget']['error_message'])) {
            $email_failure_message = esc_attr($userdata_setting['data_forget']['error_message']);
        } else if (!isset($userdata_setting['data_forget']['error_message'])) {
            $email_failure_message = __('Something wrong. Please try again', TGDPRCL_DOMAIN);
        } else {
            $email_failure_message = '';
        }
        $update = update_option('tgdprc-data-forget-request', $tgdprc_data_forget_request);
        if ($update) {
            
            /**
             * Update option table that store to forget data as well 
             */
            $tgdprc_date = date('Y-m-d H:i:s');
            $tgdprc_data_forget_additional_data = get_option('tgdprc-forget-form-additional-data');
            $tgdprc_data_forget_requested_data = $tgdprc_data_forget_additional_data != false ? $tgdprc_data_forget_additional_data : array();
            $tgdprc_forget_additional_entry = array(
                'email_addresss' => $email_address_value,
                'forget_request_date' => $tgdprc_date,
                'status' => 'email-not-send',
                'email_sent_date' => '',
            );
            array_push($tgdprc_data_forget_requested_data, $tgdprc_forget_additional_entry);
            update_option('tgdprc-forget-form-additional-data', $tgdprc_data_forget_requested_data);

            
            if (isset($userdata_setting['data_forget']['enable']) && $userdata_setting['data_forget']['enable'] == 1) {
                $site_name = 'no-repy@' . esc_attr(get_option('blogname'));
                if (isset($userdata_setting['data_forget']['reciever_email']) && !empty($userdata_setting['data_forget']['reciever_email'])) {
                    $to = $userdata_setting['data_forget']['reciever_email'];
                } else {
                    $to = get_option('admin_email');
                }
                $email_message_from_backend = isset($userdata_setting['data_forget']['email_info_text']) && !empty($userdata_setting['data_forget']['email_info_text']) ? nl2br(html_entity_decode($userdata_setting['data_forget']['email_info_text'])) :
                        __('Hi there,

You got Data Forget Request at your site #sitename from #email. 

Please visit site to view additional details.

Thank you', TGDPRCL_DOMAIN);
                $orginalstr = array("#email", '#sitename');
                $replacestr = array($email_address_value, esc_attr(get_option('blogname')));
                $message = str_replace($orginalstr, $replacestr, $email_message_from_backend);
                $subject_header = isset($userdata_setting['data_forget']['email_header']) && !empty($userdata_setting['data_forget']['email_header']) ? esc_attr($userdata_setting['data_forget']['email_header']) : __('Data Access Request [', TGDPRCL_DOMAIN) . get_option('blogname') . ']';

                /** Mail Format */
                $from = 'From:' . $site_name . ' <' . $site_name . '>' . "\r\n";
                $subject = $subject_header;
                $somesitename_preg_replace = preg_replace('/\s*/', '', $site_name);
                // convert the string to all lowercase
                $somesitename = strtolower($somesitename_preg_replace);
                $headers = "X-Mailer: php\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                /* @var $from_site_url type */
                $headers .= 'From: ' . $somesitename . ' ' . "\r\n\\";
                $headers .= 'Reply-To: ' . $somesitename . ' ' . "\r\n\\";
                $headers .= 'X-Mailer: PHP/' . phpversion();

                $mail = wp_mail($to, $subject, $message, $headers);
                if ($mail) {
                    echo $message = 'message_type=success&message=' . $email_success_message;
                } else {
                    //var_dump($to, $subject, $message, $headers);
                    echo $message = 'message_type=success&message=' . $email_success_message;
                }
            } else {
                echo $message = 'message_type=success&message=' . $email_success_message;
            }
        } else {
            echo $message = 'message_type=failed&message=' . $email_failure_message;
        }
    } else {
        echo $message = 'message_type=failed&message=' . __("Oh Snap! Please Try Again.", TGDPRCL_DOMAIN);
    }
} else if ($user_data_submit_type == 'data-rectification') {
    $tgdprc_data_rectification_request_data = get_option('tgdprc-data-rectification-request');
    $tgdprc_data_rectification_request = $tgdprc_data_rectification_request_data != false ? $tgdprc_data_rectification_request_data : array();
    if (in_array($email_address_value, $tgdprc_data_rectification_request)) {
        if (isset($userdata_setting['data_request']['already_submitted_message']) && !empty($userdata_setting['data_request']['already_submitted_message'])) {
            $email_already_message = esc_attr($userdata_setting['data_request']['already_submitted_message']);
        } else if (!isset($userdata_setting['data_request']['already_submitted_message'])) {
            $email_already_message = __('Your Earlier request is pending. Please try again later.', TGDPRCL_DOMAIN);
        } else {
            $email_already_message = '';
        }

        echo $message = 'message_type=failed&message=' . $email_already_message;
    } else if (!in_array($email_address_value, $tgdprc_data_rectification_request)) {
        array_push($tgdprc_data_rectification_request, $email_address_value);

        if (isset($userdata_setting['data_request']['submission_message']) && !empty($userdata_setting['data_request']['submission_message'])) {
            $email_success_message = esc_attr($userdata_setting['data_request']['submission_message']);
        } else if (!isset($userdata_setting['data_request']['submission_message'])) {
            $email_success_message = __('Thank you. You will be Notified soon through email.', TGDPRCL_DOMAIN);
        } else {
            $email_success_message = '';
        }

        if (isset($userdata_setting['data_rectification']['error_message']) && !empty($userdata_setting['data_rectification']['error_message'])) {
            $email_failure_message = esc_attr($userdata_setting['data_rectification']['error_message']);
        } else if (!isset($userdata_setting['data_rectification']['error_message'])) {
            $email_failure_message = __('Something wrong. Please try again', TGDPRCL_DOMAIN);
        } else {
            $email_failure_message = '';
        }

        $update = update_option('tgdprc-data-rectification-request', $tgdprc_data_rectification_request);

        if ($update) {

            /**
             * Update option table that store to rectify data as well 
             */
            $tgdprc_date = date('Y-m-d H:i:s');
            $tgdprc_data_rectification_json_data = get_option('tgdprc-rectify-form-json-data');
            $tgdprc_data_rectification_requested_data = $tgdprc_data_rectification_json_data != false ? $tgdprc_data_rectification_json_data : array();
            $tgdprc_rectify_request_json_entry = array(
                'email_addresss' => $email_address_value,
                'old_data_to_rectify' => $old_data_to_rectify,
                'new_data_rectify' => $new_data_rectify,
                'rectify_request_date' => $tgdprc_date,
                'status' => 'email-not-send',
                'email_sent_date' => '',
            );
            array_push($tgdprc_data_rectification_requested_data, $tgdprc_rectify_request_json_entry);
            update_option('tgdprc-rectify-form-json-data', $tgdprc_data_rectification_requested_data);

            /**
             * Update option table that store to rectify data as well ends here
             */
            if (isset($userdata_setting['data_rectification']['enable']) && $userdata_setting['data_rectification']['enable'] == 1) {
                $site_name = 'no-repy@' . esc_attr(get_option('blogname'));
                if (isset($userdata_setting['data_rectification']['reciever_email']) && !empty($userdata_setting['data_rectification']['reciever_email'])) {
                    $to = $userdata_setting['data_rectification']['reciever_email'];
                } else {
                    $to = get_option('admin_email');
                }
                $email_message_from_backend = isset($userdata_setting['data_rectification']['email_info_text']) && !empty($userdata_setting['data_rectification']['email_info_text']) ? nl2br(html_entity_decode($userdata_setting['data_rectification']['email_info_text'])) :
                        __('Hi there,

You got Data Rectification Request at your site #sitename from #email. 

Please visit site to view additional details.

Thank you', TGDPRCL_DOMAIN);
                $orginalstr = array("#email", '#sitename');
                $replacestr = array($email_address_value, esc_attr(get_option('blogname')));
                $message = str_replace($orginalstr, $replacestr, $email_message_from_backend);
                $subject_header = isset($userdata_setting['data_rectification']['email_header']) && !empty($userdata_setting['data_forget']['email_header']) ? esc_attr($userdata_setting['data_rectification']['email_header']) : __('Data Access Request [', TGDPRCL_DOMAIN) . get_option('blogname') . ']';

                /** Mail Format */
                $from = 'From:' . $site_name . ' <' . $site_name . '>' . "\r\n";
                $subject = $subject_header;
                $somesitename_preg_replace = preg_replace('/\s*/', '', $site_name);
                // convert the string to all lowercase
                $somesitename = strtolower($somesitename_preg_replace);
                $headers = "X-Mailer: php\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                /* @var $from_site_url type */
                $headers .= 'From: ' . $somesitename . ' ' . "\r\n\\";
                $headers .= 'Reply-To: ' . $somesitename . ' ' . "\r\n\\";
                $headers .= 'X-Mailer: PHP/' . phpversion();
                $mail = wp_mail($to, $subject, $message, $headers);
                if ($mail) {
                    echo $message = 'message_type=success&message=' . $email_success_message;
                } else {
                    echo $message = 'message_type=success&message=' . $email_success_message;
                }
            } else {
                echo $message = 'message_type=success&message=' . $email_success_message;
            }
        } else {
            echo $message = 'message_type=failed&message=' . $email_failure_message;
        }
    } else {
        echo $message = 'message_type=failed&message=' . __("Oh Snap! Please Try Again.", TGDPRCL_DOMAIN);
    }
}


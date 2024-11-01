<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<?php
$field_array = array(
    'necessary' => 'Necessary',
    'analytics' => 'Analytics & Marketting',
    'advertisement' => 'Advertisement'
);
?>

<div class="tgdprc_design_settings_wrap tgdprc-user-data-tabs-content" id="tgdprc-userdata-tabs-content-tgdprc-data-rectification" style="display: none;" >
    <div class="tgdprc_struct_settings_header">
        <h3><?php esc_attr_e('General Setting', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <div class="tgdprc_struct_settings_body">
        <div class="tgdprc_checkbox_wrap">
            <label><?php esc_attr_e('Disable Rectification Request Form', TGDPRCL_DOMAIN) ?></label>
            <input type="checkbox" name="userdata_setting[data_rectification][disable_this_form]" value="1" <?php
            if (isset($userdata_setting['data_rectification']['disable_this_form']) && $userdata_setting['data_rectification']['disable_this_form'] == 1) {
                echo 'checked="checked"';
            }
            ?> class="tgdprc-bulb-switch" id="tgdprc-disable-rectification-request-form">
            <label for="tgdprc-disable-rectification-request-form"></label>
            <p class="tgdprc-description"><?php echo __('Default: Enabled. Please check this checkbox to disable "User Data Rectification Request" form.', TGDPRCL_DOMAIN); ?></p>	
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Form Header', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_rectification][display_header_text]" value="<?php
            if (isset($userdata_setting['data_rectification']['display_header_text']) && !empty($userdata_setting['data_rectification']['display_header_text'])) {
                echo esc_attr($userdata_setting['data_rectification']['display_header_text']);
            } else if (!isset($userdata_setting['data_rectification']['display_header_text'])) {
                echo __('User Data Rectification Request', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Email Placeholder', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_rectification][tgdprc_email_placeholder]" value="<?php
            if (isset($userdata_setting['data_rectification']['tgdprc_email_placeholder']) && !empty($userdata_setting['data_rectification']['tgdprc_email_placeholder'])) {
                echo esc_attr($userdata_setting['data_rectification']['tgdprc_email_placeholder']);
            } else if (!isset($userdata_setting['data_rectification']['tgdprc_email_placeholder'])) {
                echo __('Your email address Used in this site', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Old Json Data Placeholder', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_rectification][rectified_old_data_placeholder]" value="<?php
            if (isset($userdata_setting['data_rectification']['rectified_old_data_placeholder']) && !empty($userdata_setting['data_rectification']['rectified_old_data_placeholder'])) {
                echo esc_attr($userdata_setting['data_rectification']['rectified_old_data_placeholder']);
            } else if (!isset($userdata_setting['data_rectification']['rectified_old_data_placeholder'])) {
                echo __('Original Json Data to Rectify', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('New Json Data Placeholder', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_rectification][rectified_new_data_placeholder]" value="<?php
            if (isset($userdata_setting['data_rectification']['rectified_new_data_placeholder']) && !empty($userdata_setting['data_rectification']['rectified_new_data_placeholder'])) {
                echo esc_attr($userdata_setting['data_rectification']['rectified_new_data_placeholder']);
            } else if (!isset($userdata_setting['data_rectification']['rectified_new_data_placeholder'])) {
                echo __('New Rectified Json Data', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Consent Checkbox Placeholder', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_rectification][checkbox_consent_label]" value="<?php
            if (isset($userdata_setting['data_rectification']['checkbox_consent_label']) && !empty($userdata_setting['data_rectification']['checkbox_consent_label'])) {
                echo esc_attr($userdata_setting['data_rectification']['checkbox_consent_label']);
            } else if (!isset($userdata_setting['data_rectification']['checkbox_consent_label'])) {
                echo __('I give consent to store my email address and other datas.', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_checkbox_wrap">
            <label><?php esc_attr_e('Consent Accepted by Default', TGDPRCL_DOMAIN) ?></label>
            <input type="checkbox" name="userdata_setting[data_rectification][checked_by_default]" value="1" <?php
            if (isset($userdata_setting['data_rectification']['checked_by_default']) && $userdata_setting['data_rectification']['checked_by_default'] == 1) {
                echo 'checked="checked"';
            }
            ?> class="tgdprc-bulb-switch" id="tgdprc-consent-rectification-checked-default">
            <label for="tgdprc-consent-rectification-checked-default"></label>
            <p class="tgdprc-description"><?php echo __('If checked, consent checkbox will be checked by default.', TGDPRCL_DOMAIN); ?></p>	
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Already Submitted Message', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_rectification][already_submitted_message]" value="<?php
            if (isset($userdata_setting['data_rectification']['already_submitted_message']) && !empty($userdata_setting['data_rectification']['already_submitted_message'])) {
                echo esc_attr($userdata_setting['data_rectification']['already_submitted_message']);
            } else if (!isset($userdata_setting['data_rectification']['already_submitted_message'])) {
                echo __('Email already entered for query.', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Error Message', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_rectification][error_message]" value="<?php
            if (isset($userdata_setting['data_rectification']['error_message']) && !empty($userdata_setting['data_rectification']['error_message'])) {
                echo esc_attr($userdata_setting['data_rectification']['error_message']);
            } else if (!isset($userdata_setting['data_rectification']['error_message'])) {
                echo __('Something wrong. Please try again', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Submit Button Text', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_rectification][submit_button_text]" value="<?php
            if (isset($userdata_setting['data_rectification']['submit_button_text']) && !empty($userdata_setting['data_rectification']['submit_button_text'])) {
                echo esc_attr($userdata_setting['data_rectification']['submit_button_text']);
            } else if (!isset($userdata_setting['data_rectification']['submit_button_text'])) {
                echo __('Submit', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_header">
            <h3><?php esc_attr_e('Admin Email Setting', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <div class="tgdprc_checkbox_wrap">
            <label><?php esc_attr_e('Enable Alert Admin', TGDPRCL_DOMAIN) ?></label>
            <input type="checkbox" name="userdata_setting[data_rectification][enable]" value="1" <?php
            if (isset($userdata_setting['data_rectification']['enable']) && $userdata_setting['data_rectification']['enable'] == 1) {
                echo 'checked="checked"';
            }
            ?> id="tgdprc_user_data_rectification_admin_alert_check">
            <label for="tgdprc_user_data_rectification_admin_alert_check"></label>
            <p class="tgdprc-description"><?php echo __('Please enable this checkbox to get alert on "User Data Rectification" request', TGDPRCL_DOMAIN); ?></p>	
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Reciever Email', TGDPRCL_DOMAIN) ?></label>
            <input type="email" name="userdata_setting[data_rectification][reciever_email]" value="<?php
            if (isset($userdata_setting['data_rectification']['reciever_email']) && !empty($userdata_setting['data_rectification']['reciever_email'])) {
                echo esc_attr($userdata_setting['data_rectification']['reciever_email']);
            } else if (!isset($userdata_setting['data_rectification']['reciever_email'])) {
                echo get_option('admin_email');
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Email Header', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_rectification][email_header]" value="<?php
            if (isset($userdata_setting['data_rectification']['email_header']) && !empty($userdata_setting['data_rectification']['email_header'])) {
                echo esc_attr($userdata_setting['data_rectification']['email_header']);
            } else if (!isset($userdata_setting['data_rectification']['email_header'])) {
                echo __('Data Rectification Request [', TGDPRCL_DOMAIN) . get_option('blogname') . ']';
            }
            ?>">
        </div>
        <div class="tgdprc_more_info_action_options" >
            <div class="tgdprc_struct_settings_field">
                <label><?php esc_attr_e('Email Info Text', TGDPRCL_DOMAIN) ?></label>
                <?php
                $allowed_html = wp_kses_allowed_html('post');
                if (!empty($userdata_setting['data_rectification']['email_info_text'])) {
                    $content = wp_kses(stripslashes($userdata_setting['data_rectification']['email_info_text']), $allowed_html);
                } else if (!isset($userdata_setting['data_rectification']['email_info_text'])) {
                    $content = __('Hi there,
                        
You got Data Rectification Request at your site #sitename from #email. 

Please visit site to view additional details.

Thank you', TGDPRCL_DOMAIN) . ' ' . get_option('blogname');
                } else {
                    $content = '';
                }
                $editor_id = 'wpcui_wp_data_rectification_email_in_settings';
                $settings = array(
                    'textarea_name' => 'userdata_setting[data_rectification][email_info_text]',
                    'media_buttons' => false,
                    'editor_class' => 'wpcui_wp_editor_in_settings',
                    'editor_height' => 200
                );
                wp_editor($content, $editor_id, $settings);
                ?>
            </div>
        </div>
        <div class="tgdprc_struct_settings_header">
            <h3><?php esc_attr_e('User Email Setting', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Email Header', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_rectification][user_email_header]" value="<?php
            if (isset($userdata_setting['data_rectification']['user_email_header']) && !empty($userdata_setting['data_rectification']['user_email_header'])) {
                echo esc_attr($userdata_setting['data_rectification']['user_email_header']);
            } else if (!isset($userdata_setting['data_rectification']['user_email_header'])) {
                echo __('Data Rectification Results [', TGDPRCL_DOMAIN) . get_option('blogname') . ']';
            }
            ?>">
        </div>
        <div class="tgdprc_more_info_action_options" >
            <div class="tgdprc_struct_settings_field">
                <label><?php esc_attr_e('Email Info Text', TGDPRCL_DOMAIN) ?></label>
                <?php
                $allowed_html = wp_kses_allowed_html('post');
                if (!empty($userdata_setting['data_rectification']['user_email_info_text'])) {
                    $content = wp_kses(stripslashes($userdata_setting['data_rectification']['user_email_info_text']), $allowed_html);
                } else if (!isset($userdata_setting['data_rectification']['user_email_info_text'])) {
                    $content = __('Hi there,

This mail is to inform you that your data in the site has been successfully rectified.

Please contact us for additional details.

Thanks', TGDPRCL_DOMAIN);
                } else {
                    $content = '';
                }
                $editor_id = 'wpcui_wp_data_rectification_email_in_settings';
                $settings = array(
                    'textarea_name' => 'userdata_setting[data_rectification][user_email_info_text]',
                    'media_buttons' => false,
                    'editor_class' => 'wpcui_wp_editor_in_settings',
                    'editor_height' => 200
                );
                wp_editor($content, $editor_id, $settings);
                ?>
            </div>
        </div>
    </div>
    <div class="tgdprc_struct_settings_header">
        <h3><?php esc_attr_e('Data Rectification Requests', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <?php
    $tgdprc_data_rectify_request_data = get_option('tgdprc-data-rectification-request');
    $tgdprc_data_rectify_request = $tgdprc_data_rectify_request_data != false ? $tgdprc_data_rectify_request_data : array();
    ?>
    <table class="tgdprc-cookie-bar-display-table" cellspacing="0">
        <thead>
            <tr>
                <th><?php esc_attr_e('User Email', TGDPRCL_DOMAIN) ?></th>
                <th><?php esc_attr_e('Request Date', TGDPRCL_DOMAIN) ?></th>
                <th><?php esc_attr_e('Status', TGDPRCL_DOMAIN) ?></th>
                <th><?php esc_attr_e('Last Email Sent', TGDPRCL_DOMAIN) ?></th>
                <th><?php esc_attr_e('Action', TGDPRCL_DOMAIN) ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($tgdprc_data_rectify_request) > 0) {
                foreach ($tgdprc_data_rectify_request as $tgdprc_data_rectify_req):
                    $rectify_json_data = $this->tgdprc_pull_related_array_rectify_userdata($tgdprc_data_rectify_req);
                    ?>
                    <tr>
                        <td><?php echo!empty($tgdprc_data_rectify_req) ? esc_attr($tgdprc_data_rectify_req) : ''; ?></td>
                        <td><?php echo isset($rectify_json_data['forget_request_date']) && !empty($rectify_json_data['forget_request_date']) ? date("F jS, Y h:i:s", strtotime(esc_attr($rectify_json_data['forget_request_date']))) : ''; ?></td>
                        <td><span class="<?php echo (isset($rectify_json_data['status']) && $rectify_json_data['status'] == 'email-not-send') || !isset($rectify_json_data['status']) ? 'tgdprc-email-not-send-stat' : 'tgdprc-email-sent-stat'; ?>"><?php echo (isset($rectify_json_data['status']) && $rectify_json_data['status'] == 'email-not-send') || !isset($rectify_json_data['status']) ? __('Email Not Sent', TGDPRCL_DOMAIN) : __('Email Sent', TGDPRCL_DOMAIN); ?></span></td>
                        <td><?php echo isset($rectify_json_data['email_sent_date']) && !empty($rectify_json_data['email_sent_date']) ? date("F jS, Y h:i:s", strtotime(esc_attr($rectify_json_data['email_sent_date']))) : ''; ?></td>

                        <td>
                            <div class="cookie_settings_options">
                                <a href="<?php echo admin_url("admin.php?page=tgdprcl-userdata&subpage=rectification-data-log&email_address=$tgdprc_data_rectify_req"); ?>" class="wpcui_preview_button"></a>
                                <!-- <a href="< ?php echo admin_url("admin-post.php?action=tgdprc_send_rectified_email_to_user&email_address=$tgdprc_data_rectify_req&_wpnonce=$tgdprc_user_data_nonce"); ?>" onclick="return confirm('Do you want to send email to this selected user ?')" class="wpcui_edit_button"></a>-->
                                <a href="<?php echo admin_url("admin-post.php?action=delete_chosen_user_rectify_req_email&email_address=$tgdprc_data_rectify_req&_wpnonce=$tgdprc_user_data_nonce"); ?>" onclick="return confirm('Do you want to delete log for this user ?')" class="tgdprc_delete_button"></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php
            } else {
                ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><?php esc_attr_e('No Consent to Display.', TGDPRCL_DOMAIN) ?></td>
                    <td>&nbsp;</td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th><?php esc_attr_e('User Email', TGDPRCL_DOMAIN) ?></th>
                <th><?php esc_attr_e('Request Date', TGDPRCL_DOMAIN) ?></th>
                <th><?php esc_attr_e('Status', TGDPRCL_DOMAIN) ?></th>
                <th><?php esc_attr_e('Last Email Sent', TGDPRCL_DOMAIN) ?></th>
                <th><?php esc_attr_e('Action', TGDPRCL_DOMAIN) ?></th>
            </tr>
        </tfoot>
    </table>
</div>
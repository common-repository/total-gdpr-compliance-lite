<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<div class="tgdprc_struct_settings_wrap tgdprc-user-data-tabs-content" id="tgdprc-userdata-tabs-content-tgdprc-data-access">
    <div class="tgdprc_struct_settings_header">
        <h3><?php esc_attr_e('General Setting', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <div class="tgdprc_struct_settings_body">
        <div class="tgdprc_checkbox_wrap">
            <label><?php esc_attr_e('Enable All User Data Services', TGDPRCL_DOMAIN) ?></label>
            <input type="checkbox" name="userdata_setting[data_request][enable]" value="1" <?php
            if (isset($userdata_setting['data_request']['enable']) && $userdata_setting['data_request']['enable'] == 1) {
                echo 'checked="checked"';
            }
            ?> class="tgdprc-bulb-switch" id="tgdprc-enable-services-across-site">
            <label for="tgdprc-enable-services-across-site"></label>
            <p class="tgdprc-description"><?php echo __('Default: Enabled. Please enable this checkbox to enable "User Data" service in the frontend.', TGDPRCL_DOMAIN); ?></p>	
        </div>
        <div class="tgdprc_checkbox_wrap">
            <label><?php esc_attr_e('Disable Access Request Form', TGDPRCL_DOMAIN) ?></label>
            <input type="checkbox" name="userdata_setting[data_request][disable_this_form]" value="1" <?php
            if (isset($userdata_setting['data_request']['disable_this_form']) && $userdata_setting['data_request']['disable_this_form'] == 1) {
                echo 'checked="checked"';
            }
            ?> class="tgdprc-bulb-switch" id="tgdprc-disable-access-request-form">
            <label for="tgdprc-disable-access-request-form"></label>
            <p class="tgdprc-description"><?php echo __('Please check this checkbox to disable "User Data Access Request" form.', TGDPRCL_DOMAIN); ?></p>	
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Form Header', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_request][display_header_text]" value="<?php
            if (isset($userdata_setting['data_request']['display_header_text']) && !empty($userdata_setting['data_request']['display_header_text'])) {
                echo esc_attr($userdata_setting['data_request']['display_header_text']);
            } else if (!isset($userdata_setting['data_request']['display_header_text'])) {
                echo __('User Data Access Request', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Email Placeholder', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_request][tgdprc_email_placeholder]" value="<?php
            if (isset($userdata_setting['data_request']['tgdprc_email_placeholder']) && !empty($userdata_setting['data_request']['tgdprc_email_placeholder'])) {
                echo esc_attr($userdata_setting['data_request']['tgdprc_email_placeholder']);
            } else if (!isset($userdata_setting['data_request']['tgdprc_email_placeholder'])) {
                echo __('Your email address Used in this site', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Consent Checkbox Placeholder', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_request][checkbox_consent_label]" value="<?php
            if (isset($userdata_setting['data_request']['checkbox_consent_label']) && !empty($userdata_setting['data_request']['checkbox_consent_label'])) {
                echo esc_attr($userdata_setting['data_request']['checkbox_consent_label']);
            } else if (!isset($userdata_setting['data_request']['checkbox_consent_label'])) {
                echo __('I give consent to store my email address.', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_checkbox_wrap">
            <label><?php esc_attr_e('Consent Accepted by Default', TGDPRCL_DOMAIN) ?></label>
            <input type="checkbox" name="userdata_setting[data_request][checked_by_default]" value="1" <?php
            if (isset($userdata_setting['data_request']['checked_by_default']) && $userdata_setting['data_request']['checked_by_default'] == 1) {
                echo 'checked="checked"';
            }
            ?> class="tgdprc-bulb-switch" id="tgdprc-consent-request-checked-default">
            <label for="tgdprc-consent-request-checked-default"></label>
            <p class="tgdprc-description"><?php echo __('If checked, consent checkbox will be checked by default.', TGDPRCL_DOMAIN); ?></p>	
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Submission Message', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_request][submission_message]" value="<?php
            if (isset($userdata_setting['data_request']['submission_message']) && !empty($userdata_setting['data_request']['submission_message'])) {
                echo esc_attr($userdata_setting['data_request']['submission_message']);
            } else if (!isset($userdata_setting['data_request']['submission_message'])) {
                echo __('Thank you. You will be Notified soon through email.', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Already Submitted Message', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_request][already_submitted_message]" value="<?php
            if (isset($userdata_setting['data_request']['already_submitted_message']) && !empty($userdata_setting['data_request']['already_submitted_message'])) {
                echo esc_attr($userdata_setting['data_request']['already_submitted_message']);
            } else if (!isset($userdata_setting['data_request']['already_submitted_message'])) {
                echo __('Email already entered for query.', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Error Message', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_request][error_message]" value="<?php
            if (isset($userdata_setting['data_request']['error_message']) && !empty($userdata_setting['data_request']['error_message'])) {
                echo esc_attr($userdata_setting['data_request']['error_message']);
            } else if (!isset($userdata_setting['data_request']['error_message'])) {
                echo __('Something wrong. Please try again', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Submit Button Text', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_request][submit_button_text]" value="<?php
            if (isset($userdata_setting['data_request']['submit_button_text']) && !empty($userdata_setting['data_request']['submit_button_text'])) {
                echo esc_attr($userdata_setting['data_request']['submit_button_text']);
            } else if (!isset($userdata_setting['data_request']['submit_button_text'])) {
                echo __('Submit', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_header">
            <h3><?php esc_attr_e('Admin Email Setting', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <div class="tgdprc_checkbox_wrap">
            <label><?php esc_attr_e('Enable Alert Admin', TGDPRCL_DOMAIN) ?></label>
            <input type="checkbox" name="userdata_setting[data_request][enable]" value="1" <?php
            if (isset($userdata_setting['data_request']['enable']) && $userdata_setting['data_request']['enable'] == 1) {
                echo 'checked="checked"';
            }
            ?> id="tgdprc_user_data_request_admin_alert_check">
            <label for="tgdprc_user_data_request_admin_alert_check"></label>
            <p class="tgdprc-description"><?php echo __('Please enable this checkbox to get alert on "User Data Access" request', TGDPRCL_DOMAIN); ?></p>	
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Reciever email', TGDPRCL_DOMAIN) ?></label>
            <input type="email" name="userdata_setting[data_request][reciever_email]" value="<?php
            if (isset($userdata_setting['data_request']['reciever_email']) && !empty($userdata_setting['data_request']['reciever_email'])) {
                echo esc_attr($userdata_setting['data_request']['reciever_email']);
            } else if (!isset($userdata_setting['data_request']['reciever_email'])) {
                echo get_option('admin_email');
            }
            ?>">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Email Header', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_request][email_header]" value="<?php
            if (isset($userdata_setting['data_request']['email_header']) && !empty($userdata_setting['data_request']['email_header'])) {
                echo esc_attr($userdata_setting['data_request']['email_header']);
            } else if (!isset($userdata_setting['data_request']['email_header'])) {
                echo __('Data Access Request [', TGDPRCL_DOMAIN) . get_option('blogname') . ']';
            }
            ?>">
        </div>
        <div class="tgdprc_more_info_action_options" id="wpcui_more_info_slideout_content">
            <div class="tgdprc_struct_settings_field">
                <label><?php esc_attr_e('Email Info Text', TGDPRCL_DOMAIN) ?></label>
                <?php
                $allowed_html = wp_kses_allowed_html('post');
                if (!empty($userdata_setting['data_request']['email_info_text'])) {
                    $content = wp_kses(stripslashes($userdata_setting['data_request']['email_info_text']), $allowed_html);
                } else if (!isset($userdata_setting['data_request']['email_info_text'])) {
                    $content = __('Hi there,
                        
You got Data Access Request at your site #sitename from #email.

Please visit site to view additional details.

Thank you', TGDPRCL_DOMAIN) . ' ' . get_option('blogname');
                } else {
                    $content = '';
                }
                $editor_id = 'wpcui_wp_data_request_email_in_settings';
                $settings = array(
                    'textarea_name' => 'userdata_setting[data_request][email_info_text]',
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
            <input type="text" name="userdata_setting[data_request][user_email_header]" value="<?php
            if (isset($userdata_setting['data_request']['user_email_header']) && !empty($userdata_setting['data_request']['user_email_header'])) {
                echo esc_attr($userdata_setting['data_request']['user_email_header']);
            } else if (!isset($userdata_setting['data_request']['user_email_header'])) {
                echo __('Data Request Results [', TGDPRCL_DOMAIN) . get_option('blogname') . ']';
            }
            ?>">
        </div>
        <div class="tgdprc_more_info_action_options" id="wpcui_more_info_slideout_content">
            <div class="tgdprc_struct_settings_field">
                <label><?php esc_attr_e('User Email Info Text', TGDPRCL_DOMAIN); ?></label>
                <?php
                $allowed_html = wp_kses_allowed_html('post');
                if (!empty($userdata_setting['data_request']['user_email_info_text'])) {
                    $content = wp_kses(stripslashes($userdata_setting['data_request']['user_email_info_text']), $allowed_html);
                } else if (!isset($userdata_setting['data_request']['user_email_info_text'])) {
                    $content = __('Hi there,
                        
Here is your data as per requested as requested from #sitename.

Please contact us to view additional details.

', TGDPRCL_DOMAIN);
                } else {
                    $content = '';
                }
                $editor_id = 'wpcui_wp_data_request_email_in_settings';
                $settings = array(
                    'textarea_name' => 'userdata_setting[data_request][user_email_info_text]',
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
        <h3><?php esc_attr_e('Data Access Requests', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <?php
    $tgdprc_data_access_request_data = get_option('tgdprc-data-access-request');
    $tgdprc_data_access_request = $tgdprc_data_access_request_data != false ? $tgdprc_data_access_request_data : array();
    $tgdprc_access_additional_data_array = get_option('tgdprc-access-additional-data');
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
            if (count($tgdprc_data_access_request) > 0) {
                foreach ($tgdprc_data_access_request as $tgdprc_data_access_req):
                    $return_access_data = $this->tgdprc_pull_related_array_access_userdata($tgdprc_data_access_req);
                    ?>
                    <tr>
                        <td><?php echo!empty($tgdprc_data_access_req) ? esc_attr($tgdprc_data_access_req) : ''; ?></td>
                        <td><?php echo isset($return_access_data['access_request_date']) && !empty($return_access_data['access_request_date']) ? date("F jS, Y h:i:s", strtotime(esc_attr($return_access_data['access_request_date']))) : ''; ?></td>
                        <td> <span class="<?php echo (isset($return_access_data['status']) && $return_access_data['status'] == 'email-not-send') || !isset($return_access_data['status']) ? 'tgdprc-email-not-sent-stat' : 'tgdprc-email-sent-stat'; ?>"><?php echo (isset($return_access_data['status']) && $return_access_data['status'] == 'email-not-send') || !isset($return_access_data['status']) ? __('Email Not Sent', TGDPRCL_DOMAIN) : __('Email Sent', TGDPRCL_DOMAIN); ?></span> </td>
                        <td><?php echo isset($return_access_data['email_sent_date']) && !empty($return_access_data['email_sent_date']) ? date("F jS, Y h:i:s", strtotime(esc_attr($return_access_data['email_sent_date']))) : ''; ?></td>
                        <td>
                            <div class="cookie_settings_options">
                                <a href="<?php echo admin_url("admin.php?page=tgdprcl-userdata&subpage=preview-user-data-logs&email_address=$tgdprc_data_access_req"); ?>" class="wpcui_preview_button"></a>
                                <a href="<?php echo admin_url("admin-post.php?action=tgdprc_send_email_with_userdata_to_user&email_address=$tgdprc_data_access_req&_wpnonce=$tgdprc_user_data_nonce"); ?>" onclick="return confirm('Do you want to send email to this selected user ?')" class="wpcui_edit_button"></a>
                                <a href="<?php echo admin_url("admin-post.php?action=delete_chosen_user_access_email&email_address=$tgdprc_data_access_req&_wpnonce=$tgdprc_user_data_nonce"); ?>" onclick="return confirm('Do you want to delete?')" class="tgdprc_delete_button"></a>
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

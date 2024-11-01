<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_struct_settings_wrap tgdprc-user-data-tabs-content" id="tgdprc-userdata-tabs-content-tgdprc-data-breach" style="display:none;">
    <div class="tgdprc_struct_settings_header">
        <h3><?php esc_attr_e('General Setting', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <div class="tgdprc_struct_settings_body">
        <div class="tgdprc_struct_settings_header">
            <h4>
                <?php esc_attr_e('You can sent mail in case of databreach to the user for displaying the form for user data request, rectification or forget anywhere in the site.', TGDPRCL_DOMAIN) ?>
            </h4> 
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Form Header', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="userdata_setting[data_breach][email_header]" value="<?php
            if (isset($userdata_setting['data_breach']['email_header']) && !empty($userdata_setting['data_breach']['email_header'])) {
                echo esc_attr($userdata_setting['data_breach']['email_header']);
            } else if (!isset($userdata_setting['data_breach']['email_header'])) {
                echo __('Data Breach Notice [', TGDPRCL_DOMAIN) . get_option('blogname') . ']';
            }
            ?>">
        </div>
        <div class="tgdprc_more_info_action_options" id="wpcui_more_info_slideout_content">
            <div class="tgdprc_struct_settings_field">
                <label><?php esc_attr_e('Email Info Text', TGDPRCL_DOMAIN) ?></label>
                <?php
                $allowed_html = wp_kses_allowed_html('post');
                if (!empty($userdata_setting['data_breach']['email_info_text'])) {
                    $content = wp_kses(stripslashes($userdata_setting['data_breach']['email_info_text']), $allowed_html);
                } else if (!isset($userdata_setting['data_breach']['email_info_text'])) {
                    $content = __('Hi there,
                        
We are writing this email to notify you that there was breach in our site.

Please contact us for additional details.

Thank you', TGDPRCL_DOMAIN) . ' ' . get_option('blogname');
                } else {
                    $content = '';
                }
                $editor_id = 'wpcui_wp_data_breach_email_in_settings';
                $settings = array(
                    'textarea_name' => 'userdata_setting[data_breach][email_info_text]',
                    'media_buttons' => false,
                    'editor_class' => 'wpcui_wp_editor_in_settings',
                    'editor_height' => 200
                );
                wp_editor($content, $editor_id, $settings);
                ?>
            </div>
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Pull Email From Following Services', TGDPRCL_DOMAIN) ?></label>
            <label>
                <input type="checkbox" name="userdata_setting[data_breach][pull_email_from_services][data_access_request]" value="access-data" <?php
                if (isset($userdata_setting['data_breach']['pull_email_from_services']['data_access_request']) && $userdata_setting['data_breach']['pull_email_from_services']['data_access_request'] == 'access-data') {
                    echo 'checked="checked"';
                }
                ?>><?php esc_attr_e('Data Access Request', TGDPRCL_DOMAIN); ?>
            </label>
            <label>
                <input type="checkbox" name="userdata_setting[data_breach][pull_email_from_services][data_rectification_request]" value="rectify-data" <?php
                if (isset($userdata_setting['data_breach']['pull_email_from_services']['data_rectification_request']) && $userdata_setting['data_breach']['pull_email_from_services']['data_rectification_request'] == 'rectify-data') {
                    echo 'checked="checked"';
                }
                ?>><?php esc_attr_e('Data Rectification Request', TGDPRCL_DOMAIN); ?>
            </label>
            <label>
                <input type="checkbox" name="userdata_setting[data_breach][pull_email_from_services][wp_user_data]" value="wp-user-data" <?php
                if (isset($userdata_setting['data_breach']['pull_email_from_services']['wp_user_data']) && $userdata_setting['data_breach']['pull_email_from_services']['wp_user_data'] == 'wp-user-data') {
                    echo 'checked="checked"';
                }
                ?>><?php esc_attr_e('WP User Data', TGDPRCL_DOMAIN); ?>
            </label>
            <label>
                <input type="checkbox" name="userdata_setting[data_breach][pull_email_from_services][woo_data]" value="woo-data" <?php
                if (isset($userdata_setting['data_breach']['pull_email_from_services']['woo_data']) && $userdata_setting['data_breach']['pull_email_from_services']['woo_data'] == 'woo-data') {
                    echo 'checked="checked"';
                }
                ?>><?php esc_attr_e('Woo Commerce Data', TGDPRCL_DOMAIN); ?>
            </label>
        </div>
    </div>
    <div class="tgdprc_struct_settings_header">
        <h3><?php esc_attr_e('Data Breach Emails to be Sent', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <?php
    $tgdprc_data_access_request_data = get_option('tgdprc-data-access-request');
    $tgdprc_data_access_request = $tgdprc_data_access_request_data != false ? $tgdprc_data_access_request_data : array();
    $tgdprc_data_rectify_request_data = get_option('tgdprc-data-rectification-request');
    $tgdprc_data_rectify_request = $tgdprc_data_rectify_request_data != false ? $tgdprc_data_rectify_request_data : array();
    ?>
    <table class="tgdprc-cookie-bar-display-table" cellspacing="0">
        <thead>
            <tr>
                <th><?php esc_attr_e('User Email', TGDPRCL_DOMAIN) ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($userdata_setting['data_breach']['pull_email_from_services']['data_access_request']) && $userdata_setting['data_breach']['pull_email_from_services']['data_access_request'] == 'access-data') {
                if (count($tgdprc_data_access_request) > 0) {
                    foreach ($tgdprc_data_access_request as $tgdprc_data_access_req):
                        ?>
                        <tr>
                            <td><?php echo!empty($tgdprc_data_access_req) ? esc_attr($tgdprc_data_access_req) : ''; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php
                }
            }
            ?>
            <?php
            if (isset($userdata_setting['data_breach']['pull_email_from_services']['data_rectification_request']) && $userdata_setting['data_breach']['pull_email_from_services']['data_rectification_request'] == 'rectify-data') {
                if (count($tgdprc_data_rectify_request) > 0) {
                    foreach ($tgdprc_data_rectify_request as $tgdprc_data_rectify_request):
                        ?>
                        <tr>
                            <td><?php echo!empty($tgdprc_data_rectify_request) ? esc_attr($tgdprc_data_rectify_request) : ''; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php
                }
            }
            ?>
            <?php
            if (isset($userdata_setting['data_breach']['pull_email_from_services']['wp_user_data']) && $userdata_setting['data_breach']['pull_email_from_services']['wp_user_data'] == 'wp-user-data') {
                global $wpdb;
                $results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "users");
                if (!empty($results)) {
                    foreach ($results as $key => $val) {
                        if ($key == 'user_email'):
                            ?>
                            <tr>
                                <td><?php echo sanitize_email($val); ?></td>
                            </tr>
                            <?php
                        endif;
                    }
                }
            }
            ?>
            <?php
            if (isset($userdata_setting['data_breach']['pull_email_from_services']['woo_data']) && $userdata_setting['data_breach']['pull_email_from_services']['woo_data'] == 'woo-data') {
                global $wpdb;
                $results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "usermeta WHERE meta_key = 'billing_email'");
                if (!empty($results)) {
                    foreach ($results as $key => $val) {
                        if ($key == 'meta_value'):
                            ?>
                            <tr>
                                <td><?php echo sanitize_email($val); ?></td>
                            </tr>
                            <?php
                        endif;
                    }
                }
            }

            /** Empty Table */
            if (!isset($userdata_setting['data_breach']['pull_email_from_services']['woo_data']) && !isset($userdata_setting['data_breach']['pull_email_from_services']['wp_user_data']) && !isset($userdata_setting['data_breach']['pull_email_from_services']['data_rectification_request']) && !isset($userdata_setting['data_breach']['pull_email_from_services']['data_access_request'])) {
                ?><tr>
                    <td><?php echo __('No Email to Show.',TGDPRCL_DOMAIN); ?></td>
                </tr>
            <?php }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th><?php esc_attr_e('User Email', TGDPRCL_DOMAIN); ?></th>
            </tr>
        </tfoot>
    </table>
    <p><a href="<?php echo admin_url("admin-post.php?action=tgdprc_send_breach_email_to_user&_wpnonce=$tgdprc_user_data_nonce"); ?>" onclick="return confirm('Do you want to send email to all listed emails ?')" class="button button-primary"><?php esc_attr_e('Send Mail To all listed Email', TGDPRCL_DOMAIN) ?></a></p>
    <p><?php echo __('If user email repeats, repeated email will be skipped and email to others will be sent.', TGDPRCL_DOMAIN); ?></p>
</div>
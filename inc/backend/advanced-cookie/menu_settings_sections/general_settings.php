<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_struct_settings_wrap">
    <div class="tgdprc_struct_settings_header">
        <h3><?php esc_attr_e('General Settings', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <div class="tgdprc_struct_settings_body">
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Enable Advanced Cookie Setting', TGDPRCL_DOMAIN) ?></label>
            <div class="tgdprc_checkbox_wrap">
                <input type="checkbox" class="tgdprc-bulb-switch" name="advanced_cookie_settings[general][enable_advanced_cookie_setting]" value="1" <?php
                if (isset($advanced_cookie_settings['general']['enable_advanced_cookie_setting']) && $advanced_cookie_settings['general']['enable_advanced_cookie_setting'] == 1) {
                    echo 'checked="checked"';
                }
                ?> id="advanced_cookie_genral_enable_advanced_cookie">
                <label for="advanced_cookie_genral_enable_advanced_cookie"></label>
            </div>
            <i class="additional_field_message"><?php echo __('Please enable this checkbox to use "Advanced Cookie Setting"', TGDPRCL_DOMAIN); ?></i>	
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Header Info Title', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="advanced_cookie_settings[general][header_info_title]" value="<?php
            if (isset($advanced_cookie_settings['general']['header_info_title']) && !empty($advanced_cookie_settings['general']['header_info_title'])) {
                echo esc_attr($advanced_cookie_settings['general']['header_info_title']);
            } else if (!isset($advanced_cookie_settings['general']['header_info_title'])) {
                echo __('Advanced Cookie Settings', TGDPRCL_DOMAIN);
            }
            ?>">
        </div>
        <div class="tgdprc_more_info_action_options">
            <div class="tgdprc_struct_settings_field">
                <label><?php esc_attr_e('Header Info Text', TGDPRCL_DOMAIN) ?></label>
                <?php
                $allowed_html = wp_kses_allowed_html('post');
                if (!empty($advanced_cookie_settings['general']['header_info_text'])) {
                    $content = wp_kses(stripslashes($advanced_cookie_settings['general']['header_info_text']), $allowed_html);
                } else if (!isset($advanced_cookie_settings['general']['header_info_text'])) {
                    $content = __('You can configure the cookie preference settings from here any time. To understand the cookies and functionality, please read our related document carefully.', TGDPRCL_DOMAIN);
                } else {
                    $content = '';
                }
                $editor_id = 'wpcui_wp_more_info_editor_in_settings';
                $settings = array(
                    'textarea_name' => 'advanced_cookie_settings[general][header_info_text]',
                    'media_buttons' => false,
                    'editor_class' => 'wpcui_wp_editor_in_settings',
                    'editor_height' => 200
                );
                wp_editor($content, $editor_id, $settings);
                ?>
                <i class="additional_field_message"><?php echo __('You can use basic HTML Tags such as', TGDPRCL_DOMAIN); ?> &lt;a&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;br&gt;</i>	
            </div>
        </div>
        <?php ?>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Cookie Setting Sub Header', TGDPRCL_DOMAIN) ?></label>
            <div class="tgdprc_checkbox_wrap">
                <textarea cols="79" rows="5" name="advanced_cookie_settings[general][setting_controller_header_text]"><?php
                    if (isset($advanced_cookie_settings['general']['setting_controller_header_text']) && !empty($advanced_cookie_settings['general']['setting_controller_header_text'])) {
                        echo esc_attr($advanced_cookie_settings['general']['setting_controller_header_text']);
                    } else if (!isset($advanced_cookie_settings['general']['setting_controller_header_text'])) {
                        echo __('You can configure different types of cookies as follows', TGDPRCL_DOMAIN);
                    }
                    ?></textarea>
            </div>
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Save and Close Button Text', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="advanced_cookie_settings[general][save_and_close_button_text]" value="<?php echo (isset($advanced_cookie_settings['general']['save_and_close_button_text']) && !empty($advanced_cookie_settings['general']['save_and_close_button_text'])) ? esc_attr($advanced_cookie_settings['general']['save_and_close_button_text']) : esc_attr__('Save Cookie Preference', TGDPRCL_DOMAIN); ?>"/>
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Form Submission Success Message', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="advanced_cookie_settings[general][form_submitted_success_message]" value="<?php echo (isset($advanced_cookie_settings['general']['save_and_close_button_text']) && !empty($advanced_cookie_settings['general']['form_submitted_success_message'])) ? esc_attr($advanced_cookie_settings['general']['form_submitted_success_message']) : esc_attr__('Cookie Preference Stored', TGDPRCL_DOMAIN); ?>"/>
        </div>
        <div class="tgdprc_more_info_action_options">
            <div class="tgdprc_struct_settings_field">
                <label>
                    <?php esc_attr_e('View All Consent Log', TGDPRCL_DOMAIN) ?>
                </label>
                <a href="<?php echo admin_url('admin.php') . '?page=tgdprcl-advance-cookies&subpage=view-consent-logs'; ?>">
                    <button type="button" class="tgdprc-view-consent-logs button button-primary"><?php esc_attr_e('View All Consent Logs', TGDPRCL_DOMAIN); ?></button>
                </a>
            </div>
        </div>
    </div>
</div>
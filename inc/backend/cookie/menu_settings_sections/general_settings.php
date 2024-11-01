<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_struct_settings_wrap">

    <div class="tgdprc_struct_settings_header">
        <h3><?php esc_attr_e('Cookie Settings', TGDPRCL_DOMAIN); ?></h3>
    </div>

    <?php
    //To fill in the options in the form
    $options = get_option('tgdprc_general_option');
    ?>

    <div class="tgdprc_struct_settings_body">

        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Title Text', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="general_settings[content][info][title_text]" value="<?php echo!empty($general_settings['content']['info']['title_text']) ? esc_attr($general_settings['content']['info']['title_text']) : '' ?>">
        </div>

        <!-- Cookie Info Text or General Text notice is shown in cookie bar -->
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('General Text', TGDPRCL_DOMAIN) ?></label>

            <?php
            $allowed_html = wp_kses_allowed_html('post');
            $general_value = (($result_status) && (!empty($general_settings['content']['info']['general_text']))) ? ($general_settings['content']['info']['general_text']) : esc_attr__('This site uses cookies to function smoothly. And so our website can remember your preferences.', TGDPRCL_DOMAIN);
            $content = wp_kses(stripslashes($general_value), $allowed_html);
            $editor_id = 'wpcui_wp_editor_in_settings';
            $settings = array(
                'textarea_name' => 'general_settings[content][info][general_text]',
                'media_buttons' => false,
                'editor_class' => 'wpcui_wp_editor_in_settings',
                'editor_height' => 200,
                    // 'quicktags'		=> array('buttons'=>'a,b,i,strong,em,ul,ol,li'),
            );
            wp_editor($content, $editor_id, $settings);
            ?>
            <i class="additional_field_message"><?php echo __('You can use basic HTML Tags such as', TGDPRCL_DOMAIN); ?> &lt;a&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;br&gt; <?php echo __('and so on', TGDPRCL_DOMAIN); ?></i>	
        </div>

        <!-- Info dismiss text Agreeing to the cookie notice is confirmation text -->
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Confirmation Text', TGDPRCL_DOMAIN) ?></label>
            <textarea name="general_settings[content][info][confirmation_text]" cols="79" rows="5"><?php echo (($result_status) && !empty($general_settings['content']['info']['confirmation_text'])) ? esc_attr($general_settings['content']['info']['confirmation_text']) : esc_attr__('Got it', TGDPRCL_DOMAIN); ?></textarea>		
        </div>

        <!-- Enable or Disable the close button -->
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Close Button', TGDPRCL_DOMAIN) ?></label>
            <div class="tgdprc_checkbox_wrap">
                <input type="checkbox" name="general_settings[content][info][close_button]" <?php echo isset($result_status) && isset($general_settings['content']['info']['close_button']) ? "checked='checked'" : ''; ?> id="wpcui_close_button_status" >
                <label for="wpcui_close_button_status"></label>
            </div>
        </div>

        <div class="tgdprc_struct_settings_field">
            <label><?php _e('More Info Status', TGDPRCL_DOMAIN) ?></label>
            <div class="tgdprc_checkbox_wrap">
                <input class="tgdprc-bulb-switch" type="checkbox" name="general_settings[content][more_info][status]"
                <?php
                if (($result_status) && isset($general_settings['content']['more_info']['status'])) {
                    echo "checked='checked'";
                }
                ?>
                       id="wpcui_more_info_status"
                       >
                <label for="wpcui_more_info_status"></label>
            </div>
        </div>

        <div class="tgdprc-bulb-light" style="display: none;">
            <!-- What text to show in more info notice -->
            <div class="tgdprc_struct_settings_field">
                <label><?php esc_attr_e('More Info Text', TGDPRCL_DOMAIN) ?></label>
                <textarea name="general_settings[content][more_info][text]" cols="79" rows="5"><?php echo (($result_status) && !empty($general_settings['content']['more_info']['text'])) ? esc_attr($general_settings['content']['more_info']['text']) : esc_attr__('More Info', TGDPRCL_DOMAIN); ?></textarea>
            </div>

            <div class="tgdprc_struct_settings_field">
                <label><?php esc_attr_e('More Info Action', TGDPRCL_DOMAIN) ?></label>
                <select name="general_settings[content][more_info][action]" id="wpcui_more_info_action_selector">
                    <?php foreach ($options['more_info_action'] as $index => $value): ?>
                        <option value="<?php echo $value; ?>"

                                <?php
                                if (isset($general_settings['content']['more_info']['action']) && $general_settings['content']['more_info']['action'] == $value) {
                                    echo "selected='selected'";
                                }
                                ?>
                                ><?php echo ucwords(esc_attr($value)); ?></option>
                            <?php endforeach ?>
                </select>
            </div>


            <div class="tgdprc_more_info_action_options" id="wpcui_more_info_page_redirect">

                <!-- Link to redirect to -->
                <div class="tgdprc_struct_settings_field">
                    <label><?php esc_attr_e('More Info Redirect Link', TGDPRCL_DOMAIN) ?></label>
                    <input name="general_settings[content][more_info][link]" class="regular-text" type="text" name="" value="<?php echo (($result_status) && !empty($general_settings['content']['more_info']['link'])) ? esc_attr($general_settings['content']['more_info']['link']) : get_site_url() . '/privacy-policy'; ?>">
                </div>

                <!-- Link target -->
                <div class="tgdprc_struct_settings_field">
                    <label><?php esc_attr_e('Link Target', TGDPRCL_DOMAIN) ?></label>
                    <select name="general_settings[content][more_info][link_target]">
                        <?php foreach ($options['link_target'] as $index => $value): ?>
                            <option

                                value="<?php echo esc_attr($value); ?>"

                                <?php
                                if (($result_status) && isset($general_settings['content']['more_info']['link_target']) && $general_settings['content']['more_info']['link_target'] == $value) {
                                    echo "selected='selected'";
                                }
                                ?>

                                ><?php echo ucwords(esc_attr($value)); ?></option>
                            <?php endforeach ?>
                    </select>
                </div>
            </div>


            <div class="tgdprc_more_info_action_options" id="wpcui_more_info_slideout_content">
                <!-- More Display Info Text or More Info Text notice is shown in cookie bar on More Info button clicked -->
                <div class="tgdprc_struct_settings_field">
                    <label><?php esc_attr_e('Slide out Content Text', TGDPRCL_DOMAIN) ?></label>
                    <?php
                    $allowed_html = wp_kses_allowed_html('post');
                    $content = (!empty($general_settings['content']['more_info']['slide_text'])) ? wp_kses(stripslashes($general_settings['content']['more_info']['slide_text']), $allowed_html) : esc_attr__('Cookies is a small file used and stored by your browser', TGDPRCL_DOMAIN);
                    $editor_id = 'wpcui_wp_more_info_content_text_editor_in_settings';
                    $settings = array(
                        'textarea_name' => 'general_settings[content][more_info][slide_text]',
                        'media_buttons' => true,
                        'editor_class' => 'wpcui_wp_editor_in_settings',
                        'editor_height' => 200
                    );
                    wp_editor($content, $editor_id, $settings);
                    ?>

                    <i class="additional_field_message"><?php echo __('You can use basic HTML Tags such as', TGDPRCL_DOMAIN); ?> &lt;a&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;br&gt; <?php echo __('and so on', TGDPRCL_DOMAIN); ?></i>	
                </div>
            </div>	


        </div>

    </div>
</div>
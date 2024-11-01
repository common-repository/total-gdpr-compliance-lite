<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<?php
$tgdprc_global_value_array = $this->global_default_values_array_call();
$default_custom_cookie_category_array = $tgdprc_global_value_array['default_custom_cookie_category_array'];
$advancedcookie_default_excluded_array = $tgdprc_global_value_array['advancedcookie_default_excluded_array'];
?>

<div class="tgdprc_design_settings_wrap" style="display: none;" >
    <div class="tgdprc_struct_settings_header">
        <h3><?php esc_attr_e('Content Settings', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <div class="tgdprc_struct_settings_field">
        <label><?php esc_attr_e('What It Do: Text', TGDPRCL_DOMAIN) ?></label>
        <input type="text" name="advanced_cookie_settings[general][what_it_store_text]" value="<?php
        if (isset($advanced_cookie_settings['general']['what_it_store_text']) && !empty($advanced_cookie_settings['general']['what_it_store_text'])) {
            echo esc_attr($advanced_cookie_settings['general']['what_it_store_text']);
        } else if (!isset($advanced_cookie_settings['general']['what_it_store_text'])) {
            echo __('What It Do', TGDPRCL_DOMAIN);
        }
        ?>">
    </div>
    <div class="tgdprc_struct_settings_field">
        <label><?php esc_attr_e('What It Won\'t Do: Text', TGDPRCL_DOMAIN) ?></label>
        <input type="text" name="advanced_cookie_settings[general][what_it_wont_store_text]" value="<?php
        if (isset($advanced_cookie_settings['general']['what_it_wont_store_text']) && !empty($advanced_cookie_settings['general']['what_it_wont_store_text'])) {
            echo esc_attr($advanced_cookie_settings['general']['what_it_wont_store_text']);
        } else if (!isset($advanced_cookie_settings['general']['what_it_wont_store_text'])) {
            echo __('What It Won\'t Do', TGDPRCL_DOMAIN);
        }
        ?>">
    </div>
    <div class="tgdprc_struct_settings_field">
        <label><?php esc_attr_e('Block All: Text', TGDPRCL_DOMAIN) ?></label>
        <input type="text" name="advanced_cookie_settings[general][block_all_text]" value="<?php
        if (isset($advanced_cookie_settings['general']['block_all_text']) && !empty($advanced_cookie_settings['general']['block_all_text'])) {
            echo esc_attr($advanced_cookie_settings['general']['block_all_text']);
        } else if (!isset($advanced_cookie_settings['general']['block_all_text'])) {
            echo __('Block All', TGDPRCL_DOMAIN);
        }
        ?>">
    </div>
    <?php
    $field_array_count = 0;
    foreach ($default_custom_cookie_category_array as $key => $val) {
        ?> 
        <div class="tgdprc_struct_settings_body tgdprc-open-field-div">
            <div class="tgdprc_adv_cookie_settings_ind_head_wrap">
                <div class="tgdprc_adv_cookie_settings_ind_head_inn_wrap">
                    <h3 class="tgdprc-adv-cookie-indv-cookie-setting-title <?php echo isset($advanced_cookie_settings['content_setting'][$key]['disable']) ? 'tgdprc-inactive-category-class' : 'tgdprc-active-category-class'; ?>">
                        <?php
                        if (isset($advanced_cookie_settings[$key]['setting_display_header']) && !empty($advanced_cookie_settings[$key]['setting_display_header'])) {
                            echo esc_attr($advanced_cookie_settings[$key]['setting_display_header']);
                        } else if (!isset($advanced_cookie_settings[$key]['setting_display_header']) || empty($advanced_cookie_settings[$key]['setting_display_header'])) {
                            echo $val;
                        } else {
                            echo __('Undefined Category Header', TGDPRCL_DOMAIN);
                        }
                        ?>
                    </h3>
                    <span class="tgdprc_struct_settings_head-trigger"><i class="fa <?php echo isset($field_array_count) && $field_array_count == 0 ? 'fa-sort-up' : 'fa-sort-down'; ?>"></i></span>
                </div>
            </div>
            <div class="tgdprc_struct_settings_body_inner" id="tgdprc_struct_settings_body_inner-<?php echo $key; ?>" <?php echo isset($field_array_count) && $field_array_count == 0 ? 'style="display:block"' : 'style="display:none"'; ?>>
                <div class="tgdprc_struct_settings_field-wrap">
                    <div class="tgdprc_checkbox_wrap">
                        <label><?php esc_attr_e('Disable This Section', TGDPRCL_DOMAIN) ?></label>
                        <input type="checkbox" name="advanced_cookie_settings[content_setting][<?php echo $key; ?>][disable]" class="tgdprc-bulb-switch" value="1" <?php echo isset($advanced_cookie_settings['content_setting'][$key]['disable']) ? 'checked="checked"' : ''; ?> id="tgdprc_protected_content_setting_<?php echo $key; ?>">
                        <label for="tgdprc_protected_content_setting_<?php echo $key; ?>"></label>
                        <p class="tgdprc-description"><?php echo __('If checked, this content will be hidden in front.', TGDPRCL_DOMAIN); ?></p>
                    </div>
                    <div class="tgdprc_struct_settings_field">
                        <label><?php esc_attr_e('Setting Display Text', TGDPRCL_DOMAIN) ?></label>
                        <input type="text" id="tgdprc-advanced-cookie-indv-title" name="advanced_cookie_settings[<?php echo $key; ?>][setting_display_header]" value="<?php
                        if (isset($advanced_cookie_settings[$key]['setting_display_header']) && !empty($advanced_cookie_settings[$key]['setting_display_header'])) {
                            echo esc_attr($advanced_cookie_settings[$key]['setting_display_header']);
                        }
                        ?>">
                    </div>
                    <div class="tgdprc_struct_settings_field">
                        <label><?php esc_attr_e('Header Info Title', TGDPRCL_DOMAIN) ?></label>
                        <input type="text" name="advanced_cookie_settings[<?php echo $key; ?>][header_info_title]" value="<?php
                        if (isset($advanced_cookie_settings[$key]['header_info_title']) && !empty($advanced_cookie_settings[$key]['header_info_title'])) {
                            echo esc_attr($advanced_cookie_settings[$key]['header_info_title']);
                        } else if (!isset($advanced_cookie_settings[$key]['header_info_title'])) {
                            echo __('About', TGDPRCL_DOMAIN);
                        }
                        ?>">
                    </div>
                    <div class="tgdprc_struct_settings_field">
                        <label><?php esc_attr_e('Info Text', TGDPRCL_DOMAIN) ?></label>
                        <?php
                        $allowed_html = wp_kses_allowed_html('post');
                        if (!empty($advanced_cookie_settings[$key]['basic_info_text'])) {
                            $content = wp_kses(stripslashes($advanced_cookie_settings[$key]['basic_info_text']), $allowed_html);
                        } else if (!isset($advanced_cookie_settings[$key]['basic_info_text'])) {
                            switch ($key) {
                                case 'necessary':
                                    $content = __('These are the cookies for the normal running and proper functionality of our websites.', TGDPRCL_DOMAIN);
                                    break;
                                case 'analytics':
                                    $content = __('These are the cookies in order to evaluate your use of the website and compile reports on activity on the site', TGDPRCL_DOMAIN);
                                    break;
                                case 'advertisement':
                                    $content = __('These are the cookies that different companies like Facebook, Google or any other advertising platforms to show relevant ads based on your recent search queries.', TGDPRCL_DOMAIN);
                                    break;
                                default:
                                    break;
                            }
                        } else {
                            $content = '';
                        }
                        $editor_id = 'basic_info_text_' . $key . '_';
                        $settings = array(
                            'textarea_name' => 'advanced_cookie_settings[' . $key . '][basic_info_text]',
                            'media_buttons' => false,
                            'editor_class' => 'wpcui_wp_editor_in_settings',
                            'editor_height' => 200
                        );
                        wp_editor($content, $editor_id, $settings);
                        ?>
                        <i class="additional_field_message"><?php echo __('You can use basic HTML Tags such as', TGDPRCL_DOMAIN); ?> &lt;a&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;br&gt; </i>	
                    </div>
                    <div class="tgdprc_more_info_action_options">
                        <div class="tgdprc_struct_settings_field">
                            <label><?php esc_attr_e('What It Do', TGDPRCL_DOMAIN) ?></label>
                            <?php
                            $allowed_html = wp_kses_allowed_html('post');
                            if (!empty($advanced_cookie_settings[$key]['what_it_store'])) {
                                $content = wp_kses(stripslashes($advanced_cookie_settings[$key]['what_it_store']), $allowed_html);
                            } else if (!isset($advanced_cookie_settings[$key]['what_it_store'])) {
                                switch ($key) {
                                    case 'necessary':
                                        $content = __('Remember your cookie permission setting.
Allow session cookies.
Gather information from newsletter and other forms.
Keep track of what you input in a shopping cart.', TGDPRCL_DOMAIN);
                                        break;
                                    case 'analytics':
                                        $content = __('Keep track of the time spent on each page.
Increase the data quality of the statistics functions.', TGDPRCL_DOMAIN);
                                        break;
                                    case 'advertisement':
                                        $content = __('Tailor information and advertising to your interests base.
Gather personal identity info like public name or location.', TGDPRCL_DOMAIN);
                                        break;
                                    default:
                                        break;
                                }
                            } else {
                                $content = '';
                            }
                            $editor_id = 'what_it_store_' . $key . '_';
                            $settings = array(
                                'textarea_name' => 'advanced_cookie_settings[' . $key . '][what_it_store]',
                                'media_buttons' => false,
                                'editor_class' => 'wpcui_wp_editor_in_settings',
                                'editor_height' => 200
                            );
                            wp_editor($content, $editor_id, $settings);
                            ?>
                            <i class="additional_field_message"><?php echo __('Please insert one sentence per row for individual list', TGDPRCL_DOMAIN); ?></i>
                        </div>
                    </div>
                    <div class="tgdprc_more_info_action_options">
                        <div class="tgdprc_struct_settings_field">
                            <label>
                                <?php esc_attr_e('What It Won\'t Do', TGDPRCL_DOMAIN) ?>
                            </label>
                            <?php
                            $allowed_html = wp_kses_allowed_html('post');
                            if (!empty($advanced_cookie_settings[$key]['what_it_wont_store'])) {
                                $content = wp_kses(stripslashes($advanced_cookie_settings[$key]['what_it_wont_store']), $allowed_html);
                            } else if (!isset($advanced_cookie_settings[$key]['what_it_wont_store'])) {
                                switch ($key) {
                                    case 'necessary':
                                        $content = __('Remember your login details.
Remember social media settings.', TGDPRCL_DOMAIN);
                                        break;
                                    case 'analytics':
                                        $content = __('Remember any of you personal details.', TGDPRCL_DOMAIN);
                                        break;
                                    case 'advertisement':
                                        $content = __('Remember any of you private user info.', TGDPRCL_DOMAIN);
                                        break;
                                    default:
                                        break;
                                }
                            } else {
                                $content = '';
                            }
                            $editor_id = 'what_it_wont_store_' . $key . '_';
                            $settings = array(
                                'textarea_name' => 'advanced_cookie_settings[' . $key . '][what_it_wont_store]',
                                'media_buttons' => false,
                                'editor_class' => 'wpcui_wp_editor_in_settings',
                                'editor_height' => 200
                            );
                            wp_editor($content, $editor_id, $settings);
                            ?>
                            <i class="additional_field_message"><?php echo __('Please insert one sentence per row for individual list', TGDPRCL_DOMAIN); ?></i>
                        </div>
                    </div>
                    <?php if (!in_array($key, $advancedcookie_default_excluded_array)) { ?>
                        <div class="tgdprc-field-remove">
                            <a href="#" class="tgdprc-remove-custom-category"><?php _e('Remove', TGDPRCL_DOMAIN); ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        $field_array_count++;
    }
    ?>
    <div class="tgdprc-add-new-category-button">
        <div class="tgdprc-custom-cookie-category-holder" style="display:none;"></div>
        <div class="tgdprc-custom-cookie-category-field">

        </div>
    </div>
    <?php
    ?>

    <div class="tgdprc-add-new-category-button">
        <?php
        $max_key = isset($keyArray) && !empty($keyArray) ? array_keys($keyArray, max($keyArray)) : array('0' => '0');
        $nonce_data = wp_create_nonce('tgdprc_add_Custom_cookie_category_nonce');
        ?>
        <input type="hidden" name="menu_count" value="<?php echo $max_key[0]; ?>" class="tgdprc-custom-cookie-category-count"/>
        <input type="hidden" id="tgdprc_advanced_cookie_category_nonce" value="<?php echo $nonce_data ?>">
        <span class="tgdprc-view-wrap" style="display:none;"><img src="<?php echo TGDPRCL_IMAGE . 'tgdprc-loader.gif'; ?>"/></span>
    </div>
</div>
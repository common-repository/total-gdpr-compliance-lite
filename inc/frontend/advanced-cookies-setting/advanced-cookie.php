<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<?php
global $wpdb, $wp;

$tgdprc_table_name = $wpdb->prefix . 'tgdprc_consent_log';
$current_url = home_url(add_query_arg(array(), $wp->request));
$tgdprc_browser_ip = $this->tgdprc_getip();
$advanced_cookie_settings['advanced'] = get_option('tgdprc-advanced-cookie-settings');
$allowed_html = wp_kses_allowed_html('post');

$tgdprc_result = $wpdb->get_row("SELECT * FROM $tgdprc_table_name WHERE browser_ip = '$tgdprc_browser_ip'");
$tgdprc_consent_log_details = isset($tgdprc_result) && !empty($tgdprc_result) ? maybe_unserialize($tgdprc_result->consent_log_details) : array();
$tgdprc_consent_log_values_arr = isset($tgdprc_result) && !empty($tgdprc_result) ? array_map('esc_attr', $tgdprc_consent_log_details['consent_values']) : array();
$all_Services = $this->pull_services_cookies_for_block_function();

$tgdprc_global_value_array = $this->global_default_values_array_call();
$default_custom_cookie_category_array = $tgdprc_global_value_array['default_custom_cookie_category_array'];
$advancedcookie_default_excluded_array = $tgdprc_global_value_array['advancedcookie_default_excluded_array'];
if (isset($advanced_cookie_settings['advanced']) && !empty($advanced_cookie_settings['advanced'])) {
    foreach ($advanced_cookie_settings['advanced'] as $key => $val) {
        if (!in_array($key, $advancedcookie_default_excluded_array)) {
            $default_custom_cookie_category_array[$key] = isset($val['setting_display_header']) && !empty($val['setting_display_header']) ? $val['setting_display_header'] : __('Undefined Category Header', TGDPRCL_DOMAIN); //array_push key into the $default_custom_cookie_category_array
        }
    }
} else {
    $default_custom_cookie_category_array = $default_custom_cookie_category_array;
}

if (isset($advanced_cookie_settings['advanced']['general']['enable_advanced_cookie_setting']) && $advanced_cookie_settings['advanced']['general']['enable_advanced_cookie_setting'] == 1) {
    if (isset($advanced_cookie_settings['advanced']['additional']['design_type']) && $advanced_cookie_settings['advanced']['additional']['design_type'] == 'custom') {
        ?>
        <style>
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['header_info_text_color']) && !empty($advanced_cookie_settings['advanced']['additional']['header_info_text_color'])) {
            ?>
                .tgdprc-advanced-cookies-setting-wrap .tgdprc-advanced-cookies-main-header h3{
            <?php echo 'color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['header_info_text_color']) . ';'; ?>
                }
            <?php
        }
        ?>
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['primary_text_color']) && !empty($advanced_cookie_settings['advanced']['additional']['primary_text_color'])) {
            ?>
                .tgdprc-advanced-cookies-setting-wrap .tgdprc-advanced-cookies-main-description{
            <?php echo 'color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['primary_text_color']) . ';'; ?>
                }
            <?php
        }
        ?>
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['secondary_text_color']) && !empty($advanced_cookie_settings['advanced']['additional']['secondary_text_color'])) {
            ?>
                .tgdprc-advanced-cookies-setting-wrap .tgdprc-advanced-cookies-secondary-header{
            <?php echo 'color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['secondary_text_color']) . ';'; ?>
                }
            <?php
        }
        ?>
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['other_text_color']) && !empty($advanced_cookie_settings['advanced']['additional']['other_text_color'])) {
            ?>
                .tgdprc-advanced-cookies-setting-wrap .tgdprc-first-row label{
            <?php echo 'color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['other_text_color']) . ';'; ?>
                }
            <?php
        }
        ?>
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['cookie_type_title_text_color']) && !empty($advanced_cookie_settings['advanced']['additional']['cookie_type_title_text_color'])) {
            ?>
                .tgdprc-advanced-cookies-setting-wrap .tgdprc-advanced-cookies-main-header h5{
            <?php echo 'color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['cookie_type_title_text_color']) . ';'; ?>
                }
            <?php
        }
        ?>
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['cookie_type_description_text_color']) && !empty($advanced_cookie_settings['advanced']['additional']['cookie_type_description_text_color'])) {
            ?>
                .tgdprc-advanced-cookies-setting-wrap .tgdprc-cookie-info-description p{
            <?php echo 'color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['cookie_type_description_text_color']) . ';'; ?>
                }
            <?php
        }
        ?>        
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['cookie_type_list_header_text_color']) && !empty($advanced_cookie_settings['advanced']['additional']['cookie_type_list_header_text_color'])) {
            ?>
                .tgdprc-advanced-cookies-setting-wrap .tgdprc-description-will-do p,
                .tgdprc-advanced-cookies-setting-wrap .tgdprc-description-wont-do p{
            <?php echo 'color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['cookie_type_list_header_text_color']) . ';'; ?>
                }
            <?php
        }
        ?>
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['what_it_do_text_color']) && !empty($advanced_cookie_settings['advanced']['additional']['what_it_do_text_color'])) {
            ?>
                .tgdprc-advanced-cookies-setting-wrap .tgdprc-description-will-do ul li
                {
            <?php echo 'color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['what_it_do_text_color']) . ';'; ?>
                }
            <?php
        }
        ?>
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['what_it_wont_do_text_color']) && !empty($advanced_cookie_settings['advanced']['additional']['what_it_wont_do_text_color'])) {
            ?>
                .tgdprc-advanced-cookies-setting-wrap .tgdprc-description-wont-do ul li
                {
            <?php echo 'color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['what_it_wont_do_text_color']) . ';'; ?>
                }
            <?php
        }
        ?>
                                                                                                                                                                                                                                                                                                                                                                                
            .tgdprc-advanced-cookies-setting-wrap #tgdprc-advanced-cookie-acceptance-button{
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['button_text_color']) && !empty($advanced_cookie_settings['advanced']['additional']['button_text_color'])) {
            echo 'color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['button_text_color']) . ';';
        }
        ?>
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['button_bg_color']) && !empty($advanced_cookie_settings['advanced']['additional']['button_bg_color'])) {
            echo 'background-color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['button_bg_color']) . ';';
        }
        ?>
            }
            .tgdprc-advanced-cookies-setting-wrap #tgdprc-advanced-cookie-acceptance-button:hover{
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['button_hover_text_color']) && !empty($advanced_cookie_settings['advanced']['additional']['button_hover_text_color'])) {
            echo 'color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['button_hover_text_color']) . ';';
        }
        ?>
        <?php
        if (isset($advanced_cookie_settings['advanced']['additional']['button_bg_hover_color']) && !empty($advanced_cookie_settings['advanced']['additional']['button_bg_hover_color'])) {
            echo 'background-color:' . esc_attr($advanced_cookie_settings['advanced']['additional']['button_bg_hover_color']) . ';';
        }
        ?>
            }
        </style>
        <?php
    }
    ?>
    <div class="tgdprc-advanced-cookies-setting-wrap" id="tgdprc-advanced-cookies-bar-terms-wrap">
        <div class="tgdprc-advanced-cookies-inner-contentwrap">
            <div class="tgdprc-advanced-cookies-container-1">
                <?php
                if (isset($advanced_cookie_settings['advanced']['general']['header_info_title']) && !empty($advanced_cookie_settings['advanced']['general']['header_info_title'])) {
                    ?>
                    <div class="tgdprc-advanced-cookies-main-header">
                        <h3><?php echo esc_attr($advanced_cookie_settings['advanced']['general']['header_info_title']); ?></h3>
                    </div>
                <?php } ?>
                <?php if (isset($advanced_cookie_settings['advanced']['general']['header_info_text']) && !empty($advanced_cookie_settings['advanced']['general']['header_info_text'])) {
                    ?>
                    <div class="tgdprc-advanced-cookies-main-description">
                        <h4><?php echo wp_kses(stripslashes($advanced_cookie_settings['advanced']['general']['header_info_text']), $allowed_html); ?></h4>
                    </div>
                <?php } ?>
                <?php if (isset($advanced_cookie_settings['advanced']['general']['setting_controller_header_text']) && !empty($advanced_cookie_settings['advanced']['general']['setting_controller_header_text'])) {
                    ?>
                    <div class="tgdprc-advanced-cookies-secondary-header">
                        <p><?php echo wp_kses(stripslashes($advanced_cookie_settings['advanced']['general']['setting_controller_header_text']), $allowed_html); ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="tgdprc-advanced-cookies-container-2 tgdprc-advanced-cookies-setting-wrap">
            <div class="tgdprc-first-row"> 
                <label>
                    <input type="checkbox" value="block-all" name="advanced_cookie_control_check" class="tgdprc-advance-cookie-control-check" id="tgdprc-advance-cookie-block-all" <?php echo in_array('block-all', $tgdprc_consent_log_values_arr) || !isset($tgdprc_result) ? 'checked="checked"' : ''; ?>/>
                    <label for="tgdprc-advance-cookie-block-all"><?php echo isset($advanced_cookie_settings['advanced']['general']['block_all_text']) && !empty($advanced_cookie_settings['advanced']['general']['block_all_text']) ? esc_attr($advanced_cookie_settings['advanced']['general']['block_all_text']) : __('Block All', TGDPRCL_DOMAIN); ?></label>
                </label>
                <span class="tgdprc-first-row-inner-checks"> 
                    <?php
                    foreach ($default_custom_cookie_category_array as $key => $val) {
                        if (!isset($advanced_cookie_settings['advanced']['content_setting'][$key]['disable']) || (isset($advanced_cookie_settings['advanced']['content_setting'][$key]['disable']) && $advanced_cookie_settings['advanced']['content_setting'][$key]['disable'] != 1)) {
                            ?>
                            <label>        
                                <input type="checkbox" value="allow-<?php echo $key; ?>" name="advanced_cookie_control_check" class="tgdprc-advance-cookie-control-check" id="tgdprc-advance-cookie-allow-<?php echo $key; ?>" <?php echo in_array('allow-' . $key, $tgdprc_consent_log_values_arr) ? 'checked="checked"' : ''; ?>/>
                                <label for="tgdprc-advance-cookie-allow-<?php echo $key; ?>">
                                    <?php
                                    if (isset($advanced_cookie_settings['advanced'][$key]['setting_display_header']) && !empty($advanced_cookie_settings['advanced'][$key]['setting_display_header'])) {
                                        echo esc_attr($advanced_cookie_settings['advanced'][$key]['setting_display_header']);
                                    } else if (isset($advanced_cookie_settings['advanced'][$key]['setting_display_header']) && empty($advanced_cookie_settings['advanced'][$key]['setting_display_header'])) {
                                        echo $val;
                                    } else {
                                        echo __('Undefined Category Header', TGDPRCL_DOMAIN);
                                    }
                                    ?>
                                </label>
                            </label>       
                            <?php
                        }
                    }
                    ?>
                </span>
            </div>
            <div class="tgdprc-second-row">
                <?php
                foreach ($default_custom_cookie_category_array as $key => $val) {
                    if (!isset($advanced_cookie_settings['advanced'][$key]['disable']) || (isset($advanced_cookie_settings['advanced'][$key]['disable']) && $advanced_cookie_settings['advanced'][$key]['disable'] != 1)) {
                        ?>
                        <div class="tgdprc-second-row-inner" id="tgdprc-cookie-setting-allow-<?php echo $key; ?>" <?php echo in_array('allow-' . $key, $tgdprc_consent_log_values_arr) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
                            <?php
                            if (isset($advanced_cookie_settings['advanced'][$key]['setting_display_header']) && !empty($advanced_cookie_settings['advanced'][$key]['setting_display_header'])) {
                                ?>
                                <div class="tgdprc-advanced-cookies-main-header">
                                    <h5><?php
                                        if (isset($advanced_cookie_settings['advanced'][$key]['setting_display_header']) && !empty($advanced_cookie_settings['advanced'][$key]['setting_display_header'])) {
                                            echo esc_attr($advanced_cookie_settings['advanced'][$key]['setting_display_header']);
                                        } else if (isset($advanced_cookie_settings['advanced'][$key]['setting_display_header']) && empty($advanced_cookie_settings['advanced'][$key]['setting_display_header'])) {
                                            echo esc_attr($val);
                                        } else {
                                            echo __('Undefined Category Header', TGDPRCL_DOMAIN);
                                        }
                                        ?>:</h5>
                                </div>
                            <?php } ?>
                            <?php if (isset($advanced_cookie_settings['advanced'][$key]['basic_info_text']) && !empty($advanced_cookie_settings['advanced'][$key]['basic_info_text'])) {
                                ?>
                                <div class="tgdprc-cookie-info-description">
                                    <p><?php echo wp_kses(stripslashes($advanced_cookie_settings['advanced'][$key]['basic_info_text']), $allowed_html); ?></p>
                                </div>
                            <?php } ?>
                            <div class="tgdprc-description-do-dont-wrap clearfix">

                                <?php if (isset($advanced_cookie_settings['advanced'][$key]['what_it_store']) && !empty($advanced_cookie_settings['advanced'][$key]['what_it_store'])) {
                                    ?>
                                    <div class="tgdprc-description-will-do">
                                        <?php if (isset($advanced_cookie_settings['advanced']['general']['what_it_store_text']) && !empty($advanced_cookie_settings['advanced']['general']['what_it_store_text'])) { ?>
                                            <p>
                                                <?php echo esc_attr($advanced_cookie_settings['advanced']['general']['what_it_store_text']); ?>
                                            </p>
                                        <?php } ?>                                    
                                        <?php
                                        $what_it_store_texts = explode("\n", stripslashes_deep(wp_kses(htmlspecialchars_decode($advanced_cookie_settings['advanced'][$key]['what_it_store']), $allowed_html)));
                                        $final_string = '<ul>';
                                        foreach ($what_it_store_texts as $what_it_store_text) {
                                            $strTemp = trim($what_it_store_text);
                                            if ($strTemp !== '' || !empty($strTemp)):
                                                $final_string .= "<li>" . $what_it_store_text . "</li>";
                                            endif;
                                        }
                                        $final_string .= '</ul>';
                                        echo $final_string;
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php if (isset($advanced_cookie_settings['advanced'][$key]['what_it_wont_store']) && !empty($advanced_cookie_settings['advanced'][$key]['what_it_wont_store'])) {
                                    ?>
                                    <div class="tgdprc-description-wont-do">
                                        <?php if (isset($advanced_cookie_settings['advanced']['general']['what_it_wont_store_text']) && !empty($advanced_cookie_settings['advanced']['general']['what_it_wont_store_text'])) { ?>
                                            <p>
                                                <?php echo esc_attr($advanced_cookie_settings['advanced']['general']['what_it_wont_store_text']); ?>
                                            </p>
                                        <?php } ?>
                                        <?php
                                        $what_it_wont_store_texts = explode("\n", stripslashes_deep(wp_kses(htmlspecialchars_decode($advanced_cookie_settings['advanced'][$key]['what_it_wont_store']), $allowed_html)));
                                        $final_string = '<ul>';
                                        foreach ($what_it_wont_store_texts as $what_it_wont_store_text) {
                                            $strTemp = trim($what_it_wont_store_text);
                                            if ($strTemp !== '' || !empty($strTemp)):
                                                $final_string .= "<li>" . $what_it_wont_store_text . "</li>";
                                            endif;
                                        }
                                        $final_string .= '</ul>';
                                        echo $final_string;
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    } // If not disabled to show ends here
                } //End For each
                ?>
            </div>
        </div>
        <div class="tgdprc-advanced-cookie-button-wrap">
            <button class = "tgdprc-advanced-cookies-button" id = "tgdprc-advanced-cookie-acceptance-button">
                <?php echo isset($advanced_cookie_settings['advanced']['general']['save_and_close_button_text']) && !empty($advanced_cookie_settings['advanced']['general']['save_and_close_button_text']) ? esc_attr($advanced_cookie_settings['advanced']['general']['save_and_close_button_text']) : __('Save Cookie Preference', TGDPRCL_DOMAIN); ?>
            </button>
            <span class="tgdprc-loader" style="display:none;"><img src="<?php echo TGDPRCL_IMAGE . 'tgdprc-loader.gif'; ?>"/></span>
            <span class="tgdprc-hidden-display-message" data-message="<?php echo isset($advanced_cookie_settings['advanced']['general']['form_submitted_success_message']) && !empty($advanced_cookie_settings['advanced']['general']['save_and_close_button_text']) ? esc_attr($advanced_cookie_settings['advanced']['general']['form_submitted_success_message']) : __('Cookie Preference Stored', TGDPRCL_DOMAIN); ?>"></span>
        </div>

        <input type = "hidden" id = "tgdprc-consent-id" value = "<?php echo isset($tgdprc_result) && (!empty($tgdprc_result)) ? esc_attr($tgdprc_result->id) : 'none'; ?>"/>
        <input type = "hidden" id = "tgdprc-browser-ip" value = "<?php echo $tgdprc_browser_ip; ?>"/>
        <input type = "hidden" id = "tgdprc-browser-header" value = "<?php echo $this->tgdprc_browser_header(); ?>"/>
        <input type = "hidden" id = "tgdprc-user-agent" value = "<?php echo $_SERVER['HTTP_USER_AGENT']; ?>"/>
        <input type = "hidden" id = "tgdprc-user-current-redirect-url" value = "<?php echo $current_url; ?>"/>
    </div>
    <?php
} 
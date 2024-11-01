<?php
defined('ABSPATH') or die("No direct script allowed!!!");
$post_id = intval($post->ID);
$tgdpr_service_detail = get_post_meta($post_id, 'tgdpr_service_detail', true);
$tgdpr_service_detailssss = get_post_meta($post_id, 'cookie_used', true);
$advanced_cookie_settings = get_option('tgdprc-advanced-cookie-settings');

$tgdprc_global_value_array = $this->global_default_values_array_call();
$default_custom_cookie_category_array = $tgdprc_global_value_array['default_custom_cookie_category_array'];
$advancedcookie_default_excluded_array = $tgdprc_global_value_array['advancedcookie_default_excluded_array'];

if (isset($advanced_cookie_settings) && !empty($advanced_cookie_settings)) {
    foreach ($advanced_cookie_settings as $key => $val) {
        if (!in_array($key, $advancedcookie_default_excluded_array)) {
            $default_custom_cookie_category_array[$key] = $val['setting_display_header']; //array_push key into the $default_custom_cookie_category_array
        }
    }
} else {
    $default_custom_cookie_category_array = $default_custom_cookie_category_array;
}
?>
<div class="tgdprc-default-setting-tab-wrapper ttp-default-setting-field-wrapper clearfix" id='ttp-basic-layout-setting'>
    <div class="tgdprc-setting-tab-wrapper ttp-setting-member-tab-wrap">
        <h4><?php _e('General', TGDPRCL_DOMAIN); ?></h4>
    </div>
    <div class="tgdprc-setting-tab-content" id="content-ttp-setting-general" >
        <div class="tgdprc-default-setting-field-wrapper" id='ttp-basic-layout-setting'>
            <div class="tgdprc-setting-tab-content-inner tgdprc_struct_settings_body" id="content-ttp-setting-general-input-type">
                <div class="tgdprc_struct_settings_field">
                    <label>
                        <?php echo __('Cookie Used', TGDPRCL_DOMAIN); ?>
                    </label>
                    <input type="text" name="tgdpr_service_detail[cookie_used]" value="<?php
                    if (isset($tgdpr_service_detail['cookie_used']) && !empty($tgdpr_service_detail['cookie_used'])) {
                        echo esc_attr($tgdpr_service_detail['cookie_used']);
                    }
                    ?>"/>
                    <i class="additional_field_message"><?php echo __('Comma separated Cookies List used by this services', TGDPRCL_DOMAIN); ?></i>
                </div>
                <div class="tgdprc_struct_settings_field">
                    <label>
                        <?php echo __('Cookie Types', TGDPRCL_DOMAIN); ?>
                    </label>
                    <select name="tgdpr_service_detail[cookie_types]"> 
                        <option value="" <?php echo isset($tgdpr_service_detail['cookie_types']) && empty($tgdpr_service_detail['cookie_types']) ? 'selected="selected"' : ''; ?>>
                            <?php echo __('Undisclosed', TGDPRCL_DOMAIN); ?>
                        </option>
                        <?php foreach ($default_custom_cookie_category_array as $key => $val) { ?>
                            <option value="<?php echo $key; ?>" <?php echo isset($tgdpr_service_detail['cookie_types']) && $tgdpr_service_detail['cookie_types'] == $key ? 'selected="selected"' : ''; ?>>
                                <?php
                                if (isset($advanced_cookie_settings[$key]['setting_display_header']) && !empty($advanced_cookie_settings[$key]['setting_display_header'])) {
                                    echo esc_attr($advanced_cookie_settings[$key]['setting_display_header']);
                                } else if (isset($advanced_cookie_settings[$key]['setting_display_header']) && empty($advanced_cookie_settings[$key]['setting_display_header'])) {
                                    echo $val;
                                } else {
                                    echo __('Undefined Category Header', TGDPRCL_DOMAIN);
                                }
                                ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="tgdprc_struct_settings_field">
                    <label>
                        <?php echo __('Cookie Nature ?', TGDPRCL_DOMAIN); ?>
                    </label>
                    <select name="tgdpr_service_detail[cookie_nature]"> 
                        <option value="" <?php echo isset($tgdpr_service_detail['cookie_nature']) && empty($tgdpr_service_detail['cookie_nature']) ? 'selected="selected"' : ''; ?>>
                            <?php echo __('Undisclosed', TGDPRCL_DOMAIN); ?>
                        </option>
                        <option value="repetitive" <?php echo isset($tgdpr_service_detail['cookie_nature']) && $tgdpr_service_detail['cookie_nature'] == 'repetitive' ? 'selected="selected"' : ''; ?>>
                            <?php echo __('Repetitive', TGDPRCL_DOMAIN); ?>
                        </option>
                        <option value="session" <?php echo isset($tgdpr_service_detail['cookie_nature']) && $tgdpr_service_detail['cookie_nature'] == 'session' ? 'selected="selected"' : ''; ?>>
                            <?php echo __('Session', TGDPRCL_DOMAIN); ?>
                        </option>
                    </select>
                </div>
                <div class="tgdprc_struct_settings_field">
                    <label>
                        <?php echo __('Cookie Expiry Time ( For Repititive)', TGDPRCL_DOMAIN); ?>
                    </label>
                    <input type="text" name="tgdpr_service_detail[cookie_expire_duration]" value="<?php
                    if (isset($tgdpr_service_detail['cookie_expire_duration']) && !empty($tgdpr_service_detail['cookie_expire_duration'])) {
                        echo esc_attr($tgdpr_service_detail['cookie_expire_duration']);
                    }
                    ?>"/>
                    <i class="additional_field_message"><?php echo __('Blank if services does\'nt contain the persistent cookies', TGDPRCL_DOMAIN); ?></i>
                </div>
                <div class="tgdprc_struct_settings_field">
                    <label>
                        <?php echo __('Custom Cookie Expiry Time ?', TGDPRCL_DOMAIN); ?>
                    </label>
                    <label for="tgdprc-have-custom-expiry-time">
                        <input type="checkbox" id="tgdprc-have-custom-expiry-time" name="tgdpr_service_detail[custom_cookie_expiry_condition]" <?php
                        if (isset($tgdpr_service_detail['custom_cookie_expiry_condition']) && $tgdpr_service_detail['custom_cookie_expiry_condition'] == 'on') {
                            echo 'checked="checked"';
                        }
                        ?>/><?php echo __('Yes/No', TGDPRCL_DOMAIN); ?>
                    </label>
                    <i class="additional_field_message"><?php echo __('Please check if you\'re unsure or services includes both session and persistent cookies', TGDPRCL_DOMAIN); ?></i>
                </div>
                <div class="tgdprc_struct_settings_field">
                    <label>
                        <?php echo __('Can be Blocked ?', TGDPRCL_DOMAIN); ?>
                    </label>
                    <label for="tgdprc-can-be-blockable">
                        <input type="checkbox" id="tgdprc-can-be-blockable" name="tgdpr_service_detail[blockable]" <?php
                        if (isset($tgdpr_service_detail['blockable']) && $tgdpr_service_detail['blockable'] == 'on') {
                            echo 'checked="checked"';
                        }
                        ?>/><?php echo __('Yes/No', TGDPRCL_DOMAIN); ?>
                    </label>
                </div>
                <div class="tgdprc_struct_settings_field">
                    <label>
                        <?php echo __('Is Currently Active in Site ?', TGDPRCL_DOMAIN); ?>
                    </label>
                    <label for="tgdprc-currently-active">
                        <input type="checkbox" id="tgdprc-currently-active" name="tgdpr_service_detail[currently_active]" <?php
                        if (isset($tgdpr_service_detail['currently_active']) && $tgdpr_service_detail['currently_active'] == 'on') {
                            echo 'checked="checked"';
                        }
                        ?>/>
                               <?php echo __('Yes/No', TGDPRCL_DOMAIN); ?>
                    </label>
                    <i class="additional_field_message"><?php echo __('If unchecked, this service won\'t  be affected by "Advanced Cookie Setting"', TGDPRCL_DOMAIN); ?></i>
                </div>
            </div>
        </div>
    </div>
</div> 
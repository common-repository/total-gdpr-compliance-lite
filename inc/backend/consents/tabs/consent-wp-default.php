<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc-consent-tabs-content" id="tgdprc-consent-tabs-content-tgdprc-wp-comment" <?php echo ((isset($tgdprc_consent_settings['current_active_tab']) && $tgdprc_consent_settings['current_active_tab'] == 'tgdprc-wp-comment') || !isset($tgdprc_consent_settings['current_active_tab'])) ? 'style="display:block;"' : 'style="display:none;"'; ?>>
    <div class="tgdprc_checkbox_wrap">
        <label><?php esc_attr_e('Enable Consent for WP Comment', TGDPRCL_DOMAIN) ?></label>
        <input type="checkbox" name="plugin_consent_settings[wp_default_user_data][enable]" class="tgdprc-bulb-switch" id="tgdprc_plugin_consent_wp_userdata" value="1" <?php echo isset($tgdprc_consent_settings['wp_default_user_data']['enable']) && $tgdprc_consent_settings['wp_default_user_data']['enable'] == 1 ? 'checked="checked"' : ''; ?>>
        <label for="tgdprc_plugin_consent_wp_userdata"></label>
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Consent Checkbox Label', TGDPRCL_DOMAIN) ?></label>
        <textarea class="tgdprc-color-field" name="plugin_consent_settings[wp_default_user_data][consent_text]"><?php echo (!empty($tgdprc_consent_settings['wp_default_user_data']['consent_text'])) ? esc_attr($tgdprc_consent_settings['wp_default_user_data']['consent_text']) : ''; ?></textarea>
        <p class="tgdprc-description"><?php echo __('Default: I consent to storing of my name, email and other details.', TGDPRCL_DOMAIN); ?></p>
    </div>
</div>
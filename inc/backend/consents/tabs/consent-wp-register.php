<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc-consent-tabs-content" id="tgdprc-consent-tabs-content-tgdprc-wp-register" <?php echo isset($tgdprc_consent_settings['current_active_tab']) && $tgdprc_consent_settings['current_active_tab'] == 'tgdprc-wp-register' ? 'style="display:block;"' : 'style="display:none;"'; ?>>
    <div class="tgdprc_checkbox_wrap">
        <label><?php esc_attr_e('Enable Consent for WP Registry Page', TGDPRCL_DOMAIN) ?></label>
        <input type="checkbox" name="plugin_consent_settings[wp_register][enable]" class="tgdprc-bulb-switch" id="tgdprc_plugin_consent_wp_register" value="1" <?php echo isset($tgdprc_consent_settings['wp_register']['enable']) ? 'checked="checked"' : ''; ?>>
        <label for="tgdprc_plugin_consent_wp_register"></label>
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Consent Checkbox Label', TGDPRCL_DOMAIN) ?></label>
        <textarea class="tgdprc-color-field" name="plugin_consent_settings[wp_register][consent_text]"><?php echo (!empty($tgdprc_consent_settings['wp_register']['consent_text'])) ? esc_attr($tgdprc_consent_settings['wp_register']['consent_text']) : ''; ?></textarea>
        <p class="tgdprc-description"><?php echo __('Default: I accept storing of my basic data.', TGDPRCL_DOMAIN); ?></p>
    </div>
</div>
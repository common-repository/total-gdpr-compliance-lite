<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc-consent-tabs-content" id="tgdprc-consent-tabs-content-tgdprc-cf7" <?php echo isset($tgdprc_consent_settings['current_active_tab']) && $tgdprc_consent_settings['current_active_tab'] == 'tgdprc-cf7' ? 'style="display:block;"' : 'style="display:none;"'; ?>>
    <div class="tgdprc_checkbox_wrap">
        <label><?php esc_attr_e('Enable Consent for CF7', TGDPRCL_DOMAIN) ?></label>
        <input type="checkbox" name="plugin_consent_settings[consent_cf7][enable]" class="tgdprc-bulb-switch" id="tgdprc_plugin_consent_wordpress_comment" value="1" <?php echo isset($tgdprc_consent_settings['consent_cf7']['enable']) ? 'checked="checked"' : ''; ?>>
        <label for="tgdprc_plugin_consent_wordpress_comment"></label>
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Consent Checkbox Label', TGDPRCL_DOMAIN) ?></label>
        <textarea class="tgdprc-color-field" name="plugin_consent_settings[consent_cf7][consent_text]"><?php echo (!empty($tgdprc_consent_settings['consent_cf7']['consent_text'])) ? esc_attr($tgdprc_consent_settings['consent_cf7']['consent_text']) : ''; ?></textarea>
        <p class="tgdprc-description"><?php echo __('Default: I am okay with storage of my data and accept Privacy Policy.', TGDPRCL_DOMAIN); ?></p>
    </div>
</div>
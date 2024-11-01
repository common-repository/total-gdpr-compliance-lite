<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<div class="tgdprc-consent-tabs-content" id="tgdprc-consent-tabs-content-tgdprc-woocommerce" <?php echo isset($tgdprc_consent_settings['current_active_tab']) && $tgdprc_consent_settings['current_active_tab'] == 'tgdprc-woocommerce' ? 'style="display:block;"' : 'style="display:none;"'; ?>>
    <div class="tgdprc_checkbox_wrap">
        <label><?php esc_attr_e('Enable Consent for Woocommerce Checkout', TGDPRCL_DOMAIN) ?></label>
        <input type="checkbox" name="plugin_consent_settings[woo_commerce][enable]" class="tgdprc-bulb-switch" id="tgdprc_plugin_consent_woocommerce" value="1" <?php echo isset($tgdprc_consent_settings['woo_commerce']['enable']) ? 'checked="checked"' : ''; ?>>
        <label for="tgdprc_plugin_consent_woocommerce"></label>
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Consent Checkbox Label', TGDPRCL_DOMAIN) ?></label>
        <textarea class="tgdprc-color-field" name="plugin_consent_settings[woo_commerce][consent_text]"><?php echo (!empty($tgdprc_consent_settings['woo_commerce']['consent_text'])) ? esc_attr($tgdprc_consent_settings['woo_commerce']['consent_text']) : ''; ?></textarea>
        <p class="tgdprc-description"><?php echo __('Default: I accept storing of my basic data and Privacy Policy.', TGDPRCL_DOMAIN); ?></p>
    </div>
</div>
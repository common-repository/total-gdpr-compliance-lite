<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<div class="tgdprc-terms-policies-tabs-content" id="tgdprc-terms-policies-tabs-content-tgdprc-policies" style="display: none;">
    <div class="tgdprc_struct_settings_header">
        <h4>
            <?php esc_attr_e('Settings for displaying the "Policies" Consent acceptance button.', TGDPRCL_DOMAIN) ?>
        </h4>
        <p>
        <quote><strong><?php esc_attr_e('Shortcode', TGDPRCL_DOMAIN) ?></strong> : [tgdprc-policies]</quote>
        </p>
    </div>
    <div class="tgdprc_struct_settings_header">
        <h3>
            <?php esc_attr_e('General Settings', TGDPRCL_DOMAIN); ?>
        </h3>
    </div>
    <div class="tgdprc_struct_settings_body">
        <div class="tgdprc_struct_settings_field">
            <label>
                <?php esc_attr_e('Display Text', TGDPRCL_DOMAIN) ?>
            </label>
            <input type="text" name="policies_settings[display_text]" value="<?php
            if (isset($policies_settings['display_text']) && !empty($policies_settings['display_text'])) {
                echo esc_attr($policies_settings['display_text']);
            } else if (!isset($policies_settings['display_text'])) {
                echo __('Accept Policies', TGDPRCL_DOMAIN);
            } else {
                echo __('Accept Policies', TGDPRCL_DOMAIN);
            }
            ?>" placeholder="Defult: Accept Policies">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label>
                <?php esc_attr_e('Button Text After Acceptance', TGDPRCL_DOMAIN) ?>
            </label>
            <input type="text" name="policies_settings[after_accept_button_text]" value="<?php echo!empty($policies_settings['after_accept_button_text']) ? esc_attr($policies_settings['after_accept_button_text']) : '' ?>" placeholder="Defult: Accepted">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label>
                <?php esc_attr_e('Message After Acceptance', TGDPRCL_DOMAIN) ?>
            </label>
            <input type="text" name="policies_settings[after_accept_message]" value="<?php echo!empty($policies_settings['after_accept_message']) ? esc_attr($policies_settings['after_accept_message']) : '' ?>" placeholder="Defult: Policies accepted. Click button again to unaccept.">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label>
                <?php esc_attr_e('Message After Unacceptance', TGDPRCL_DOMAIN) ?>
            </label>
            <input type="text" name="policies_settings[after_unaccept_message]" value="<?php echo!empty($policies_settings['after_unaccept_message']) ? esc_attr($policies_settings['after_unaccept_message']) : '' ?>" placeholder="Defult: Policies Unaccepted.">
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Consent Expiry Time', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="policies_settings[consent_expiry_time]" value="<?php
            if ((isset($policies_settings['consent_expiry_time']) && !empty($policies_settings['consent_expiry_time']))) {
                echo esc_attr($policies_settings['consent_expiry_time']);
            } else if (!isset($policies_settings['consent_expiry_time'])) {
                echo 1;
            } else {
                echo '';
            }
            ?>"/>		
        </div>
        <div class="tgdprc_struct_settings_field">
            <label>
                <?php esc_attr_e('Require logged in to Accept', TGDPRCL_DOMAIN); ?>
            </label>
            <div class="tgdprc_checkbox_wrap">
                <input type="checkbox" name="policies_settings[require_logged_in]" <?php echo isset($policies_settings['require_logged_in']) ? "checked='checked'" : ''; ?> id="require_logged_in_policies" >
                <label for="require_logged_in_policies"></label>
            </div>
        </div>
        <div class="tgdprc_struct_settings_field">
            <label><?php esc_attr_e('Login Required Message', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="policies_settings[login_required_message]" value="<?php
            if (!empty($policies_settings['login_required_message'])) {
                echo esc_attr($policies_settings['login_required_message']);
            } else if (!isset($policies_settings['login_required_message'])) {
                echo __('Require Login to Change Policies Consent.', TGDPRCL_DOMAIN);
            } else {
                echo '';
            }
            ?>"/>		
        </div>

        <div class="tgdprc_struct_settings_field">
            <label>
                <?php esc_attr_e('Enable Redirect after Acceptance', TGDPRCL_DOMAIN) ?>
            </label>
            <div class="tgdprc_checkbox_wrap">
                <input type="checkbox" name="policies_settings[redirect_enabled]" <?php echo isset($policies_settings['redirect_enabled']) ? "checked='checked'" : ''; ?> id="enable_redirect_after_acceptance_policies" >
                <label for="enable_redirect_after_acceptance_policies"></label>
            </div>
        </div>

        <div class="tgdprc_struct_settings_field">
            <label for ="page_to_redirect_after_accepting_terms">
                <?php _e('Page to Redirect After Acceptance', TGDPRCL_DOMAIN) ?>
            </label>
            <select name="policies_settings[redirect_page_after_acceptance]" id="page_to_redirect_after_accepting_terms">
                <option value="default"><?php _e('Current Page', TGDPRCL_DOMAIN) ?></option>
                <?php foreach ($all_pages_list as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="tgdprc_struct_settings_header">
        <h3>
            <?php esc_attr_e('Layout Designs', TGDPRCL_DOMAIN); ?>
        </h3>
    </div>
    <div class="tgdprc_struct_settings_body">
        <div class="tgdprc_struct_settings_field">
            <label for ="button_design_type">
                <?php _e('Select Button Design Type', TGDPRCL_DOMAIN) ?>
            </label>
            <select name="policies_settings[button_design_type]" id="button_design_type">
                <option value="default" <?php echo (isset($policies_settings['button_design_type']) && $policies_settings['button_design_type'] == 'default') ? 'selected="selected"' : ''; ?>><?php _e('Default', TGDPRCL_DOMAIN) ?></option>
                <option value="custom" <?php echo (isset($policies_settings['button_design_type']) && $policies_settings['button_design_type'] == 'custom') ? 'selected="selected"' : ''; ?>><?php _e('Custom', TGDPRCL_DOMAIN) ?></option>
            </select>
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Text color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="policies_settings[button_text_color]" value="<?php echo (!empty($policies_settings['button_text_color'])) ? esc_attr($policies_settings['button_text_color']) : ''; ?>">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Hover Text color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="policies_settings[hover_button_text_color]" value="<?php echo (!empty($policies_settings['hover_button_text_color'])) ? esc_attr($policies_settings['hover_button_text_color']) : ''; ?>">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Background color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="policies_settings[button_bg]" value="<?php echo (!empty($policies_settings['button_bg'])) ? esc_attr($policies_settings['button_bg']) : ''; ?>" data-alpha="true">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Hover Background color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="policies_settings[button_bg_hover_color]" value="<?php echo (!empty($policies_settings['button_bg_hover_color'])) ? esc_attr($policies_settings['button_bg_hover_color']) : ''; ?>" data-alpha="true">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Border Color') ?></label>
            <input type="text" name="policies_settings[button_border_color]" class="tgdprc-color-field color-field" value="<?php echo!empty($policies_settings['button_border_color']) ? esc_attr($policies_settings['button_border_color']) : '' ?>" data-alpha="true">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Hover Border Color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="policies_settings[button_hover_border_color]" class="tgdprc-color-field color-field" value="<?php echo!empty($policies_settings['button_hover_border_color']) ? esc_attr($policies_settings['button_hover_border_color']) : '' ?>" data-alpha="true">
        </div>
    </div>
</div>
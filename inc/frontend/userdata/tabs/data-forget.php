<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<div class="tgdprc-user-data-tabs-content" data-submit-type="data-forget" id="tgdprc-userdata-tabs-content-tgdprc-data-forget" <?php
if ((!isset($userdata_setting['data_forget']['disable_this_form']) && isset($userdata_setting['data_request']['disable_this_form']) && isset($userdata_setting['data_rectification']['disable_this_form']))) {
    echo 'style="display:block"';
} else {
    echo 'style="display:none"';
}
?>>
    <form action="#" class="tgdprc-contact-form" name="tgdprc-custom-form-submission">
        <div class="tgdprc-user-data-content-inner">
            <p class="tgdprc-content-title">
                <?php
                if (isset($userdata_setting['data_forget']['display_header_text']) && !empty($userdata_setting['data_forget']['display_header_text'])) {
                    echo esc_attr($userdata_setting['data_forget']['display_header_text']);
                } else if (!isset($userdata_setting['data_forget']['display_header_text'])) {
                    echo __('User Data Forget Request', TGDPRCL_DOMAIN);
                } else {
                    echo '';
                }
                ?>
            </p>
            <div class="tgdprc-theme1-form">
                <div class="tgdprc-right-input-field">
                    <input id="tgdprc-right-text-field" class="tgdprc-fe-form-field tgdprc-email-field required" type="text" name="tgdprc_email_address" placeholder="<?php echo isset($userdata_setting['data_forget']['tgdprc_email_placeholder']) && !empty($userdata_setting['data_forget']['tgdprc_email_placeholder']) ? esc_attr($userdata_setting['data_forget']['tgdprc_email_placeholder']) : ''; ?>">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                </div>
                <div class="tgdprc-right-input-field">
                    <label for="tgdprc-userdata-forget-consent-checkfield">
                        <input id="tgdprc-userdata-forget-consent-checkfield" class="tgdprc-fe-form-field tgdprc-userdata-consent-checkfield required" type="checkbox" name="tgdprc_data_forget_request_consent" <?php
                        if (isset($userdata_setting['data_forget']['checked_by_default']) && $userdata_setting['data_forget']['checked_by_default'] == 1) {
                            echo 'checked="checked"';
                        }
                        ?>>
                        <label for="tgdprc-userdata-forget-consent-checkfield"><?php echo isset($userdata_setting['data_forget']['checkbox_consent_label']) && !empty($userdata_setting['data_forget']['checkbox_consent_label']) ? esc_attr($userdata_setting['data_forget']['checkbox_consent_label']) : ''; ?></label>
                    </label>
                </div>
                <button type="submit" name="submit" class="tgdprc-user-data-submit-button">
                    <?php
                    if (isset($userdata_setting['data_forget']['submit_button_text']) && !empty($userdata_setting['data_forget']['submit_button_text'])) {
                        echo esc_attr($userdata_setting['data_forget']['submit_button_text']);
                    } else if (!isset($userdata_setting['data_forget']['submit_button_text'])) {
                        echo __('Submit', TGDPRCL_DOMAIN);
                    } else {
                        echo '';
                    }
                    ?>
                </button>
                <span class="tgdprc-loader" style="display:none;"><img src="<?php echo TGDPRCL_IMAGE . 'tgdprc-loader.gif'; ?>"/></span>
            </div>
            <span class="tgdprc-form-message"></span>
        </div>
    </form>
</div>


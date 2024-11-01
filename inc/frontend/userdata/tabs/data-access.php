<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<div class="tgdprc-user-data-tabs-content" data-submit-type="data-access" id="tgdprc-userdata-tabs-content-tgdprc-data-access" <?php
if (!isset($userdata_setting['data_request']['disable_this_form'])) {
    echo 'style="display:block"';
}
?>>
    <form action="#" class="tgdprc-contact-form" name="tgdprc-custom-form-submission">
        <div class="tgdprc-user-data-content-inner">
            <p class="tgdprc-content-title">
                <?php
                if (isset($userdata_setting['data_request']['display_header_text']) && !empty($userdata_setting['data_request']['display_header_text'])) {
                    echo esc_attr($userdata_setting['data_request']['display_header_text']);
                } else if (!isset($userdata_setting['data_request']['display_header_text'])) {
                    echo __('User Data Access Request', TGDPRCL_DOMAIN);
                } else {
                    echo '';
                }
                ?>
            </p>
            <div class="tgdprc-theme1-form">
                <div class="tgdprc-right-input-field">
                    <input id="tgdprc-right-text-field" class="tgdprc-fe-form-field tgdprc-email-field required" type="text" name="tgdprc_email_address" placeholder="<?php echo isset($userdata_setting['data_request']['tgdprc_email_placeholder']) && !empty($userdata_setting['data_request']['tgdprc_email_placeholder']) ? esc_attr($userdata_setting['data_request']['tgdprc_email_placeholder']) : ''; ?>">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                </div>
                <div class="tgdprc-right-input-field">
                    <label>
                        <input id="tgdprc-userdata-access-consent-checkfield" class="tgdprc-fe-form-field tgdprc-userdata-consent-checkfield required" type="checkbox" name="tgdprc_data_access_request_consent" <?php
                        if (isset($userdata_setting['data_request']['checked_by_default']) && $userdata_setting['data_request']['checked_by_default'] == 1) {
                            echo 'checked="checked"';
                        }
                        ?>>
                        <label for="tgdprc-userdata-access-consent-checkfield"><?php echo isset($userdata_setting['data_request']['checkbox_consent_label']) && !empty($userdata_setting['data_request']['checkbox_consent_label']) ? esc_attr($userdata_setting['data_request']['checkbox_consent_label']) : ''; ?></label>
                    </label>
                </div>
                <button type="submit" name="submit" class="tgdprc-user-data-submit-button">
                    <?php
                    if (isset($userdata_setting['data_request']['submit_button_text']) && !empty($userdata_setting['data_request']['submit_button_text'])) {
                        echo esc_attr($userdata_setting['data_request']['submit_button_text']);
                    } else if (!isset($userdata_setting['data_request']['submit_button_text'])) {
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

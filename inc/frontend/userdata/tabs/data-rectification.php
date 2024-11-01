<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<div class="tgdprc-user-data-tabs-content" data-submit-type="data-rectification" id="tgdprc-userdata-tabs-content-tgdprc-data-rectification" <?php
if ((isset($userdata_setting['data_forget']['disable_this_form']) && isset($userdata_setting['data_request']['disable_this_form']) && !isset($userdata_setting['data_rectification']['disable_this_form']))) {
    echo 'style="display:block"';
} else {
    echo 'style="display:none"';
}
?>>
    <form action="#" class="tgdprc-contact-form" name="tgdprc-custom-form-submission">
        <div class="tgdprc-user-data-content-inner">
            <p class="tgdprc-right-content-title">
                <?php
                if (isset($userdata_setting['data_rectification']['display_header_text']) && !empty($userdata_setting['data_rectification']['display_header_text'])) {
                    echo esc_attr($userdata_setting['data_rectification']['display_header_text']);
                } else if (!isset($userdata_setting['data_rectification']['display_header_text'])) {
                    echo __('User Data Rectification Request', TGDPRCL_DOMAIN);
                } else {
                    echo '';
                }
                ?>
            </p>
            <p class="tgdprc-right-content-sub-title"><?php echo isset($userdata_setting['data_rectification']['tgdprc_secondary_subheader_text']) && !empty($userdata_setting['data_rectification']['tgdprc_secondary_subheader_text']) ? esc_attr($userdata_setting['data_rectification']['tgdprc_secondary_subheader_text']) : ''; ?></p>
            <div class="tgdprc-theme1-form">
                <div class="tgdprc-right-input-field">
                    <input id="tgdprc-right-text-field" class="tgdprc-fe-form-field tgdprc-email-field required" type="text" name="tgdprc_email_address" placeholder="<?php echo isset($userdata_setting['data_rectification']['tgdprc_email_placeholder']) && !empty($userdata_setting['data_rectification']['tgdprc_email_placeholder']) ? esc_attr($userdata_setting['data_rectification']['tgdprc_email_placeholder']) : ''; ?>">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                </div>
                <div class="tgdprc-right-input-field">
                    <textarea id="tgdprc-right-text-field" class="tgdprc-fe-form-field tgdprc-rectified-older-data-field required" name="tgdprc_older_data" placeholder="<?php echo isset($userdata_setting['data_rectification']['rectified_old_data_placeholder']) && !empty($userdata_setting['data_rectification']['rectified_old_data_placeholder']) ? esc_attr($userdata_setting['data_rectification']['rectified_old_data_placeholder']) : ''; ?>"></textarea>
                </div>
                <div class="tgdprc-right-input-field">
                    <textarea id="tgdprc-right-text-field" class="tgdprc-fe-form-field tgdprc-rectified-newer-data-field required" name="tgdprc_newer_data" placeholder="<?php echo isset($userdata_setting['data_rectification']['rectified_new_data_placeholder']) && !empty($userdata_setting['data_rectification']['rectified_new_data_placeholder']) ? esc_attr($userdata_setting['data_rectification']['rectified_new_data_placeholder']) : ''; ?>"></textarea>
                </div>
                <div class="tgdprc-right-input-field">
                    <label>
                        <input id="tgdprc-userdata-rectification-consent-checkfield" class="tgdprc-fe-form-field tgdprc-userdata-consent-checkfield required" type="checkbox" name="tgdprc_data_rectification_request_consent" <?php
                        if (isset($userdata_setting['data_rectification']['checked_by_default']) && $userdata_setting['data_rectification']['checked_by_default'] == 1) {
                            echo 'checked="checked"';
                        }
                        ?>>
                        <label for="tgdprc-userdata-rectification-consent-checkfield"><?php echo isset($userdata_setting['data_rectification']['checkbox_consent_label']) && !empty($userdata_setting['data_rectification']['checkbox_consent_label']) ? esc_attr($userdata_setting['data_rectification']['checkbox_consent_label']) : ''; ?></label>
                    </label>
                </div>
                <button type="submit" name="submit" class="tgdprc-user-data-submit-button">
                    <?php
                    if (isset($userdata_setting['data_rectification']['submit_button_text']) && !empty($userdata_setting['data_rectification']['submit_button_text'])) {
                        echo esc_attr($userdata_setting['data_rectification']['submit_button_text']);
                    } else if (!isset($userdata_setting['data_rectification']['submit_button_text'])) {
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


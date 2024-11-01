<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_container tgdprc-consent-container-wrap">

    <?php include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php'; ?>

    <?php if (isset($_GET['message']) && $_GET['message'] == 1): ?>
        <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Setting successsfully Updated', TGDPRCL_DOMAIN) ?></p></div>
    <?php endif ?>

    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" class="tgdprc_custom_template_form">
        <input type="hidden" name="action" value="save_consent_settings">
        <?php
        wp_nonce_field('tgdprc_consent_setting_nonce_field', 'tgdprc_consent_setting_nonce');
        $tgdprc_consent_settings = get_option('tgdprc-consent-settings');
        ?>

        <div class="wpcui_custom_template_struct_wrap">
            <div class="header-short-description">
                <span>
                    <?php esc_attr_e('From here, you can configure different default section in wordPress site and other third party plugin as supported by our plugin and add the custom checkbox as user consent approval.', TGDPRCL_DOMAIN) ?>
                </span>
            </div>
            <div class="tgdprc_custom_color_tab_wrapper">
                <div class="tgdprc_custom_template_color_tab_selector">
                    <a href="javascript:void(0)" id="tgdprc-wp-comment" class="tgdprc-consent-tabs <?php echo ((isset($tgdprc_consent_settings['current_active_tab']) && $tgdprc_consent_settings['current_active_tab'] == 'tgdprc-wp-comment') || !isset($tgdprc_consent_settings['current_active_tab'])) ? 'tgdprc_bar_colors' : ''; ?>">
                        <div class="tgdprc_color_tab_content">
                            <?php esc_attr_e('WordPress Comment', TGDPRCL_DOMAIN) ?>
                        </div>
                    </a>
                    <a href="javascript:void(0)" id="tgdprc-wp-login" class="tgdprc-consent-tabs <?php echo isset($tgdprc_consent_settings['current_active_tab']) && $tgdprc_consent_settings['current_active_tab'] == 'tgdprc-wp-login' ? 'tgdprc_bar_colors' : ''; ?>">
                        <div class="tgdprc_color_tab_content">
                            <?php esc_attr_e('WordPress Login Form', TGDPRCL_DOMAIN) ?>
                        </div>
                    </a>
                    <a href="javascript:void(0)" id="tgdprc-wp-register" class="tgdprc-consent-tabs <?php echo isset($tgdprc_consent_settings['current_active_tab']) && $tgdprc_consent_settings['current_active_tab'] == 'tgdprc-wp-register' ? 'tgdprc_bar_colors' : ''; ?>">
                        <div class="tgdprc_color_tab_content">
                            <?php esc_attr_e('WordPress Register Form', TGDPRCL_DOMAIN) ?>
                        </div>
                    </a>
                    <a href="javascript:void(0)" id="tgdprc-cf7" class="tgdprc-consent-tabs <?php echo isset($tgdprc_consent_settings['current_active_tab']) && $tgdprc_consent_settings['current_active_tab'] == 'tgdprc-cf7' ? 'tgdprc_bar_colors' : ''; ?>">
                        <div class="tgdprc_color_tab_content">
                            <?php esc_attr_e('Contact Form 7', TGDPRCL_DOMAIN) ?>
                        </div>
                    </a>
                    <a href="javascript:void(0)" id="tgdprc-woocommerce" class="tgdprc-consent-tabs <?php echo isset($tgdprc_consent_settings['current_active_tab']) && $tgdprc_consent_settings['current_active_tab'] == 'tgdprc-woocommerce' ? 'tgdprc_bar_colors' : ''; ?>">
                        <div class="tgdprc_color_tab_content">
                            <?php esc_attr_e('Woocommerce', TGDPRCL_DOMAIN) ?>
                        </div>
                    </a>
                </div>
                <div class="tgdprc_custom_tab">
                    <?php
                    include_once 'tabs/consent-wp-default.php';
                    include_once 'tabs/consent-wp-login.php';
                    include_once 'tabs/consent-wp-register.php';
                    include_once 'tabs/consent-cf7.php';
                    include_once 'tabs/consent-woocommerce.php';
                    ?>
                </div>
            </div>

        </div>
        <button class="tgdprc-plugin-consent-save-button button-primary" type="submit"><?php esc_attr_e('Save Consent Settings', TGDPRCL_DOMAIN) ?></button>
        <input type="hidden" id="tdprc_current_active_tab" name="plugin_consent_settings[current_active_tab]" value="<?php echo (!empty($tgdprc_consent_settings['current_active_tab'])) ? esc_attr($tgdprc_consent_settings['current_active_tab']) : 'tgdprc-wp-comment'; ?>">
    </form>
</div>
<div id="tgdprcl-postbox-container-1" class="tgdprcl-postbox-container">
    <?php include(TGDPRCL_PATH . 'inc/backend/tgdprcl-sidebar.php'); ?>
</div>
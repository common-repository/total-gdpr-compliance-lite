<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php
if ((isset($_GET['page']) && $_GET['page'] == 'tgdprcl-advance-cookies') && (isset($_GET['subpage']) && $_GET['subpage'] == 'view-consent-logs')) {
    include TGDPRCL_PATH . 'inc/backend/advanced-cookie/tgdprc-view-consent-log.php';
} else {
    ?>
    <div class = "tgdprc_container">
        <?php
        $title = esc_attr__('Advanced Cookie Setting', TGDPRCL_DOMAIN);
        include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php';
        $advanced_cookie_settings = get_option('tgdprc-advanced-cookie-settings');
        $default_cookies = $this->global_default_cookie_array_call();
        ?>
        <?php if (isset($_GET['message']) && $_GET['message'] == 1): ?>
            <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Advanced Cookie Settings Updated Successfully', TGDPRCL_DOMAIN) ?></p></div>
            <?php elseif (isset($_GET['message']) && $_GET['message'] == 0): ?>
                <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Advanced Cookie Settings Update Failed. Please Try Again.', TGDPRCL_DOMAIN) ?></p></div>
                <?php elseif (isset($_GET['message']) && $_GET['message'] == 2): ?>
                    <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('All Consent Deleted Successfully.', TGDPRCL_DOMAIN) ?></p><a href=""><?php esc_attr_e('All Consent Deleted Successfully.', TGDPRCL_DOMAIN) ?></a></div>
                    <?php elseif (isset($_GET['message']) && $_GET['message'] == 3): ?>
                        <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Advanced Cookie Settings Update Failed. Please Try Again.', TGDPRCL_DOMAIN) ?></p></div>
                    <?php endif ?>	

                    <form method="post" id="manageForm" action="<?php echo admin_url('admin-post.php'); ?>">

                        <div class="tgdprci-cookie-bar-form-container">

                            <?php wp_nonce_field('tgdprc_advanced_cookie_nonce', 'tgdprc_advanced_cookie_noncefield'); ?>

                            <input type="hidden" name="action" value="tgdprc_save_manage_advanced_cookie_settings">
                            <div class="tgdprc_struct_settings_header">
                                <h4>
                                    <?php esc_attr_e('Configuration for displaying the advanced cookie control setting form.', TGDPRCL_DOMAIN) ?>
                                </h4>
                                <p>
                                    <quote><strong><?php esc_attr_e('Shortcode', TGDPRCL_DOMAIN) ?></strong> : [tgdprc-advanced-cookie-setting] </quote>
                                </p>
                            </div>
                            <div class="nav-tab-wrapper">
                                <a href="javascript:void(0)" class="nav-tab nav-tab-active" id="tgdprc_content_nav_tab"><?php esc_attr_e('General', TGDPRCL_DOMAIN) ?></a>
                                <a href="javascript:void(0)" class="nav-tab" id="tgdprc_design_nav_tab"><?php esc_attr_e('Content', TGDPRCL_DOMAIN) ?></a>
                                <a href="javascript:void(0)" class="nav-tab" id="tgdprc_extra_nav_tab"><?php esc_attr_e('Design', TGDPRCL_DOMAIN) ?></a>
                            </div>
                            <?php
                            include_once 'menu_settings_sections/general_settings.php';
                            include_once 'menu_settings_sections/display_settings.php';
                            include_once 'menu_settings_sections/design_settings.php';
                            ?>
                            <button type="submit" class="tgdprc-advanced-cookie-form-template-save button button-primary"><?php esc_attr_e('Save Setting', TGDPRCL_DOMAIN) ?></button>
                        </div>
                    </form>
                </div>
                <div id="tgdprcl-postbox-container-1" class="tgdprcl-postbox-container">
                    <?php include(TGDPRCL_PATH . 'inc/backend/tgdprcl-sidebar.php'); ?>
                </div>
                <?php } ?>
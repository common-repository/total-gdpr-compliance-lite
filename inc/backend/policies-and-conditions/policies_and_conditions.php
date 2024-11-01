<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_container">
    <?php
    $title = esc_attr__('Policies & Conditions', TGDPRCL_DOMAIN);
    include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php';
    $all_pages_list = $this->get_all_page_lists();
    ?>

    <?php if (isset($_GET['message']) && $_GET['message'] == 1): ?>
        <?php if (isset($_GET['message']) && $_GET['message'] == 1): ?>
            <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Settings Updated Successfully', TGDPRCL_DOMAIN) ?></p></div>
            <?php elseif (isset($_GET['message']) && $_GET['message'] == 0): ?>
                <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Settings Update Failed', TGDPRCL_DOMAIN) ?></p></div>
            <?php endif ?>	
        <?php endif ?>

        <?php
        $policies_settings = get_option('tgdprc-policies-settings');
        $terms_and_condition_settings = get_option('tgdprc-terms-settings');
        ?>
        <form method="post" id="manageForm" action="<?php echo admin_url('admin-post.php'); ?>">
            <div class="tgdprci-cookie-bar-form-container">
                <?php wp_nonce_field('tgdprc_nonce', 'tgdprc_nonce_field'); ?>
                <input type="hidden" name="action" value="tgdprc_save_terms_and_policies_field_options">
                <div class="nav-tab-wrapper">
                    <a href="javascript:void(0)" class="nav-tab tgdprc-nav-tab-terms-condition-policies nav-tab-active" id="tgdprc-terms-condition"><?php esc_attr_e('Terms and Conditions', TGDPRCL_DOMAIN) ?></a>
                    <a href="javascript:void(0)" class="nav-tab tgdprc-nav-tab-terms-condition-policies" id="tgdprc-policies"><?php esc_attr_e('Policies', TGDPRCL_DOMAIN) ?></a>
                </div>
                <?php
                include_once 'tabs/terms_and_conditions.php';
                include_once 'tabs/policies_settings.php';
                ?>
            </div>
            <input type="submit" name="tgdprc_save_terms_policies_settings" class="tgdprc_save_terms_policies_button button button-primary" value="<?php esc_attr_e('Save Setting', TGDPRCL_DOMAIN) ?>"/>
        </form>
    </div>
    <div id="tgdprcl-postbox-container-1" class="tgdprcl-postbox-container">
        <?php include(TGDPRCL_PATH . 'inc/backend/tgdprcl-sidebar.php'); ?>
    </div>


<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_container">
    <?php
    $title = esc_attr($action) . esc_attr__('Info', TGDPRCL_DOMAIN);
    include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php';
    $result_status = ($result) ? true : false;
    ?>

    <?php if (isset($_GET['message']) && $_GET['message'] == 1): ?>
        <?php if (isset($_GET['message']) && $_GET['message'] == 1): ?>
            <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Settings Updated Successfully', TGDPRCL_DOMAIN) ?></p></div>
        <?php elseif (isset($_GET['message']) && $_GET['message'] == 0): ?>
            <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Settings Update Failed', TGDPRCL_DOMAIN) ?></p></div>
        <?php endif ?>	
    <?php endif ?>


    <?php
    $general_settings = ($result_status && !empty($result->general_settings)) ? unserialize($result->general_settings) : '';
    $display_settings = ($result_status && !empty($result->display_settings)) ? unserialize($result->display_settings) : '';
    $extra_settings = ($result_status && !empty($result->extra_settings)) ? unserialize($result->extra_settings) : '';
    ?>

    <!-- Add a new Cookie bar -->
    <?php if ($action != 'Add New '): ?>

        <a href="<?php echo admin_url('admin.php') . '?page=tgdprcl-manage-cookie-settings&action=add'; ?>" id="add_cookie_bar"><button class="wpcui_add_button button button-primary"><?php esc_attr_e('Add New Cookie Info', TGDPRCL_DOMAIN) ?></button></a>

        <a href="<?php echo get_home_url(); ?>?tgdprc_cookie_preview=<?php echo intval($result->id) ?>" target="_blank">
            <button class="button button-secondary" class="tgdprc-preview-button"><?php esc_attr_e('Preview', TGDPRCL_DOMAIN) ?></button>
        </a>

    <?php endif ?>


    <form method="post" id="manageForm" action="<?php echo admin_url('admin-post.php'); ?>">

        <div class="tgdprci-cookie-bar-form-container">

            <?php wp_nonce_field('tgdprc_nonce', 'tgdprc_nonce_field'); ?>

            <input type="hidden" name="action" value="tgdprc_save_manage_form_settings_pro">

            <?php if (isset($_GET['id'])): ?>
                <input type="hidden" name="id" value="<?php echo intval($_GET['id']); ?>">
            <?php elseif ($result && !empty($result)): ?>
                <input type="hidden" name="id" value="<?php echo intval($result->id); ?>">
            <?php endif ?>

            <div class="tgdprc_title_field">
                <label><?php esc_attr_e('Title', TGDPRCL_DOMAIN) ?></label>
                <input type="text" class="regular-text" name="title" value="<?php echo (!empty($result->name)) ? esc_attr($result->name) : ''; ?>">
            </div>

            <div class="nav-tab-wrapper">
                <a href="javascript:void(0)" class="nav-tab nav-tab-active" id="tgdprc_content_nav_tab"><?php esc_attr_e('Content', TGDPRCL_DOMAIN) ?></a>
                <a href="javascript:void(0)" class="nav-tab" id="tgdprc_design_nav_tab"><?php esc_attr_e('Layout', TGDPRCL_DOMAIN) ?></a>
                <a href="javascript:void(0)" class="nav-tab" id="tgdprc_extra_nav_tab"><?php esc_attr_e('Extra', TGDPRCL_DOMAIN) ?></a>
            </div>

            <?php
            include_once 'menu_settings_sections/general_settings.php';
            include_once 'menu_settings_sections/display_settings.php';
            include_once 'menu_settings_sections/extra_settings.php';
            ?>

            <button type="submit" class="tgdprc-cookie-bar-form-template-save button button-primary"><?php esc_attr_e('Save all settings', TGDPRCL_DOMAIN) ?></button>
        </div>
    </form>
</div>


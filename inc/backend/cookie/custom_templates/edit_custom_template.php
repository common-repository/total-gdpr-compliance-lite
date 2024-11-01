<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_container">

    <?php include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php'; ?>

    <?php if (isset($_GET['message']) && $_GET['message'] == 1): ?>
        <?php if (isset($_GET['template_message']) && $_GET['template_message'] == 'edited'): ?>
            <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Template Updated Successfully', TGDPRCL_DOMAIN) ?></p></div>
        <?php elseif (isset($_GET['template_message']) && $_GET['template_message'] == 'notedited'): ?>
            <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Template Update Failed', TGDPRCL_DOMAIN) ?></p></div>
        <?php elseif (isset($_GET['template_message']) && $_GET['template_message'] == 'added'): ?>
            <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Template Added', TGDPRCL_DOMAIN) ?></p></div>
        <?php elseif (isset($_GET['copyFailed']) && $_GET['copyFailed'] == 0) : ?>
            <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Successfully Copied Template', TGDPRCL_DOMAIN) ?></p></div>
        <?php endif ?>
    <?php endif ?>

    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" class="tgdprc_custom_template_form">

        <input type="hidden" name="action" value="save_custom_template">

        <input type="hidden" name="id" value="<?php echo intval($selected_template->id) ?>">

        <input type="hidden" name="p_id" value="<?php echo esc_attr($selected_template->public_id) ?>">

        <?php wp_nonce_field('tgdprc_template_nonce_field', 'tgdprc_template_nonce'); ?>

        <div class="wpcui_custom_template_struct_wrap">

            <div class="tgdprc_custom_template_field">
                <div class="tgdprc_custom_template_title">
                    <label><?php esc_attr_e('Template Name', TGDPRCL_DOMAIN) ?></label>
                    <input type="text" name="template_name" value="<?php echo (!empty($selected_template->template_name)) ? esc_attr($selected_template->template_name) : ''; ?>" class="wpcui_custom_template_name">
                </div>
            </div>

            <div class="tgdprc_custom_color_tab_wrapper">
                <div class="tgdprc_custom_template_color_tab_selector">
                    <a href="javascript:void(0)" id="tgdprc_bar_colors" class="tgdprc_color_tab_selector tgdprc_bar_colors">
                        <div class="tgdprc_color_tab_content">
                            <?php esc_attr_e('General Area', TGDPRCL_DOMAIN) ?>
                        </div>
                    </a>
                    <a href="javascript:void(0)" id="tgdprc_info_button_colors" class="tgdprc_color_tab_selector">
                        <div class="tgdprc_color_tab_content">
                            <?php esc_attr_e('Confirmation Button', TGDPRCL_DOMAIN) ?>
                        </div>
                    </a>
                    <a href="javascript:void(0)" id="tgdprc_more_info_button_colors" class="tgdprc_color_tab_selector">
                        <div class="tgdprc_color_tab_content">
                            <?php esc_attr_e('More Info Button', TGDPRCL_DOMAIN) ?>
                        </div>
                    </a>
                    <a href="javascript:void(0)" id="tgdprc_close_button_colors" class="tgdprc_color_tab_selector">
                        <div class="tgdprc_color_tab_content">
                            <?php esc_attr_e('Close Button', TGDPRCL_DOMAIN) ?>
                        </div>
                    </a>
                </div>


                <div class="tgdprc_custom_tab">
                    <?php
                    include_once 'color_tabs/bar_colors.php';
                    include_once 'color_tabs/info_button_colors.php';
                    include_once 'color_tabs/more_info_button_colors.php';
                    include_once 'color_tabs/close_button_colors.php';
                    ?>
                </div>
            </div>


        </div>


        <button class="tgdprc-save-custom-setting-button button button-primary" type="submit"><?php esc_attr_e('Save Settings', TGDPRCL_DOMAIN) ?></button>

    </form>


</div>
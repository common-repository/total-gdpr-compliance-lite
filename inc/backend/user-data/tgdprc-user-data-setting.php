<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_container">
    <?php
    if (isset($_GET['subpage']) && $_GET['subpage'] == 'preview-user-data-logs') {
        $title = esc_attr__('Access User Data Log', TGDPRCL_DOMAIN);
    } else if (isset($_GET['subpage']) && $_GET['subpage'] == 'forget-data-log') {
        $title = esc_attr__('Forget User Data Log', TGDPRCL_DOMAIN);
    } else if (isset($_GET['subpage']) && $_GET['subpage'] == 'rectification-data-log') {
        $title = esc_attr__('Rectify User Data Log', TGDPRCL_DOMAIN);
    } else {
        $title = esc_attr__('User Data Settings', TGDPRCL_DOMAIN);
    }
    include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php';

    $userdata_setting = get_option('user-data-settings');
    $tgdprc_data_not_found_message = __("No Data Correspond to Provided Email Address Found", TGDPRCL_DOMAIN);
    ?>
    <?php
    if (isset($_GET['message_type']) && $_GET['message_type'] == 'userdata' && !isset($_GET['subpage'])):
        $email_address = isset($_GET['email_address']) && !empty($_GET['email_address']) ? sanitize_email($_GET['email_address']) : '';
    if (isset($_GET['message']) && $_GET['message'] == 1):
        ?>    
        <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Mail Sent to the selected emailaddress', TGDPRCL_DOMAIN); ?> <?php echo '<strong>' . $email_address . '</strong>'; ?></p></div>
        <?php elseif (isset($_GET['message']) && $_GET['message'] == 0): ?>
            <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Mail Wasn\'t Sent to the selected emailaddress', TGDPRCL_DOMAIN); ?> <?php echo '<strong>' . $email_address . '</strong>'; ?></p></div>
        <?php elseif (isset($_GET['message']) && $_GET['message'] == 2):
            ?>
            <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Selected user was Removed Successfully.', TGDPRCL_DOMAIN); ?></p></div>
            <?php
        endif;
    endif;

    if (isset($_GET['message_type']) && $_GET['message_type'] == 'userdata-setting' && !isset($_GET['subpage'])):
        if (isset($_GET['message']) && $_GET['message'] == 1):
            ?>    
            <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Settings Updated Successfully', TGDPRCL_DOMAIN) ?></p></div>
            <?php elseif (isset($_GET['message']) && $_GET['message'] == 0): ?>
                <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Settings Wasn\'t updated. Please Try Again.', TGDPRCL_DOMAIN) ?></p></div>
                <?php
            endif;
        endif;

        if (isset($_GET['message_type']) && $_GET['message_type'] == 'forgetdata' && !isset($_GET['subpage'])):
            if (isset($_GET['message']) && $_GET['message'] == 1):
                ?>    
                <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Data forgotten and mail sent to the selected emailaddress', TGDPRCL_DOMAIN); ?> <?php echo '<strong>' . $email_address . '</strong>'; ?></p></div>
                <?php elseif (isset($_GET['message']) && $_GET['message'] == 0): ?>
                    <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Data forgotten Or Mail Wasn\'t Sent to the selected emailaddress', TGDPRCL_DOMAIN); ?> <?php echo '<strong>' . $email_address . '</strong>'; ?></p></div>
                <?php elseif (isset($_GET['message']) && $_GET['message'] == 2):
                    ?>
                    <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Selected user was Removed Successfully.', TGDPRCL_DOMAIN); ?></p></div>
                    <?php
                endif;
            endif;

            if (isset($_GET['message_type']) && $_GET['message_type'] == 'rectifydata' && !isset($_GET['subpage'])):
                if (isset($_GET['message']) && $_GET['message'] == 1):
                    ?>    
                    <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Data rectified and mail sent to the selected emailaddress', TGDPRCL_DOMAIN); ?> <?php echo '<strong>' . $email_address . '</strong>'; ?></p></div>
                    <?php elseif (isset($_GET['message']) && $_GET['message'] == 0): ?>
                        <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Data rectified Or Mail Wasn\'t Sent to the selected emailaddress', TGDPRCL_DOMAIN); ?> <?php echo '<strong>' . $email_address . '</strong>'; ?></p></div>
                    <?php elseif (isset($_GET['message']) && $_GET['message'] == 2):
                        ?>
                        <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Selected user was Removed Successfully.', TGDPRCL_DOMAIN); ?></p></div>
                        <?php
                    endif;
                endif;

                if (isset($_GET['message_type']) && $_GET['message_type'] == 'userdatabreach' && !isset($_GET['subpage'])):
                    if (isset($_GET['message']) && $_GET['message'] == 1):
                        ?>    
                        <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Breach Mail was Sent to All Listed Users', TGDPRCL_DOMAIN); ?></p></div>
                        <?php elseif (isset($_GET['message']) && $_GET['message'] == 0): ?>
                            <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Breach Mail wasn\'t Sent to Listed Users.', TGDPRCL_DOMAIN); ?></p></div>
                            <?php
                        endif;
                    endif;
                    ?>
                    <form method="post" id="manageForm" action="<?php echo admin_url('admin-post.php'); ?>">
                        <?php wp_nonce_field('tgdprc_nonce', 'tgdprc_nonce_field'); ?>
                        <input type="hidden" name="action" value="tgdprc_save_user_datasetting_field_options">
                        <div class="tgdprc_struct_settings_header">
                            <h4>
                                <?php esc_attr_e('Configuration for displaying the user data form in the site.', TGDPRCL_DOMAIN) ?>
                            </h4>
                            <p>
                                <quote><strong><?php esc_attr_e('Shortcode', TGDPRCL_DOMAIN) ?></strong> : [tgdprc-userdata-form] </quote>
                            </p>
                        </div>
                        <?php
                        $tgdprc_user_data_nonce = wp_create_nonce('tgdprc_user_data_nonce');
                        if ((isset($_GET['page']) && $_GET['page'] == 'tgdprcl-userdata') && (isset($_GET['subpage']) && $_GET['subpage'] == 'preview-user-data-logs')) {
                            include TGDPRCL_PATH . 'inc/backend/user-data/user-data-request/tgdprc-user-data-log.php';
                        } else if ((isset($_GET['page']) && $_GET['page'] == 'tgdprcl-userdata') && (isset($_GET['subpage']) && $_GET['subpage'] == 'forget-data-log')) {
                            include TGDPRCL_PATH . 'inc/backend/user-data/user-data-forget/tgdprc-forget-user-data-log.php';
                        } else if ((isset($_GET['page']) && $_GET['page'] == 'tgdprcl-userdata') && (isset($_GET['subpage']) && $_GET['subpage'] == 'rectification-data-log')) {
                            include TGDPRCL_PATH . 'inc/backend/user-data/user-data-rectification/tgdprc-rectification-user-data-log.php';
                        } else {
                            ?>
                            <div class="tgdprci-cookie-bar-form-container">
                                <div class="nav-tab-wrapper">
                                    <a href="javascript:void(0)" class="nav-tab tgdprc-nav-tab-user-data nav-tab-active" id="tgdprc-data-access"><?php esc_attr_e('Data Access Request', TGDPRCL_DOMAIN) ?></a>
                                    <a href="javascript:void(0)" class="nav-tab tgdprc-nav-tab-user-data" id="tgdprc-data-rectification"><?php esc_attr_e('Data Rectification Request', TGDPRCL_DOMAIN) ?></a>
                                    <a href="javascript:void(0)" class="nav-tab tgdprc-nav-tab-user-data" id="tgdprc-data-forget"><?php esc_attr_e('Data Forget Request', TGDPRCL_DOMAIN) ?></a>
                                    <a href="javascript:void(0)" class="nav-tab tgdprc-nav-tab-user-data" id="tgdprc-data-breach"><?php esc_attr_e('Data Breach Notification', TGDPRCL_DOMAIN) ?></a>
                                </div>
                                <?php
                                include_once 'user-data-request/data-request-setting.php';
                                include_once 'user-data-rectification/data-rectification-setting.php';
                                include_once 'user-data-forget/data-forget-setting.php';
                                include_once 'user-data-breach/data-breach-setting.php';
                                ?>

                            </div>
                            <input type="submit" name="tgdprc_save_user_datasetting_field_settings" class="tgdprc_save_user_datasetting_button button button-primary" value="<?php esc_attr_e('Save Settings', TGDPRCL_DOMAIN) ?>"/>
                        <?php } ?>
                    </form>
                </div>
                <div id="tgdprcl-postbox-container-1" class="tgdprcl-postbox-container">
                    <?php include(TGDPRCL_PATH . 'inc/backend/tgdprcl-sidebar.php'); ?>
                </div>

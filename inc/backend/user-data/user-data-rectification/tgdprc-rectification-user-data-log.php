

<div class="tgdprc_container">
    <?php
    global $wpdb;
    $tgdprc_rectify_form_json_data = get_option('tgdprc-rectify-form-json-data');
    $email_address = isset($_GET['email_address']) ? sanitize_email($_GET['email_address']) : '';
    $tgdprc_subpage = isset($_GET['subpage']) ? sanitize_text_field($_GET['subpage']) : '';
    $tgdprc_subpage_title = esc_attr__('Log for Email', TGDPRCL_DOMAIN) . ' - ' . $email_address;

    include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php';

    wp_nonce_field('tgdprc_nonce', 'tgdprc_nonce_field');
    ?>
    <?php if (isset($_GET['message']) && $_GET['message'] == 1):
        ?>    
        <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Data rectified and mail sent to the selected emailaddress', TGDPRCL_DOMAIN); ?> <?php echo '<strong>' . $email_address . '</strong>'; ?></p></div>
    <?php elseif (isset($_GET['message']) && $_GET['message'] == 0): ?>
        <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Data rectified Or Mail Wasn\'t Sent to the selected emailaddress', TGDPRCL_DOMAIN); ?> <?php echo '<strong>' . $email_address . '</strong>'; ?></p></div>
        <?php
    endif;
    ?>
    <form method = "post" id = "manageForm" action = "<?php echo admin_url('admin-post.php'); ?>">
        <input type = "hidden" name = "action" value = "tgdprc_send_rectified_email_to_user">
        <input type = "hidden" name = "email_address" value = "<?php echo esc_attr($email_address); ?>">
        <input type = "hidden" name = "subpage" value = "<?php echo esc_attr($tgdprc_subpage); ?>">
        <div class = "tgdprc_title_field">
            <label><?php echo esc_attr($tgdprc_subpage_title); ?></label>
        </div>
        <div class="tgdprc-first-row">
            <a href="<?php echo admin_url("admin.php?page=tgdprcl-userdata"); ?>" class="button button-secondary tgdprc-action-button-1"><?php echo __('Go Back', TGDPRCL_DOMAIN); ?></a>
            <input type="submit" name="tgdprc_send_rectified_email_to_user_settings" onclick="return confirm('Do you want to send rectified email to this selected user ?')" class="button button-secondary tgdprc-action-button-2" value="<?php esc_attr_e('Send Mail to This User', TGDPRCL_DOMAIN) ?>"/>
            <a href="<?php echo admin_url("admin-post.php?action=delete_chosen_user_rectify_req_email&email_address=$email_address&_wpnonce=$tgdprc_user_data_nonce"); ?>" onclick="return confirm('Do you want to delete log for this user ?')" class="button button-secondary tgdprc-action-button-3"><?php esc_attr_e('Delete', TGDPRCL_DOMAIN) ?></a>
        </div>
        <?php include TGDPRCL_PATH . 'inc/backend/user-data/tgdprc-inc-logs.php'; ?>
        <div class="tgdprc-user-data-content-log-wrap tgdprc-user-data-log-wrap-2">
            <div class="tgdprc_title_field">
                <label><?php echo __('Rectification Data Submitted By User', TGDPRCL_DOMAIN); ?></label>
            </div>
            <?php
            foreach ($tgdprc_rectify_form_json_data as $key => $val) {
                if ($val['email_addresss'] == $email_address) {
                    ?>
                    <div class="tgdprc_struct_settings_field">
                        <label for="tgdprc-old-text-field"><?php esc_attr_e('Old User Data', TGDPRCL_DOMAIN) ?></label>
                        <textarea id="tgdprc-old-text-field" class="tgdprc-rectified-older-data" name="old_data_to_rectify"><?php echo isset($val['old_data_to_rectify']) && !empty($val['old_data_to_rectify']) ? stripslashes_deep($val['old_data_to_rectify']) : ''; ?></textarea>
                    </div>  
                    <div class="tgdprc_struct_settings_field">              
                        <label for="tgdprc-new-text-field"><?php esc_attr_e('New User Data', TGDPRCL_DOMAIN) ?></label>
                        <textarea id="tgdprc-new-text-field" class="tgdprc-fe-form-field tgdprc-rectified-newer-data" name="new_data_rectify"><?php echo isset($val['new_data_rectify']) && !empty($val['new_data_rectify']) ? stripslashes_deep($val['new_data_rectify']) : ''; ?></textarea>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="tgdprc-first-row">
            <a href="<?php echo admin_url("admin.php?page=tgdprcl-userdata"); ?>" class="button button-secondary tgdprc-action-button-1"><?php echo __('Go Back', TGDPRCL_DOMAIN); ?></a>
            <input type="submit" name="tgdprc_send_rectified_email_to_user_settings" onclick="return confirm('Do you want to send rectified email to this selected user ?')" class="button button-secondary tgdprc-action-button-2" value="<?php esc_attr_e('Send Mail to This User', TGDPRCL_DOMAIN) ?>"/>
            <a href="<?php echo admin_url("admin-post.php?action=delete_chosen_user_rectify_req_email&email_address=$email_address&_wpnonce=$tgdprc_user_data_nonce"); ?>" onclick="return confirm('Do you want to delete log for this user ?')" class="button button-secondary tgdprc-action-button-3"><?php esc_attr_e('Delete', TGDPRCL_DOMAIN) ?></a>
        </div>
    </form>

</div>
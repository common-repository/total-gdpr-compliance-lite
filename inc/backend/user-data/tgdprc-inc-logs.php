<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc-user-data-content-log-wrap tgdprc-user-data-log-wrap-1">
    <div class="tgdprc_title_field">
        <label><?php echo __('Data Log', TGDPRCL_DOMAIN); ?></label>
    </div>
    <div class="tgdprc_struct_settings_header">
        <h3><?php _e('WP Comment Data', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <div class="tgdprc_struct_settings_content">
        <?php
        $args = array(
            'author_email' => $email_address
        );
        $all_comment_meta_array = get_comments($args);
        if (!empty($all_comment_meta_array)) {
            $all_comments_meta_output = json_encode($all_comment_meta_array);
            echo $all_comments_meta_output;
        } else {
            ?>
            <span><?php echo esc_attr($tgdprc_data_not_found_message); ?></span>
        <?php }
        ?>
    </div>
    <div class="tgdprc_struct_settings_header">
        <h3><?php _e('WP User Data', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <div class="tgdprc_struct_settings_content">
        <?php
        if (email_exists($email_address)) {
            $user_Array = get_user_by("email", $email_address);
            $all_user_meta_output = json_encode($user_Array);
            echo $all_user_meta_output;
        } else {
            ?>
            <span><?php echo esc_attr($tgdprc_data_not_found_message); ?></span>
            <?php
        }
        ?>
    </div>
    <div class = "tgdprc_struct_settings_header">
        <h3>
            <?php _e('Post Meta Data', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <div class="tgdprc_struct_settings_content">
        <?php
        $all_post_meta_results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "postmeta WHERE meta_value = '$email_address' ");
        if ($all_post_meta_results) {
            $all_post_meta_output = json_encode($all_post_meta_results);
            echo $all_post_meta_output;
        } else {
            ?>
            <span><?php echo esc_attr($tgdprc_data_not_found_message); ?></span>
            <?php
        }
        ?>
    </div>
    <div class = "tgdprc_struct_settings_header">
        <h3>
            <?php _e('Woo Commerce Data', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <div class="tgdprc_struct_settings_content">
        <?php
        $user_data_woo_results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "usermeta WHERE meta_key = 'billing_email' AND meta_value = '$email_address' ");
        if ($user_data_woo_results) {
            $user_data_woo_details = get_user_meta($user_data_woo_results->user_id);
            if (!empty($user_data_woo_details)) {
                $all_woocommerce_user_meta_output = json_encode($user_data_woo_details);
                echo $all_woocommerce_user_meta_output;
            } else {
                ?>
                <span><?php echo esc_attr($tgdprc_data_not_found_message); ?></span>
                <?php
            }
        } else {
            ?>
            <?php echo esc_attr($tgdprc_data_not_found_message); ?>
            <?php
        }
        ?>
    </div>
    <div class="tgdprc_struct_settings_header">
        <h2><?php _e('Quick User Info', TGDPRCL_DOMAIN); ?></h2>
    </div>
    <div class="tgdprc_struct_settings_content">
        <?php
        $tgdpr_user_log_requested_date_label = __('Initial Request Date', TGDPRCL_DOMAIN);
        $tgdprc_user_log_email_sent_status = __('Email Sent to User', TGDPRCL_DOMAIN);
        $tgdprc_user_log_email_sent_date = __('Last Email Sent Date', TGDPRCL_DOMAIN);

        if (isset($_GET['subpage']) && 'preview-user-data-logs') {
            $return_access_data = $this->tgdprc_pull_related_array_access_userdata($email_address);
            ?>

            <div class="tgdprc_struct_settings_field">
                <label>
                    <?php echo $tgdpr_user_log_requested_date_label; ?> :
                </label>
                <?php echo isset($return_access_data['access_request_date']) && !empty($return_access_data['access_request_date']) ? date("F jS, Y h:i:s", strtotime(esc_attr($return_access_data['access_request_date']))) : ''; ?>
            </div>
            <div class="tgdprc_struct_settings_field">
                <label>
                    <?php echo esc_attr($tgdprc_user_log_email_sent_status); ?> :
                </label>
                <?php echo (isset($return_access_data['status']) && $return_access_data['status'] == 'email-not-send') || !isset($return_access_data['status']) ? __('Email Not Sent Yet', TGDPRCL_DOMAIN) : __('Email Sent', TGDPRCL_DOMAIN); ?>
            </div>
            <div class="tgdprc_struct_settings_field">
                <label>
                    <?php echo $tgdprc_user_log_email_sent_date; ?> :
                </label>
                <?php echo isset($return_access_data['email_sent_date']) && !empty($return_access_data['email_sent_date']) ? date("F jS, Y h:i:s", strtotime(esc_attr($return_access_data['email_sent_date']))) : ''; ?>
            </div>
            <?php
        } else if (isset($_GET['subpage']) && 'rectification-data-log') {
            $rectify_json_data = $this->tgdprc_pull_related_array_rectify_userdata($email_address);
            ?>

            <div class="tgdprc_struct_settings_field">
                <label>
                    <?php echo $tgdpr_user_log_requested_date_label; ?> :
                </label>
                <?php echo isset($rectify_json_data['rectify_request_date']) && !empty($rectify_json_data['rectify_request_date']) ? date("F jS, Y h:i:s", strtotime(esc_attr($return_access_data['rectify_request_date']))) : ''; ?>
            </div>
            <div class="tgdprc_struct_settings_field">
                <?php echo $tgdprc_user_log_email_sent_status; ?>
                <?php echo (isset($rectify_json_data['status']) && $rectify_json_data['status'] == 'email-not-send') || !isset($rectify_json_data['status']) ? __('Email Not Sent Yet', TGDPRCL_DOMAIN) : __('Email Sent', TGDPRCL_DOMAIN); ?>
            </div>
            <div class="tgdprc_struct_settings_field">
                <label>
                    <?php echo $tgdprc_user_log_email_sent_date; ?> :
                </label>
                <?php echo isset($rectify_json_data['email_sent_date']) && !empty($rectify_json_data['email_sent_date']) ? date("F jS, Y h:i:s", strtotime(esc_attr($rectify_json_data['email_sent_date']))) : ''; ?>
            </div>
            <?php
        } else if (isset($_GET['subpage']) && 'forget-data-log') {
            $return_forget_data = $this->tgdprc_pull_related_array_forget_userdata($email_address);
            ?>
            <div class="tgdprc_struct_settings_field">
                <label>
                    <?php echo $tgdpr_user_log_requested_date_label; ?> :
                </label>
                <?php echo isset($return_forget_data['forget_request_date']) && !empty($return_forget_data['forget_request_date']) ? date("F jS, Y h:i:s", strtotime(esc_attr($return_forget_data['forget_request_date']))) : ''; ?>
            </div>
            <div class="tgdprc_struct_settings_field">
                <label>
                    <?php echo $tgdprc_user_log_email_sent_status; ?> :</label>
                <?php echo (isset($return_forget_data['status']) && $return_forget_data['status'] == 'email-not-send') || !isset($return_forget_data['status']) ? __('Email Not Sent Yet', TGDPRCL_DOMAIN) : __('Email Sent', TGDPRCL_DOMAIN); ?>
            </div>
            <div class="tgdprc_struct_settings_field">
                <label>
                    <?php echo $tgdprc_user_log_email_sent_date; ?> :
                </label>
                <?php echo isset($return_forget_data['email_sent_date']) && !empty($return_forget_data['email_sent_date']) ? date("F jS, Y h:i:s", strtotime(esc_attr($return_forget_data['email_sent_date']))) : ''; ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>

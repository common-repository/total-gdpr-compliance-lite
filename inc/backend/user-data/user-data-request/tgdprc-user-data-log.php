<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php
global $wpdb;
$email_address = isset($_GET['email_address']) ? sanitize_text_field($_GET['email_address']) : '';
$tgdprc_subpage_title = esc_attr__('Log For Email', TGDPRCL_DOMAIN) . ' - <strong>' . $email_address . '</strong>';
?>
<div class="tgdprc_container">
    <?php
    include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php';

    if (isset($_GET['message']) && $_GET['message'] == 1):
        ?>    
        <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Mail Sent to the selected emailaddress', TGDPRCL_DOMAIN); ?> <?php echo '<strong>' . $email_address . '</strong>'; ?></p></div>
    <?php elseif (isset($_GET['message']) && $_GET['message'] == 0): ?>
        <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Mail Wasn\'t Sent to the selected emailaddress', TGDPRCL_DOMAIN); ?> <?php echo '<strong>' . $email_address . '</strong>'; ?></p></div>
        <?php
    endif;
    ?>
    <form method="post" id="manageForm" action="<?php echo admin_url('admin-post.php'); ?>">
        <div class="tgdprc_title_field">
            <label><?php echo esc_attr($tgdprc_subpage_title); ?></label>
        </div>
        <div class="tgdprc-first-row">
            <a href="<?php echo admin_url("admin.php?page=tgdprcl-userdata"); ?>" class="button button-secondary tgdprc-action-button-1"><?php echo __('Go Back', TGDPRCL_DOMAIN); ?></a>
            <a href="<?php echo admin_url("admin-post.php?action=tgdprc_send_email_with_userdata_to_user&subpage=preview-user-data-logs&email_address=$email_address&_wpnonce=$tgdprc_user_data_nonce"); ?>" onclick="return confirm('Do you want to send email to this selected user ?')" class="button button-secondary tgdprc-action-button-2"><?php echo __('Send Log to This Email', TGDPRCL_DOMAIN); ?></a>
            <a href="<?php echo admin_url("admin-post.php?action=delete_chosen_user_access_email&email_address=$email_address&_wpnonce=$tgdprc_user_data_nonce"); ?>" onclick="return confirm('Do you want to delete?')" class="button button-secondary tgdprc-action-button-3"><?php echo __('Delete', TGDPRCL_DOMAIN); ?></a>
        </div>
        <?php include_once TGDPRCL_PATH . 'inc/backend/user-data/tgdprc-inc-logs.php'; ?>
        <div class="tgdprc-first-row">
            <a href="<?php echo admin_url("admin.php?page=tgdprcl-userdata"); ?>" class="button button-secondary tgdprc-action-button-1"><?php echo __('Go Back', TGDPRCL_DOMAIN); ?></a>
            <a href="<?php echo admin_url("admin-post.php?action=tgdprc_send_email_with_userdata_to_user&subpage=preview-user-data-logs&email_address=$email_address&_wpnonce=$tgdprc_user_data_nonce"); ?>" onclick="return confirm('Do you want to send email to this selected user ?')" class="button button-secondary tgdprc-action-button-2"><?php echo __('Send Log to This Email', TGDPRCL_DOMAIN); ?></a>
            <a href="<?php echo admin_url("admin-post.php?action=delete_chosen_user_access_email&email_address=$email_address&_wpnonce=$tgdprc_user_data_nonce"); ?>" onclick="return confirm('Do you want to delete?')" class="button button-secondary tgdprc-action-button-3"><?php echo __('Delete', TGDPRCL_DOMAIN); ?></a>
        </div>
    </form>
</div>
<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_container">
    <?php
    global $wpdb;
    $tgdprc_table_name = $wpdb->prefix . 'tgdprc_consent_log';
    $title = esc_attr__('View Advanced Cookie Consent Log', TGDPRCL_DOMAIN);
    include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php';
    $delete_nonce = wp_create_nonce('tgdprc_consent_delete_nonce');
    $export_nonce = wp_create_nonce('tgdprc_export_consent_nonce');
    $export_link = admin_url('admin-post.php?page=tgdprcl-advance-cookies&subpage=view-consent-logs&action=export_consent_log_entries&_wpnonce=' . $export_nonce);
    ?>
    <?php if (isset($_GET['message']) && $_GET['message'] == 1): ?>
        <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Consent Deleted Successfully', TGDPRCL_DOMAIN) ?></p></div>
    <?php elseif (isset($_GET['message']) && $_GET['message'] == 0): ?>
        <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Consent Delete Failed. Please Try Again.', TGDPRCL_DOMAIN) ?></p></div>
    <?php endif ?>	
    <form method="post" id="manageForm" action="<?php echo admin_url('admin-post.php'); ?>">
        <?php
        $tgdprc_result = $wpdb->get_results("SELECT * FROM $tgdprc_table_name");
        ?>
        <table class="tgdprc-cookie-bar-display-table" cellspacing="0">
            <thead>
                <tr>
                    <th><?php esc_attr_e('Browser IP', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Consent Log Browser Header', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Consent Values', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Consent Date', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Consent Last Edited Date', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Action', TGDPRCL_DOMAIN) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($tgdprc_result) > 0) {

                    foreach ($tgdprc_result as $tgdprc_resultt):
                        $consent_log_details = isset($tgdprc_resultt->consent_log_details) && !empty($tgdprc_resultt->consent_log_details) ? maybe_unserialize($tgdprc_resultt->consent_log_details) : array();
                        ?>
                        <tr>
                            <td><?php echo!empty($tgdprc_resultt->browser_ip) ? esc_attr($tgdprc_resultt->browser_ip) : ''; ?></td>
                            <td><?php
                                echo isset($consent_log_details['tgdprc_user_agent']) && !empty($consent_log_details['tgdprc_user_agent']) ? esc_attr($consent_log_details['tgdprc_user_agent']) : '';
                                ?> / <?php
                                echo isset($consent_log_details['tgdprc_browser_header']) && !empty($consent_log_details['tgdprc_browser_header']) ? esc_attr($consent_log_details['tgdprc_browser_header']) : '';
                                ?>
                            </td>
                            <td>
                                <?php
                                if (isset($consent_log_details['consent_values']) && !empty($consent_log_details['consent_values'])) {
                                    foreach ($consent_log_details['consent_values'] as $consent_key => $consent_val) {
                                        echo '<p>' . $consent_val . '</p>';
                                    }
                                }
                                ?>
                            </td>
                            <td><?php echo!empty($tgdprc_resultt->consent_date) ? esc_attr($tgdprc_resultt->consent_date) : ''; ?></td>
                            <td><?php echo!empty($tgdprc_resultt->consent_last_edit_date) ? esc_attr($tgdprc_resultt->consent_last_edit_date) : ''; ?></td>
                            <td><div class="cookie_settings_options"><a href="<?php echo admin_url("admin-post.php?action=tgdprc_delete_consent_log&log_id=$tgdprc_resultt->id&_wpnonce=$delete_nonce"); ?>" onclick="return confirm('Do you want to delete?')" class="tgdprc_delete_button"></a></div></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php
                } else {
                    ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td><?php esc_attr_e('No Consent to Display.', TGDPRCL_DOMAIN) ?></td>
                        <td>&nbsp;</td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th><?php esc_attr_e('Browser IP', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Consent Log Browser Header', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Consent Values', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Consent Date', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Consent Last Edited Date', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Action', TGDPRCL_DOMAIN) ?></th>
                </tr>
            </tfoot>
        </table>
        <div class="tgdprci-cookie-bar-form-container">
            <?php
            ?>
            <a href="<?php echo admin_url("admin-post.php?action=tgdprc_delete_all_consent_log&_wpnonce=$delete_nonce"); ?>" onclick="return confirm('Do you want to delete all consent logs?')" class="tgdprc_delete_button"></a>
    </form>
</div>
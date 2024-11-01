<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<?php
$userdata_setting = get_option('user-data-settings');
if (isset($userdata_setting['data_request']['enable']) && $userdata_setting['data_request']['enable'] == 1) {
    ?>
    <div class="tgdprc-user-data-form-wrap" id="tgdprc-user-data-form-wrap">
        <form method="post" id="manageForm" action="<?php echo admin_url('admin-post.php'); ?>">
            <div class="tgdprci-cookie-bar-form-container">
                <?php wp_nonce_field('tgdprc_nonce', 'tgdprc_nonce_field'); ?>
                <input type="hidden" name="action" value="tgdprc_save_user_datasetting_field_options">
                <div class="nav-tab-wrapper">
                    <?php if (!isset($userdata_setting['data_request']['disable_this_form'])) { ?>
                        <a href="javascript:void(0)" class="nav-tab tgdprc-nav-tab-user-data nav-tab-active tgdprc-user-nav-tab-active" id="tgdprc-data-access"><?php esc_attr_e('Data Access', TGDPRCL_DOMAIN) ?></a>
                    <?php } ?>
                    <?php if (!isset($userdata_setting['data_rectification']['disable_this_form'])) { ?>
                        <a href="javascript:void(0)" class="nav-tab tgdprc-nav-tab-user-data <?php
                        if ((!isset($userdata_setting['data_rectification']['disable_this_form']) && isset($userdata_setting['data_request']['disable_this_form']) && !isset($userdata_setting['data_forget']['disable_this_form'])) || (!isset($userdata_setting['data_rectification']['disable_this_form']) && isset($userdata_setting['data_request']['disable_this_form']) && isset($userdata_setting['data_forget']['disable_this_form']))) {
                            echo 'nav-tab-active tgdprc-user-nav-tab-active';
                        }
                        ?>" id="tgdprc-data-rectification"><?php esc_attr_e('Data Rectification', TGDPRCL_DOMAIN) ?></a>
                       <?php } ?>
                       <?php if (!isset($userdata_setting['data_forget']['disable_this_form'])) { ?>
                        <a href="javascript:void(0)" class="nav-tab tgdprc-nav-tab-user-data <?php
                        if ((isset($userdata_setting['data_rectification']['disable_this_form']) && isset($userdata_setting['data_request']['disable_this_form']) && !isset($userdata_setting['data_forget']['disable_this_form'])) || (isset($userdata_setting['data_rectification']['disable_this_form']) && isset($userdata_setting['data_request']['disable_this_form']) && !isset($userdata_setting['data_forget']['disable_this_form']))) {
                            echo 'nav-tab-active tgdprc-user-nav-tab-active';
                        }
                        ?>" id="tgdprc-data-forget"><?php esc_attr_e('Data Forget', TGDPRCL_DOMAIN) ?></a>
                       <?php } ?>
                </div>
                <?php
                if (!isset($userdata_setting['data_request']['disable_this_form'])) {
                    include_once 'tabs/data-access.php';
                }
                if (!isset($userdata_setting['data_rectification']['disable_this_form'])) {
                    include_once 'tabs/data-rectification.php';
                }
                if (!isset($userdata_setting['data_forget']['disable_this_form'])) {
                    include_once 'tabs/data-forget.php';
                }
                ?>
            </div>
        </form>
    </div>
<?php } ?> 
<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_container">
    <?php
    $title = esc_attr__('Service Settings', TGDPRCL_DOMAIN);
    include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php';

    $tgdprc_service_setting = get_option('tgdprc-services-settings');
    ?>
    <?php
    if (isset($_GET['message']) && $_GET['message'] == 1):
        ?>    
        <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Setting Saved Successfullly.', TGDPRCL_DOMAIN); ?></p></div>
        <?php elseif (isset($_GET['message']) && $_GET['message'] == 0): ?>
            <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Setting wasn\'t Saved Successfullly.', TGDPRCL_DOMAIN); ?></p></div>
            <?php
        endif;
        ?>
        <form method="post" id="manageForm" action="<?php echo admin_url('admin-post.php'); ?>">
            <?php wp_nonce_field('tgdprc_nonce', 'tgdprc_nonce_field'); ?>
            <input type="hidden" name="action" value="tgdprc_save_service_setting_field_options">
            <?php
            $tgdprc_service_setting_nonce = wp_create_nonce('tgdprc_service_setting_nonce');
            ?>
            <div class="tgdprc_design_settings_wrap tgdprc-services-tabs-content" id="tgdprc-userdata-tabs-content-tgdprc-data-services-settings">
                <div class="tgdprc_struct_settings_header">
                    <h4>
                        <?php esc_attr_e('Setting for configuring all the services that are being used in the site.', TGDPRCL_DOMAIN) ?>
                    </h4> 
                    <p>
                        <quote>
                            <strong><?php esc_attr_e('Shortcode', TGDPRCL_DOMAIN) ?></strong> : [tgdprc-cookies-used] 
                        </quote>
                    </p>
                </div>
                <div class="tgdprc_struct_settings_header">
                    <h3><?php esc_attr_e('Form Setting', TGDPRCL_DOMAIN); ?></h3>
                </div>
                <div class="tgdprc_struct_settings_body">
                    <div class="tgdprc_checkbox_wrap">
                        <label><?php esc_attr_e('Enable Services', TGDPRCL_DOMAIN) ?></label>
                        <input type="checkbox" name="tgdprc_service_setting[enable]" value="1" <?php
                        if (isset($tgdprc_service_setting['enable']) && $tgdprc_service_setting['enable'] == 1) {
                            echo 'checked="checked"';
                        }
                        ?> class="tgdprc-bulb-switch" id="tgdprc-enable-services-across-site">
                        <label for="tgdprc-enable-services-across-site"></label>
                        <p class="tgdprc-description"><?php echo __('Please enable this checkbox to show services in the frontend.', TGDPRCL_DOMAIN); ?></p>	
                    </div>
                    <div class="tgdprc_checkbox_wrap">
                        <label><?php esc_attr_e('Enable Display of Default Plugin Services', TGDPRCL_DOMAIN) ?></label>
                        <input type="checkbox" name="tgdprc_service_setting[display_plugin_services]" value="1" <?php
                        if (isset($tgdprc_service_setting['display_plugin_services']) && $tgdprc_service_setting['display_plugin_services'] == 1) {
                            echo 'checked="checked"';
                        }
                        ?> class="tgdprc-bulb-switch" id="tgdprc-enable-default-services-default-service-row">
                        <label for="tgdprc-enable-default-services-default-service-row"></label>
                        <p class="tgdprc-description"><?php echo __('Please enable this checkbox to show services used by the plugin.', TGDPRCL_DOMAIN); ?></p>	
                    </div>
                    <div class="tgdprc_struct_settings_field tgdprc-secondary-setting-label-class">
                        <label><?php esc_attr_e('Preview Of Services Used by the plugin', TGDPRCL_DOMAIN) ?></label>
                    </div>
                    <table class="tgdprc-cookie-bar-display-table tgdprc-gdpr-default-services-table" cellspacing="0">
                        <thead>
                            <tr>
                                <th><?php esc_attr_e('S.N.', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Header', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Purpose', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Cookies Used', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Cookies Types', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Cookies Nature', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Expiry Time(For Repititive)', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Is Blockable', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Currently Active in Site', TGDPRCL_DOMAIN) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php esc_attr_e('1', TGDPRCL_DOMAIN) ?></td>
                                <td><?php esc_attr_e('Total GDPR Complaince Lite', TGDPRCL_DOMAIN) ?></td>
                                <td><?php esc_attr_e('Making the site GDPR Compatible', TGDPRCL_DOMAIN) ?></td>
                                <td><?php esc_attr_e('tgdprc_policie_cookie, tgdprc_terms_cookie, tgdprc_cookie_expiry', TGDPRCL_DOMAIN) ?></td>
                                <td><?php esc_attr_e('Strictly Neccessary', TGDPRCL_DOMAIN) ?></td>
                                <td><?php esc_attr_e('Repetitive', TGDPRCL_DOMAIN) ?></td>
                                <td><?php esc_attr_e('Custom', TGDPRCL_DOMAIN) ?></td>
                                <td><?php esc_attr_e('No', TGDPRCL_DOMAIN) ?></td>
                                <td><?php esc_attr_e('Yes', TGDPRCL_DOMAIN) ?></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php esc_attr_e('S.N.', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Header', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Purpose', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Cookies Used', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Cookies Types', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Cookies Nature', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Expiry Time(For Repititive)', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Is Blockable', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Currently Active in Site', TGDPRCL_DOMAIN) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="tgdprc-cookie-list-used-in-site">
                        <div class="tgdprc_struct_settings_header">
                            <h3><?php esc_attr_e('Basic Cookies Used/Currently Active In the Site', TGDPRCL_DOMAIN); ?></h3>
                        </div>
                        <table class="tgdprc-cookie-bar-display-table tgdprc-gdpr-default-services-table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><?php esc_attr_e('Header', TGDPRCL_DOMAIN) ?></th>
                                    <th><?php esc_attr_e('Values', TGDPRCL_DOMAIN) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cookie = isset($_COOKIE) && !empty($_COOKIE) ? $_COOKIE : '';
                                foreach ($cookie as $key => $val) {
                                    if (is_array($val)) {
                                        ?>
                                        <tr>
                                            <?php
                                            foreach ($val as $k => $v):
                                                echo '<td>' . esc_attr($k) . ', ';
                                                echo stripslashes_deep(esc_attr($v)) . '</td>';
                                            endforeach;
                                            ?>
                                        </tr>
                                        <?php
                                    }else {
                                        ?>
                                        <tr>
                                            <?php
                                            echo '<td>' . esc_attr($key) . '</td>';
                                            echo '<td>' . stripslashes_deep(esc_attr($val)) . '</td>';
                                            ?>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?php esc_attr_e('Header', TGDPRCL_DOMAIN) ?></th>
                                    <th><?php esc_attr_e('Values', TGDPRCL_DOMAIN) ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <input type="submit" name="tgdprc_save_service_setting_field_settings" class="tgdprc_save_service_setting_button button button-primary" value="<?php esc_attr_e('Save Settings', TGDPRCL_DOMAIN) ?>"/>
        </form>
    </div>
    <div id="tgdprcl-postbox-container-1" class="tgdprcl-postbox-container">
        <?php include(TGDPRCL_PATH . 'inc/backend/tgdprcl-sidebar.php'); ?>
    </div>
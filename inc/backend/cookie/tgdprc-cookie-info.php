<?php
defined('ABSPATH') or die('No script kiddies please!');
?>
<div class="tgdprc_container">
    <div class="tgdprc_main_function_wrap">
        <?php
        //Declaring the inner join above
        global $tgdprcl_template_key_value_pair;
        global $wpdb;
        $wpcui_table = $wpdb->prefix . "tgdprc_settings";
        $menu_lists = $wpdb->get_results("SELECT * FROM $wpcui_table");
        ?>
        <?php include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php'; ?>

        <?php if (isset($_GET['message']) && $_GET['message'] == 1): ?>
            <?php if (isset($_GET['delete_message']) && $_GET['delete_message'] == 1): ?>
                <div class="notice notice-success is-dismissible">
                    <p>
                        <?php esc_attr_e('Deleted Successfully', TGDPRCL_DOMAIN) ?>
                    </p>
                </div>
                <?php elseif (isset($_GET['delete_message']) && $_GET['delete_message'] == 0): ?>
                    <div class="notice notice-error is-dismissible">
                        <p>
                            <?php esc_attr_e('Deletion Failed', TGDPRCL_DOMAIN) ?>
                        </p>
                    </div>
                    <?php elseif (isset($_GET['copyFailed']) && $_GET['copyFailed'] == 0): ?>
                        <div class="notice notice-error is-dismissible">
                            <p>
                                <?php esc_attr_e('Copy Failed', TGDPRCL_DOMAIN) ?>
                            </p>
                        </div>
                    <?php endif ?>
                    <?php elseif (isset($_GET['message']) && $_GET['message'] == 404): ?>
                        <div class="notice notice-error is-dismissible">
                            <p>
                                <?php esc_attr_e('Action Failed. Please Try Again.', TGDPRCL_DOMAIN) ?>
                            </p>
                        </div>
                    <?php endif ?>

                    <a href="<?php echo admin_url('admin.php') . '?page=tgdprcl-manage-cookie-settings&action=add'; ?>" id="add_cookie_bar"><button class="wpcui_add_button button button-primary"><?php esc_attr_e('Add New Cookie Info', TGDPRCL_DOMAIN) ?></button></a>

                    <?php
                    $del_sel_nonce = wp_create_nonce('tgdprc_delete_marked_nonce');
                    ?>
                    <input type="hidden" id="wpcui_del_mark_field" value="<?= $del_sel_nonce ?>">
                    <button class="tgdprc_delete_marked button button-secondary" data-source="element" style="display: none;"><?php esc_attr_e('Delete Marked', TGDPRCL_DOMAIN) ?></button>

                    <div class="tgdprc_body">
                        <table class="tgdprc-cookie-bar-display-table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><?php if (count($menu_lists) > 0) { ?><input type="checkbox" class="tgdprc_mark_all_elements"><?php
                                } else {
                                    echo "&nbsp;";
                                }
                                ?></th>
                                <th><?php esc_attr_e('Cookie Title', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Display Type', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Position', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Template Name', TGDPRCL_DOMAIN) ?></th>
                                <th><?php esc_attr_e('Actions', TGDPRCL_DOMAIN) ?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (count($menu_lists) > 0) {
                                foreach ($menu_lists as $menu):
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" class="tgdprc_mark_individual" value="<?php echo intval(esc_attr($menu->id)) ?>"></td>

                                        <td><a href="<?php echo admin_url('admin.php'); ?>?page=tgdprcl-manage-cookie-settings&action=edit&id=<?php echo intval(esc_attr($menu->id)); ?>"><div class="wcui_cookie_bar_name"><?php echo esc_attr($menu->name); ?></div></a></td>

                                        <?php $display_settings = maybe_unserialize($menu->display_settings); ?>
                                        <td><?php echo!empty($display_settings['layout']['display_type']) ? ucwords(esc_attr($display_settings['layout']['display_type'])) : '' ?></td>

                                        <td><?php echo!empty($display_settings['layout']['display_type']) ? (esc_attr($display_settings['layout']['display_type'] == 'bar') ? ucwords(esc_attr($display_settings['layout']['bar_position'])) : (($display_settings['layout']['display_type'] == 'popup') ? ucwords(esc_attr($display_settings['layout']['popup_position'])) : (($display_settings['layout']['floating_position']) ? ucwords(esc_attr($display_settings['layout']['floating_position'])) : ''))) : esc_attr__('Error', TGDPRCL_DOMAIN); ?></td>

                                        <td><?php echo esc_attr(($display_settings['layout']['display_type'] == 'bar') ? esc_attr($tgdprcl_template_key_value_pair[$display_settings['layout']['bar_template_type']]) : (($display_settings['layout']['display_type'] == 'popup') ? ($tgdprcl_template_key_value_pair[$display_settings['layout']['popup_template_type']]) : (($display_settings['layout']['display_type'] == 'floating') ? ($tgdprcl_template_key_value_pair[$display_settings['layout']['floating_template_type']]) : ''))); ?></td>

                                        <td><div class="cookie_settings_options">
                                            <a href="<?php echo admin_url('admin.php'); ?>?page=tgdprcl-manage-cookie-settings&action=edit&id=<?php echo intval(esc_attr($menu->id)); ?>" class="wpcui_edit_button"></a>

                                            <a href="<?php echo get_home_url(); ?>?tgdprc_cookie_preview=<?php echo intval(esc_attr($menu->id)); ?>" target="_blank" class="wpcui_preview_button"></a>
                                            <?php
                                            $nonce1 = wp_create_nonce('delete_setting_nonce');
                                            ?>
                                            <a href="<?php echo admin_url('admin-post.php'); ?>?action=delete_choosen_setting&id=<?php echo intval(esc_attr($menu->id)); ?>&_wpnonce=<?php echo esc_attr($nonce1); ?>" onclick="return confirm('Do you want to delete?')" class="tgdprc_delete_button"></a>
                                            <?php
                                            $nonce2 = wp_create_nonce('copy_setting_nonce');
                                            ?>
                                            <a href="<?php echo admin_url('admin-post.php'); ?>?action=copy_choosen_setting&id=<?php echo intval(esc_attr($menu->id)); ?>&_wpnonce=<?php echo esc_attr($nonce2); ?>" onclick="return confirm('Do you wish to copy?')" class="tgdprc_copy_button"></a>
                                        </div></td>

                                    </tr>
                                <?php endforeach; ?>
                                <?php
                            }

                            else {
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><?php esc_attr_e('No Cookie bar to display. Add a New Cookie Info', TGDPRCL_DOMAIN) ?></td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php if (count($menu_lists) > 0) { ?><input type="checkbox" class="tgdprc_mark_all_elements"><?php
                            } else {
                                echo "&nbsp;";
                            }
                            ?></th>
                            <th><?php esc_attr_e('Cookie Title', TGDPRCL_DOMAIN) ?></th>
                            <th><?php esc_attr_e('Display Type', TGDPRCL_DOMAIN) ?></th>
                            <th><?php esc_attr_e('Position', TGDPRCL_DOMAIN) ?></th>
                            <th><?php esc_attr_e('Template Name', TGDPRCL_DOMAIN) ?></th>
                            <th><?php esc_attr_e('Actions', TGDPRCL_DOMAIN) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div id="tgdprcl-postbox-container-1" class="tgdprcl-postbox-container">
        <?php include(TGDPRCL_PATH . 'inc/backend/tgdprcl-sidebar.php'); ?>
    </div>
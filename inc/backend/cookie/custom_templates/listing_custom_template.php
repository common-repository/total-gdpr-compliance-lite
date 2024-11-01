<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_container">

    <div class="tgdprc_main_function_wrap">

        <?php
        //Declaring the inner join above
        global $wpdb;
        $wpcui_table = $wpdb->prefix . "tgdprc_custom_template";
        $menu_lists = $wpdb->get_results("SELECT * FROM $wpcui_table");
        ?>


        <?php include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php'; ?>

        <?php if (isset($_GET['message']) && $_GET['message'] == 1): ?>
            <?php if (isset($_GET['delete_message']) && $_GET['delete_message'] == 1): ?>
                <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Template deleted', TGDPRCL_DOMAIN) ?></p></div>
                <?php elseif (isset($_GET['delete_message']) && $_GET['delete_message'] == 0): ?>
                    <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Template cannot be deleted', TGDPRCL_DOMAIN) ?></p></div>
                    <?php elseif (isset($_GET['copyFailed']) && $_GET['copyFailed'] == 1) : ?>
                        <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Copying Template Failed', TGDPRCL_DOMAIN) ?></p></div>
                    <?php endif ?>
                <?php endif ?>

                <a href="<?php echo admin_url('admin.php') . '?page=tgdprcl-cookie-custom-template&action=add'; ?>" id="add_custom_template"><button class="wpcui_add_button button button-primary"><?php esc_attr_e('Add New Custom Template', TGDPRCL_DOMAIN) ?></button></a>

                <?php
                $del_sel_nonce = wp_create_nonce('tgdprc_delete_marked_template_nonce');
                ?>
                <input type="hidden" id="wpcui_del_mark_field" value="<?= $del_sel_nonce ?>">
                <button class="tgdprc_delete_marked button button-secondary" data-source="template" style="display: none;"><?php esc_attr_e('Delete Marked', TGDPRCL_DOMAIN) ?></button>

                <div class="tgdprc_body">

                    <table class="tgdprc-cookie-bar-display-table" cellspacing="0">

                        <thead>
                            <tr>
                                <th><?php if (count($menu_lists) > 0) { ?><input type="checkbox" class="tgdprc_mark_all_elements"><?php
                            } else {
                                echo "&nbsp;";
                            }
                            ?></th>
                            <th><?php esc_attr_e('Custom Template Title', TGDPRCL_DOMAIN) ?></th>
                            <th><?php esc_attr_e('Actions', TGDPRCL_DOMAIN) ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (count($menu_lists) > 0) {
                            foreach ($menu_lists as $menu):
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="tgdprc_mark_individual" value="<?php echo intval($menu->id) ?>"></td>

                                    <td><a href="<?php echo admin_url('admin.php'); ?>?page=tgdprcl-cookie-custom-template&action=edit&id=<?php echo intval($menu->id); ?>"><div class="wcui_cookie_bar_name"><?php echo esc_attr($menu->template_name); ?></div></a>
                                    </td>
                                    <td>
                                        <div class="cookie_settings_options">
                                            <a href="<?php echo admin_url('admin.php'); ?>?page=tgdprcl-cookie-custom-template&action=edit&id=<?php echo intval($menu->id); ?>" class="wpcui_edit_button"></a>
                                            <?php
                                            $nonce1 = wp_create_nonce('delete_template_nonce');
                                            ?>
                                            <a href="<?php echo admin_url('admin-post.php'); ?>?action=delete_template_setting&id=<?php echo $menu->id; ?>&_wpnonce=<?php echo esc_attr($nonce1); ?>" onclick="return confirm('Do you want to delete?')" class="tgdprc_delete_button"></a>
                                            <?php
                                            $nonce2 = wp_create_nonce('copy_template_nonce');
                                            ?>
                                            <a href="<?php echo admin_url('admin-post.php'); ?>?action=copy_template_setting&id=<?php echo $menu->id; ?>&_wpnonce=<?php echo esc_attr($nonce2); ?>" onclick="return confirm('Do you wish to copy?')" class="tgdprc_copy_button"></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php
                        }

                        else {
                            ?>
                            <tr>
                                <td><?php esc_attr_e('No Custom Template to display. Add a New Custom Template', TGDPRCL_DOMAIN) ?></td>
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
                        <th><?php esc_attr_e('Custom Template Title', TGDPRCL_DOMAIN) ?></th>
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
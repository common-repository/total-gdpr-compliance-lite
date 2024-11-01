<?php
defined('ABSPATH') or die('No scripts for you!!');
if (isset($selected_cookie['specific_page']) && !empty($selected_cookie['specific_page']) && $selected_cookie['specific_page'] != '-1'):
    ?>
<div class="wpcui_specific_terms" style="display: none;">
    <?php
    $specific_pages = explode(',', $selected_cookie['specific_page']);
    foreach ($specific_pages as $index => $value):
        ?>
        <input type="hidden" class="term_id" value="<?php echo intval($value) ?>">
    <?php endforeach ?>
</div>
<?php endif ?> 
<div class="tgdprc_container">
    <div class="tgdprc_main_function_wrap">

        <?php include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php'; ?>

        <?php if (isset($_GET['message']) && $_GET['message'] == 1): ?>
            <div class="notice notice-success is-dismissible"><p><?php esc_attr_e('Cookie Setting Saved Successfully.', TGDPRCL_DOMAIN) ?></p></div>
            <?php elseif (isset($_GET['message']) && $_GET['message'] == 2): ?>
                <div class="notice notice-error is-dismissible"><p><?php esc_attr_e('Couldnot Save Cookie Setting or No Changes Done. Please Try Again.', TGDPRCL_DOMAIN) ?></p></div>
            <?php endif; ?>

            <div style="margin-top: 15px;"></div>
            <form method="post" action="<?php echo admin_url('admin-post.php') ?>">
                <input type="hidden" name="action" value="tgdprc_save_cookie_settings">
                <?php wp_nonce_field('tgdprc_nonce', 'tgdprc_nonce_field'); ?>
                <div class="tgdprc_choice_settings_field">
                    <label><?php esc_attr_e('Enable/Disable Notice', TGDPRCL_DOMAIN) ?></label>
                    <div class="tgdprc_checkbox_wrap">
                        <input type="checkbox" name="status"

                        <?php
                        if (isset($selected_cookie['status'])) {
                           echo "checked='checked'";
                       }
                       ?>
                       id="wpcui_cookie_bar_status"
                       >
                       <label for="wpcui_cookie_bar_status"></label>
                   </div>
               </div>
               <div class="tgdprc_choice_settings_field">
                <label><?php esc_attr_e('Mobile Mode', TGDPRCL_DOMAIN) ?></label>
                <div class="tgdprc_checkbox_wrap">
                    <input type="checkbox" name="mobile_mode" value="1" id="wpcui_mobile_mode" <?php 
                    if(isset($selected_cookie['mobile_mode'])) checked($selected_cookie['mobile_mode']) ?>>
                    <label for="wpcui_mobile_mode"></label>
                </div>
            </div>
            <div class="tgdprc_choice_settings_field">
                <label><?php esc_attr_e('Cookie Info', TGDPRCL_DOMAIN) ?></label>
                <?php if ($active): ?>
                    <select name="selected_cookie">
                        <?php foreach ($cookie_bars as $cookie_bar => $object): ?>
                            <option value="<?php echo intval($object->id); ?>" <?php selected($selected_cookie['cookie-bar'], $object->id);
                            ?> ><?php echo esc_attr($object->name); ?></option>							
                        <?php endforeach ?>
                    </select>
                    <?php else: ?>
                        <i class="additional_field_message"><?php esc_attr_e('Add a cookie bar first: ', TGDPRCL_DOMAIN) ?><a href="<?php echo admin_url('admin.php') . '?page=tgdprcl-manage-cookie-settings'; ?>"><?php esc_attr_e('here', TGDPRCL_DOMAIN) ?></a><?php esc_attr_e(' to select a cookie bar', TGDPRCL_DOMAIN) ?></i>
                    <?php endif; ?>
                </div>
                <div class="tgdprc_choice_settings_field">
                    <label><?php esc_attr_e('Display Page', TGDPRCL_DOMAIN) ?></label>
                    <select name="displayed_pages" class="tgdprc-show-specific-page-selector">
                        <?php
                        $options = get_option('tgdprc_general_option');
                        foreach ($options['displayed_pages'] as $key => $value):
                            ?>
                            <option value="<?php echo esc_attr($value); ?>"

                                <?php
                                if (isset($selected_cookie['displayed_pages']) &&  $selected_cookie['displayed_pages']== $value) {
                                    echo "selected='selected'";
                                }
                                ?>

                                ><?php echo ucwords(esc_attr($value)); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Specific Pages and Taxonomies Post -->
                    <div class="tgdprc_notice_display_option tgdprc_field_of_specific_page" style="display: none;">
                        <input type="hidden" id="tgdprc_checked_cma" name="specific_page" value="<?php echo!empty($checked_cma) ? esc_attr__($checked_cma) : ''; ?>">
                        <div class="tgdprc_choice_settings_field">
                            <label><?php esc_attr_e('Choose From Specific', TGDPRCL_DOMAIN) ?></label>
                            <?php
                            $p_nonce = wp_create_nonce('tgdprc_pagination_nonce');
                            ?>
                            <input type="hidden" id="pagination_nonce" value="<?php echo esc_attr($p_nonce); ?>">
                        </div>
                        <div class="tgdprc_choice_settings_field">
                            <label><?php esc_attr_e('Default Pages', TGDPRCL_DOMAIN) ?></label>
                            <div class="wpcui_default_pages_div wpcui_terms_div">
                                <?php $default_page = (isset($selected_cookie['default_page']) && $selected_cookie['default_page'] != '-1') ? maybe_unserialize($selected_cookie['default_page']) : array() ?>
                                <div class="wpcui_def_index_pages"><input type="checkbox" name="default_page[]" value="<?= esc_attr("404") ?>" <?php checked(in_array('404', $default_page), boolval(1)) ?>><span><?php esc_attr_e("404 Page", TGDPRCL_DOMAIN) ?></span></div>
                                <div class="wpcui_def_index_pages"><input type="checkbox" name="default_page[]" value="<?= esc_attr("archive") ?>" <?php checked(in_array('archive', $default_page), boolval(1)) ?>><span><?php esc_attr_e("Archive Page", TGDPRCL_DOMAIN) ?></span></div>
                                <div class="wpcui_def_index_pages"><input type="checkbox" name="default_page[]" value="<?= esc_attr("search") ?>" <?php checked(in_array('search', $default_page), boolval(1)) ?>><span><?php esc_attr_e("Search Page", TGDPRCL_DOMAIN) ?></span></div>
                                <div class="wpcui_def_index_pages"><input type="checkbox" name="default_page[]" value="<?= esc_attr("blog") ?>" <?php checked(in_array('blog', $default_page), boolval(1)) ?>><span><?php esc_attr_e("Home/Blog Page", TGDPRCL_DOMAIN) ?></span></div>
                                <div class="wpcui_def_index_pages"><input type="checkbox" name="default_page[]" value="<?= esc_attr("default_home") ?>" <?php checked(in_array('default_home', $default_page), boolval(1)) ?>><span><?php esc_attr_e("Default Home Page", TGDPRCL_DOMAIN) ?></span></div>
                                <div class="wpcui_def_index_pages"><input type="checkbox" name="default_page[]" value="<?= esc_attr("static_home") ?>" <?php checked(in_array('static_home', $default_page), boolval(1)) ?>><span><?php esc_attr_e("Static Home Page", TGDPRCL_DOMAIN) ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tgdprc_choice_settings_field">
                    <button type="submit" class="tgdprc-save-cookie-choice-setting-button button button-primary" <?php echo (!$active) ? "disabled='disabled'" : ''; ?>>
                        <?php esc_attr_e('Save Setting', TGDPRCL_DOMAIN) ?>
                    </button>
                </div>
            </form>

        </div>
        <div id="tgdprcl-postbox-container-1" class="tgdprcl-postbox-container">
            <?php include(TGDPRCL_PATH . 'inc/backend/tgdprcl-sidebar.php'); ?>
        </div>
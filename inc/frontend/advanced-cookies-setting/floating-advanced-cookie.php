<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php
$advanced_cookie_settings['advanced'] = get_option('tgdprc-advanced-cookie-settings');
$enable_floating_trigger = isset($advanced_cookie_settings['advanced']['floating_advanced_cookie']['enable_floating_advanced_cookie_setting']) && $advanced_cookie_settings['advanced']['floating_advanced_cookie']['enable_floating_advanced_cookie_setting'] == 1 ? 1 : 0;

if ($enable_floating_trigger == 1) {
    $show_pageswise_floating_adv_cookie_trigger = isset($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_display_where']) && !empty($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_display_where']) ? esc_attr($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_display_where']) : '';
    $trigger_icon = isset($advanced_cookie_settings['advanced']['floating_advanced_cookie']['floating_advanced_cookie_icon']) && !empty($advanced_cookie_settings['advanced']['floating_advanced_cookie']['floating_advanced_cookie_icon']) ? $advanced_cookie_settings['advanced']['floating_advanced_cookie']['floating_advanced_cookie_icon'] : array();
    $trigger_show_default_section_array = isset($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_display_where_default']) && !empty($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_display_where_default']) ? $advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_display_where_default'] : array();
    $trigger_show_trigger_box_type = isset($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_type']) && !empty($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_type']) ? 'tgdprc-icon-trigger-design-' . esc_attr($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_type']) : 'tgdprc-icon-trigger-design-square';
    $trigger_show_trigger_box_position = isset($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_position']) && !empty($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_position']) ? 'tgdprc-icon-trigger-position-' . esc_attr($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_position']) : 'tgdprc-icon-trigger-position-bottom-left';
    if (!is_feed()) {
        if ($show_pageswise_floating_adv_cookie_trigger == "all-pages") {
            $show_floating_advanced_menu_trigger = 'on';
        } else if ($show_pageswise_floating_adv_cookie_trigger == "home-page") {
            if (is_front_page()) {
                $show_floating_advanced_menu_trigger = 'on';
            } else {
                $show_floating_advanced_menu_trigger = 'off';
            }
        } else
        if (!empty($trigger_show_default_section_array)) {
            /** For 404 Page Check */
            if (in_array('404', $trigger_show_default_section_array) && is_404()) {
                $show_floating_advanced_menu_trigger = 'on';
            }
            /** For Archive Page Check */
            if (in_array('archive', $trigger_show_default_section_array) && (is_archive() || is_page('archives'))) {
                $show_floating_advanced_menu_trigger = 'on';
            }
            /** For Search Page Check */
            if (in_array('search', $trigger_show_default_section_array) && (is_search())) {
                $show_floating_advanced_menu_trigger = 'on';
            }
            /** Check if Home page if Blog */
            if (in_array('blog', $trigger_show_default_section_array) && is_home()) {
                $show_floating_advanced_menu_trigger = 'on';
            }

            /**  Check if Home page if Default Homepage  */
            if (in_array('default_home', $trigger_show_default_section_array) && is_front_page() && is_home()) {
                $show_floating_advanced_menu_trigger = 'on';
            }
        }

        if ($show_floating_advanced_menu_trigger == 'on') {
            ?>
            <style>
            <?php if (isset($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_bg_color']) && !empty($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_bg_color'])) {
                ?>
                    .tgdprc-floating-trigger-wrap{
                        background-color:<?php esc_attr($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_bg_color']); ?>;                                                           
                    }
                <?php
            }
            ?>
            <?php if (isset($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_icon_color']) && !empty($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_icon_color'])) {
                ?>
                    .tgdprc-icon-trigger-design-square{
                        color: <?php esc_attr($advanced_cookie_settings['advanced']['floating_advanced_cookie']['trigger_box_icon_color']); ?>;                                                           
                    }
                <?php
            }
            ?>
            </style>            
            <div class="tgdprc-floating-trigger-parent-wrap <?php echo esc_attr($trigger_show_trigger_box_position); ?>">
                <div class="tgdprc-floating-trigger-wrap">
                    <span class="<?php echo esc_attr($trigger_show_trigger_box_type); ?>"><i class="<?php
                        if (isset($trigger_icon) && !empty($trigger_icon)) {
                            $v = explode('|', $trigger_icon);
                            echo $v[0] . ' ' . $v[1];
                        } else {
                            echo "fa fa-lightbulb-o";
                        }
                        ?>" aria-hidden="true"></i></span>
                </div>
                <div class="tgdprc-floating-trigger-content-wrap tgdprc-floating-trigger-hidden" style="display:none;">
                    <span class="tgdprc-floating-close-trigger-inner">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </span>
                    <div class="tgdprc-floating-trigger-content-inner">
                        <?php echo do_shortcode('[tgdprc-advanced-cookie-setting]'); ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}    
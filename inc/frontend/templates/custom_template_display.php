<?php
defined('ABSPATH') or die('No script kiddies please!');
if ($display_settings['layout']['select_template_type'] == 'custom' && $custom_template != false) :
    ?>
    <style type="text/css">
        .tgdprc-cookie-bar-display{
            display: none;
        }

        #tgdprc_cookie_bar_main_body{
            <?php
            if ($custom_template['bg_defined_type'] == 'user') {
                echo "background-image: url('" . wp_get_attachment_url($custom_template['background_image_id']) . "');";
                echo "background-size: cover;";
            } elseif ($custom_template['bg_defined_type'] == 'system') {
                echo "background-image: url('" . stripslashes($custom_template['background_image_url']) . "');";
                echo "background-size: cover;";
            } else {
                if (!empty($custom_template['info_bar_bg'])) {
                    echo "background: " . esc_attr($custom_template['info_bar_bg']) . ";";
                }
            }


            if (isset($custom_template['border_status'])) {
                if ($display_settings['layout']['display_type'] == 'bar') {
                    if ($display_settings['layout']['bar_position'] == 'bottom') {
                        echo "border-top: " . $custom_template['border_width'] . "px " . $custom_template['border_type'] . " " . (!empty($custom_template['border_color']) ? esc_attr($custom_template['border_color']) : '') . ";";
                    } elseif ($display_settings['layout']['bar_position'] == 'top fixed' || $display_settings['layout']['bar_position'] == 'top absolute') {
                        echo "border-bottom: " . $custom_template['border_width'] . "px " . $custom_template['border_type'] . " " . (!empty($custom_template['border_color']) ? esc_attr($custom_template['border_color']) : '') . ";";
                    } else {
                        
                    }
                } elseif ($display_settings['layout']['display_type'] == 'popup') {
                    echo "border: " . $custom_template['border_width'] . "px " . $custom_template['border_type'] . " " . (!empty($custom_template['border_color']) ? esc_attr($custom_template['border_color']) : '') . ";";
                }
            }
            ?>
        }

        <?php include_once TGDPRCL_PATH . 'inc/frontend/templates/layouts/bar_templates.php'; ?>
        <?php include_once TGDPRCL_PATH . 'inc/frontend/templates/layouts/popup_templates.php'; ?>
        <?php include_once TGDPRCL_PATH . 'inc/frontend/templates/layouts/floating_templates.php'; ?>

        .tgdprc-cookie-bar-display .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?>:before{
            <?php
            echo "content: '';";
            echo "height: 100%;";
            echo "width: 100%;";
            echo "position: absolute;";
            echo "left: 0px;";
            echo "top: 0px;";
            echo "z-index: -1;";
            if ($custom_template['bg_defined_type'] == 'user') {
                if (!empty($custom_template['info_bar_bg'])) {
                    echo "background: " . $custom_template['info_bar_bg'] . ";";
                }
            } elseif ($custom_template['bg_defined_type'] == 'system') {
                if (!empty($custom_template['info_bar_bg'])) {
                    echo "background: " . $custom_template['info_bar_bg'] . ";";
                }
            }
            ?>
        }

        div#tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-info-wrap a{
            <?php
            if (!empty($custom_template['info_bar_color'])) {
                echo "color: " . esc_attr($custom_template['info_bar_color']) . ";";
            }
            ?>
        }

        div#tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-info-wrap p,
        div#tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-info-wrap .tgdprc_title_text {
            <?php
            if (!empty($custom_template['info_bar_color'])) {
                echo "color: " . esc_attr($custom_template['info_bar_color']) . ";";
            }
            echo "font-family: " . esc_attr($custom_template['font_family']) . ";";
            ?>
        }

        #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-info-confirm{
            <?php
            //When Custom colors are enabled
            if (!empty($custom_template['info_bar_button_color'])) {
                echo "color: " . esc_attr($custom_template['info_bar_button_color']) . ";";
            }
            if (!empty($custom_template['info_bar_button_bg'])) {
                echo "background: " . esc_attr($custom_template['info_bar_button_bg']) . ";";
            }
            if (!empty($custom_template['info_bar_button_border_color'])) {
                echo "border-color: " . esc_attr($custom_template['info_bar_button_border_color']) . ";";
            }
            ?>
        }

        #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-info-confirm:hover{
            <?php
            echo "color: " . esc_attr($custom_template['info_bar_hover_button_text_color']) . ";";
            echo "background: " . esc_attr($custom_template['info_bar_hover_button_bg_color']) . ";";
            echo "border-color: " . esc_attr($custom_template['info_bar_button_hover_border_color']) . ";";
            ?>
        }






        #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-more_info{
            <?php
            if (!empty($custom_template['more_info_bar_button_color'])) {
                echo "color: " . esc_attr($custom_template['more_info_bar_button_color']) . ";";
            }
            if (!empty($custom_template['more_info_bar_button_bg']) && ($template != 'Template-15')) {
                echo "background: " . esc_attr($custom_template['more_info_bar_button_bg']) . ";";
            }
            if (!empty($custom_template['more_info_bar_button_border_color'])) {
                echo "border-color: " . esc_attr($custom_template['more_info_bar_button_border_color']) . ";";
            }
            ?>
        }

        #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-more_info:hover{
            <?php
            if (!empty($custom_template['more_info_bar_hover_button_text_color'])) {
                echo "color: " . esc_attr($custom_template['more_info_bar_hover_button_text_color']) . ";";
            }
            if (!empty($custom_template['more_info_bar_hover_button_bg_color']) && ($template != 'Template-15')) {
                echo "background: " . esc_attr($custom_template['more_info_bar_hover_button_bg_color']) . ";";
            }
            if (!empty($custom_template['more_info_bar_button_hover_border_color'])) {
                echo "border-color: " . esc_attr($custom_template['more_info_bar_button_hover_border_color']) . ";";
            }
            ?>
        }




        <?php // Close Button Default Styles ?>
        #tgdprc_cookie_bar_main_body .tgdprc-3-column:after {
            <?php
            if (!empty($custom_template['close_button_button_color'])) {
                echo "color: " . esc_attr($custom_template['close_button_button_color']) . ";";
            }
            ?>
        }

        #tgdprc_cookie_bar_main_body .tgdprc-3-column:hover:after{
            <?php
            if (!empty($custom_template['close_button_hover_button_text_color'])) {
                echo "color: " . esc_attr($custom_template['close_button_hover_button_text_color']) . ";";
            }
            ?>
        }


        <?php // Custom Settings for More Info Content Area in Bar and Floating Layouts ?>
        .tgdprc-cookie-bar-more-info-wrap .tgdprc_more_bar_floating .tgdprc-cookie-info-content{
            <?php
            if ($custom_template['more_info_bg_defined_type'] == 'user') {
                echo "background-image: url('" . wp_get_attachment_url($custom_template['more_info_background_image_id']) . "');";
                echo "background-size: cover;";
            } elseif ($custom_template['more_info_bg_defined_type'] == 'system') {
                echo "background-image: url('" . stripslashes($custom_template['more_info_background_image_url']) . "');";
                echo "background-size: cover;";
            } else {
                if (!empty($custom_template['more_info_bg_color'])) {
                    echo "background: " . esc_attr($custom_template['more_info_bg_color']) . ";";
                }
            }

            if (!empty($custom_template['more_info_text_color'])) {
                echo "color: " . esc_attr($custom_template['more_info_text_color']) . ";";
            }
            echo "font-family: " . esc_attr($custom_template['more_info_font_family']) . ";";
            ?>
        }
        .tgdprc-cookie-bar-more-info-wrap .tgdprc_more_bar_floating .tgdprc-cookie-info-content:before{
            <?php
            if (!empty($custom_template['more_info_bg_color'])) {
                echo "content: '';position: absolute;top: 0px;left: 0px;height: 100%;width: 100%;";
                echo "background: " . esc_attr($custom_template['more_info_bg_color']) . ";";
            }
            ?>
        }
        <?php //End of Custom Settings for More Info Content Area  ?>
    </style>
<?php endif; ?>
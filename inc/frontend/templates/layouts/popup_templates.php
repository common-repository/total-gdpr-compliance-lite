<?php
defined('ABSPATH') or die('No scripts for you');

if ($display_settings['layout']['display_type'] == 'popup'):
    $no_close_bg = array('Template-11', 'Template-12', 'Template-14');

    if ($template == 'Template-13'): //Template-13 styles 
        ?>
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn{
        <?php
        if (!empty($custom_template['close_button_button_bg'])) {
            echo 'background-color: ' . esc_attr($custom_template['close_button_button_bg']) . ';';
        }
        if (!empty($custom_template['close_button_button_color'])) {
            echo 'color: ' . esc_attr($custom_template['close_button_button_color']);
        }
        ?>
        }
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn:hover{
        <?php
        if (!empty($custom_template['close_button_hover_button_bg_color'])) {
            echo 'background-color: ' . esc_attr($custom_template['close_button_hover_button_bg_color']) . ';';
        }
        if (!empty($custom_template['close_button_hover_button_text_color'])) {
            echo 'color: ' . esc_attr($custom_template['close_button_hover_button_text_color']);
        }
        ?>
        }

        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-info-confirm:before,
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-info-confirm:after,
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-info-confirm:hover:after,
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-info-confirm:hover:before{
        <?php
        if (!empty($custom_template['info_bar_button_border_color'])) {
            echo 'border-color: ' . esc_attr($custom_template['info_bar_button_border_color']);
        } elseif (!empty($custom_template['info_bar_button_hover_border_color'])) {
            echo 'border-color: ' . esc_attr($custom_template['info_bar_button_hover_border_color']);
        }
        ?>
        }

        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-more_info:after,
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-more_info:before,
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-more_info:hover:after,
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-more_info:hover:before{
        <?php
        if (!empty($custom_template['more_info_bar_button_border_color'])) {
            echo 'border-color: ' . esc_attr($custom_template['more_info_bar_button_border_color']);
        } elseif (!empty($custom_template['more_info_bar_button_hover_border_color'])) {
            echo 'border-color: ' . esc_attr($custom_template['more_info_bar_button_hover_border_color']);
        }
        ?>
        }
    <?php elseif ($template == 'Template-15') : ?>
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn{
        <?php
        if (!empty($custom_template['close_button_border_bg'])) {
            echo 'border-color: ' . esc_attr($custom_template['close_button_border_bg']);
        }
        ?>
        }
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn:hover{
        <?php
        if (!empty($custom_template['close_button_hover_border_bg'])) {
            echo 'border-color: ' . esc_attr($custom_template['close_button_hover_border_bg']);
        }
        ?>
        }
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-more_info:hover:before{
        <?php
        if (!empty($custom_template['more_info_bar_button_hover_border_color'])) {
            echo 'background-color: ' . esc_attr($custom_template['more_info_bar_button_hover_border_color']);
        }
        ?>
        }
    <?php endif //End of Template-13 & Template-15 styles ?>

    <?php if (!in_array($template, $no_close_bg)): ?>
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn{
        <?php
        if (!empty($custom_template['close_button_button_bg'])) {
            echo 'background-color: ' . esc_attr($custom_template['close_button_button_bg']) . ';';
        }
        ?>
        }
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn:hover{
        <?php
        if (!empty($custom_template['close_button_hover_button_bg_color'])) {
            echo 'background-color: ' . esc_attr($custom_template['close_button_hover_button_bg_color']) . ';';
        }
        ?>
        }
    <?php endif ?>

    <?php if ($template != 'Template-13'): ?>
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn:after{
        <?php
        if (!empty($custom_template['close_button_button_color'])) {
            echo 'color: ' . esc_attr($custom_template['close_button_button_color']);
        }
        ?>
        }
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn:hover:after{
        <?php
        if (!empty($custom_template['close_button_hover_button_text_color'])) {
            echo 'color: ' . esc_attr($custom_template['close_button_hover_button_text_color']);
        }
        ?>
        }
    <?php endif ?>

    <?php if ($template == 'Template-12'): ?>
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn:after{
        <?php
        if (!empty($custom_template['close_button_button_bg'])) {
            echo 'color: ' . esc_attr($custom_template['close_button_button_bg']);
        }
        ?>
        }
        .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn:hover:after{
        <?php
        if (!empty($custom_template['close_button_hover_button_bg_color'])) {
            echo 'color: ' . esc_attr($custom_template['close_button_hover_button_bg_color']);
        }
        ?>
        }
    <?php endif ?>


    <?php // More Info Content Area ?>
    .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-more-info-wrap{
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
    ?>
    }

    .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-more-info-wrap:before{
    <?php
    if (!empty($custom_template['more_info_bg_color'])) {
        echo "content: '';position: absolute;top: 0px;left: 0px;height: 100%;width: 100%;";
        echo "background: " . esc_attr($custom_template['more_info_bg_color']) . ";";
    }
    ?>
    }

    .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-more-info-wrap p, .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-more-info-wrap h3, .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-more-info-wrap h4, .tgdprc-cookie-bar-display.tgdprc_display_popup_center .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc-cookie-bar-more-info-wrap a{
    <?php
    if (!empty($custom_template['more_info_text_color'])) {
        echo "color: " . esc_attr($custom_template['more_info_text_color']) . ";";
    }
    echo "font-family: " . esc_attr($custom_template['more_info_font_family']) . ";";
    ?>
    }
    <?php // End of More Info Content Area ?>




    <?php
 endif //End of Popup Custom styles ?>
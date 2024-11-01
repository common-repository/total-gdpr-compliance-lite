<?php
defined('ABSPATH') or die('No scripts for you');
if ($display_settings['layout']['display_type'] == 'floating'):
    ?>
    <?php if ($template != 'Template-18'): ?>
        .tgdprc_cookie_notice_floating.tgdprc_display_floating_top_left .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn{
        <?php
        if (!empty($custom_template['close_button_button_bg'])) {
            echo 'background-color: ' . esc_attr($custom_template['close_button_button_bg']);
        }
        ?>
        }
        .tgdprc_cookie_notice_floating.tgdprc_display_floating_top_left .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn:hover{
        <?php
        if (!empty($custom_template['close_button_hover_button_bg_color'])) {
            echo 'background-color: ' . esc_attr($custom_template['close_button_hover_button_bg_color']);
        }
        ?>
        }

    <?php endif ?>

    .tgdprc_cookie_notice_floating.tgdprc_display_floating_top_left .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn:before{
    <?php
    if (!empty($custom_template['close_button_button_color'])) {
        echo 'color: ' . esc_attr($custom_template['close_button_button_color']);
    }
    ?>
    }

    .tgdprc_cookie_notice_floating.tgdprc_display_floating_top_left .tgdprc-cookie-bar-body.tgdprc_template_<?= $template ?> .tgdprc_close_btn:hover:before{
    <?php
    if (!empty($custom_template['close_button_hover_button_text_color'])) {
        echo 'color: ' . esc_attr($custom_template['close_button_hover_button_text_color']);
    }
    ?>
    }


    <?php


 endif ?>
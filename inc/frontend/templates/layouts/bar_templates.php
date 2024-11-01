<?php
defined('ABSPATH') or die('No scripts for you');
if ($template == 'Template-5'):
    ?>
    .tgdprc-cookie-bar-display .tgdprc-cookie-bar-body.tgdprc_template_Template-5:before{
    <?php
    if (!empty($custom_template['info_bar_bg'])) {
        echo "background-color: " . esc_attr($custom_template['info_bar_bg']) . ";";
    }
    ?>
    }
<?php endif ?>
<?php if ($template == 'Template-23'): ?>
    #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-info-confirm:after {
    <?php
    if (!empty($custom_template['info_bar_box_shadow_hover'])) {
        echo "background-color: " . esc_attr($custom_template['info_bar_box_shadow_hover']);
    }
    ?>
    }
<?php elseif ($template == 'Template-27') :; ?>
    #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-info-confirm{
    <?php
    if (!empty($custom_template['info_bar_box_shadow_hover'])) {
        echo "box-shadow: 0 4px " . esc_attr($custom_template['info_bar_box_shadow_hover']);
    }
    ?>
    }
    #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-info-confirm:hover{
    <?php
    if (!empty($custom_template['info_bar_box_shadow_hover'])) {
        echo "box-shadow: 0 2px " . esc_attr($custom_template['info_bar_box_shadow_hover']);
    }
    ?>
    }
<?php endif ?>
<?php if ($template == 'Template-23'): ?>
    #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-more_info:after {
    <?php
    if (!empty($custom_template['more_info_bar_box_shadow_hover'])) {
        echo "background-color: " . esc_attr($custom_template['more_info_bar_box_shadow_hover']) . ";";
    }
    ?>
    }
<?php elseif ($template == 'Template-25') : ?>
    .tgdprc-cookie-bar-display .tgdprc-cookie-bar-body.tgdprc_template_Template-25 .tgdprc-2-column button.tgdprc-cookie-bar-more_info:before,
    .tgdprc-cookie-bar-display .tgdprc-cookie-bar-body.tgdprc_template_Template-25 .tgdprc-2-column button.tgdprc-cookie-bar-more_info:after{
    <?php
    if (!empty($custom_template['more_info_bar_button_border_color'])) {
        echo "border-color: " . esc_attr($custom_template['more_info_bar_button_border_color']);
    }
    ?>
    }
    .tgdprc-cookie-bar-display .tgdprc-cookie-bar-body.tgdprc_template_Template-25 .tgdprc-2-column button.tgdprc-cookie-bar-more_info:hover:before,
    .tgdprc-cookie-bar-display .tgdprc-cookie-bar-body.tgdprc_template_Template-25 .tgdprc-2-column button.tgdprc-cookie-bar-more_info:hover:after{
    <?php
    if (!empty($custom_template['more_info_bar_button_hover_border_color'])) {
        echo "border-color: " . esc_attr($custom_template['more_info_bar_button_hover_border_color']);
    }
    ?>
    }
<?php endif ?>
<?php if ($template != 'Template-23'): //condition 1: Bar Template Specific Styles   ?>

    #tgdprc_cookie_bar_main_display #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-close-button:before {
    <?php
    //When Custom colors are enabled
    if (!empty($custom_template['close_button_button_bg'])) {
        echo "background: " . esc_attr($custom_template['close_button_button_bg']) . ";";
    }
    if (!empty($custom_template['close_button_border_bg'])) {
        echo "border-color: " . esc_attr($custom_template['close_button_border_bg']);
    }
    ?>
    }
    #tgdprc_cookie_bar_main_display #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-close-button:hover:before{
    <?php
    //When Custom colors are enabled
    if (!empty($custom_template['close_button_hover_button_bg_color'])) {
        echo "background: " . esc_attr($custom_template['close_button_hover_button_bg_color']) . ";";
    }
    if (!empty($custom_template['close_button_hover_border_bg'])) {
        echo "border-color: " . esc_attr($custom_template['close_button_hover_border_bg']);
    }
    ?>
    }


    <?php
    // 	Condition 1.1
    $close_group1 = array('Template-2', 'Template-3', 'Template-5', 'Template-6', 'Template-7');
    if (in_array($template, $close_group1)):
        ?>
        #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-close-button{
        <?php
        //When Custom colors are enabled
        if (!empty($custom_template['close_button_button_bg'])) {
            echo "background: " . esc_attr($custom_template['close_button_button_bg']) . ";";
        }
        if (!empty($custom_template['close_button_border_bg'])) {
            echo "border-color: " . esc_attr($custom_template['close_button_border_bg']);
        }
        ?>
        }
        #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-close-button:hover{
        <?php
        //When Custom colors are enabled
        if (!empty($custom_template['close_button_hover_button_bg_color'])) {
            echo "background: " . esc_attr($custom_template['close_button_hover_button_bg_color']) . ";";
        }
        if (!empty($custom_template['close_button_hover_border_bg'])) {
            echo "border-color: " . esc_attr($custom_template['close_button_hover_border_bg']);
        }
        ?>
        }
    <?php elseif ($template == 'Template-8') : ?>
        .tgdprc-cookie-bar-display .tgdprc-cookie-bar-body.tgdprc_template_Template-8 .tgdprc-3-column{
        <?php
        //When Custom colors are enabled
        if (!empty($custom_template['close_button_button_bg'])) {
            echo "background: " . esc_attr($custom_template['close_button_button_bg']) . ";";
        }
        if (!empty($custom_template['close_button_border_bg'])) {
            echo "border-color: " . esc_attr($custom_template['close_button_border_bg']);
        }
        ?>
        }
        .tgdprc-cookie-bar-display .tgdprc-cookie-bar-body.tgdprc_template_Template-8 .tgdprc-3-column:hover{
        <?php
        //When Custom colors are enabled
        if (!empty($custom_template['close_button_hover_button_bg_color'])) {
            echo "background: " . esc_attr($custom_template['close_button_hover_button_bg_color']) . ";";
        }
        if (!empty($custom_template['close_button_hover_border_bg'])) {
            echo "border-color: " . esc_attr($custom_template['close_button_hover_border_bg']);
        }
        ?>
        }
    <?php elseif (($template == 'Template-9') || ($template == 'Template-10')) : ?>
        #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-close-button span{
        <?php
        //When Custom colors are enabled
        if (!empty($custom_template['close_button_button_bg'])) {
            echo "background: " . esc_attr($custom_template['close_button_button_bg']) . ";";
        }
        if (!empty($custom_template['close_button_border_bg'])) {
            echo "border-color: " . esc_attr($custom_template['close_button_border_bg']);
        }
        ?>
        }
        #tgdprc_cookie_bar_main_body .tgdprc-cookie-bar-close-button span:hover{
        <?php
        //When Custom colors are enabled
        if (!empty($custom_template['close_button_hover_button_bg_color'])) {
            echo "background: " . esc_attr($custom_template['close_button_hover_button_bg_color']) . ";";
        }
        if (!empty($custom_template['close_button_hover_border_bg'])) {
            echo "border-color: " . esc_attr($custom_template['close_button_hover_border_bg']);
        }
        ?>
        }

    <?php endif; //end of condition 1.1 ?>

<?php elseif ($template == 'Template-23') : ?>
    .tgdprc-cookie-bar-display .tgdprc-cookie-bar-body.tgdprc_template_Template-23 .tgdprc-3-column:before{
    <?php
    //When Custom colors are enabled
    if (!empty($custom_template['close_button_button_bg'])) {
        echo "background: " . esc_attr($custom_template['close_button_button_bg']) . ";";
    }
    if (!empty($custom_template['close_button_border_bg'])) {
        echo "border-color: " . esc_attr($custom_template['close_button_border_bg']) . ";";
    }
    ?>
    }

    .tgdprc-cookie-bar-display.tgdprc_display_bar_bottom .tgdprc-cookie-bar-body.tgdprc_template_Template-23 .tgdprc-3-column:hover:before{
    <?php
    //When Custom colors are enabled
    if (!empty($custom_template['close_button_hover_button_bg_color'])) {
        echo "background: " . esc_attr($custom_template['close_button_hover_button_bg_color']) . ";";
    }
    if (!empty($custom_template['close_button_hover_border_bg'])) {
        echo "border-color: " . esc_attr($custom_template['close_button_hover_border_bg']) . ";";
    }
    if (!empty($custom_template['close_button_hover_button_text_color'])) {
        echo "color: " . esc_attr($custom_template['close_button_hover_button_text_color']) . ";";
    }
    ?>
    }
    <?php
endif; //end of condition 1 ?>
<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<!-- Close Button display configuration -->
<div class="tgdprc_color_customizations" id="tgdprc_close_button_colors_tab" style="display: none;">

    <div class="tgdprc_extra_settings_header">
        <h2><?php esc_attr_e('Text', TGDPRCL_DOMAIN); ?></h2>
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Close Button Text Color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" class="tgdprc-color-field color-field" name="custom_template[close_button_button_color]" value="<?php echo (!empty($custom_template['close_button_button_color'])) ? esc_attr($custom_template['close_button_button_color']) : ''; ?>" data-alpha="true">
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Close Button Hover Text Color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" class="tgdprc-color-field color-field" name="custom_template[close_button_hover_button_text_color]" value="<?php echo (!empty($custom_template['close_button_hover_button_text_color'])) ? esc_attr($custom_template['close_button_hover_button_text_color']) : ''; ?>" data-alpha="true">
    </div>
    <div class="tgdprc_extra_settings_header">
        <h2><?php esc_attr_e('Background', TGDPRCL_DOMAIN); ?></h2>
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Close Button Background Color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" class="tgdprc-color-field color-field" name="custom_template[close_button_button_bg]" value="<?php echo (!empty($custom_template['close_button_button_bg'])) ? esc_attr($custom_template['close_button_button_bg']) : ''; ?>" data-alpha="true">
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Close Button Hover Background Color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" class="tgdprc-color-field color-field" name="custom_template[close_button_hover_button_bg_color]" value="<?php echo (!empty($custom_template['close_button_hover_button_bg_color'])) ? esc_attr($custom_template['close_button_hover_button_bg_color']) : ''; ?>" data-alpha="true">
    </div>
    <div class="tgdprc_extra_settings_header">
        <h2><?php esc_attr_e('Border', TGDPRCL_DOMAIN); ?></h2>
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Close Button Border Color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" class="tgdprc-color-field color-field" name="custom_template[close_button_border_bg]" value="<?php echo (!empty($custom_template['close_button_border_bg'])) ? esc_attr($custom_template['close_button_border_bg']) : ''; ?>" data-alpha="true">
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Close Button Hover Border Color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" class="tgdprc-color-field color-field" name="custom_template[close_button_hover_border_bg]" value="<?php echo (!empty($custom_template['close_button_hover_border_bg'])) ? esc_attr($custom_template['close_button_hover_border_bg']) : ''; ?>" data-alpha="true">
    </div>
</div>
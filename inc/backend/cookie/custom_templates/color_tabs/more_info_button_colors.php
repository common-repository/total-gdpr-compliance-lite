<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<!-- Start of More Info button display configurations -->
<div class="tgdprc_color_customizations" id="tgdprc_more_info_button_colors_tab" style="display: none;">

    <div class="tgdprc_extra_settings_header">
        <h2><?php esc_attr_e('Icon', TGDPRCL_DOMAIN); ?></h2>
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Icon Type', TGDPRCL_DOMAIN) ?></label>
        <select name="custom_template[more_info_icon_type]" class="tgdprc_icon_type_selector" id="tgdprc_more_info_icon_selector">
            <?php foreach ($option['icon_type'] as $index => $value): ?>
                <option value="<?php echo esc_attr($value) ?>" <?php selected((isset($custom_template['more_info_icon_type']) ? esc_attr($custom_template['more_info_icon_type']) : ''), esc_attr($value)) ?>><?php echo ucwords(esc_attr($value)) . ' ' . esc_attr__('Icons', TGDPRCL_DOMAIN) ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="tgdprc_design_settings_field tgdprc_icon_type_field" id="tgdprc_icon_type_default">
        <label><?php esc_attr_e('More Info Icon', TGDPRCL_DOMAIN) ?></label>
        <input class="tgdprc-icon-picker" type="hidden" id="tgdprc-more-info-icon-picker" name="custom_template[more_info_icon]" data-field-name="menu_id" value="<?php echo (!empty($custom_template['more_info_icon'])) ? esc_attr($custom_template['more_info_icon']) : 'fa|fa-lightbulb-o'; ?>"/>
        <div id="tgdprc-more-info-icon-div" data-target="#tgdprc-more-info-icon-picker" class="tgdprc_icon_picker_div button icon-picker <?php
        if (isset($custom_template['more_info_icon']) && !empty($custom_template['more_info_icon'])) {
            $v = explode('|', $custom_template['more_info_icon']);
            echo $v[0] . ' ' . $v[1];
        } else {
            echo "fa fa-lightbulb-o";
        }
        ?>"><div class="tgdprc_icon_picker_label"><?php esc_attr_e('Select Icon', TGDPRCL_DOMAIN); ?></div></div>
    </div>
    <div class="tgdprc_design_settings_field tgdprc_icon_type_field" id="tgdprc_icon_type_image">
        <label><?php esc_attr_e('More Info Icon Image', TGDPRCL_DOMAIN) ?></label>
        <input type="hidden" name="custom_template[more_info_image_id]" value="<?php echo (!empty($custom_template['more_info_image_id'])) ? intval($custom_template['more_info_image_id']) : '' ?>" class="tgdprc_more_info_icon_id">
        <button type="button" class="button button-primary tgdprc_media_manager" data-input="tgdprc_more_info_icon_id" data-preview="tgdprc_more_info_icon_preview" id="wpcui_icon_image_manager"><?php esc_attr_e('Upload Icon', TGDPRCL_DOMAIN) ?></button>
        <img class="tgdprc_more_info_icon_preview" src="<?php echo (!empty($custom_template['more_info_image_id'])) ? esc_url(wp_get_attachment_url(intval($custom_template['more_info_image_id']))) : (TGDPRCL_IMAGE . 'default-blog.jpg') ?>" height=100 width=100>
    </div>

    <!-- More Info button text color -->
    <div class="tgdprc_extra_settings_header">
        <h2><?php esc_attr_e('Text', TGDPRCL_DOMAIN); ?></h2>
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('More Info Button Text color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" class="tgdprc-color-field color-field" name="custom_template[more_info_bar_button_color]" value="<?php echo (!empty($custom_template['more_info_bar_button_color'])) ? esc_attr($custom_template['more_info_bar_button_color']) : ''; ?>" data-alpha="true">
    </div>
    <!-- More Info button hover text change -->
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('More Info Button Hover Text color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" class="tgdprc-color-field color-field" name="custom_template[more_info_bar_hover_button_text_color]" value="<?php echo (!empty($custom_template['more_info_bar_hover_button_text_color'])) ? esc_attr($custom_template['more_info_bar_hover_button_text_color']) : ''; ?>" data-alpha="true">
    </div>
    <!-- More Info button bg color -->
    <div class="tgdprc_extra_settings_header">
        <h2><?php esc_attr_e('Background', TGDPRCL_DOMAIN); ?></h2>
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('More Info Button Background color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" class="tgdprc-color-field color-field" name="custom_template[more_info_bar_button_bg]" value="<?php echo (!empty($custom_template['more_info_bar_button_bg'])) ? esc_attr($custom_template['more_info_bar_button_bg']) : ''; ?>" data-alpha="true">
    </div>
    <!-- More Info button hover background color -->
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('More Info Button Hover Background color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" class="tgdprc-color-field color-field" name="custom_template[more_info_bar_hover_button_bg_color]" value="<?php echo (!empty($custom_template['more_info_bar_hover_button_bg_color'])) ? esc_attr($custom_template['more_info_bar_hover_button_bg_color']) : ''; ?>" data-alpha="true">
    </div>
    <!-- Border Colors -->
    <div class="tgdprc_extra_settings_header">
        <h2><?php esc_attr_e('Border', TGDPRCL_DOMAIN); ?></h2>
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('More Info Button Border Color') ?></label>
        <input type="text" name="custom_template[more_info_bar_button_border_color]" class="tgdprc-color-field color-field" value="<?php echo!empty($custom_template['more_info_bar_button_border_color']) ? esc_attr($custom_template['more_info_bar_button_border_color']) : '' ?>" data-alpha="true">
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('More Info Button Hover Border Color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" name="custom_template[more_info_bar_button_hover_border_color]" class="tgdprc-color-field color-field" value="<?php echo!empty($custom_template['more_info_bar_button_hover_border_color']) ? esc_attr($custom_template['more_info_bar_button_hover_border_color']) : '' ?>" data-alpha="true">
    </div>
    <!-- Box shadow -->
    <div class="tgdprc_extra_settings_header">
        <h2><?php esc_attr_e('Box Shadow', TGDPRCL_DOMAIN); ?></h2>
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('More Info button Box Shadow Hover Color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" name="custom_template[more_info_bar_box_shadow_hover]" class="tgdprc-color-field color-field" value="<?php echo!empty($custom_template['more_info_bar_box_shadow_hover']) ? esc_attr($custom_template['more_info_bar_box_shadow_hover']) : '' ?>" data-alpha="true">
        <div class="additional_field_message_wrap"><i class="additional_field_message"><?php esc_attr_e('This field is active only for Template Blue Chill', TGDPRCL_DOMAIN) ?></i></div>
    </div>
</div>

<!-- End of More Info button display configurations -->
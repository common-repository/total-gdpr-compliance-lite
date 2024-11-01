<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php $option = get_option('tgdprc_general_option'); ?>

<div class="tgdprc_color_customizations" id="tgdprc_bar_colors_tab">
    <div class="tgdprc_custom_template_field">
        <label><?php esc_attr_e('Typography', TGDPRCL_DOMAIN) ?></label>
        <select name="custom_template[font_family]" class="tgdprc_custom_template_preview_selector" id="tgdprc_preview_font_family">
            <?php
            $families = get_option('tgdprc_typo_fonts');
            foreach ($families as $family):
                ?>
                <option value="<?php echo esc_attr($family) ?>"

                        <?php
                        if (isset($custom_template) && $custom_template['font_family'] == $family) {
                            echo "selected='selected'";
                        }
                        ?>

                        ><?php echo esc_attr($family) ?></option>
                    <?php endforeach ?>
        </select>
    </div>

    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Confirmation Text color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" class="tgdprc-color-field color-field" name="custom_template[info_bar_color]" value="<?php echo (!empty($custom_template['info_bar_color'])) ? esc_attr($custom_template['info_bar_color']) : ''; ?>" data-alpha="true" id="wpcui_preview_font_color">
    </div>
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Confirmation Background color', TGDPRCL_DOMAIN) ?></label>
        <input type="text" class="tgdprc-color-field color-field" name="custom_template[info_bar_bg]" value="<?php echo (!empty($custom_template['info_bar_bg'])) ? esc_attr($custom_template['info_bar_bg']) : ''; ?>" data-alpha="true" id="tgdprc_preview_bg_color">
    </div>

    <div class="tgdprc_custom_template_preview_wrap" id="tgdprc_custom_template_preview_wrap">
        <span id="wpcui_custom_template_font"><?php esc_attr_e('This is the content of the cookie bar', TGDPRCL_DOMAIN) ?></span>
    </div>

    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Border', TGDPRCL_DOMAIN) ?></label>
        <input type="checkbox" name="custom_template[border_status]" class="tgdprc-bulb-switch" id="tgdprc_border_status" value="1" <?php checked((isset($custom_template['border_status']) ? boolval($custom_template['border_status']) : boolval(0)), 1) ?>>
        <label for="tgdprc_border_status"></label>
    </div>

    <div class="tgdprc_border_options tgdprc-bulb-light" style="display: none;">
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Border Width', TGDPRCL_DOMAIN) ?></label>
            <input type="number" name="custom_template[border_width]" min="0" max="5" value="<?php echo (!empty($custom_template['border_width'])) ? esc_attr($custom_template['border_width']) : '' ?>">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Border Type', TGDPRCL_DOMAIN) ?></label>
            <select name="custom_template[border_type]">
                <?php foreach ($option['border_style'] as $index => $border_style): ?>
                    <option value="<?php echo esc_attr($border_style) ?>" <?php selected((isset($custom_template['border_type']) ? esc_attr($custom_template['border_type']) : ''), $border_style) ?>><?php echo ucwords(esc_attr($border_style)) ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Border Color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="custom_template[border_color]" class="tgdprc_color_field color-field" value="<?php echo (!empty($custom_template['border_color'])) ? esc_attr($custom_template['border_color']) : '' ?>" data-alpha="true">
        </div>
    </div>

    <!-- Set Background Image -->
    <div class="tgdprc_design_settings_field">
        <label><?php esc_attr_e('Background Image', TGDPRCL_DOMAIN) ?></label>

        <select name="custom_template[bg_defined_type]" class="tgdprc_bg_type_selector">
            <option value="disable" <?php selected((isset($custom_template['bg_defined_type']) ? esc_attr($custom_template['bg_defined_type']) : ''), 'default') ?>><?php esc_attr_e('Disable', TGDPRCL_DOMAIN) ?></option>
            <?php foreach ($option['background_image_type'] as $value => $name): ?>
                <option value="<?php echo esc_attr($value) ?>" <?php selected(isset($custom_template['bg_defined_type']) ? $custom_template['bg_defined_type'] : '', $value) ?> ><?php echo esc_attr($name); ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="tgdprc_design_settings_field tgdprc_bg_section tgdprc_bg_section_user" style="display: none;">
        <label><?php esc_attr_e('Background Image', TGDPRCL_DOMAIN) ?></label>
        <input type="hidden" name="custom_template[background_image_id]" value="<?php echo (!empty($custom_template['background_image_id'])) ? intval($custom_template['background_image_id']) : '' ?>" class="tgdprc_bg_image_id">
        <button type="button" class="button button-primary tgdprc_media_manager" data-input="tgdprc_bg_image_id" data-preview="tgdprc_image_preview" id="tgdprc_bg_image_manager"><?php esc_attr_e('Upload Image', TGDPRCL_DOMAIN) ?></button>
        <img class="tgdprc_image_preview" src="<?php echo (!empty($custom_template['background_image_id'])) ? esc_url(wp_get_attachment_url(intval($custom_template['background_image_id']))) : (TGDPRCL_IMAGE . 'default-blog.jpg') ?>" height=100 width=100>
    </div>

    <div class="tgdprc_design_settings_field tgdprc_bg_section tgdprc_bg_section_system" style="display: none;">
        <label><?php esc_attr_e('Background Image', TGDPRCL_DOMAIN) ?></label>
        <select name="custom_template[background_image_url]" class="tgdprc_bg_image_preview_selector">
            <?php $img_url = TGDPRCL_IMAGE . 'cookies-temp-bg-3.JPG'; ?>

            <?php foreach ($options['background_image'] as $index => $value): ?>
                <option

                    value="<?php echo addslashes($value['img']); ?>"
                    data-img="<?php echo esc_attr($value['img']); ?>"

                    <?php
                    if (isset($custom_template['background_image_url']) && $custom_template['background_image_url'] == stripslashes($value['img'])) {
                        echo "selected='selected'";
                        $img_url = $value['img'];
                    }
                    ?>

                    ><?php echo esc_attr($index); ?></option>
                <?php endforeach ?>
        </select>
        <img class="tgdprc-bg-image-container" style="display: block;" src="<?php echo esc_url($img_url); ?>">
    </div>
</div>
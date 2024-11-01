<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_extra_settings_wrap" style="display: none;">
    <div class="tgdprc_extra_settings_header">
        <h3><?php esc_attr_e('Design Settings', TGDPRCL_DOMAIN); ?></h3>
    </div>
    <div class="tgdprc_struct_settings_body">
        <div class="tgdprc_struct_settings_field">
            <label for ="button_design_type">
                <?php _e('Select Design Type', TGDPRCL_DOMAIN) ?>
            </label>
            <select name="advanced_cookie_settings[additional][design_type]" id="button_design_type">
                <option value="default" <?php echo (isset($advanced_cookie_settings['additional']['design_type']) && $advanced_cookie_settings['additional']['design_type'] == 'default') ? 'selected="selected"' : ''; ?>><?php _e('As Per The Site Layout', TGDPRCL_DOMAIN) ?></option>
                <option value="custom" <?php echo (isset($advanced_cookie_settings['additional']['design_type']) && $advanced_cookie_settings['additional']['design_type'] == 'custom') ? 'selected="selected"' : ''; ?>><?php _e('Custom', TGDPRCL_DOMAIN) ?></option>
            </select>
        </div>
        <div class="tgdprc_extra_settings_header">
            <h3><?php esc_attr_e('Header Description', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Header Info Title Color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="advanced_cookie_settings[additional][header_info_text_color]" value="<?php echo (!empty($advanced_cookie_settings['additional']['header_info_text_color'])) ? esc_attr($advanced_cookie_settings['additional']['header_info_text_color']) : ''; ?>">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Primary Description Color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="advanced_cookie_settings[additional][primary_text_color]" value="<?php echo (!empty($advanced_cookie_settings['additional']['primary_text_color'])) ? esc_attr($advanced_cookie_settings['additional']['primary_text_color']) : ''; ?>">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Secondary Description Color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="advanced_cookie_settings[additional][secondary_text_color]" value="<?php echo (!empty($advanced_cookie_settings['additional']['secondary_text_color'])) ? esc_attr($advanced_cookie_settings['additional']['secondary_text_color']) : ''; ?>">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Checkbox label Text Color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="advanced_cookie_settings[additional][other_text_color]" value="<?php echo (!empty($advanced_cookie_settings['additional']['other_text_color'])) ? esc_attr($advanced_cookie_settings['additional']['other_text_color']) : ''; ?>">
        </div>
        <div class="tgdprc_extra_settings_header">
            <h3><?php esc_attr_e('Inner Hidden Content', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Cookie Type Description Color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="advanced_cookie_settings[additional][cookie_type_description_text_color]" value="<?php echo (!empty($advanced_cookie_settings['additional']['cookie_type_description_text_color'])) ? esc_attr($advanced_cookie_settings['additional']['cookie_type_description_text_color']) : ''; ?>">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Cookie Type Title Color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="advanced_cookie_settings[additional][cookie_type_title_text_color]" value="<?php echo (!empty($advanced_cookie_settings['additional']['cookie_type_title_text_color'])) ? esc_attr($advanced_cookie_settings['additional']['cookie_type_title_text_color']) : ''; ?>">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Cookie Type List Header Color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="advanced_cookie_settings[additional][cookie_type_list_header_text_color]" value="<?php echo (!empty($advanced_cookie_settings['additional']['cookie_type_list_header_text_color'])) ? esc_attr($advanced_cookie_settings['additional']['cookie_type_list_header_text_color']) : ''; ?>">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Cookie Type List "What It Do" Color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="advanced_cookie_settings[additional][what_it_do_text_color]" value="<?php echo (!empty($advanced_cookie_settings['additional']['what_it_do_text_color'])) ? esc_attr($advanced_cookie_settings['additional']['what_it_do_text_color']) : ''; ?>">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Cookie Type List "What It Won\'t Do" Color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="advanced_cookie_settings[additional][what_it_wont_do_text_color]" value="<?php echo (!empty($advanced_cookie_settings['additional']['what_it_wont_do_text_color'])) ? esc_attr($advanced_cookie_settings['additional']['what_it_wont_do_text_color']) : ''; ?>">
        </div>
        <div class="tgdprc_extra_settings_header">
            <h3><?php esc_attr_e('Button', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Button Background color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="advanced_cookie_settings[additional][button_bg_color]" value="<?php echo (!empty($advanced_cookie_settings['additional']['button_bg_color'])) ? esc_attr($advanced_cookie_settings['additional']['button_bg_color']) : ''; ?>" data-alpha="true">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Button Hover Background color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" class="tgdprc-color-field color-field" name="advanced_cookie_settings[additional][button_bg_hover_color]" value="<?php echo (!empty($advanced_cookie_settings['additional']['button_bg_hover_color'])) ? esc_attr($advanced_cookie_settings['additional']['button_bg_hover_color']) : ''; ?>" data-alpha="true">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Button Text Color') ?></label>
            <input type="text" name="advanced_cookie_settings[additional][button_text_color]" class="tgdprc-color-field color-field" value="<?php echo!empty($advanced_cookie_settings['additional']['button_text_color']) ? esc_attr($advanced_cookie_settings['additional']['button_text_color']) : '' ?>">
        </div>
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Button Hover Text Color', TGDPRCL_DOMAIN) ?></label>
            <input type="text" name="advanced_cookie_settings[additional][button_hover_text_color]" class="tgdprc-color-field color-field" value="<?php echo!empty($advanced_cookie_settings['additional']['button_hover_text_color']) ? esc_attr($advanced_cookie_settings['additional']['button_hover_text_color']) : '' ?>">
        </div>
    </div>
</div>
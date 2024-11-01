<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc_design_settings_wrap" style="display: none;" >

    <div class="wpcui_design_settings_header">
        <h3><?php esc_attr_e('Display Settings', TGDPRCL_DOMAIN); ?></h3>
    </div>

    <div class="wpcui_design_settings_body">

        <!-- Where to display the cookie notice -->
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Info Display Type', TGDPRCL_DOMAIN) ?></label>
            <select name="display_settings[layout][display_type]" id="tgdprc_display_type_selector">
                <?php foreach ($options['display_type'] as $index => $value): ?>
                    <option
                        value="<?php echo esc_attr($value); ?>"

                        <?php
                        if (isset($display_settings['layout']['display_type']) && $display_settings['layout']['display_type'] == $value) {
                            echo "selected='selected'";
                        }
                        ?>

                        ><?php echo ucwords(esc_attr($value)); ?></option>
                    <?php endforeach ?>
            </select>
        </div>

        <!-- Where to display the cookie notice -->
        <div class="tgdprc_design_settings_field wpcui_position_field wpcui_bar_position_field">
            <label><?php esc_attr_e('Bar Position', TGDPRCL_DOMAIN) ?></label>
            <select name="display_settings[layout][bar_position]" id="wpcui_bar_positional">
                <?php foreach ($options['bar_position'] as $index => $value): ?>
                    <?php
                    $bar_position = explode('_', esc_attr($value));
                    if (!in_array($bar_position, array('top absolute', 'top fixed'))) {
                        ?>
                        <option
                            value="<?php echo esc_attr($value); ?>"
                            <?php
                            if (isset($display_settings['layout']['bar_position']) && $display_settings['layout']['bar_position'] == $value) {
                                echo "selected='selected'";
                            }
                            ?>
                            ><?php echo ucwords(esc_attr($bar_position[0] . ' ' . (isset($bar_position[1]) ? $bar_position[1] : ''))); ?></option>
                            <?php
                        }
                    endforeach;
                    ?>
            </select>
        </div>

        <div class="wpcui_more_info_position">
            <div class="tgdprc_design_settings_field wpcui_top_style">
                <label><?php esc_attr_e('More Info Content Position', TGDPRCL_DOMAIN) ?></label>
                <select name="display_settings[layout][more_info_position]">
                    <?php foreach ($options['more_info_position'] as $index => $value): ?>
                        <option value="<?php echo esc_attr($value) ?>" <?php selected((isset($display_settings['layout']['more_info_position']) ? esc_attr($display_settings['layout']['more_info_position']) : ''), $value) ?> id="wpcui_more_info_position_<?php echo esc_attr($value) ?>"><?php echo ucwords(esc_attr($value)); ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="tgdprc_design_settings_field wpcui_bottom_style">
                <label><?php esc_attr_e('More Info Content Position', TGDPRCL_DOMAIN) ?></label>
                <select name="display_settings[layout][more_info_position]">
                    <?php foreach ($options['more_info_position'] as $index => $value): ?>
                        <option value="<?php echo esc_attr($value) ?>" <?php selected((isset($display_settings['layout']['more_info_position']) ? esc_attr($display_settings['layout']['more_info_position']) : ''), $value) ?> id="wpcui_more_info_position_<?php echo esc_attr($value) ?>"><?php echo ucwords(esc_attr($value)); ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>

        <!-- Where to display the cookie notice -->
        <div class="tgdprc_design_settings_field wpcui_position_field wpcui_popup_position_field">
            <label><?php esc_attr_e('Popup Position', TGDPRCL_DOMAIN) ?></label>
            <select name="display_settings[layout][popup_position]">
                <?php foreach ($options['popup_position'] as $index => $value): ?>
                    <?php $popup_position = explode('_', esc_attr($value)); ?>
                    <option

                        value="<?php echo esc_attr($value); ?>"

                        <?php
                        if (isset($display_settings['layout']['popup_position']) && $display_settings['layout']['popup_position'] == $value) {
                            echo "selected='selected'";
                        }
                        ?>

                        ><?php echo ucwords(esc_attr($popup_position[0] . ' ' . (isset($popup_position[1]) ? $popup_position[1] : ''))); ?></option>
                    <?php endforeach ?>
            </select>
        </div>

        <!-- Where to display the cookie notice -->
        <div class="tgdprc_design_settings_field wpcui_position_field wpcui_floating_position_field">
            <label><?php esc_attr_e('Floating Position', TGDPRCL_DOMAIN) ?></label>
            <select name="display_settings[layout][floating_position]">
                <?php foreach ($options['floating_position'] as $index => $value): ?>
                    <?php
                    $floating_position = explode('_', esc_attr($value));
                    if (!in_array($floating_position, array('top_left', 'top_right'))) {
                        ?>
                        <option value="<?php echo esc_attr($value); ?>" <?php
                        if (isset($display_settings['layout']['floating_position']) && $display_settings['layout']['floating_position'] == $value) {
                            echo "selected='selected'";
                        }
                        ?>><?php echo ucwords(esc_attr($floating_position[0] . ' ' . (isset($floating_position[1]) ? $floating_position[1] : ''))); ?></option>
                                <?php
                            }
                        endforeach;
                        ?>
            </select>
        </div>


        <!-- The template to use on cookie notice -->
        <div class="tgdprc_design_settings_field tgdprc_display_type" id="wpcui_bar_display_type">
            <label><?php esc_attr_e('Template Type', TGDPRCL_DOMAIN) ?></label>
            <select name="display_settings[layout][bar_template_type]" class="wpcui-template-bar-image-selector wpcui-display-type-bar">

                <?php
                $img_url = TGDPRCL_IMAGE . 'template_images/bar/template1.png';
                $bar_template_counter = 1;
                ?>
                <?php
                foreach ($options['bar_template_type'] as $index => $value):
                    if ($bar_template_counter <= 3) {
                        ?>
                        <option

                            value="<?php echo esc_attr($index); ?>"
                            data-img="<?php echo esc_attr($value['img']); ?>"

                            <?php
                            if (isset($display_settings['layout']['bar_template_type']) && $display_settings['layout']['bar_template_type'] == $index) {
                                echo "selected='selected'";
                                $img_url = $value['img'];
                            }
                            ?>

                            ><?php echo esc_attr($value['alias']); ?></option>
                            <?php
                            $bar_template_counter++;
                        }
                    endforeach
                    ?>
            </select>
            <img class="wpcui-template-image wpcui-template-bar-image-container" style="display: block;" src="<?php echo esc_url($img_url); ?>">
        </div>

        <!-- The template to use on popup display cookie notice -->
        <div class="tgdprc_design_settings_field tgdprc_display_type" id="wpcui_popup_display_type">
            <label><?php esc_attr_e('Template Type', TGDPRCL_DOMAIN) ?></label>
            <select name="display_settings[layout][popup_template_type]" class="wpcui-template-popup-image-selector wpcui-display-type-popup">
                <?php $img_url = TGDPRCL_IMAGE . 'template_images/popup/template1.png'; ?>
                <?php
                $popup_template_type_first = true;
                foreach ($options['popup_template_type'] as $index => $value):
                    if ($popup_template_type_first) {
                        $popup_template_type_first = false;
                        ?>
                        <option
                            value="<?php echo $index; ?>"
                            data-img="<?php echo $value['img']; ?>"
                            <?php
                            if (isset($display_settings['layout']['popup_template_type']) && $display_settings['layout']['popup_template_type'] == $index) {
                                echo "selected='selected'";
                                $img_url = strtolower($value['img']);
                            }
                            ?>
                            ><?php echo esc_attr($value['alias']); ?></option>	
                            <?php
                        }
                    endforeach;
                    ?>
            </select>

            <img class="wpcui-template-image wpcui-template-popup-image-container" style="display: block;" src="<?php echo esc_url($img_url); ?>">
        </div>

        <!-- The template to use on floating display cookie notice -->
        <div class="tgdprc_design_settings_field tgdprc_display_type" id="wpcui_floating_display_type">
            <label><?php esc_attr_e('Template Type', TGDPRCL_DOMAIN) ?></label>
            <select name="display_settings[layout][floating_template_type]" class="wpcui-template-floating-image-selector wpcui-display-type-floating">
                <?php $img_url = TGDPRCL_IMAGE . 'template_images/floating/template1.png'; ?>
                <?php
                $floating_template_type_first = true;
                foreach ($options['floating_template_type'] as $index => $value):
                    if ($floating_template_type_first) {
                        $floating_template_type_first = false;
                        ?>
                        <option
                            value="<?php echo $index; ?>"
                            data-img="<?php echo $value['img']; ?>"
                            <?php
                            if (isset($display_settings['layout']['floating_template_type']) && $display_settings['layout']['floating_template_type'] == $index) {
                                echo "selected='selected'";
                                $img_url = $value['img'];
                            }
                            ?>
                            ><?php echo esc_attr($value['alias']); ?></option>	
                        <?php } endforeach; ?>
            </select>
            <img class="wpcui-template-image wpcui-template-floating-image-container" style="display: block;" src="<?php echo esc_url($img_url); ?>">
        </div>

        <!-- Choosing Custom Template -->
        <div class="tgdprc_design_settings_field">
            <label><?php esc_attr_e('Custom Template', TGDPRCL_DOMAIN) ?></label>
            <select name="display_settings[layout][select_template_type]" id="wpcui_select_template_type">
                <?php foreach ($options['select_template_type'] as $index => $value): ?>
                    <option

                        value="<?php echo esc_attr($value); ?>"

                        <?php
                        if (isset($display_settings['layout']['select_template_type']) && $display_settings['layout']['select_template_type'] == $value) {
                            echo "selected='selected'";
                        }
                        ?>

                        ><?php echo ucwords(esc_attr($value)); ?></option>
                    <?php endforeach ?>
            </select>
        </div>

        <!-- Choosing Custom Template -->
        <div class="tgdprc_design_settings_field wpcui_select_custom_template_section">
            <label><?php esc_attr_e('Select Custom Template', TGDPRCL_DOMAIN) ?></label>
            <?php
            $table_name = $wpdb->prefix . 'tgdprc_custom_template';
            $custom_templates = $wpdb->get_results("SELECT * FROM $table_name");
            if ($custom_templates):
                ?>
                <select name="display_settings[layout][selected_custom_template]">
                    <?php foreach ($custom_templates as $index => $value): ?>
                        <option

                            value="<?php echo esc_attr($value->public_id); ?>"

                            <?php
                            if (isset($display_settings['layout']['selected_custom_template']) && $display_settings['layout']['selected_custom_template'] == $value->public_id) {
                                echo "selected='selected'";
                            }
                            ?>

                            ><?php echo ucwords(esc_attr($value->template_name)); ?></option>
                        <?php endforeach ?>
                </select>
            <?php else: ?>
                <span><?php esc_attr_e('No Custom Template added so far. Add', TGDPRCL_DOMAIN) ?> <a href="<?php echo admin_url('admin.php') . '?page=tgdprcl-cookie-custom-template&action=add'; ?>"><?php esc_attr_e('here', TGDPRCL_DOMAIN) ?></a></span>
            <?php endif ?>
        </div>
    </div>
</div>
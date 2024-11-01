<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="wpcui_custom_meta_box_wrap">
    <div class="wpcui_meta_box_input">

        <?php
        wp_nonce_field('tgdprc_meta_box_nonce', 'tgdprc_meta_box_nonce_field');
        ?>
        <?php if ($page_active): ?>
            <label><?php esc_attr_e('Cookie Bar', TGDPRCL_DOMAIN) ?></label>
            <?php
            $selected_meta = get_post_meta(get_the_ID(), 'tgdprc_post_cookie_bar');
            $selected_id = (!empty($selected_meta)) ? $selected_meta[0] : $default_id;
            ?>
            <select name="tgdprc_cookie_in_post_type">
                <option value="<?php echo esc_attr($default_id); ?>" <?php selected($default_id, $selected_id) ?>><?php esc_attr_e('Default', TGDPRCL_DOMAIN) ?></option>
                <?php if ($data_active): ?>
                    <?php foreach ($cookie_bars as $index => $cookie_object): ?>
                        <option value="<?php echo $cookie_object->id; ?>" <?php ($cookie_object->id != $default_id) ? selected($cookie_object->id, $selected_id) : ''; ?>><?php echo $cookie_object->name; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
                <option value="-1" <?php selected(-1, $selected_id) ?>><?php esc_attr_e('Disable', TGDPRCL_DOMAIN) ?></option>
            </select>
            <?php if (!$data_active): ?>
                <span><?php esc_attr_e('You have to add a Cookie Notice first', TGDPRCL_DOMAIN) ?></span>
            <?php endif; ?>
            <?php if ($page_active == 'Home'): ?>
                <?php if (get_the_ID() != get_option('page_on_front')): ?>
                    <div><?php esc_attr_e('Cookie Notice has been set to Home Page only, change option in', TGDPRCL_DOMAIN) ?> <a href="<?php echo admin_url('admin.php') ?>?page=tgdprcl-cookie-settings"><?php esc_attr_e('Cookie Setting', TGDPRCL_DOMAIN) ?></a> <?php esc_attr_e('for this cookie notice to display.', TGDPRCL_DOMAIN) ?></div>
                <?php endif; ?>
            <?php elseif ($page_active == 'Specific'): ?>
                <?php if ($specific_not): ?>
                    <div><?php esc_attr_e('Cookie Notice has been set to specific page, make sure that this page has been selected or it\'s related terms for taxonomies has been selected in', TGDPRCL_DOMAIN) ?> <a href="<?php echo admin_url('admin.php') ?>?page=tgdprcl-cookie-settings"><?php esc_attr_e('Cookie Setting', TGDPRCL_DOMAIN) ?></a></div>
                <?php endif ?>
                <div></div>
            <?php endif; ?>
        <?php else: ?>
            <span><?php esc_attr_e('Add a Cookie Notice first.. ', TGDPRCL_DOMAIN) ?></span>
        <?php endif; ?>
    </div>
</div>

<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php if (isset($general_settings['content']['more_info']['status'])): ?>
    <?php if ($general_settings['content']['more_info']['action'] == 'slideout content'): ?>
        <div class="tgdprc-cookie-bar-more-info-wrap tgdprc_info_position_<?php echo (($display_settings['layout']['display_type'] == 'bar') || ($display_settings['layout']['display_type'] == 'floating')) ? esc_attr($display_settings['layout']['more_info_position']) : 'inline' ?>">
            <div class="tgdprc_info_wrapper <?= ($display_settings['layout']['display_type'] != 'popup') ? esc_attr('tgdprc_more_bar_floating') : '' ?>">
                <div class="tgdprc-cookie-info-overlay"></div>
                <div class="tgdprc-cookie-info-content">
                    <?php $allowed_html = wp_kses_allowed_html('post') ?>
                    <div id="tgdprc_content_area"><?php echo (!empty($general_settings['content']['more_info']['slide_text'])) ? do_shortcode(wp_kses(stripslashes($general_settings['content']['more_info']['slide_text']), $allowed_html)) : ''; ?></div>

                    <?php if ($display_settings['layout']['display_type'] != 'popup') : ?>
                        <?php if ($custom_template): ?>
                            <?php if (isset($custom_template['more_info_close_btn_status'])): ?>
                                <div class="tgdprc_info_close_button" onclick="more_info_hide(this)"></div>
                            <?php endif ?>
                        <?php else: ?>
                            <div class="tgdprc_info_close_button" onclick="more_info_hide(this)"></div>
                        <?php endif ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php
defined('ABSPATH') or die('No script kiddies please!');
if (($display_settings['layout']['display_type'] == 'popup') && ($display_settings['layout']['popup_template_type'] == 'Template-15')):
    ?>
    <div class="tgdprc_template_15_content_wrapper">
    <?php endif ?>
    <div class="tgdprc-cookie-bar-info-wrap tgdprc-1-column">
        <?php if ($display_settings['layout']['display_type'] == 'popup'): ?>
            <div class="tgdprc_text_container_wrap">
            <?php endif ?>
            <div class="tgdprc_title_text"><?php echo!empty($general_settings['content']['info']['title_text']) ? esc_attr($general_settings['content']['info']['title_text']) : ''; ?></div>
            <?php $allowed_html = wp_kses_allowed_html('post') ?>
            <p><?php echo (!empty($general_settings['content']['info']['general_text'])) ? wp_kses(stripslashes($general_settings['content']['info']['general_text']), $allowed_html) : ''; ?></p>
            <?php if ($display_settings['layout']['display_type'] == 'popup'): ?>
            </div>
        <?php endif ?>
    </div>
    <?php
    if ($display_settings['layout']['display_type'] == 'popup') {
        include_once 'component_4.php';
    }
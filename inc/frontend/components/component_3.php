<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<!-- This is composed of close button -->

<?php if (isset($general_settings['content']['info']['close_button'])): ?>
    <div class="tgdprc_close_btn">
        <div class="tgdprc-cookie-bar-close-button tgdprc-3-column"
             <?php if (!isset($_GET['preview']) && $extra_settings['extra']['cookie_expiry'] != 'show Always'): ?>
                 onclick="setCookie(cname, cvalue, exdays)"
             <?php endif ?>
             >
                 <?php if ($display_settings['layout']['display_type'] == 'popup' && $display_settings['layout']['popup_template_type'] == 'Template-13'): ?>
                <span><?php esc_attr_e('Close', TGDPRCL_DOMAIN) ?></span>

            <?php elseif (($display_settings['layout']['display_type'] == 'bar') && (($display_settings['layout']['bar_template_type'] == 'Template-10') || ($display_settings['layout']['bar_template_type'] == 'Template-9'))) : ?>
                <span><?php esc_attr_e('Close', TGDPRCL_DOMAIN) ?></span>

            <?php endif ?>
        </div>
    </div>
    <?php
 endif ?>
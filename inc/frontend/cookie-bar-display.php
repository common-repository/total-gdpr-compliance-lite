<?php
defined('ABSPATH') or die('No scripts for you!!');

$displayType = esc_attr($display_settings['layout']['display_type']);
$position = ($display_settings['layout']['display_type'] == 'bar') ? ((esc_attr($display_settings['layout']['bar_position'] == 'top absolute')) ? 'top_absolute' : (($display_settings['layout']['bar_position'] == 'top fixed') ? 'top_fixed' : esc_attr($display_settings['layout']['bar_position']))) : esc_attr($display_settings['layout']['bar_position']);
$position = ($display_settings['layout']['display_type'] == 'popup') ? (esc_attr($display_settings['layout']['popup_position'])) : $position;
$position = ($display_settings['layout']['display_type'] == 'floating') ? (esc_attr($display_settings['layout']['floating_position'])) : $position;
$template = ($display_settings['layout']['display_type'] == 'bar') ? (esc_attr($display_settings['layout']['bar_template_type'])) : (($display_settings['layout']['display_type'] == 'popup') ? (esc_attr($display_settings['layout']['popup_template_type'])) : (($display_settings['layout']['display_type'] == 'floating') ? (esc_attr($display_settings['layout']['floating_template_type'])) : ''));

$display_class = "tgdprc_display_" . $displayType . "_$position";
$body_class = 'tgdprc_template_' . $template;
?>
<div class="tgdprc-cookie-bar-display tgdprc_cookie_notice_<?= esc_attr($display_settings['layout']['display_type']) ?> <?php echo esc_attr($display_class); ?> <?php echo ($display_settings['layout']['select_template_type'] == 'custom') ? esc_attr('tgdprc_cookie_notice_custom-temp') : ''; ?>" id="tgdprc_cookie_bar_main_display" data-type="<?php echo esc_attr($display_settings['layout']['display_type']) ?>" style="display: none;">

    <div class="tgdprc-cookie-bar-body <?php echo esc_attr($body_class); ?> <?= ((($display_settings['layout']['display_type'] == 'popup') && (!isset($general_settings['content']['more_info']['status']))) || (($template == 'Template-20') && !isset($general_settings['content']['more_info']['status']))) ? esc_attr('wpcui_more_info_nf') : '' ?>" id="tgdprc_cookie_bar_main_body">

        <?php
        $display_sequence = array('1', '2', '3');
        foreach ($display_sequence as $index => $value) {
            include_once "components/component_$value.php";
        }
        ?>
    </div>
</div>
<?php
if ($display_settings['layout']['display_type']) {
    include_once 'components/component_4.php';
}

include_once TGDPRCL_PATH . 'inc/frontend/templates/custom_template_display.php';
include_once TGDPRCL_PATH . 'inc/frontend/cookie_bar_expiry/cookie_button_event.php';

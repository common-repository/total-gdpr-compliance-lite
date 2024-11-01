<?php defined('ABSPATH') or die('No scripts for you!!'); ?>
<div class="tgdprc_header">
    <div class="wpcui_logo"style=" padding: 60px 10px 0px 14px;
         font-size: 22px;
         font-weight: 700;
         Color: #fff;
         max-width: 400px;
         max-height: 254px;
         overflow: unset;">
        <?php esc_attr_e('Total GDPR Compliance Lite', TGDPRCL_DOMAIN) ?>
    </div>
    <div class="wpcui_title">
        <?php if ($title == 'Info'): ?>
            <h1><?php esc_attr_e('TGDPRC Lite', TGDPRCL_DOMAIN) ?> <?php echo esc_attr($title); ?></h1>

        <?php elseif ($title == 'Listing'): ?>
            <h1><?php esc_attr_e('Cookie Info Template Lists', TGDPRCL_DOMAIN) ?></h1>

        <?php elseif ($title): ?>
            <h1><?php echo esc_attr($title); ?></h1>
        <?php endif ?>
    </div>

</div>
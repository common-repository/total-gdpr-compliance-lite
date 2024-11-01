<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="tgdprc-2-column">

    <!-- Confirmation button -->
    <button class="tgdprc-cookie-bar-info-confirm <?= isset($confirm_image_class) ? esc_attr($confirm_image_class) : '' ?>" type="submit"
    <?php if (!isset($_GET['preview']) && $extra_settings['extra']['cookie_expiry'] != 'show Always'): ?>

                onclick="setCookie(cname, cvalue, exdays)"

            <?php endif ?>
            >
                <?php if ($display_settings['layout']['select_template_type'] == 'custom') : ?>

            <?php
            $no_icon_templates = array('Template-11', 'Template-12', 'Template-15', 'Template-16', 'Template-18', 'Template-20');
            if (!in_array($template, $no_icon_templates)):
                ?>

                <?php if ($custom_template['confirmation_icon_type'] == 'default'): ?>

                    <i class="<?php echo (!empty($confirmation_class)) ? esc_attr($confirmation_class) : 'fa fa-check' ?>" id="tgdprc_confirmation_icon"></i>

                <?php elseif ($custom_template['confirmation_icon_type'] == 'image') : ?>

                    <img class="tgdprc_image_icon" src="<?php echo wp_get_attachment_url(intval($custom_template['confirmation_image_id'])) ?>" height=25 width=25>

                <?php endif; //end of icon type  ?>

            <?php endif ?>


        <?php elseif ($display_settings['layout']['select_template_type'] == 'default') : ?>

            <i class="fa fa-check" id="tgdprc_confirmation_icon"></i>

        <?php endif; //end of template type  ?>

        <?php if (($display_settings['layout']['display_type'] != 'popup') || ($display_settings['layout']['popup_template_type'] != 'Template-13')): ?>
            <?php echo (!empty($general_settings['content']['info']['confirmation_text'])) ? esc_attr($general_settings['content']['info']['confirmation_text']) : ''; ?></button>
    <?php endif ?>

    <?php if (isset($general_settings['content']['more_info']['status'])): ?>
        <?php if ($general_settings['content']['more_info']['action'] == 'page redirect'): ?>

            <a	href="<?php echo (!empty($general_settings['content']['more_info']['link'])) ? esc_url($general_settings['content']['more_info']['link']) : ''; ?>"

               target="<?php echo (!empty($general_settings['content']['more_info']['link_target'])) ? esc_attr($general_settings['content']['more_info']['link_target']) : ''; ?>"
               >
               <?php endif ?>

            <button
            <?php if ($general_settings['content']['more_info']['action'] == 'slideout content'): ?>
                    onclick="display_info_content()"
                <?php endif ?>
                class="tgdprc-cookie-bar-more_info <?= isset($more_info_image_class) ? esc_attr($more_info_image_class) : '' ?>">
                    <?php if ($display_settings['layout']['select_template_type'] == 'custom') : ?>

                    <?php if (!in_array($template, $no_icon_templates)): ?>

                        <?php if ($custom_template['more_info_icon_type'] == 'default'): ?>

                            <i class="<?php echo (!empty($more_info_class)) ? esc_attr($more_info_class) : 'fa fa-lightbulb-o' ?>" id="tgdprc_more_info_icon"></i>

                        <?php elseif ($custom_template['more_info_icon_type'] == 'image') : ?>

                            <img class="tgdprc_image_icon" src="<?php echo wp_get_attachment_url(intval($custom_template['more_info_image_id'])) ?>" height=25 width=25>

                        <?php endif; //end of icon type  ?>

                    <?php endif ?>


                <?php elseif ($display_settings['layout']['select_template_type'] == 'default') : ?>

                    <i class="fa fa-lightbulb-o" id="tgdprc_more_info_icon"></i>

                <?php endif; //end of template type  ?>

                <?php if (($display_settings['layout']['display_type'] != 'popup') || ($display_settings['layout']['popup_template_type'] != 'Template-13')): ?>
                    <?php echo (!empty($general_settings['content']['more_info']['text'])) ? esc_attr($general_settings['content']['more_info']['text']) : ''; ?></button>
            <?php endif ?>

            <?php if ($general_settings['content']['more_info']['action'] == 'page redirect'): ?>
            </a>
        <?php endif; ?>

    <?php endif ?>

</div>
<?php if (($display_settings['layout']['display_type'] == 'popup') && ($display_settings['layout']['popup_template_type'] == 'Template-15')): ?>
    </div>
    <?php


 endif ?>
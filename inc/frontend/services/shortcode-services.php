<?php
$allowed_html = wp_kses_allowed_html('post');
$tgdprc_service_setting = get_option('tgdprc-services-settings');
$tgdprc_advanced_cookie_settings = get_option('tgdprc-advanced-cookie-settings');
$tgdprc_global_value_array = $this->global_default_values_array_call();
$default_custom_cookie_category_array = $tgdprc_global_value_array['default_custom_cookie_category_array'];
$advancedcookie_default_excluded_array = $tgdprc_global_value_array['advancedcookie_default_excluded_array'];

if (isset($tgdprc_advanced_cookie_settings) && !empty($tgdprc_advanced_cookie_settings)) {
    foreach ($tgdprc_advanced_cookie_settings as $key => $val) {
        if (!in_array($key, $advancedcookie_default_excluded_array)) {
            $default_custom_cookie_category_array[$key] = $val['setting_display_header']; //array_push key into the $default_custom_cookie_category_array
        }
    }
} else {
    $default_custom_cookie_category_array = $default_custom_cookie_category_array;
}
if (isset($tgdprc_service_setting['enable']) && $tgdprc_service_setting['enable'] == 1) {
    $tgdprc_services_query = new WP_Query(array(
        'post_type' => 'totalgdprcompliance',
        'post_status' => 'publish'
    ));
    $post_count = 1;
    ?>
    <div class = "tgdprc-cookie-bar-info-wrap tgdprc-1-column" style="overflow-x: auto;">
        <table class="tgdprc-cookie-bar-display-table" cellspacing="0">
            <thead>
                <tr>
                    <th><?php esc_attr_e('S.N.', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Header', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Purpose', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Cookies Used', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Cookies Types', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Cookies Nature', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Expiry Time(For Repititive)', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Is Blockable', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Currently Active in Site', TGDPRCL_DOMAIN) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($tgdprc_service_setting['display_plugin_services']) && $tgdprc_service_setting['display_plugin_services'] == 1) {
                    ?><tr>
                        <td><?php esc_attr_e($post_count, TGDPRCL_DOMAIN) ?></td>
                        <td><?php esc_attr_e('Total GDPR Complaince', TGDPRCL_DOMAIN) ?></td>
                        <td><?php esc_attr_e('Making the site GDPR Compatible', TGDPRCL_DOMAIN) ?></td>
                        <td><?php esc_attr_e('tgdprc_policie_cookie, tgdprc_terms_cookie, tgdprc_cookie_expiry', TGDPRCL_DOMAIN) ?></td>
                        <td><?php esc_attr_e('Strictly Neccessary', TGDPRCL_DOMAIN) ?></td>
                        <td><?php esc_attr_e('Repetitive', TGDPRCL_DOMAIN) ?></td>
                        <td><?php esc_attr_e('Custom', TGDPRCL_DOMAIN) ?></td>
                        <td><?php esc_attr_e('No', TGDPRCL_DOMAIN) ?></td>
                        <td><?php esc_attr_e('Yes', TGDPRCL_DOMAIN) ?></td>
                    </tr>
                    <?php
                    $post_count++;
                }
                if ($tgdprc_services_query->have_posts()) {
                    while ($tgdprc_services_query->have_posts()) {
                        $tgdprc_services_query->the_post();
                        $img_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                        $tgdprc_services_title = get_the_title();
                        $tgdprc_services_description = get_the_content();
                        $tgdpr_service_detail = get_post_meta(get_the_id(), 'tgdpr_service_detail', true);
                        ?>
                        <tr>                
                            <td>
                                <?php echo $post_count; ?>
                            </td>        
                            <td>
                                <?php echo!empty($tgdprc_services_title) ? esc_attr($tgdprc_services_title) : __('Undefined Header', TGDPRCL_DOMAIN); ?>
                            </td>
                            <td>
                                <?php echo wp_kses(stripslashes($tgdprc_services_description), $allowed_html); ?>
                            </td>
                            <td>
                                <?php
                                if (isset($tgdpr_service_detail['cookie_used']) && !empty($tgdpr_service_detail['cookie_used'])) {
                                    echo esc_attr($tgdpr_service_detail['cookie_used']);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (isset($tgdpr_service_detail['cookie_types']) && !empty($tgdpr_service_detail['cookie_types'])) {
                                    foreach ($default_custom_cookie_category_array as $key => $val) {
                                        if ($tgdpr_service_detail['cookie_types'] == $key) {
                                            if (isset($tgdprc_advanced_cookie_settings[$key]['setting_display_header']) && !empty($tgdprc_advanced_cookie_settings[$key]['setting_display_header'])) {
                                                echo esc_attr($tgdprc_advanced_cookie_settings[$key]['setting_display_header']);
                                            } else if (isset($tgdprc_advanced_cookie_settings[$key]['setting_display_header']) && empty($tgdprc_advanced_cookie_settings[$key]['setting_display_header'])) {
                                                echo esc_attr($val);
                                            } else {
                                                echo __('Undefined/Undisclosed', TGDPRCL_DOMAIN);
                                            }
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (isset($tgdpr_service_detail['cookie_nature']) && !empty($tgdpr_service_detail['cookie_nature'])):
                                    switch ($tgdpr_service_detail['cookie_nature']) {
                                        case 'repetitive':
                                            echo __('Repetitive', TGDPRCL_DOMAIN);
                                            break;
                                        case 'session':
                                            echo __('Session', TGDPRCL_DOMAIN);
                                            break;
                                        default:
                                            echo __('Undisclosed', TGDPRCL_DOMAIN);
                                            break;
                                    }
                                else:
                                    echo __('Undisclosed', TGDPRCL_DOMAIN);
                                endif;
                                ?>
                            </td>
                            <td>
                                <?php
                                if (isset($tgdpr_service_detail['cookie_expire_duration']) && !empty($tgdpr_service_detail['cookie_expire_duration'])):
                                    echo esc_attr($tgdpr_service_detail['cookie_expire_duration']);
                                elseif (isset($tgdpr_service_detail['custom_cookie_expiry_condition']) && $tgdpr_service_detail['custom_cookie_expiry_condition'] == 'on'):
                                    echo __('Custom', TGDPRCL_DOMAIN);
                                endif;
                                ?>
                            </td>
                            <td>
                                <?php
                                if (isset($tgdpr_service_detail['blockable']) && !empty($tgdpr_service_detail['blockable'])):
                                    switch ($tgdpr_service_detail['blockable']) {
                                        case 'on':
                                            echo __('Yes', TGDPRCL_DOMAIN);
                                            break;
                                        default:
                                            echo __('No', TGDPRCL_DOMAIN);
                                            break;
                                    }
                                else:
                                    echo __('No', TGDPRCL_DOMAIN);
                                endif;
                                ?>
                            </td>
                            <td>
                                <?php
                                if (isset($tgdpr_service_detail['currently_active']) && !empty($tgdpr_service_detail['currently_active'])):
                                    switch ($tgdpr_service_detail['currently_active']) {
                                        case 'on':
                                            echo __('Yes', TGDPRCL_DOMAIN);
                                            break;
                                        default:
                                            echo __('No', TGDPRCL_DOMAIN);
                                            break;
                                    }
                                else:
                                    echo __('No', TGDPRCL_DOMAIN);
                                endif;
                                ?>
                            </td>
                        </tr>
                        <?php
                        $post_count++;
                    }
                }
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <th><?php esc_attr_e('S.N.', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Header', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Purpose', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Cookies Used', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Cookies Types', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Cookies Nature', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Expiry Time(For Repititive)', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Is Blockable', TGDPRCL_DOMAIN) ?></th>
                    <th><?php esc_attr_e('Currently Active in Site', TGDPRCL_DOMAIN) ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php
}
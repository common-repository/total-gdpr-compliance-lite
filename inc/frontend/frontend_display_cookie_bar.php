<?php

defined('ABSPATH') or die('No script kiddies please!');
$selected_cookie = get_option('tgdprc_selected_cookie_option');

$overall_status = true;

if (isset($selected_cookie['mobile_mode']) && $selected_cookie['mobile_mode'] == 0) {
    $overall_status = $this->tgdprcl_mobile_view();
}

if ($overall_status) {
    global $wpdb;
    $table = $wpdb->prefix . 'tgdprc_settings';


    // For Post Meta Information
    $page_id = intval(get_the_ID());
    $cookie_post_meta = get_post_meta($page_id, 'tgdprc_post_cookie_bar');

    if (isset($cookie_post_meta) && !empty($cookie_post_meta)) {
        $id = $cookie_post_meta[0];
        if ($id == 0) {
            $id = intval($selected_cookie['cookie-bar']);
        }
    } else {
        $id = intval($selected_cookie['cookie-bar']);
    }

    //Check for preview mode too
    $id = (isset($_GET['tgdprc_cookie_preview'])) ? intval($_GET['tgdprc_cookie_preview']) : intval($id);


    if (($selected_cookie['status'] ||
     isset($_GET['tgdprc_cookie_preview'])) &&
            ($id > 0)
    //unless in preview mode
    ) {


        $result = $wpdb->get_row("SELECT * FROM $table WHERE id=$id");
        $general_settings = maybe_unserialize($result->general_settings);
        $display_settings = maybe_unserialize($result->display_settings);
        $extra_settings = maybe_unserialize($result->extra_settings);

        $custom_template = false;
        if ($display_settings['layout']['select_template_type'] == 'custom') {
            $custom_table_name = $wpdb->prefix . 'tgdprc_custom_template';
            $id = esc_attr($display_settings['layout']['selected_custom_template']);
            $whole_templates = $wpdb->get_row("SELECT * FROM $custom_table_name WHERE public_id='$id'");
            $custom_template = ($whole_templates) ? maybe_unserialize($whole_templates->template_details) : false;

            // Necessary Classes
            if ($custom_template['confirmation_icon_type'] == 'default') {
                $confirmation_icon = !empty($custom_template['confirmation_icon']) ? explode('|', $custom_template['confirmation_icon']) : array();
                $confirmation_class = (!empty($confirmation_icon)) ? ($confirmation_icon[0] . ' ' . $confirmation_icon[1]) : '';
            }

            if ($custom_template['more_info_icon_type'] == 'default') {
                $more_info_icon = !empty($custom_template['more_info_icon']) ? explode('|', $custom_template['more_info_icon']) : array();
                $more_info_class = (!empty($more_info_icon)) ? ($more_info_icon[0] . ' ' . $more_info_icon[1]) : '';
            }

            if ($custom_template['confirmation_icon_type'] == 'image') {
                $confirm_image_class = 'tgdprc_confirm_image_container';
            }
            if ($custom_template['more_info_icon_type'] == 'image') {
                $more_info_image_class = 'tgdprc_more_info_image_container';
            }
            // End of Necessary Clases
        }

        //Check for preview mode
        if (isset($_GET['tgdprc_cookie_preview'])) {
            include_once TGDPRCL_PATH . 'inc/frontend/cookie-bar-display.php';
        } elseif (
                (!isset($_COOKIE['tgdprc_cookie_expiry']))
        ) {

            $term_ignore = false;
//            if (($selected_cookie['displayed_pages'] == 'specific page')) {
//                $specific_term = isset($selected_cookie['specific_term']) ? maybe_unserialize($selected_cookie['specific_term']) : array();
//                if (!empty($specific_term)) {
//                    foreach ($specific_term as $taxonomy_name => $taxonomy_array) {
//                        foreach ($taxonomy_array as $term_id) {
//                            $term_ignore = ($term_ignore || has_term(intval($term_id), esc_attr($taxonomy_name)));
//                        }
//                    }
//                }
//            }

            $default_page_status = false;
            $default_pages = ( ($selected_cookie['displayed_pages'] == 'specific page') && isset($selected_cookie['default_page']) && ($selected_cookie['default_page'] != '-1')) ? maybe_unserialize($selected_cookie['default_page']) : array();
            if (!empty($default_pages)) {
                foreach ($default_pages as $index => $default_page) {
                    if (($default_page == '404') && is_404()) {
                        $default_page_status = true;
                    } elseif (($default_page == 'archive') && is_archive()) {
                        $default_page_status = true;
                    } elseif (($default_page == 'search') && is_search()) {
                        $default_page_status = true;
                    } elseif (($default_page == 'blog') && is_home() && !is_front_page()) {
                        $default_page_status = true;
                    } elseif (($default_page == 'static_home') && is_front_page() && !is_home()) {
                        $default_page_status = true;
                    } elseif (($default_page == 'default_home') && is_front_page() && is_home()) {
                        $default_page_status = true;
                    }
                }
            }

            $specific_page = array();
                    //($selected_cookie['specific_page'] != '-1' && !empty($selected_cookie['specific_page'])) ? explode(',', $selected_cookie['specific_page']) : array();

            if (
                    ($selected_cookie['displayed_pages'] == 'show on all pages') ||
                    (($selected_cookie['displayed_pages'] == 'show on Home page') && is_front_page() && !is_404()) ||
                    (($selected_cookie['displayed_pages'] == 'specific page') && (!empty($specific_page) && is_page($specific_page))) || // If the current page is defined
                    (($selected_cookie['displayed_pages'] == 'specific page') && (!empty($specific_page) && is_single($specific_page))) || //If current post is defined

                    ( $term_ignore ) ||
                    ($default_page_status)
            ) {
                include_once TGDPRCL_PATH . 'inc/frontend/cookie-bar-display.php';
            }
        }
    }
}
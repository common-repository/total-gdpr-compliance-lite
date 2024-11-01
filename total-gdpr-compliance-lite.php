<?php
defined('ABSPATH') or die("No scripts for you!");

/**
  Plugin name: Total GDPR Compliance Lite
  Plugin URI: https://accesspressthemes.com/wordpress-plugins/total-gdpr-compliance/
  Description: WordPress Plugin for GDPR Compatibility
  Version: 1.0.5
  Author: AccessPress Themes
  Author URI: http://accesspressthemes.com
  Text Domain: total-gdpr-compliance-lite
  Domain Path: /languages/
 */
  if (!class_exists('TOTAL_GDPR_COMPLIANCE_LITE')) {

    class TOTAL_GDPR_COMPLIANCE_LITE {

        function __construct() {
            $this->tgdprcl_define_some_constants();
            register_activation_hook(TGDPRCL_PATH . 'total-gdpr-compliance-lite.php', array($this, 'tgdprc_plugin_activation'));

            add_action('init', array($this, 'register_post_type'));

            add_action('init', array($this, 'tgdprcl_load_default_general_options'));

            $this->define_web_fonts();

            add_action('admin_post_tgdprc_save_manage_form_settings_pro', array($this, 'tgdprc_save_manage_form_settings_pro'));

            add_action('admin_post_tgdprc_save_manage_advanced_cookie_settings', array($this, 'tgdprc_save_manage_advanced_cookie_settings'));

            add_action('admin_post_tgdprc_save_cookie_settings', array($this, 'tgdprc_save_cookie_settings'));

            add_action('admin_post_tgdprc_delete_consent_log', array($this, 'tgdprc_delete_consent_log'));

            add_action('admin_post_tgdprc_delete_all_consent_logs', array($this, 'tgdprc_delete_all_consent_logs'));

            add_action('admin_post_tgdprc_send_email_with_userdata_to_user', array($this, 'tgdprc_send_email_with_userdata_to_user'));

            add_action('admin_post_save_custom_template', array($this, 'save_custom_template'));

            add_action('admin_post_save_consent_settings', array($this, 'save_consent_settings'));

            add_action('admin_post_delete_template_setting', array($this, 'delete_template_setting'));

            add_action('admin_post_copy_choosen_setting', array($this, 'copy_choosen_setting'));

            add_action('admin_post_copy_template_setting', array($this, 'copy_template_setting'));

            add_action('admin_post_delete_choosen_setting', array($this, 'delete_choosen_setting'));

            add_action('admin_post_send_mail_user_access_Request', array($this, 'send_mail_user_access_Request'));
            add_action('admin_post_tgdprc_send_forgeted_email_to_user', array($this, 'tgdprc_send_forgeted_email_to_user'));
            add_action('admin_post_tgdprc_send_rectified_email_to_user', array($this, 'tgdprc_send_rectified_email_to_user'));
            add_action('admin_post_tgdprc_send_breach_email_to_user', array($this, 'tgdprc_send_breach_email_to_user'));

            add_action('admin_post_delete_chosen_user_access_email', array($this, 'delete_chosen_user_access_email'));
            add_action('admin_post_delete_chosen_user_forget_email', array($this, 'delete_chosen_user_forget_email'));
            add_action('admin_post_delete_chosen_user_rectify_req_email', array($this, 'delete_chosen_user_rectify_req_email'));

            add_action('admin_menu', array($this, 'register_a_menu'));

            add_action('admin_menu', array($this, 'register_submenus'));

            add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));

            add_action('wp_enqueue_scripts', array($this, 'register_frontend_scripts'));

            add_action('plugins_loaded', array($this, 'load_tgdprc_textdomain'));

            add_action('wp_footer', array($this, 'frontend_display_cookie_bar'));

            add_action('add_meta_boxes', array($this, 'tgdprc_add_meta_box_to_choose_cookie_bar'));

            add_action('add_meta_boxes', array($this, 'add_service_option_1_metabox'));

            add_action('save_post', array($this, 'save_service_option_metabox'));

            add_action('transition_post_status', array($this, 'tgdprc_save_post_of_meta_box'));

            add_action('wp_ajax_tgdprc_pagination_links', array($this, 'tgdprc_pagination_links'));

            add_action('wp_ajax_tgdprc_delete_marked', array($this, 'tgdprc_delete_marked'));

            add_action('wp_ajax_tgdprc_delete_marked_template', array($this, 'tgdprc_delete_marked_template'));

            add_action('admin_post_tgdprc_save_terms_and_policies_field_options', array($this, 'tgdprc_save_terms_and_policies_field_options'));
            add_action('admin_post_tgdprc_save_user_datasetting_field_options', array($this, 'tgdprc_save_user_datasetting_field_options'));
            add_action('admin_post_tgdprc_save_service_setting_field_options', array($this, 'tgdprc_save_service_setting_field_options'));
            add_action('admin_post_tgdprc_save_protected_setting_field_options', array($this, 'tgdprc_save_protected_setting_field_options'));

            add_action('init', array($this, 'func_export_all_consents'));

            add_action('wp_ajax_tgdprc_terms_policies_button_click_action', array($this, 'tgdprc_terms_policies_button_click_action'));
            add_action('wp_ajax_nopriv_tgdprc_terms_policies_button_click_action', array($this, 'tgdprc_terms_policies_button_click_action'));

            add_action('wp_ajax_tgdprc_advance_cookie_consent_storage', array($this, 'tgdprc_advance_cookie_consent_storage'));
            add_action('wp_ajax_nopriv_tgdprc_advance_cookie_consent_storage', array($this, 'tgdprc_advance_cookie_consent_storage'));

            add_action('wp_ajax_tgdprc_user_data_process_action', array($this, 'tgdprc_user_data_process_action'));
            add_action('wp_ajax_nopriv_tgdprc_user_data_process_action', array($this, 'tgdprc_user_data_process_action'));

            /** Consent WordPress Comment */
            add_filter('comment_form_default_fields', array($this, 'tgdprc_add_custom_wp_comment_consent_fields'));
            add_filter('preprocess_comment', array($this, 'tgdprc_verify_consent_fields'));
            add_action('comment_post', array($this, 'tgdprc_insert_into_commentmeta'));

            /** Consent COntact Form 7 */
            add_filter('wpcf7_form_elements', array($this, 'tgdprc_form_elements_filter'), 100);

            /** Consent Default Login Form */
            add_filter('login_form', array($this, 'tgdprc_login_form_additional_field'));
            add_filter('wp_authenticate_user', array($this, 'tgdprc_authenticate_user_consent_checkbox'), 10, 2);

            /** Consent on Registry Default WordPress Page */
            add_filter('register_form', array($this, 'tgdprc_wp_register_form_additional_field'));
            add_filter('registration_errors', array($this, 'tgdprc_authenticate_user_consent_checkbox_wp_default_registry'), 10, 2);
            add_action('user_register', array($this, 'tgdprc_update_registry_consent_user_data'));

            /** Consent on checkout for woocommerce */
            add_action('woocommerce_review_order_before_submit', array($this, 'tgdprc_woocommerce_add_checkout_consent_additional_field'), 9);
            add_action('woocommerce_checkout_process', array($this, 'tgdprc_woocommerce_not_approved_privacy'));
            add_action('woocommerce_checkout_update_user_meta', array($this, 'tgdprc_woocommerce_checkout_update_user_meta'));

            add_shortcode('tgdprc-cookies-used', array($this, 'tgdprc_cookies_used_shortcode'));
            add_shortcode('tgdprc-terms-conditions', array($this, 'tgdprc_terms_and_conditions'));
            add_shortcode('tgdprc-policies', array($this, 'tgdprc_policies'));
            add_shortcode('tgdprc-advanced-cookie-setting', array($this, 'tgdprc_advanced_cookie_settings'));
            add_shortcode('tgdprc-userdata-form', array($this, 'tgdprc_user_data_form'));

            add_action('media_buttons', array($this, 'tgdprc_shortcode_inserter_popup_content_doing_media_buttons'));
            add_action('admin_footer', array($this, 'tgdprc_main_shortcode_popup_content'));
            add_filter( 'admin_footer_text', array( $this, 'tgdprcl_admin_footer_text' ) );
            add_filter( 'plugin_row_meta', array( $this, 'tgdprcl_plugin_row_meta' ), 10, 2 );
        }

        function tgdprcl_admin_footer_text( $text ){
            global $post;
            if ( (isset( $_GET[ 'page' ] ) && in_array($_GET[ 'page' ], array('total-gdpr-compliance-lite','tgdprcl-manage-cookie-settings','tgdprcl-cookie-custom-template','tgdprcl-cookie-settings','tgdprcl-advance-cookies','tgdprcl-policies-and-conditions','tgdprcl-userdata','tgdprcl-consents','tgdprcl-services-settings','tgdprcl-more-wp-resources') ) || ( (isset( $_GET[ 'post_type' ] )) && $_GET[ 'post_type' ] == 'totalgdprcompliance' ) ) ) {
                $link = 'https://wordpress.org/support/plugin/total-gdpr-compliance-lite/reviews/#new-post';
                $pro_link = 'https://accesspressthemes.com/wordpress-plugins/total-gdpr-compliance/';
                $text = 'Enjoyed Total GDPR Compliance Lite? <a href="' . $link . '" target="_blank">Please leave us a ★★★★★ rating</a> We really appreciate your support! | Try premium version of <a href="' . $pro_link . '" target="_blank">Total GDPR Compliance</a> - more features, more power!';
                return $text;
            } else {
                return $text;
            }
        }

        function tgdprcl_plugin_row_meta( $links, $file ){

            if ( strpos( $file, 'total-gdpr-compliance-lite.php' ) !== false ) {
                $new_links = array(
                    'demo' => '<a href="http://demo.accesspressthemes.com/wordpress-plugins/total-gdpr-compliance-lite" target="_blank"><span class="dashicons dashicons-welcome-view-site"></span>Live Demo</a>',
                    'doc' => '<a href="https://accesspressthemes.com/documentation/total-gdpr-compliance-lite/" target="_blank"><span class="dashicons dashicons-media-document"></span>Documentation</a>',
                    'support' => '<a href="http://accesspressthemes.com/support" target="_blank"><span class="dashicons dashicons-admin-users"></span>Support</a>',
                    'pro' => '<a href="https://accesspressthemes.com/wordpress-plugins/total-gdpr-compliance/" target="_blank"><span class="dashicons dashicons-cart"></span>Premium version</a>'
                );

                $links = array_merge( $links, $new_links );
            }

            return $links;
        }
        /** Function to insert new posts into the services */
        function tgdprc_insert_default_posts_into_services() {
            $default_cookies = $this->global_default_cookie_array_call();
            $post_insert_counter = 0;
            $post_insert_counterlen = count($default_cookies);

            if (!empty($default_cookies) && FALSE === get_option('tgdprc_new_service_insert_flag')) {
                foreach ($default_cookies as $key => $val) {
                    if ($post_insert_counter <= $post_insert_counterlen) {
                        // first
                        $my_post_array = array(
                            'post_title' => esc_attr($val['title']),
                            'post_content' => esc_attr($val['description']),
                            'post_status' => 'publish',
                            'post_type' => 'totalgdprcompliance',
                        );

                        if ($post_id = wp_insert_post($my_post_array)) {
                            $custom_meta_default_values_array = array();
                            foreach ($val as $k => $v) {
                                if (!in_array($k, array('title', 'description'))) {
                                    $custom_meta_default_values_array[$k] = $v;
                                }
                            }
                            $this->tgdprc_update_post_meta_on_insert_default_services($post_id, 'tgdpr_service_detail', $custom_meta_default_values_array);
                        }
                    } else if ($post_insert_counter > $post_insert_counterlen) {
                        //last so flag added
                        $errors['wp_insert_post'] = 'There was an error adding the Services.';
                    }
                    $post_insert_counter++;
                }
                update_option('tgdprc_new_service_insert_flag', 'true');
            }
        }

        /** Pull cookies from services to make them ready for blocking */
        function pull_services_cookies_for_block_function() {
            $tgpdrc_cookies_services_lists = array();

            // Fallback to default array if no post 
            $default_cookies = $this->global_default_cookie_array_call();
            foreach ($default_cookies as $key => $val) {
                $tgdprc_cookie_used = isset($val['cookie_used']) && !empty($val['cookie_used']) ? esc_attr($val['cookie_used']) : '';
                $tgdprc_cookie_type = isset($val['cookie_types']) && !empty($val['cookie_types']) ? esc_attr($val['cookie_types']) : '';
                $tgdprc_cookie_used_singular = array_map('trim', explode(',', $tgdprc_cookie_used));

                if (isset($tgpdrc_cookies_services_lists[$tgdprc_cookie_type])) {
                    $tgpdrc_cookies_services_lists[$tgdprc_cookie_type] = array_merge($tgpdrc_cookies_services_lists[$tgdprc_cookie_type], $tgdprc_cookie_used_singular);
                } else {
                    $tgpdrc_cookies_services_lists[$tgdprc_cookie_type] = $tgdprc_cookie_used_singular;
                }
            }
            return $tgpdrc_cookies_services_lists;
        }

        /**
         * Updates post meta for a post. It also automatically deletes or adds the value to field_name if specified
         */
        public function tgdprc_update_post_meta_on_insert_default_services($post_id, $field_name, $value = '') {
            if (empty($value) OR ! $value) {
                delete_post_meta($post_id, $field_name);
            } elseif (!get_post_meta($post_id, $field_name)) {
                add_post_meta($post_id, $field_name, $value);
            } else {
                update_post_meta($post_id, $field_name, $value);
            }
        }

        function global_default_values_array_call() {
            $tgdprc_global_value_array = array(
                'default_custom_cookie_category_array' => array(
                    'necessary' => __('Necessary', TGDPRCL_DOMAIN),
                    'analytics' => __('Analytics & Marketing', TGDPRCL_DOMAIN),
                    'advertisement' => __('Advertisement', TGDPRCL_DOMAIN)
                ),
                'advancedcookie_default_excluded_array' => array('general', 'content_setting', 'additional', 'necessary', 'analytics', 'advertisement', 'floating_advanced_cookie'
            )
            );

            return $tgdprc_global_value_array;
        }

        /**
         * Default Advanced Cookie Array
         * @return array
         */
        function global_default_cookie_array_call() {
            include( TGDPRCL_PATH . 'inc/backend/required-constants/default-cookie-array.php' );
            return $default_advanced_cookie_check_array;
        }

        /** Secondary Shortcode inner content for Default Editor */
        function tgdprc_shortcode_inserter_popup_content_doing_media_buttons() {
            echo '<a href = "#TB_inline?width=200px%&height=100px&inlineId=tgdprc-main-custom-shortcode-popup" class = "tgdprc-main-custom-shortcode-popup buttons thickbox wp_doin_media_link button button-secondary" id = "tgdprc_main_add_shortcode" title = "' . __("TGDPRC Shorcode Inserter", TGDPRCL_DOMAIN) . '"><span class="tgdprc-dash-icon-testim"></span>' . __("TGDPRC Shortcode", TGDPRCL_DOMAIN) . '</a>';
        }

        /** Main shortcode inner content */
        function tgdprc_main_shortcode_popup_content() {
            include( TGDPRCL_PATH . 'inc/backend/content-inserter.php' );
        }

        /**
         * Pull Related Data Rectify
         */
        function tgdprc_pull_related_array_rectify_userdata($tgdprc_data_rectify_req) {
            $tgdprc_rectify_form_json_data = get_option('tgdprc-rectify-form-json-data');
            $return_rectify_data = array();
            if (!empty($tgdprc_rectify_form_json_data)) {
                foreach ($tgdprc_rectify_form_json_data as $key => $val) {
                    if ($val['email_addresss'] == $tgdprc_data_rectify_req) {
                        $return_rectify_data = $val;
                    }
                }
            }
            return $return_rectify_data;
        }

        function tgdprc_pull_related_array_access_userdata($tgdprc_data_access_req) {
            $tgdprc_access_additional_data_array = get_option('tgdprc-access-additional-data');
            $tgdprc_access_additional_data = $tgdprc_access_additional_data_array != false ? $tgdprc_access_additional_data_array : array();
            $return_access_data = array();
            if (!empty($tgdprc_access_additional_data)) {
                foreach ($tgdprc_access_additional_data as $key => $val) {
                    if ($val['email_addresss'] == $tgdprc_data_access_req) {
                        $return_access_data = $val;
                    }
                }
            }
            return $return_access_data;
        }

        function tgdprc_pull_related_array_forget_userdata($tgdprc_data_forget_req) {
            $tgdprc_forget_additional_data_array = get_option('tgdprc-forget-form-additional-data');
            $tgdprc_forget_additional_data = $tgdprc_forget_additional_data_array != false ? $tgdprc_forget_additional_data_array : array();
            $return_forget_data = array();
            if (!empty($tgdprc_forget_additional_data)) {
                foreach ($tgdprc_forget_additional_data as $key => $val) {
                    if ($val['email_addresss'] == $tgdprc_data_forget_req) {
                        $return_forget_data = $val;
                    }
                }
            }
            return $return_forget_data;
        }

        function func_export_all_consents() {
            global $post, $wpdb;
            if (isset($_GET['action']) && $_GET['action'] == 'export_consent_log_entries' && wp_verify_nonce($_REQUEST['_wpnonce'], 'tgdprc_export_consent_nonce')) {
                $tgdprc_table_name = $wpdb->prefix . 'tgdprc_consent_log';
                $tgdprc_result = $wpdb->get_results("SELECT * FROM $tgdprc_table_name");
                if (count($tgdprc_result) > 0) {
                    foreach ($tgdprc_result as $tgdprc_resultt):
                        $consent_log_details = isset($tgdprc_resultt->consent_log_details) && !empty($tgdprc_resultt->consent_log_details) ? maybe_unserialize($tgdprc_resultt->consent_log_details) : array();
                        $header_row = array(
                            0 => __('id', TGDPRCL_DOMAIN),
                            1 => __('Browser IP', TGDPRCL_DOMAIN),
                            2 => __('User Agent', TGDPRCL_DOMAIN),
                            3 => __('Browser Header', TGDPRCL_DOMAIN),
                            4 => __('Consent Values', TGDPRCL_DOMAIN),
                            5 => __('Consent Date', TGDPRCL_DOMAIN),
                            6 => __('Consent last Edited Date', TGDPRCL_DOMAIN),
                        );

                        $row[0] = !empty($tgdprc_resultt->id) ? esc_attr($tgdprc_resultt->id) : '';
                        $row[1] = !empty($tgdprc_resultt->browser_ip) ? esc_attr($tgdprc_resultt->browser_ip) : '';
                        $row[2] = isset($consent_log_details['tgdprc_user_agent']) && !empty($consent_log_details['tgdprc_user_agent']) ? esc_attr($consent_log_details['tgdprc_user_agent']) . ' / ' : '';
                        $row[3] = isset($consent_log_details['tgdprc_browser_header']) && !empty($consent_log_details['tgdprc_browser_header']) ? esc_attr($consent_log_details['tgdprc_browser_header']) : '';
                        $row[4] = '';
                        if (isset($consent_log_details['consent_values']) && !empty($consent_log_details['consent_values'])) {
                            foreach ($consent_log_details['consent_values'] as $consent_key => $consent_val) {
                                $row[4] .= $consent_val . ',';
                            }
                        }
                        $row[5] = !empty($tgdprc_resultt->consent_date) ? esc_attr($tgdprc_resultt->consent_date) : '';
                        $row[6] = !empty($tgdprc_resultt->consent_last_edit_date) ? esc_attr($tgdprc_resultt->consent_last_edit_date) : '';
                        $data_rows[] = $row;
                        /* Group Export Ends */
                    endforeach;
                }

                $filename = 'tgdprc-consent-logs-' . time() . '.csv';
//$filename = 'cf7stdb-group-entries-' . time() . '.csv';
                $fh = @fopen('php://output', 'w');
                fprintf($fh, chr(0xEF) . chr(0xBB) . chr(0xBF));
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Content-Description: File Transfer');
                header('Content-type: text/csv');
                header("Content-Disposition: attachment; filename={$filename}");
                header('Expires: 0');
                header('Pragma: public');
                fputcsv($fh, $header_row);
                foreach ($data_rows as $data_row) {
                    fputcsv($fh, $data_row);
                }
                fclose($fh);
                die();
            }
        }

        /**
         * 
         * Delete Consent Log From database
         */
        function tgdprc_delete_consent_log() {
            if (!empty($_GET) && wp_verify_nonce($_GET['_wpnonce'], 'tgdprc_consent_delete_nonce')) {
                $log_id = $_GET['log_id'];
                global $wpdb;
                $table_name = $wpdb->prefix . 'tgdprc_consent_log';
                $delete = $wpdb->delete($table_name, array('id' => $log_id), array('%d'));
                if ($delete) {
                    wp_redirect(admin_url() . 'admin.php?page=tgdprcl-advance-cookies&subpage=view-consent-logs&message=1');
                } else {
                    wp_redirect(admin_url() . 'admin.php?page=tgdprcl-advance-cookies&subpage=view-consent-logs&message=0');
                }
            } else {
                die('No direct script allowed!');
            }
        }

        /**
         * 
         * Delete Consent Log From database
         */
        function tgdprc_delete_all_consent_logs() {
            if (!empty($_GET) && wp_verify_nonce($_GET['_wpnonce'], 'tgdprc_consent_delete_nonce')) {
                $log_id = $_GET['log_id'];
                global $wpdb;
                $table_name = $wpdb->prefix . 'tgdprc_consent_log';
                $delete = $wpdb->query("TRUNCATE TABLE $table_name");
                if ($delete) {
                    wp_redirect(admin_url() . 'admin.php?page=tgdprcl-advance-cookies&subpage=view-consent-logs&message=2');
                } else {
                    wp_redirect(admin_url() . 'admin.php?page=tgdprcl-advance-cookies&subpage=view-consent-logs&message=3');
                }
            } else {
                die('No direct script allowed!');
            }
        }

        /**
         * Additing consent checkbox in the woocoomerce checkout 
         */
        function tgdprc_woocommerce_add_checkout_consent_additional_field() {
            $tgdprc_consent_settings = get_option('tgdprc-consent-settings');
            $consent_text = isset($tgdprc_consent_settings['woo_commerce']['consent_text']) && !empty($tgdprc_consent_settings['woo_commerce']['consent_text']) ? esc_attr($tgdprc_consent_settings['woo_commerce']['consent_text']) : __('I accept storing of my basic data and Privacy Policy', TGDPRCL_DOMAIN);
            if (isset($tgdprc_consent_settings['woo_commerce']['enable']) && $tgdprc_consent_settings['woo_commerce']['enable'] == 1) {
                woocommerce_form_field('tgdprc_woocommerce_consent_accept', array(
                    'type' => 'checkbox',
                    'class' => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox tgdprc-woo-concent-accept'),
                    'required' => true,
                    'label' => $consent_text,
                ));
            } else {

            }
        }

        /**
         *  Show notice if customer does not tick
         */
        function tgdprc_woocommerce_not_approved_privacy() {
            $tgdprc_consent_settings = get_option('tgdprc-consent-settings');
            $consent_required_text = (isset($tgdprc_consent_settings['woo_commerce']['consent_required_text']) && !empty($tgdprc_consent_settings['woo_commerce']['consent_required_text'])) ? esc_attr($tgdprc_consent_settings['woo_commerce']['consent_required_text']) : __("Please accept our consent checkbox to continue.", TGDPRCL_DOMAIN);
            if (isset($tgdprc_consent_settings['woo_commerce']['enable']) && $tgdprc_consent_settings['woo_commerce']['enable'] == 1) {
                if (!isset($_POST['tgdprc_woocommerce_consent_accept'])) {
                    wc_add_notice(__($consent_required_text), 'error');
                }
            }
        }

        function tgdprc_woocommerce_checkout_update_user_meta($customer_id, $data) {
            if (isset($_POST['tgdprc_woocommerce_consent_accept']) && !empty($_POST['tgdprc_woocommerce_consent_accept'])) {
                update_user_meta($customer_id, 'tgdprc_woocommerce_consent_accept', 'accepted');
            }
        }

        /**
         * Add additional consent field in WPs registry form 
         */
        function tgdprc_wp_register_form_additional_field() {
            $tgdprc_consent_settings = get_option('tgdprc-consent-settings');
            $consent_text = isset($tgdprc_consent_settings['wp_register']['consent_text']) && !empty($tgdprc_consent_settings['wp_register']['consent_text']) ? esc_attr($tgdprc_consent_settings['wp_register']['consent_text']) : __('I accept storing of my basic data.', TGDPRCL_DOMAIN);

            if (isset($tgdprc_consent_settings['wp_register']['enable']) && $tgdprc_consent_settings['wp_register']['enable'] == 1) {
                ?>
                <p>
                <label for="tgdprc_wp_register_consent_accept">
                <input type="checkbox" name="tgdprc_wp_register_consent_accept" id="tgdprc_wp_register_consent_accept" value="accepted"/>
                <?php echo $consent_text; ?>
                </label>
                </p>
                <?php
            }
        }

        /**
         * Validate User consent data from registry form
         * @param WP_Error $reg_errors
         * @param type $form_id
         * @return WP_Error
         */
        function tgdprc_authenticate_user_consent_checkbox_wp_default_registry($errors, $sanitized_user_login) {

            $tgdprc_consent_settings = get_option('tgdprc-consent-settings');
            $privacy_policy_text = (isset($tgdprc_consent_settings['wp_register']['consent_required_text']) && !empty($tgdprc_consent_settings['wp_register']['consent_required_text'])) ? esc_attr($tgdprc_consent_settings['wp_register']['privacy_policy_text']) : __("Please accept our consent checkbox to continue", TGDPRCL_DOMAIN);
            if (isset($tgdprc_consent_settings['wp_register']['enable']) && $tgdprc_consent_settings['wp_register']['enable'] == 1) {
                if (empty($_POST['tgdprc_wp_register_consent_accept']) || !empty($_POST['tgdprc_wp_register_consent_accept']) && trim($_POST['tgdprc_wp_register_consent_accept']) == '') {
                    $errors->add('tgdprc_wp_register_consent_error', sprintf('<strong>%s</strong>: %s', __('ERROR', TGDPRCL_DOMAIN), $privacy_policy_text));
                }
            }
            return $errors;
        }

        /**
         * User registry Consent accepted Value updated to metadata
         * @param type $user_id
         */
        function tgdprc_update_registry_consent_user_data($user_id) {
            if (!empty($_POST['tgdprc_wp_register_consent_accept'])) {
                update_user_meta($user_id, 'tgdprc_wp_register_consent_accept', esc_attr($_POST['tgdprc_wp_register_consent_accept']));
            }
        }

        /**
         * Login Form add Additional Field
         */
        function tgdprc_login_form_additional_field() {
            $tgdprc_consent_settings = get_option('tgdprc-consent-settings');
            $consent_text = isset($tgdprc_consent_settings['wp_login']['consent_text']) && !empty($tgdprc_consent_settings['wp_login']['consent_text']) ? esc_attr($tgdprc_consent_settings['wp_login']['consent_text']) : __('I accept storing of my basic data.', TGDPRCL_DOMAIN);
            if (isset($tgdprc_consent_settings['wp_login']['enable']) && $tgdprc_consent_settings['wp_login']['enable'] == 1) {
                echo '<p><label for="tgdprc-wp-login-accept-consent"><input type="checkbox" name="tgdprc_wp_login_consent_accept" id="tgdprc-wp-login-accept-consent" />' . $consent_text . '</label></p>';
            }
        }

        /**
         * Authenticate data from user login
         */
        function tgdprc_authenticate_user_consent_checkbox($user, $password) {
            $tgdprc_consent_settings = get_option('tgdprc-consent-settings');
            $privacy_policy_text = (isset($tgdprc_consent_settings['wp_login']['consent_required_text']) && !empty($tgdprc_consent_settings['wp_login']['consent_required_text'])) ? esc_attr($tgdprc_consent_settings['wp_login']['privacy_policy_text']) : __("Please accept our consent checkbox to continue", TGDPRCL_DOMAIN);
            if (isset($tgdprc_consent_settings['wp_login']['enable']) && $tgdprc_consent_settings['wp_login']['enable'] == 1) {
                if (isset($_REQUEST['tgdprc_wp_login_consent_accept']) && $_REQUEST['tgdprc_wp_login_consent_accept'] == 'on') {
                    return $user;
                } else {
                    $error = new WP_Error();
                    $error->add('did_not_accept', $privacy_policy_text);
                    return $error;
                }
            } else {
                return $user;
            }
        }

        /**
         * GDPR consent checkbox being added to Contact form 7 form
         */
        function tgdprc_form_elements_filter($original_fields) {
            $tgdprc_consent_settings = get_option('tgdprc-consent-settings');
            if (isset($tgdprc_consent_settings['consent_cf7']['enable']) && $tgdprc_consent_settings['consent_cf7']['enable'] == 1) {
                $additional_entries = $this->tgdprc_pull_wp_comment_consent_fields($tgdprc_consent_settings);
                return $original_fields . $additional_entries;
            } else {
                return $original_fields;
            }
        }

        /**
         * GDPR consent checkbox being added to Default WordPress Comment Field
         */
        function tgdprc_add_custom_wp_comment_consent_fields($fields) {
            $tgdprc_consent_settings = get_option('tgdprc-consent-settings');
            $commenter = wp_get_current_commenter();
            $consent_text = isset($tgdprc_consent_settings['wp_default_user_data']['consent_text']) && !empty($tgdprc_consent_settings['wp_default_user_data']['consent_text']) ? esc_attr($tgdprc_consent_settings['wp_default_user_data']['consent_text']) : __('I consent to storing of my name, email and other details', TGDPRCL_DOMAIN);
            if (isset($tgdprc_consent_settings['wp_default_user_data']['enable']) && $tgdprc_consent_settings['wp_default_user_data']['enable'] == 1) {
                $fields['policy'] = '<p class="comment-form-policy">' .
                '<label for="policy" style="display:block !important">
                <input id="policy" name="policy" value="accepted" class="comment-form-policy__input" type="checkbox" style="width:auto; margin-right:7px;" aria-required="true">' . $consent_text . '
                <span class = "comment-form-policy__required required">*</span>
                </label>
                </p>';
            }
            return $fields;
        }

        /**
         * Get original_gdpr consent fields
         * @return $message_body
         */
        function tgdprc_pull_wp_comment_consent_fields($tgdprc_consent_settings) {
            $additional_entries_text = isset($tgdprc_consent_settings['consent_cf7']['consent_text']) && !empty($tgdprc_consent_settings['consent_cf7']['consent_text']) ? esc_attr($tgdprc_consent_settings['consent_cf7']['consent_text']) : __("I am okay with storage of my data and accept Privacy Policy", TGDPRCL_DOMAIN);
            /*
             * Appended Consent Content into Contact Form 7 Form
             */
            $additional_entries = '';
            $additional_entries .= '<p><span class="wpcf7-form-control-wrap accept-this">';
            $additional_entries .= '<span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required wpcf7-exclusive-checkbox wpcf7-acceptance">';
            $additional_entries .= '<span class="wpcf7-list-item first last"><label>';
            $additional_entries .= '<input class="tgdprc-gdpr-consent-check" type="checkbox" name="tgdprc_wp_comment_consent_accept" value="accepted" required/>';
            $additional_entries .= '<span class="wpcf7-list-item-label">';
            $additional_entries .= $additional_entries_text;
            $additional_entries .= '</span></label></span></span></span><p>';
            return $additional_entries;
        }

        function tgdprc_verify_consent_fields($policydata) {
            $tgdprc_consent_settings = get_option('tgdprc-consent-settings');
            if (isset($tgdprc_consent_settings['wp_default_user_data']['enable']) && $tgdprc_consent_settings['wp_default_user_data']['enable'] == 1) {
                $consent_required_text = isset($tgdprc_consent_settings['wp_default_user_data']['consent_required_text']) && !empty($tgdprc_consent_settings['wp_default_user_data']['consent_required_text']) ? esc_attr($tgdprc_consent_settings['wp_default_user_data']['consent_required_text']) : __('please accept our consent checkbox to continue', TGDPRCL_DOMAIN);
                if (!isset($_POST['policy']) && !is_user_logged_in())
                    wp_die('<strong>' . __('ERROR: ') . '</strong>' . $consent_required_text . '<p><a href = "javascript:history.back()" > ' . __(' &laquo;
                        Back') . '</a></p>');
            }
            return $policydata;
        }

        /**
         * Add comment meta for each comment with checkbox approved
         *
         */
        function tgdprc_insert_into_commentmeta($comment_id) {
            $tgdprc_consent_settings = get_option('tgdprc-consent-settings');
            if (isset($tgdprc_consent_settings['wp_default_user_data']['enable']) && $tgdprc_consent_settings['wp_default_user_data']['enable'] == 1) {
                add_comment_meta($comment_id, 'tgdprc_wp_comment_consent_accept', isset($_POST['tgdprc_wp_comment_consent_accept']) ? esc_attr($_POST['tgdprc_wp_comment_consent_accept']) : '', true);
            }
        }

        /**
         * Action When terms and policies button clicked
         *
         */
        function tgdprc_terms_policies_button_click_action() {
            $policies_settings = get_option('tgdprc-policies-settings');
            $terms_and_condition_settings = get_option('tgdprc-terms-settings');
            if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'tgdprc_frontend_ajax_nonce')) {
                $id_value = esc_attr($_POST['id_value']);
                $policie_stats = esc_attr($_POST['policie_stats']);
                if (!empty($id_value) && $id_value == 'tgdprc-policies-button') {
                    if ($policie_stats && $policie_stats != 'accepted') {
                        if (isset($policies_settings['require_logged_in']) && $policies_settings['require_logged_in'] = 'on' && !is_user_logged_in()) {
                            $message = isset($policies_settings['login_required_message']) && !empty($policies_settings['login_required_message']) ? esc_attr($policies_settings['login_required_message']) : __('Login Required. Please Login and Try again.', TGDPRCL_DOMAIN);
                            echo 'response=failed&message=' . $message . '';
                        } else {
                            $message = isset($policies_settings['after_accept_message']) && !empty($policies_settings['after_accept_message']) ? esc_attr($policies_settings['after_accept_message']) : __('Policies accepted. Please click button again to unaccept.', TGDPRCL_DOMAIN);
                            echo 'response=success&message=' . $message . '';
                        }
                    } else {
                        $message = isset($policies_settings['after_unaccept_message']) && !empty($policies_settings['after_unaccept_message']) ? esc_attr($policies_settings['after_unaccept_message']) : __('Policies unaccepted.', TGDPRCL_DOMAIN);
                        echo 'response=success&message=' . $message . '';
                    }
                } else if (!empty($id_value) && $id_value == 'tgdprc-terms-button') {
                    if ($policie_stats && $policie_stats != 'accepted') {
                        if (isset($terms_and_condition_settings['require_logged_in']) && $terms_and_condition_settings['require_logged_in'] = 'on' && !is_user_logged_in()) {
                            $message = isset($terms_and_condition_settings['login_required_message']) && !empty($terms_and_condition_settings['login_required_message']) ? esc_attr($terms_and_condition_settings['login_required_message']) : __('Login Required. Please Login and Try again.', TGDPRCL_DOMAIN);
                            echo 'response=failed&message=' . $message . '';
                        } else {
                            $message = isset($terms_and_condition_settings['after_accept_message']) && !empty($terms_and_condition_settings['after_accept_message']) ? esc_attr($terms_and_condition_settings['after_accept_message']) : __('Terms and Condition accepted. Please click button again to unaccept.', TGDPRCL_DOMAIN);
                            echo 'response=success&message=' . $message . '';
                        }
                    } else {
                        $message = isset($terms_and_condition_settings['after_unaccept_message']) && !empty($terms_and_condition_settings['after_unaccept_message']) ? esc_attr($terms_and_condition_settings['after_unaccept_message']) : __('Terms and Condition unaccepted.', TGDPRCL_DOMAIN);
                        echo 'response=success&message=' . $message . '';
                    }
                }
            }
            die();
        }

        /**
         * Function to Store Consent Log 
         */
        function tgdprc_advance_cookie_consent_storage() {
            if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'tgdprc_frontend_ajax_nonce')) {
                include( 'inc/backend/advanced-cookie/save_consent_log.php' );
            }
            die();
        }

        /** Ajax action after user submit the save cookie preference button */
        function tgdprc_block_cookie_action($consent_id) {
            global $wpdb;
            //(int) filter_var($message, FILTER_SANITIZE_NUMBER_INT);
            $tgdprc_past = time() - 3600;
            $all_Services = $this->pull_services_cookies_for_block_function();
            if (!empty($consent_id)):
                $tgdprc_table_name = $wpdb->prefix . 'tgdprc_consent_log';
                $tgdprc_result = $wpdb->get_row("SELECT * FROM $tgdprc_table_name WHERE browser_ip = '$consent_id'");
                $tgdprc_consent_log_details = isset($tgdprc_result) && !empty($tgdprc_result) ? maybe_unserialize($tgdprc_result->consent_log_details) : array();
                $tgdprc_consent_log_values_arr = isset($tgdprc_result) && is_array($tgdprc_result) && !empty($tgdprc_result) ? $tgdprc_consent_log_details['consent_values'] : array();
                foreach ($all_Services as $services_key => $services_val) :
                    if (!empty($tgdprc_consent_log_values_arr)):
                        if (!in_array('allow-' . $services_key, $tgdprc_consent_log_values_arr)):
                            foreach ($all_Services[$services_key] as $k => $v):
                                setcookie($v, '', $tgdprc_past);
//                                if (true === array_key_exists($v, $_COOKIE) && strlen($_COOKIE[$v]) > 0) :
//                                    setcookie($v, '', $tgdprc_past);
//                                endif;
                            endforeach;
                        endif;
                    endif;
                endforeach;
            endif;
        }

        /**
         * Function to Store Consent Log 
         */
        function tgdprc_user_data_process_action() {
            if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'tgdprc_frontend_ajax_nonce')) {
                include( 'inc/backend/user-data/user-data-process.php' );
            }
            die();
        }

        /**
         * Function to save Menu 
         */
        function tgdprc_save_terms_and_policies_field_options() {
            if (isset($_POST['tgdprc_nonce_field']) && isset($_POST['tgdprc_save_terms_policies_settings']) && wp_verify_nonce($_POST['tgdprc_nonce_field'], 'tgdprc_nonce')) {
                include( 'inc/backend/policies-and-conditions/save-terms-action.php' );
                die();
            }
        }

        /**
         * Function to save Menu 
         */
        function tgdprc_save_user_datasetting_field_options() {
            if (isset($_POST['tgdprc_nonce_field']) && isset($_POST['tgdprc_save_user_datasetting_field_settings']) && wp_verify_nonce($_POST['tgdprc_nonce_field'], 'tgdprc_nonce')) {
                include( 'inc/backend/user-data/save-user-data-action.php' );
                die();
            }
        }

        /**
         * Function to save Services Settings 
         */
        function tgdprc_save_service_setting_field_options() {
            if (isset($_POST['tgdprc_nonce_field']) && isset($_POST['tgdprc_save_service_setting_field_settings']) && wp_verify_nonce($_POST['tgdprc_nonce_field'], 'tgdprc_nonce')) {
                include( 'inc/backend/services/save-services-settings-action.php' );
                die();
            }
        }

        /**
         * Function to save Services Settings 
         */
        function tgdprc_save_protected_setting_field_options() {
            if (isset($_POST['tgdprc_nonce_field']) && isset($_POST['tgdprc_save_protected_setting_field_settings']) && wp_verify_nonce($_POST['tgdprc_nonce_field'], 'tgdprc_nonce')) {
                include( 'inc/backend/protected/save-protected-settings-action.php' );
                die();
            }
        }

        /**
         * function for adding shortcode of a plugin
         */
        function tgdprc_cookies_used_shortcode($attr) {
            ob_start();
            include TGDPRCL_PATH . 'inc/frontend/services/shortcode-services.php';
            $html = ob_get_contents();
            ob_get_clean();
            return $html;
        }

        /**
         * function for adding shortcode of a plugin
         */
        function tgdprc_terms_and_conditions($attr) {
            ob_start();
            include TGDPRCL_PATH . 'inc/frontend/terms-conditions-policies/terms-condition.php';
            $html = ob_get_contents();
            ob_get_clean();
            return $html;
        }

        /**
         * function for adding shortcode of a plugin
         */
        function tgdprc_policies($attr) {
            ob_start();
            include TGDPRCL_PATH . 'inc/frontend/terms-conditions-policies/policies.php';
            $html = ob_get_contents();
            ob_get_clean();
            return $html;
        }

        /**
         * 
         * @return type Advanced Cookie Settings
         */
        function tgdprc_advanced_cookie_settings() {
            ob_start();
            include TGDPRCL_PATH . 'inc/frontend/advanced-cookies-setting/advanced-cookie.php';
            $html = ob_get_contents();
            ob_get_clean();
            return $html;
        }

        /**
         * 
         * @return type Advanced user Data Form
         */
        function tgdprc_user_data_form() {
            ob_start();
            include TGDPRCL_PATH . 'inc/frontend/userdata/user-data.php';
            $html = ob_get_contents();
            ob_get_clean();
            return $html;
        }

        /*
         * Service Setting Metabox 1 Load
         */

        function add_service_option_1_metabox() {
            add_meta_box('tgdpr_service_detail', __('Content Setting', TGDPRCL_DOMAIN), array($this, 'add_service_option_general_metabox_callback'), 'totalgdprcompliance', 'normal', 'default');
        }

        /*
         * General Setting Metabox callback
         */

        function add_service_option_general_metabox_callback($post) {
            wp_nonce_field(basename(__FILE__), 'tgdprc_settings_nonce');
            $tgdpr_service_detail = get_post_meta($post->ID);
            include TGDPRCL_PATH . 'inc/backend/services/meta/service-option-field.php';
        }

        /*
         * Service Setting Metabox save action
         */

        function save_service_option_metabox($post_id) {

            /**
             *  Checks save status
             */
            $is_autosave = wp_is_post_autosave($post_id);
            $is_revision = wp_is_post_revision($post_id);
            $is_valid_nonce = ( isset($_POST['tgdprc_settings_nonce']) && wp_verify_nonce($_POST['tgdprc_settings_nonce'], basename(__FILE__)) ) ? 'true' : 'false';
            /**
             *  Exits script depending on save status
             */
            if ($is_autosave || $is_revision || !$is_valid_nonce) {
                return;
            } else {
                include TGDPRCL_PATH . 'inc/backend/services/save-service-meta.php';
            }
        }

        /**
         * Define Web fonts
         */
        public function define_web_fonts() {
            if (!defined('TGDPRC_WEB_FONTS')) {
                $tgdprc_fonts = get_option('tgdprc_typo_fonts');
                $new_web_font = array();
                if (!empty($tgdprc_fonts)) {
                    foreach ($tgdprc_fonts as $index => $value) {
                        $new_web_font[$index] = str_replace(' ', '+', $value);
                    }
                }
                $string_var = join('|', $new_web_font);
                define('TGDPRC_WEB_FONTS', $string_var);
            }
        }

        function tgdprc_send_email_with_userdata_to_user() {
            if (!empty($_GET) && wp_verify_nonce($_GET['_wpnonce'], 'tgdprc_user_data_nonce')) {
                include TGDPRCL_PATH . 'inc/backend/user-data/user-data-request/send-user-data.php';
            }
        }

        /**
         * Checks if parameter is json data return true or false
         */
        function is_json($value = null) {
            $ret = true;

            if (null === @json_decode($value)) {
                $ret = false;
            }

            return $ret;
        }

        /**
         * This is a function for registering a menu into the Plugin
         */
        function register_a_menu() {
            /**
             * Adding a custom menu
             */
            add_menu_page(
                esc_attr__('Total GDPR Compliance Lite', TGDPRCL_DOMAIN), esc_attr__('Total GDPR Compliance Lite', TGDPRCL_DOMAIN), 'manage_options', TGDPRCL_DOMAIN, array($this, 'display_about_page')
            );
            add_submenu_page(
                TGDPRCL_DOMAIN, esc_attr__('About', TGDPRCL_DOMAIN), esc_attr__('About', TGDPRCL_DOMAIN), 'manage_options', TGDPRCL_DOMAIN, array($this, 'display_about_page')
            );
        }

        /**
         * This is a function for registering the list of submenus into the Plugin
         */
        function register_submenus() {
            add_submenu_page(
                TGDPRCL_DOMAIN, esc_attr__('Cookie Templates', TGDPRCL_DOMAIN), esc_attr__('Cookie Templates', TGDPRCL_DOMAIN), 'manage_options', 'tgdprcl-manage-cookie-settings', array($this, 'display_menu_page')
            );
            add_submenu_page(
                TGDPRCL_DOMAIN, esc_attr__('Custom Cookie Templates', TGDPRCL_DOMAIN), esc_attr__('Custom Cookie Templates', TGDPRCL_DOMAIN), 'manage_options', 'tgdprcl-cookie-custom-template', array($this, 'list_custom_template')
            );
            add_submenu_page(
                TGDPRCL_DOMAIN, esc_attr__('Cookie Settings', TGDPRCL_DOMAIN), esc_attr__('Cookie Setting', TGDPRCL_DOMAIN), 'manage_options', 'tgdprcl-cookie-settings', array($this, 'choose_from_cookies')
            );
            add_submenu_page(
                TGDPRCL_DOMAIN, __('Advanced Cookies', TGDPRCL_DOMAIN), __('Advanced Cookies', TGDPRCL_DOMAIN), 'manage_options', 'tgdprcl-advance-cookies', array($this, 'tgdprc_advanced_cookies_menu')
            );
            add_submenu_page(
                TGDPRCL_DOMAIN, __('Policies & Terms', TGDPRCL_DOMAIN), __('Policies & Terms', TGDPRCL_DOMAIN), 'manage_options', 'tgdprcl-policies-and-conditions', array($this, 'policies_and_conditions')
            );
            add_submenu_page(
                TGDPRCL_DOMAIN, __('User Data', TGDPRCL_DOMAIN), __('User Data', TGDPRCL_DOMAIN), 'manage_options', 'tgdprcl-userdata', array($this, 'tgdprc_user_data')
            );
            add_submenu_page(
                TGDPRCL_DOMAIN, __('Plugin Consents', TGDPRCL_DOMAIN), __('Plugin Consents', TGDPRCL_DOMAIN), 'manage_options', 'tgdprcl-consents', array($this, 'tgdprc_consents')
            );
            add_submenu_page(
                TGDPRCL_DOMAIN, __('Services Settings', TGDPRCL_DOMAIN), __('Services Settings', TGDPRCL_DOMAIN), 'manage_options', 'tgdprcl-services-settings', array($this, 'tgdprc_services_settings_menu')
            );
            add_submenu_page(
                TGDPRCL_DOMAIN, __('Services', TGDPRCL_DOMAIN), __('Services', TGDPRCL_DOMAIN), 'manage_options', 'edit.php?post_type=totalgdprcompliance'
            );
        }

        /**
         * Function create attachment
         */
        function tgdprc_generate_json_attachment_file($name, $extension) {

            $file = wp_tempnam($name);
            $file_new = str_replace(".tmp", ".$extension", $file);
            rename($file, $file_new);

            return $file_new;
        }

        function create_json($all_comment_meta_array, $json_Data_title_1) {
            header("Content-Disposition:attachment;filename='" . $json_Data_title_1 . ".json'");
            header("Content-Type:application/json");
            $all_comments_meta_output = $all_comment_meta_array;
            return $all_comments_meta_output;
        }

        /**
         * This is a function for registering admin assets into the Plugin
         */
        function register_admin_scripts() {
            $tgdprc_admin_ajax_nonce = wp_create_nonce('tgdprcl-admin-ajax-nonce');
            $tgdprc_admin_ajax_object = array('ajax_url' => admin_url('admin-ajax.php'), 'ajax_nonce' => $tgdprc_admin_ajax_nonce);

            $tgdprc_page_name_array = array('total-gdpr-compliance-lite', 'tgdprcl-manage-cookie-settings', 'tgdprcl-cookie-custom-template', 'tgdprcl-cookie-settings', 'tgdprcl-advance-cookies', 'tgdprcl-policies-and-conditions', 'tgdprcl-consents', 'tgdprcl-userdata', 'tgdprcl-more-wp-resources', 'tgdprcl-services-settings', 'tgdprc-import-settings', 'tgdprc-protected-content-setting');
            if (isset($_GET['page']) && in_array($_GET['page'], $tgdprc_page_name_array) || ('totalgdprcompliance' == get_post_type() && (isset($_GET['action']) && $_GET['action'] == 'edit'))) {
                wp_enqueue_script('tgdprc-colorpicker-alpha', TGDPRCL_JS . 'wp-color-picker-alpha.js', array('wp-color-picker'), TGDPRCL_VERSION);
                wp_enqueue_script('tgdprc_admin_assets_scripts', TGDPRCL_JS . 'admin-script.js', array('jquery'), TGDPRCL_VERSION);
                wp_localize_script('tgdprc_admin_assets_scripts', 'tgdprcl_backend_js_params', $tgdprc_admin_ajax_object);
                wp_enqueue_style('tgdprc_admin_assets_styles', TGDPRCL_CSS . 'admin-style.css', array(), TGDPRCL_VERSION);
                wp_enqueue_script('tgdprc_nice_select_script', TGDPRCL_JS . 'jquery.nice-select.min.js', array('jquery'), TGDPRCL_VERSION);
                wp_enqueue_style('tgdprc_nice_select_style', TGDPRCL_CSS . 'nice-select.css', array(), TGDPRCL_VERSION);
                wp_enqueue_style('tgdprc-admin-fontawesome', TGDPRCL_CSS . 'font-awesome/font-awesome.min.css', TGDPRCL_VERSION);
                wp_enqueue_style('tgdprc_admin_genericon_style', TGDPRCL_CSS . 'genericons.css', TGDPRCL_VERSION);
                wp_enqueue_style('tgdprc_icon_picker_style', TGDPRCL_CSS . 'icon-picker.css', TGDPRCL_VERSION);
                wp_enqueue_script('tgdprc_icon_picker_script', TGDPRCL_JS . 'icon-picker.js', TGDPRCL_VERSION);
                wp_enqueue_script('tgdprc-pro-webfont', TGDPRCL_JS . 'webfont.js', TGDPRCL_VERSION);
                wp_enqueue_media();
                wp_enqueue_style('wp-color-picker');
            }
        }

        /**
         * This is a function for registering frontend assets into the Plugin
         */
        function register_frontend_scripts() {
            $tgdprc_frontend_ajax_nonce = wp_create_nonce('tgdprc_frontend_ajax_nonce');
            $tgdprc_frontend_ajax_object = array('ajax_url' => admin_url('admin-ajax.php'), 'ajax_nonce' => $tgdprc_frontend_ajax_nonce);
            wp_enqueue_script('tgdprc-frontend_assets_scripts', TGDPRCL_JS . 'frontend-script.js', array('jquery'), TGDPRCL_VERSION);
            wp_localize_script('tgdprc-frontend_assets_scripts', 'tgdprc_frontend_js', $tgdprc_frontend_ajax_object);
            wp_enqueue_style('tgdprc-frontend_assets_styles', TGDPRCL_CSS . 'frontend-style.css', array(), TGDPRCL_VERSION); //change styles to style in file name
            wp_enqueue_style('tgdprc_frontend_genericon_style', TGDPRCL_CSS . 'genericons.css', TGDPRCL_VERSION);
            wp_enqueue_style('dashicons');
            wp_enqueue_style('tgdprc-fontawesome', TGDPRCL_CSS . 'font-awesome/font-awesome.min.css', TGDPRCL_VERSION);
            wp_enqueue_style('tgdprc-rtl-styles', TGDPRCL_CSS . 'rtl_styles.css', TGDPRCL_VERSION);
            wp_enqueue_script('tgdprc-pro-webfont', TGDPRCL_JS . 'webfont.js', TGDPRCL_VERSION);
            wp_enqueue_style('tgdprc_font_families', '//fonts.googleapis.com/css?family=' . TGDPRC_WEB_FONTS);
            wp_enqueue_script('tgdprc_json_validation', TGDPRCL_JS . 'json2validation.js', TGDPRCL_VERSION);

            /**
             *  mCustomScroller
             */
            wp_enqueue_style('tgdprc_mCustomScroller_styles', TGDPRCL_CSS . 'jquery.mCustomScrollbar.css', array(), TGDPRCL_VERSION);
            wp_enqueue_script('tgdprc_mCustomScroller_scripts', TGDPRCL_JS . 'jquery.mCustomScrollbar.js', array(), TGDPRCL_VERSION);
        }

        /**
         * This is a function for displaying cookie infos in list 
         */
        function display_menu_page() {
            /**
             * Manage Settings
             */
            global $wpdb;
            global $action; //action to be
            global $result;
            global $custom_templates;
            $label = '';

            $table = $wpdb->prefix . "tgdprc_settings";

            /**
             * For Add and Edit on Specific cookie bar
             */
            if (isset($_GET['page']) && $_GET['page'] == 'tgdprcl-manage-cookie-settings' && isset($_GET['action'])) {
                if (isset($_GET['action'])) {
                    if ($_GET['action'] == 'edit') {
                        $action = ucwords(esc_attr__($_GET['action'], TGDPRCL_DOMAIN)) . ' ';
                        if (isset($_GET['replaced']) && intval($_GET['replaced'])) {
                            $id = esc_attr($_GET['replaced']);
                        } else if (isset($_GET['id']) && intval($_GET['id'])) {
                            $id = intval($_GET['id']);
                        } else {
                            $id = '';
                        }
                        $result = $wpdb->get_row("SELECT * FROM $table WHERE id=$id");
                        include_once TGDPRCL_PATH . 'inc/backend/cookie/manage_settings.php';
                    } elseif ($_GET['action'] == 'add') {
                        $action = ucwords(esc_attr__($_GET['action'], TGDPRCL_DOMAIN)) . esc_attr__(' New ', TGDPRCL_DOMAIN);
                        $result = false;
                        include_once TGDPRCL_PATH . 'inc/backend/cookie/manage_settings.php';
                    }
                } else {
                    die('Please Die');
                }
            } else if (isset($_GET['page']) && $_GET['page'] == 'tgdprcl-manage-cookie-settings' && !isset($_GET['action'])) {
                $title = esc_attr__('Listing', TGDPRCL_DOMAIN);
                $result = false;
                include_once TGDPRCL_PATH . 'inc/backend/cookie/tgdprc-cookie-info.php';
            } else {
                $result = false;
                $action = esc_attr__('Add New ', TGDPRCL_DOMAIN);
                $label = $action;
            }
        }

        /**
         * This is a function for choosing a Cookie info to activate into the Plugin
         */
        function choose_from_cookies() {
            /**
             * To display the selected cookie first
             */
            $selected_cookie = get_option('tgdprc_selected_cookie_option');

            $tgdprc_tree_struct = isset($selected_cookie['tgdprc_tree_struct']) ? ($selected_cookie['tgdprc_tree_struct']) : null;

            global $wpdb;

            $table = $wpdb->prefix . "tgdprc_settings";

            $cookie_bars = $wpdb->get_results("SELECT * FROM $table");

            $active = false;

            if (count($cookie_bars) > 0) {
                $active = true;
            }

            $title = esc_attr__('Cookie Setting', TGDPRCL_DOMAIN);

            include_once TGDPRCL_PATH . 'inc/backend/cookie/tgdprc-cookie-setting.php';
        }

        /**
         * Advanced Cookie Setting Menu
         */
        function tgdprc_advanced_cookies_menu() {
            $title = esc_attr__('Advanced Cookie Settings', TGDPRCL_DOMAIN);
            include_once TGDPRCL_PATH . 'inc/backend/advanced-cookie/tgdprc-advanced-cookie-setting.php';
        }

        /**
         * This is a function for choosing a Cookie info to activate into the Plugin
         */
        function policies_and_conditions() {
            $title = esc_attr__('Policies & Conditions', TGDPRCL_DOMAIN);
            include_once TGDPRCL_PATH . 'inc/backend/policies-and-conditions/policies_and_conditions.php';
        }

        /**
         * This is a function for choosing a Cookie info to activate into the Plugin
         */
        function tgdprc_consents() {
            $title = esc_attr__('Consents', TGDPRCL_DOMAIN);
            include_once TGDPRCL_PATH . 'inc/backend/consents/consents-settings.php';
        }

        /**
         * This is a function for service setting menu 
         */
        function tgdprc_services_settings_menu() {
            $title = esc_attr__('Service Setting', TGDPRCL_DOMAIN);
            include_once TGDPRCL_PATH . 'inc/backend/services/service-settings.php';
        }

        /**
         * This is a function for choosing a Cookie info to activate into the Plugin
         */
        function tgdprc_user_data() {
            $title = esc_attr__('User Data', TGDPRCL_DOMAIN);
            include_once TGDPRCL_PATH . 'inc/backend/user-data/tgdprc-user-data-setting.php';
        }

        /**
         * This is a function for saving form values for cookie info
         */
        function tgdprc_save_manage_form_settings_pro() {
            if (current_user_can('manage_options')) {
                if (isset($_POST['tgdprc_nonce_field']) && wp_verify_nonce($_POST['tgdprc_nonce_field'], 'tgdprc_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/cookie/settings/save_manage_form_settings.php';
                } else {
                    die('Problem with nonce');
                }
            } else {
                die("You Don't have enough rights");
            }
        }

        /**
         * This is a function for saving form values for cookie info
         */
        function tgdprc_save_manage_advanced_cookie_settings() {
            if (current_user_can('manage_options')) {
                if (isset($_POST['tgdprc_advanced_cookie_noncefield']) && wp_verify_nonce($_POST['tgdprc_advanced_cookie_noncefield'], 'tgdprc_advanced_cookie_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/advanced-cookie/save-advanced-cookie-settings.php';
                } else {
                    die('Problem with nonce');
                }
            } else {
                die("You Don't have enough rights");
            }
        }

        /**
         * This is a function for saving choosen cookie as active or inactive for cookie info
         */
        function tgdprc_save_cookie_settings() {
            if (current_user_can('manage_options')) {
                if (isset($_POST['tgdprc_nonce_field']) && wp_verify_nonce($_POST['tgdprc_nonce_field'], 'tgdprc_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/cookie/settings/save_choice_settings.php';
                }
            }
        }

        /**
         * This is a function for displaying a submenu about into the Plugin
         */
        function display_about_page() {
            $title = esc_attr__('About', TGDPRCL_DOMAIN);
            include_once TGDPRCL_PATH . 'inc/backend/about.php';
        }

        /**
         * This is a function executes on plugin activation
         */
        function tgdprc_plugin_default_template_array() {
            include TGDPRCL_PATH . 'inc/backend/required-constants/default-fonts-array.php';
            return $tgdprc_font_family;
        }

        function tgdprc_plugin_default_font_array() {
            include TGDPRCL_PATH . 'inc/backend/required-constants/default-template-value-array.php';
            return $options;
        }

        /**
         * This is a function executes on plugin activation
         */
        function tgdprc_plugin_activation() {
            include_once TGDPRCL_PATH . 'inc/backend/includes/activate.php';
        }

        /**
         * This is a function executes on plugin activation
         */
        function register_post_type() {
            include_once TGDPRCL_PATH . 'inc/backend/includes/register-post.php';
            register_post_type('totalgdprcompliance', $args);
        }

        /**
         * This function loads default values Template/Typography from the database
         */
        function tgdprcl_load_default_general_options() {
            $options = array(
                'display_type' => array('bar', 'popup', 'floating'),
                'more_info_action' => array('page redirect'),
                'more_info_position' => array('left', 'right'),
                'bar_position' => array('bottom'),
                'floating_position' => array('bottom_left', 'bottom_right'),
                'popup_position' => array('center'),
                'bar_template_type' => array(
                    'Template-1' => array(
                        'name' => 'Template-1',
                        'alias' => 'Cerulean',
                        'img' => TGDPRCL_IMAGE . 'template_images/bar/template1.PNG'
                    ),
                    'Template-2' => array(
                        'name' => 'Template-2',
                        'alias' => 'Comet',
                        'img' => TGDPRCL_IMAGE . 'template_images/bar/template2.PNG'
                    ),
                    'Template-3' => array(
                        'name' => 'Template-3',
                        'alias' => 'Astronaut Blue',
                        'img' => TGDPRCL_IMAGE . 'template_images/bar/template3.PNG'
                    ),
                    'Template-4' => array(
                        'name' => 'Template-4',
                        'alias' => 'Mako',
                        'img' => TGDPRCL_IMAGE . 'template_images/bar/template4.PNG'
                    ),
                    'Template-5' => array(
                        'name' => 'Template-5',
                        'alias' => 'Green with Image',
                        'img' => TGDPRCL_IMAGE . 'template_images/bar/template5.PNG'
                    ),
                ),
                'popup_template_type' => array(
                    'Template-11' => array(
                        'name' => 'Template-1',
                        'alias' => 'Paradiso and Fountain Blue',
                        'img' => TGDPRCL_IMAGE . 'template_images/popup/template1.PNG'
                    )
                ),
                'floating_template_type' => array(
                    'Template-16' => array(
                        'name' => 'Template-1',
                        'alias' => 'Governor Bay',
                        'img' => TGDPRCL_IMAGE . 'template_images/floating/template1.PNG'
                    )
                ),
                'cookie_expiry' => array('show Always', 'per Session', 'show Once', 'show After'),
                'link_target' => array('_blank', '_self'),
                'displayed_pages' => array('show on all pages', 'show on Home page', 'specific page'),
                'show_cookie_on' => array('default', 'page load delay', 'page scroll'),
                'scroll_options' => array('half way from start', 'end of document', 'by percentage'),
                'select_template_type' => array('default', 'custom'),
                'border_style' => array('dashed', 'dotted', 'double', 'solid', 'groove', 'ridge'),
                'background_image_type' => array(
                    'user' => 'User Defined',
                    'system' => 'Built In'
                ),
                'background_image' => array(
                    'Image 1' => array(
                        'img' => TGDPRCL_IMAGE . 'cookies-temp-bg-3.jpg'
                    ),
                    'Image 2' => array(
                        'img' => TGDPRCL_IMAGE . 'cookies-temp-bg-4.jpg'
                    ),
                    'Image 3' => array(
                        'img' => TGDPRCL_IMAGE . 'cookies-temp-bg-5.jpg'
                    ),
                ),
                'icon_type' => array('default', 'image')
            );
            update_option('tgdprc_general_option', $options);


            /** Updating Google font into Database */
            $tgdprc_font_family = array('Montserrat', 'Rubik', 'Open Sans', 'ABeeZee', 'Abel', 'Abril Fatface', 'Aclonica', 'Acme', 'Actor', 'Adamina', 'Advent Pro', 'Aguafina Script', 'Akronim', 'Aladin', 'Aldrich', 'Alef', 'Alegreya', 'Alegreya SC', 'Alegreya Sans', 'Alegreya Sans SC', 'Alex Brush', 'Alfa Slab One', 'Alice', 'Alike', 'Alike Angular', 'Allan', 'Allerta', 'Allerta Stencil', 'Allura', 'Almendra', 'Almendra Display', 'Almendra SC', 'Amarante', 'Amaranth', 'Amatic SC', 'Amethysta', 'Amiri', 'Amita', 'Anaheim', 'Andada', 'Andika', 'Angkor', 'Annie Use Your Telescope', 'Anonymous Pro', 'Antic', 'Antic Didone', 'Antic Slab', 'Anton', 'Arapey', 'Arbutus', 'Arbutus Slab', 'Architects Daughter', 'Archivo Black', 'Archivo Narrow', 'Arimo', 'Arizonia', 'Armata', 'Artifika', 'Arvo', 'Arya', 'Asap', 'Asar', 'Asset', 'Astloch', 'Asul', 'Atomic Age', 'Aubrey', 'Audiowide', 'Autour One', 'Average', 'Average Sans', 'Averia Gruesa Libre', 'Averia Libre', 'Averia Sans Libre', 'Averia Serif Libre', 'Bad Script', 'Balthazar', 'Bangers', 'Basic', 'Battambang', 'Baumans', 'Bayon', 'Belgrano', 'Belleza', 'BenchNine', 'Bentham', 'Berkshire Swash', 'Bevan', 'Bigelow Rules', 'Bigshot One', 'Bilbo', 'Bilbo Swash Caps', 'Biryani', 'Bitter', 'Black Ops One', 'Bokor', 'Bonbon', 'Boogaloo', 'Bowlby One', 'Bowlby One SC', 'Brawler', 'Bree Serif', 'Bubblegum Sans', 'Bubbler One', 'Buda', 'Buenard', 'Butcherman', 'Butterfly Kids', 'Cabin', 'Cabin Condensed', 'Cabin Sketch', 'Caesar Dressing', 'Cagliostro', 'Calligraffitti', 'Cambay', 'Cambo', 'Candal', 'Cantarell', 'Cantata One', 'Cantora One', 'Capriola', 'Cardo', 'Carme', 'Carrois Gothic', 'Carrois Gothic SC', 'Carter One', 'Caudex', 'Cedarville Cursive', 'Ceviche One', 'Changa One', 'Chango', 'Chau Philomene One', 'Chela One', 'Chelsea Market', 'Chenla', 'Cherry Cream Soda', 'Cherry Swash', 'Chewy', 'Chicle', 'Chivo', 'Cinzel', 'Cinzel Decorative', 'Clicker Script', 'Coda', 'Coda Caption', 'Codystar', 'Combo', 'Comfortaa', 'Coming Soon', 'Concert One', 'Condiment', 'Content', 'Contrail One', 'Convergence', 'Cookie', 'Copse', 'Corben', 'Courgette', 'Cousine', 'Coustard', 'Covered By Your Grace', 'Crafty Girls', 'Creepster', 'Crete Round', 'Crimson Text', 'Croissant One', 'Crushed', 'Cuprum', 'Cutive', 'Cutive Mono', 'Damion', 'Dancing Script', 'Dangrek', 'Dawning of a New Day', 'Days One', 'Dekko', 'Delius', 'Delius Swash Caps', 'Delius Unicase', 'Della Respira', 'Denk One', 'Devonshire', 'Dhurjati', 'Didact Gothic', 'Diplomata', 'Diplomata SC', 'Domine', 'Donegal One', 'Doppio One', 'Dorsa', 'Dosis', 'Dr Sugiyama', 'Droid Sans', 'Droid Sans Mono', 'Droid Serif', 'Duru Sans', 'Dynalight', 'EB Garamond', 'Eagle Lake', 'Eater', 'Economica', 'Eczar', 'Ek Mukta', 'Electrolize', 'Elsie', 'Elsie Swash Caps', 'Emblema One', 'Emilys Candy', 'Engagement', 'Englebert', 'Enriqueta', 'Erica One', 'Esteban', 'Euphoria Script', 'Ewert', 'Exo', 'Exo 2', 'Expletus Sans', 'Fanwood Text', 'Fascinate', 'Fascinate Inline', 'Faster One', 'Fasthand', 'Fauna One', 'Federant', 'Federo', 'Felipa', 'Fenix', 'Finger Paint', 'Fira Mono', 'Fira Sans', 'Fjalla One', 'Fjord One', 'Flamenco', 'Flavors', 'Fondamento', 'Fontdiner Swanky', 'Forum', 'Francois One', 'Freckle Face', 'Fredericka the Great', 'Fredoka One', 'Freehand', 'Fresca', 'Frijole', 'Fruktur', 'Fugaz One', 'GFS Didot', 'GFS Neohellenic', 'Gabriela', 'Gafata', 'Galdeano', 'Galindo', 'Gentium Basic', 'Gentium Book Basic', 'Geo', 'Geostar', 'Geostar Fill', 'Germania One', 'Gidugu', 'Gilda Display', 'Give You Glory', 'Glass Antiqua', 'Glegoo', 'Gloria Hallelujah', 'Goblin One', 'Gochi Hand', 'Gorditas', 'Goudy Bookletter 1911', 'Graduate', 'Grand Hotel', 'Gravitas One', 'Great Vibes', 'Griffy', 'Gruppo', 'Gudea', 'Gurajada', 'Habibi', 'Halant', 'Hammersmith One', 'Hanalei', 'Hanalei Fill', 'Handlee', 'Hanuman', 'Happy Monkey', 'Headland One', 'Henny Penny', 'Herr Von Muellerhoff', 'Hind', 'Holtwood One SC', 'Homemade Apple', 'Homenaje', 'IM Fell DW Pica', 'IM Fell DW Pica SC', 'IM Fell Double Pica', 'IM Fell Double Pica SC', 'IM Fell English', 'IM Fell English SC', 'IM Fell French Canon', 'IM Fell French Canon SC', 'IM Fell Great Primer', 'IM Fell Great Primer SC', 'Iceberg', 'Iceland', 'Imprima', 'Inconsolata', 'Inder', 'Indie Flower', 'Inika', 'Inknut Antiqua', 'Irish Grover', 'Istok Web', 'Italiana', 'Italianno', 'Jacques Francois', 'Jacques Francois Shadow', 'Jaldi', 'Jim Nightshade', 'Jockey One', 'Jolly Lodger', 'Josefin Sans', 'Josefin Slab', 'Joti One', 'Judson', 'Julee', 'Julius Sans One', 'Junge', 'Jura', 'Just Another Hand', 'Just Me Again Down Here', 'Kadwa', 'Kalam', 'Kameron', 'Kantumruy', 'Karla', 'Karma', 'Kaushan Script', 'Kavoon', 'Kdam Thmor', 'Keania One', 'Kelly Slab', 'Kenia', 'Khand', 'Khmer', 'Khula', 'Kite One', 'Knewave', 'Kotta One', 'Koulen', 'Kranky', 'Kreon', 'Kristi', 'Krona One', 'Kurale', 'La Belle Aurore', 'Laila', 'Lakki Reddy', 'Lancelot', 'Lateef', 'Lato', 'League Script', 'Leckerli One', 'Ledger', 'Lekton', 'Lemon', 'Libre Baskerville', 'Life Savers', 'Lilita One', 'Lily Script One', 'Limelight', 'Linden Hill', 'Lobster', 'Lobster Two', 'Londrina Outline', 'Londrina Shadow', 'Londrina Sketch', 'Londrina Solid', 'Lora', 'Love Ya Like A Sister', 'Loved by the King', 'Lovers Quarrel', 'Luckiest Guy', 'Lusitana', 'Lustria', 'Macondo', 'Macondo Swash Caps', 'Magra', 'Maiden Orange', 'Mako', 'Mallanna', 'Mandali', 'Marcellus', 'Marcellus SC', 'Marck Script', 'Margarine', 'Marko One', 'Marmelad', 'Martel', 'Martel Sans', 'Marvel', 'Mate', 'Mate SC', 'Maven Pro', 'McLaren', 'Meddon', 'MedievalSharp', 'Medula One', 'Megrim', 'Meie Script', 'Merienda', 'Merienda One', 'Merriweather', 'Merriweather Sans', 'Metal', 'Metal Mania', 'Metamorphous', 'Metrophobic', 'Michroma', 'Milonga', 'Miltonian', 'Miltonian Tattoo', 'Miniver', 'Miss Fajardose', 'Modak', 'Modern Antiqua', 'Molengo', 'Molle', 'Monda', 'Monofett', 'Monoton', 'Monsieur La Doulaise', 'Montaga', 'Montez', 'Montserrat Alternates', 'Montserrat Subrayada', 'Moul', 'Moulpali', 'Mountains of Christmas', 'Mouse Memoirs', 'Mr Bedfort', 'Mr Dafoe', 'Mr De Haviland', 'Mrs Saint Delafield', 'Mrs Sheppards', 'Muli', 'Mystery Quest', 'NTR', 'Neucha', 'Neuton', 'New Rocker', 'News Cycle', 'Niconne', 'Nixie One', 'Nobile', 'Nokora', 'Norican', 'Nosifer', 'Nothing You Could Do', 'Noticia Text', 'Noto Sans', 'Noto Serif', 'Nova Cut', 'Nova Flat', 'Nova Mono', 'Nova Oval', 'Nova Round', 'Nova Script', 'Nova Slim', 'Nova Square', 'Numans', 'Nunito', 'Odor Mean Chey', 'Offside', 'Old Standard TT', 'Oldenburg', 'Oleo Script', 'Oleo Script Swash Caps', 'Open Sans Condensed', 'Oranienbaum', 'Orbitron', 'Oregano', 'Orienta', 'Original Surfer', 'Oswald', 'Over the Rainbow', 'Overlock', 'Overlock SC', 'Ovo', 'Oxygen', 'Oxygen Mono', 'PT Mono', 'PT Sans', 'PT Sans Caption', 'PT Sans Narrow', 'PT Serif', 'PT Serif Caption', 'Pacifico', 'Palanquin', 'Palanquin Dark', 'Paprika', 'Parisienne', 'Passero One', 'Passion One', 'Pathway Gothic One', 'Patrick Hand', 'Patrick Hand SC', 'Patua One', 'Paytone One', 'Peddana', 'Peralta', 'Permanent Marker', 'Petit Formal Script', 'Petrona', 'Philosopher', 'Piedra', 'Pinyon Script', 'Pirata One', 'Plaster', 'Play', 'Playball', 'Playfair Display', 'Playfair Display SC', 'Podkova', 'Poiret One', 'Poller One', 'Poly', 'Pompiere', 'Pontano Sans', 'Poppins', 'Port Lligat Sans', 'Port Lligat Slab', 'Pragati Narrow', 'Prata', 'Preahvihear', 'Press Start 2P', 'Princess Sofia', 'Prociono', 'Prosto One', 'Puritan', 'Purple Purse', 'Quando', 'Quantico', 'Quattrocento', 'Quattrocento Sans', 'Questrial', 'Quicksand', 'Quintessential', 'Qwigley', 'Racing Sans One', 'Radley', 'Rajdhani', 'Raleway', 'Raleway Dots', 'Ramabhadra', 'Ramaraja', 'Rambla', 'Rammetto One', 'Ranchers', 'Rancho', 'Ranga', 'Rationale', 'Ravi Prakash', 'Redressed', 'Reenie Beanie', 'Revalia', 'Rhodium Libre', 'Ribeye', 'Ribeye Marrow', 'Righteous', 'Risque', 'Roboto', 'Roboto Condensed', 'Roboto Mono', 'Roboto Slab', 'Rochester', 'Rock Salt', 'Rokkitt', 'Romanesco', 'Ropa Sans', 'Rosario', 'Rosarivo', 'Rouge Script', 'Rozha One', 'Rubik Mono One', 'Rubik One', 'Ruda', 'Rufina', 'Ruge Boogie', 'Ruluko', 'Rum Raisin', 'Ruslan Display', 'Russo One', 'Ruthie', 'Rye', 'Sacramento', 'Sahitya', 'Sail', 'Salsa', 'Sanchez', 'Sancreek', 'Sansita One', 'Sarala', 'Sarina', 'Sarpanch', 'Satisfy', 'Scada', 'Scheherazade', 'Schoolbell', 'Seaweed Script', 'Sevillana', 'Seymour One', 'Shadows Into Light', 'Shadows Into Light Two', 'Shanti', 'Share', 'Share Tech', 'Share Tech Mono', 'Shojumaru', 'Short Stack', 'Siemreap', 'Sigmar One', 'Signika', 'Signika Negative', 'Simonetta', 'Sintony', 'Sirin Stencil', 'Six Caps', 'Skranji', 'Slabo 13px', 'Slabo 27px', 'Slackey', 'Smokum', 'Smythe', 'Sniglet', 'Snippet', 'Snowburst One', 'Sofadi One', 'Sofia', 'Sonsie One', 'Sorts Mill Goudy', 'Source Code Pro', 'Source Sans Pro', 'Source Serif Pro', 'Special Elite', 'Spicy Rice', 'Spinnaker', 'Spirax', 'Squada One', 'Sree Krushnadevaraya', 'Stalemate', 'Stalinist One', 'Stardos Stencil', 'Stint Ultra Condensed', 'Stint Ultra Expanded', 'Stoke', 'Strait', 'Sue Ellen Francisco', 'Sumana', 'Sunshiney', 'Supermercado One', 'Sura', 'Suranna', 'Suravaram', 'Suwannaphum', 'Swanky and Moo Moo', 'Syncopate', 'Tangerine', 'Taprom', 'Tauri', 'Teko', 'Telex', 'Tenali Ramakrishna', 'Tenor Sans', 'Text Me One', 'The Girl Next Door', 'Tienne', 'Tillana', 'Timmana', 'Tinos', 'Titan One', 'Titillium Web', 'Trade Winds', 'Trocchi', 'Trochut', 'Trykker', 'Tulpen One', 'Ubuntu', 'Ubuntu Condensed', 'Ubuntu Mono', 'Ultra', 'Uncial Antiqua', 'Underdog', 'Unica One', 'UnifrakturCook', 'UnifrakturMaguntia', 'Unkempt', 'Unlock', 'Unna', 'VT323', 'Vampiro One', 'Varela', 'Varela Round', 'Vast Shadow', 'Vesper Libre', 'Vibur', 'Vidaloka', 'Viga', 'Voces', 'Volkhov', 'Vollkorn', 'Voltaire', 'Waiting for the Sunrise', 'Wallpoet', 'Walter Turncoat', 'Warnes', 'Wellfleet', 'Wendy One', 'Wire One', 'Work Sans', 'Yanone Kaffeesatz', 'Yantramanav', 'Yellowtail', 'Yeseva One', 'Yesteryear', 'Zeyada');
            update_option('tgdprc_typo_fonts', $tgdprc_font_family);
        }

        /**
         * This is a function for defining constant values
         * throughout the plugin
         */
        function tgdprcl_define_some_constants() {
            defined('TGDPRCL_PATH') or define('TGDPRCL_PATH', plugin_dir_path(__FILE__));
            defined('TGDPRCL_DIR_URL') or define('TGDPRCL_DIR_URL', plugin_dir_url(__FILE__));
            defined('TGDPRCL_CSS') or define('TGDPRCL_CSS', TGDPRCL_DIR_URL . 'assets/css/');
            defined('TGDPRCL_JS') or define('TGDPRCL_JS', TGDPRCL_DIR_URL . 'assets/js/');
            defined('TGDPRCL_VERSION') or define('TGDPRCL_VERSION', '1.0.5'); //plugin version
            defined('TGDPRCL_IMAGE') or define('TGDPRCL_IMAGE', TGDPRCL_DIR_URL . 'assets/images/');
            defined('TGDPRCL_DOMAIN') or define('TGDPRCL_DOMAIN', 'total-gdpr-compliance-lite');
            global $tgdprcl_template_key_value_pair;
            $tgdprcl_template_key_value_pair = array(
                'Template-1' => 'Cerulean',
                'Template-2' => 'Comet',
                'Template-3' => 'Astronaut Blue',
                'Template-4' => 'Mako',
                'Template-5' => 'Green with Image',
                'Template-6' => 'Wine Berry',
                'Template-7' => 'Seashell',
                'Template-8' => 'Wisteria',
                'Template-9' => 'White',
                'Template-10' => 'Mountain Meadow',
                'Template-21' => 'Mako and Sunglo',
                'Template-22' => 'East Bay',
                'Template-23' => 'Blue Chill',
                'Template-24' => 'Punch',
                'Template-25' => 'Orange Peel',
                'Template-26' => 'Bright Red',
                'Template-27' => 'School Bus Yellow',
                'Template-28' => 'Cod Gray',
                'Template-29' => 'Governor Bay',
                'Template-30' => 'Caribbean Green',
                'Template-11' => 'Paradiso and Fountain Blue',
                'Template-12' => 'Havelock Blue',
                'Template-13' => 'Shiraz',
                'Template-14' => 'Chicago',
                'Template-15' => 'White and Mountain Meadow',
                'Template-16' => 'Governor Bay',
                'Template-17' => 'Mako',
                'Template-18' => 'East Bay',
                'Template-19' => 'Manatee',
                'Template-20' => 'Paradiso and Fountain Blue'
            );
        }

        /**
         * This is a function for loading the text domains for plugins
         * Translations
         */
        function load_tgdprc_textdomain() {
            load_plugin_textdomain(TGDPRCL_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages/');
        }

        /**
         * This is a function for displaying cookie info in the frontend
         * Translations
         */
        function frontend_display_cookie_bar() {
            include_once TGDPRCL_PATH . 'inc/frontend/frontend_display_cookie_bar.php';
        }

        /**
         * This is a function checks whether the window is desktop or mobile
         * Translations
         *
         * @since 1.0.0
         *
         */
        function tgdprcl_mobile_view() {
            $useragent = $_SERVER['HTTP_USER_AGENT'];

            if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
                return false;
            }
            return true;
        }

        /**
         * This is a function for displaying custom templates in a list
         * Translations
         */
        function list_custom_template() {

            if (isset($_GET['page']) && $_GET['page'] == 'tgdprcl-cookie-custom-template') {
                if (isset($_GET['action'])) {
                    if ($_GET['action'] == 'add') {
                        $options = get_option('tgdprc_general_option');
                        $base_templates = $options['display_type'];
                        $bar_templates = $options['bar_template_type'];
                        $title = esc_attr__("Add New Template", TGDPRCL_DOMAIN);
                        include_once TGDPRCL_PATH . 'inc/backend/cookie/custom_templates/add_custom_template.php';
                    } elseif ($_GET['action'] == 'edit') {
                        global $wpdb;
                        $table_name = $wpdb->prefix . 'tgdprc_custom_template';
                        $id = intval($_GET['id']);
                        $selected_template = $wpdb->get_row("SELECT * FROM $table_name WHERE id=$id");
                        $custom_template = maybe_unserialize($selected_template->template_details);
                        $options = get_option('tgdprc_general_option');
                        $base_templates = $options['display_type'];
                        $bar_templates = $options['bar_template_type'];
                        $title = esc_attr__("Edit $selected_template->template_name", TGDPRCL_DOMAIN);
                        include_once TGDPRCL_PATH . 'inc/backend/cookie/custom_templates/edit_custom_template.php';
                    }
                } else {
                    $title = esc_attr__('Custom Template', TGDPRCL_DOMAIN);
                    include_once TGDPRCL_PATH . 'inc/backend/cookie/custom_templates/listing_custom_template.php';
                }
            }
        }

        /**
         * This is a function for saving a custom template
         * Translations
         */
        function save_custom_template() {
            if (current_user_can('manage_options')) {
                if ($_POST['tgdprc_template_nonce'] && wp_verify_nonce($_POST['tgdprc_template_nonce'], 'tgdprc_template_nonce_field')) {
                    include_once TGDPRCL_PATH . 'inc/backend/cookie/settings/custom_templates/save_custom_template.php';
                }
            }
        }

        /**
         * This is a function for saving a consent settings
         * Translations
         */
        function save_consent_settings() {
            if (current_user_can('manage_options')) {
                if ($_POST['tgdprc_consent_setting_nonce'] && wp_verify_nonce($_POST['tgdprc_consent_setting_nonce'], 'tgdprc_consent_setting_nonce_field')) {
                    include_once TGDPRCL_PATH . 'inc/backend/consents/save-consent-settings.php';
                }
            }
        }

        /**
         * This is a function for copying a choosen cookie bar
         */
        function copy_choosen_setting() {
            if (current_user_can('manage_options')) {
                if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'copy_setting_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/cookie/settings/copy_choosen_setting.php';
                }
            }
        }

        /**
         * This is a function for copying a choosen custom template
         */
        function copy_template_setting() {
            if (current_user_can('manage_options')) {
                if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'copy_template_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/cookie/settings/custom_templates/copy_template_setting.php';
                }
            }
        }

        /**
         * This is a function for deleting a choosen cookie bar
         *
         * @since 1.0.0
         */
        function delete_choosen_setting() {
            if (current_user_can('manage_options')) {
                if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'delete_setting_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/cookie/settings/delete_choosen_setting.php';
                }
            }
        }

        /**
         * This is a function for deleting a chosen user access request email
         *
         * @since 1.0.0
         */
        function delete_chosen_user_access_email() {
            if (current_user_can('manage_options')) {
                if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'tgdprc_user_data_nonce')) {
                    $tgdprc_data_access_request_data = get_option('tgdprc-data-access-request');
                    $get_email_address = sanitize_email($_GET['email_address']);
                    foreach ($tgdprc_data_access_request_data as $key => $value) {
                        if ($value == $get_email_address) {
                            unset($tgdprc_data_access_request_data[$key]);
                        }
                    }
                    update_option('tgdprc-data-access-request', $tgdprc_data_access_request_data);
                    wp_redirect(admin_url('admin.php?page=tgdprcl-userdata&message_type=user-access&message=2'));
                }
            }
        }

        /**
         * This is a function for deleting a chosen user forget request email
         *
         * @since 1.0.0
         */
        function delete_chosen_user_forget_email() {
            if (current_user_can('manage_options')) {
                if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'tgdprc_user_data_nonce')) {
                    $tgdprc_data_access_request_data = get_option('tgdprc-data-forget-request');
                    $get_email_address = sanitize_email($_GET['email_address']);
                    foreach ($tgdprc_data_access_request_data as $key => $value) {
                        if ($value == $get_email_address) {
                            unset($tgdprc_data_access_request_data[$key]);
                        }
                    }
                    update_option('tgdprc-data-forget-request', $tgdprc_data_access_request_data);
                    wp_redirect(admin_url('admin.php?page=tgdprcl-userdata&message_type=forgetdata&message=2'));
                }
            }
        }

        /**
         * This is a function for deleting a chosen user Rectification request email
         *
         * @since 1.0.0
         */
        function delete_chosen_user_rectify_req_email() {
            if (current_user_can('manage_options')) {
                if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'tgdprc_user_data_nonce')) {
                    $tgdprc_data_rectification_request_data = get_option('tgdprc-data-rectification-request');
                    $get_email_address = sanitize_email($_GET['email_address']);
                    foreach ($tgdprc_data_rectification_request_data as $key => $value) {
                        if ($value == $get_email_address) {
                            unset($tgdprc_data_rectification_request_data[$key]);
                        }
                    }
                    update_option('tgdprc-data-rectification-request', $tgdprc_data_access_request_data);
//var_dump($tgdprc_data_rectification_request_data);
                    $tgdprc_data_rectification_form_json_data = get_option('tgdprc-rectify-form-json-data');
                    foreach ($tgdprc_data_rectification_form_json_data as $key => $value) {
                        if ($value['email_addresss'] == $get_email_address) {
                            unset($tgdprc_data_rectification_form_json_data[$key]);
                        }
                    }
                    update_option('tgdprc-data-rectification-request', $tgdprc_data_rectification_form_json_data);
                    wp_redirect(admin_url('admin.php?page=tgdprcl-userdata&message_type=rectifydata&message=2'));
                }
            }
        }

        /**
         * Send mail to User with the user data
         */
        function send_mail_user_access_Request() {
            if (current_user_can('manage_options')) {
                if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'tgdprc_user_data_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/cookie/settings/user-data/user-data-request/user-access-mail-action.php';
                }
            }
        }

        /**
         * Send Mail to User with confirmation for data being forgotten
         */
        function tgdprc_send_forgeted_email_to_user() {
            if (current_user_can('manage_options')) {
                if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'tgdprc_user_data_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/user-data/user-data-forget/send-user-forgetted-mail.php';
                }
            }
        }

        /**
         * Send Mail to User with confirmation for data being Rectified
         */
        function tgdprc_send_rectified_email_to_user() {
            if (current_user_can('manage_options')) {
                if (isset($_POST['tgdprc_nonce_field']) && isset($_POST['tgdprc_send_rectified_email_to_user_settings']) && wp_verify_nonce($_POST['tgdprc_nonce_field'], 'tgdprc_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/user-data/user-data-rectification/send-user-rectified-mail.php';
                }
            }
        }

        /**
         * Send mail to User with the user data
         */
        function tgdprc_send_breach_email_to_user() {
            if (current_user_can('manage_options')) {
                if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'tgdprc_user_data_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/user-data/user-data-breach/user-breach-mail-action.php';
                }
            }
        }

        /**
         * Delete Template Settings
         */
        function delete_template_setting() {
            if (current_user_can('manage_options')) {
                if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'delete_template_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/cookie/settings/custom_templates/delete_template_setting.php';
                }
            }
        }

        /**
         * Add metabox to choose from specifc page post
         * @return type
         */
        function tgdprc_add_meta_box_to_choose_cookie_bar() {
            $args = array(
                'public' => true,
            );
            $output = 'names'; // names or objects, note names is the default
            $operator = 'and'; // 'and' or 'or'
            $post_types = get_post_types($args, $output, $operator);
            foreach ($post_types as $post_type) {
                if ($post_type == 'totalgdprcompliance'):
                    return null;
                else:
                    add_meta_box('tgdprc-meta-box-cookie-bar', esc_attr__('TGDPRC Cookie Pagewise Configuration', TGDPRCL_DOMAIN), array($this, 'display_cookie_bar_meta_box'), $post_type);
                endif;
            }
        }

        /**
         * Display Cookie Bar Meta box
         * @global type $wpdb
         */
        function display_cookie_bar_meta_box() {
            global $wpdb;

            $table = $wpdb->prefix . "tgdprc_settings";

            $cookie_bars = $wpdb->get_results("SELECT * FROM $table");

            $data_active = false;

            if (count($cookie_bars) > 0) {
                $data_active = true;
            }

            $default_id = 0;

            $page_active = false;

            $specific_not = true;

            if (get_option('tgdprc_selected_cookie_option')) {
                $selected_cookie = get_option('tgdprc_selected_cookie_option');
                if ($selected_cookie['displayed_pages'] == 'show on Home page') {
                    $page_active = 'Home';
                } elseif ($selected_cookie['displayed_pages'] == 'show on all pages') {
                    $page_active = 'All';
                } elseif ($selected_cookie['displayed_pages'] == 'specific page') {
                    $page_active = 'Specific';
                    if (!empty($selected_cookie['specific_page'])) {
                        $specific_id = ($selected_cookie['specific_page'] != '-1') ? explode(',', $selected_cookie['specific_page']) : array();
                        if (in_array(get_the_ID(), $specific_id)) {
                            $specific_not = false;
                        }
                    }
                }
            }

            include_once TGDPRCL_PATH . 'inc/backend/cookie/custom_meta/cookie_bar_meta_box.php';
        }

        /**
         * Save post for the metabox cookie controller metabox
         * @global type $post
         * @param type $post
         */
        function tgdprc_save_post_of_meta_box($post) {
            if (isset($_POST['tgdprc_meta_box_nonce_field']) && wp_verify_nonce($_POST['tgdprc_meta_box_nonce_field'], 'tgdprc_meta_box_nonce')) {
                if ($post != 'auto-draft' && $post == 'publish') {
                    global $post;
                    $id = isset($_POST['tgdprc_cookie_in_post_type']) && !empty($_POST['tgdprc_cookie_in_post_type']) ? sanitize_text_field($_POST['tgdprc_cookie_in_post_type']) : '';
                    $status = update_post_meta($post->ID, 'tgdprc_post_cookie_bar', $id);
                }
            }
        }

        /**
         * Pagination link creation
         */
        function tgdprc_pagination_links() {
            if (current_user_can('manage_options')) {
                if (isset($_POST['nonce_pagination']) && wp_verify_nonce($_POST['nonce_pagination'], 'tgdprc_pagination_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/cookie/paginations/tgdprc_pagination_links.php';
                }
            }
        }

        /**
         * Delete Multiple settings
         */
        function tgdprc_delete_marked() {
            if (current_user_can('manage_options')) {
                if (isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'tgdprc_delete_marked_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/cookie/settings/delete_multiple_settings.php';
                }
            }
        }

        /**
         * Delete marked Custom templates Multiple Row
         */
        function tgdprc_delete_marked_template() {
            if (current_user_can('manage_options')) {
                if (isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'tgdprc_delete_marked_template_nonce')) {
                    include_once TGDPRCL_PATH . 'inc/backend/cookie/settings/custom_templates/delete_multiple_template_setting.php';
                }
            }
        }

        /**
         * Utility Functions 
         *
         *
         *  Function to get the client ip address
         */
        function tgdprc_send_breach_mail($user_email_address) {
            $userdata_setting = get_option('user-data-settings');

            $site_name = 'no-repy@' . esc_attr(get_option('blogname'));
            /** strip out all whitespace */
            $somesitename_preg_replace = preg_replace('/\s*/', '', $site_name);
            /** convert the string to all lowercase */
            $somesitename = strtolower($somesitename_preg_replace);
            $to = $user_email_address;

            $message = isset($userdata_setting['data_breach']['email_info_text']) && !empty($userdata_setting['data_breach']['email_info_text']) ? nl2br(html_entity_decode($userdata_setting['data_breach']['email_info_text'])) : __('
                Hi there,

                We are writing this email to notify you that there was breach in our site.

                Please contact us for additional details.

                Thank you', TGDPRCL_DOMAIN);

            $subject_header = isset($userdata_setting['data_breach']['email_header']) && !empty($userdata_setting['data_breach']['email_header']) ? esc_attr($userdata_setting['data_breach']['email_header']) : __('Data Breach Notice [', TGDPRCL_DOMAIN) . get_option('blogname') . ']';

            $from = 'From:' . $somesitename . ' <' . $somesitename . '>' . "\r\n";
            $subject = $subject_header;
            $hash = md5(uniqid(time()));
            $headers = 'X-Mailer: PHP/' . phpversion();
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: multipart/mixed; boundary=\"" . $hash . "\"\r\n\r\n";
            $headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
            $headers .= 'From: ' . $somesitename . ' ' . "\r\n\\";
            $headers .= 'Reply-To: ' . $somesitename . ' ' . "\r\n\\";

            wp_mail($to, $subject, $message, $headers);
        }

        function tgdprc_getip() {
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if (getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if (getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if (getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if (getenv('HTTP_FORWARDED'))
                $ipaddress = getenv('HTTP_FORWARDED');
            else if (getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';

            return $ipaddress;
        }

        /**
         * Get the browser Header.
         * @see http://stackoverflow.com/a/20934782/4255615
         * @return string Browser name
         */
        function tgdprc_browser_header() {

            $ua = $_SERVER['HTTP_USER_AGENT'];

            if (
                strpos(strtolower($ua), 'safari/') &&
                strpos(strtolower($ua), 'opr/')
            ) {
// Opera
                $res = 'Opera';
            } elseif (
                strpos(strtolower($ua), 'safari/') &&
                strpos(strtolower($ua), 'chrome/')
            ) {
// Chrome
                $res = 'Chrome';
            } elseif (
                strpos(strtolower($ua), 'msie') ||
                strpos(strtolower($ua), 'trident/')
            ) {
// Internet Explorer
                $res = 'Internet Explorer';
            } elseif (strpos(strtolower($ua), 'firefox/')) {
// Firefox
                $res = 'Firefox';
            } elseif (
                strpos(strtolower($ua), 'safari/') &&
                (strpos(strtolower($ua), 'opr/') === false) &&
                (strpos(strtolower($ua), 'chrome/') === false)
            ) {
// Safari
                $res = 'Safari';
            } else {
// Out of data
                $res = false;
            }

            return $res;
        }

        /**
         * Get the browser Header.
         * @see function to check if some calue is in assoc array
         * @return string Browser name
         */
        function is_in_array($array, $key, $key_value) {
            $within_array = 'no';
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    $within_array = is_in_array($v, $key, $key_value);
                    if ($within_array == 'yes') {
                        break;
                    }
                } else {
                    if ($v == $key_value && $k == $key) {
                        $within_array = 'yes';
                        break;
                    }
                }
            }
            return $within_array;
        }

        /**
         * Get the browser Header.
         * @see function to push element into the assoc array
         * @return string Browser name
         */
        function array_push_assoc($array, $value) {
            $array[] = $value;
            return $array;
        }

        /** Get all pages */
        function get_all_page_lists() {
            wp_reset_postdata();
            $pages = get_pages(array('posts_per_page' => -1, 'post_status' => 'publish'));
            $page_lists = array();
            if (count($pages) > 0) {
                foreach ($pages as $page) :
                    $page_lists[$page->ID] = $page->post_title;
                endforeach;
            }
            return $page_lists;
        }

        /** Get all posts */
        function get_all_post_lists() {
            wp_reset_postdata();
            $posts = get_posts(array('posts_per_page' => -1, 'post_status' => 'publish'));
            $post_lists = array();
            if (count($posts) > 0) {
                foreach ($posts as $post) :
                    $post_lists[$post->ID] = $post->post_title;
                endforeach;
            }
            return $post_lists;
        }

        /** Get all categories */
        function get_categories($args = '') {
            $defaults = array('taxonomy' => 'category');
            $args = wp_parse_args($args, $defaults);
            $taxonomy = $args['taxonomy'];
            $taxonomy = apply_filters('get_categories_taxonomy', $taxonomy, $args);
            $categories = get_terms($taxonomy, $args);
            $categories_lists = array();
            if (count($categories) > 0) {
                foreach ($categories as $category):
                    $categories_lists[$category->term_id] = $category->name;
                endforeach;
            }
            return $categories_lists;
        }

        /** Get All Custom Post Types */
        function get_post_types() {
            wp_reset_postdata();
            $args = array('public' => true, '_builtin' => false);
            $output = 'objects'; // names or objects, note names is the default
            $operator = 'and'; // 'and' or 'or'
            $post_types = get_post_types($args, $output, $operator);
            $post_type_lists = array();
            if (count($post_types) > 0) {
                foreach ($post_types as $post_type) :
                    if ($post_type !== 'totalgdprcompliance'):
                        $post_type_lists[] = $post_type->labels->name;
                    endif;
                endforeach;
                return $post_type_lists;
            }
        }

        function sanitize_array($array = array(), $sanitize_rule = array()) {
            if (!is_array($array) || count($array) == 0) {
                return array();
            }

            foreach ($array as $k => $v) {
                if (!is_array($v)) {

                    $default_sanitize_rule = (is_numeric($k)) ? 'html' : 'text';
                    $sanitize_type = isset($sanitize_rule[$k]) ? $sanitize_rule[$k] : $default_sanitize_rule;
                    $array[$k] = $this->sanitize_value($v, $sanitize_type);
                }
                if (is_array($v)) {
                    $array[$k] = $this->sanitize_array($v, $sanitize_rule);
                }
            }

            return $array;
        }

        /**
         * Sanitizes Value
         *
         * @param type $value
         * @param type $sanitize_type
         * @return string
         *
         * @since 1.0.0
         */
        function sanitize_value($value = '', $sanitize_type = 'text') {
            switch ($sanitize_type) {
                case 'html':
                $allowed_html = wp_kses_allowed_html('post');
                return wp_kses($value, $allowed_html);
                break;
                case 'to_br':
                return $this->sanitize_escaping_linebreaks($value);
                break;
                case 'none':
                return $value;
                break;
                default:
                return sanitize_text_field($value);
                break;
            }
        }

    }

    new TOTAL_GDPR_COMPLIANCE_LITE(); //Class initialization
} //End of Class
<?php

defined('ABSPATH') or die('No Scripts for you');
if (is_multisite()) {
    global $wpdb;
    $current_blog = $wpdb->blogid;
    /** Create New Table For Storing Menu detail Datas on Activation* */
    $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
    foreach ($blog_ids as $blog_id) {
        switch_to_blog($blog_id);
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . "tgdprc_settings";
        $sql = "CREATE TABLE $table_name (
                  id int NOT NULL AUTO_INCREMENT,
                    name varchar(255),
                    general_settings varchar(5000),
                    display_settings varchar(5000),
                    extra_settings varchar(5000),
                    displayed_pages varchar(50),
                    PRIMARY KEY (id)
                ) $charset_collate;";
        $custom_temp_table = $wpdb->prefix . "tgdprc_custom_template";
        $tem_sql = " CREATE TABLE $custom_temp_table (
                id int NOT NULL AUTO_INCREMENT,
                template_name varchar(255),
                template_details varchar(6000),
                public_id varchar(7) NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";
        $consent_log_table = $wpdb->prefix . "tgdprc_consent_log";
        $consent_sql = " CREATE TABLE $consent_log_table (
                id int NOT NULL AUTO_INCREMENT,
                browser_ip varchar(255),
                consent_date varchar(255),
                consent_last_edit_date varchar(255),
                consent_log_details varchar(5000),
                PRIMARY KEY (id)
            ) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
        dbDelta($tem_sql);
        dbDelta($consent_sql);

        /**
         * Update initial value or advanced cookie on Plugin activation 
         */
        $advanced_cookie_field_array = array(
            'necessary' => array(
                'key_header' => 'Necessary',
                'label' => '',
                'placeholder' => '',
                'required' => '',
                'show_form' => ''
            ),
            'analytics' => array(
                'key_header' => 'Analytics & Marketting',
                'label' => '',
                'placeholder' => '',
                'required' => '',
                'show_form' => ''
            ),
            'advertisement' => array(
                'key_header' => 'Advertisement',
                'label' => '',
                'placeholder' => '',
                'required' => '',
                'show_form' => ''
            ),
        );

        /**
         * Insert default post into the services on plugin activation
         */
        $this->tgdprc_insert_default_posts_into_services();
    } //End of Blog loop
} // end of multisite condition
else {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . "tgdprc_settings";
    $sql = "CREATE TABLE $table_name (
                  id int NOT NULL AUTO_INCREMENT,
                    name varchar(255),
                    general_settings varchar(5000),
                    display_settings varchar(5000),
                    extra_settings varchar(5000),
                    displayed_pages varchar(50),
                    PRIMARY KEY (id)
                ) $charset_collate;";
    $custom_temp_table = $wpdb->prefix . "tgdprc_custom_template";
    $tem_sql = " CREATE TABLE $custom_temp_table (
                id int NOT NULL AUTO_INCREMENT,
                template_name varchar(255),
                template_details varchar(6000),
                public_id varchar(7) NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";
    $consent_log_table = $wpdb->prefix . "tgdprc_consent_log";
    $consent_sql = " CREATE TABLE $consent_log_table (
                id int NOT NULL AUTO_INCREMENT,
                browser_ip varchar(255),
                consent_date varchar(255),
                consent_last_edit_date varchar(255),
                consent_log_details varchar(5000),
                PRIMARY KEY (id)
            ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
    dbDelta($tem_sql);
    dbDelta($consent_sql);

    /**
     * Insert default post into the services on plugin activation
     */
    $this->tgdprc_insert_default_posts_into_services();
}
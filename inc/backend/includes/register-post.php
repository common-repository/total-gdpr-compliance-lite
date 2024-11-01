<?php

defined('ABSPATH') or die('No Scripts for you');
$labels = array(
    'name' => _x('Services: GDPR Cookies & Services Types', 'post type general name', 'total-gdpr-compliance-lite'),
    'singular_name' => _x('GDPR Cookies & Services Types', 'post type singular name', 'total-gdpr-compliance-lite'),
    'menu_name' => _x('Total GDPR Compliance Lite', 'admin menu', 'total-gdpr-compliance-lite'),
    'name_admin_bar' => _x('Services', 'add new on admin bar', 'total-gdpr-compliance-lite'),
    'add_new' => _x('New Service', 'Contact Form 7 Store to DB', 'total-gdpr-compliance-lite'),
    'edit_item' => __('Edit Services', 'total-gdpr-compliance-lite'),
    'view_item' => __('View Services;', 'total-gdpr-compliance-lite'),
    'all_items' => __('All Services', 'total-gdpr-compliance-lite'),
    'search_items' => __('Search Services', 'total-gdpr-compliance-lite'),
    'parent_item_colon' => __('Parent Services:', 'total-gdpr-compliance-lite'),
    'not_found' => __('No Services Found.', 'total-gdpr-compliance-lite'),
    'not_found_in_trash' => __('No Services Found in Trash.', 'total-gdpr-compliance-lite')
);

$args = array(
    'labels' => $labels,
    'description' => __('Description', 'total-gdpr-compliance-lite'),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => 'edit.php?post_type=totalgdprcompliance',
    'menu_icon' => 'dashicons-admin-users',
    'query_var' => true,
    'rewrite' => array(
        'slug' => 'tgdprc-services'
    ),
    'map_meta_cap' => true,
    'has_archive' => false,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array(
        'title',
        'editor'
    )
);

<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php

$default_advanced_cookie_check_array = array(
    'tgdprc_wordpress_cookies_arr' => array(
        'title' => 'WordPress Default',
        'description' => 'Default Cookies used by WordPress',
        'cookie_types' => 'necessary',
        'cookie_nature' => 'repetitive',
        'cookie_expire_duration' => '',
        'custom_cookie_expiry_condition'=> 'on',
        'blockable' => 'on',
        'currently_active' => 'on',
        'cookie_used' => 'comment_author_*,comment_author_email_*,comment_author_url_*'
    ),
    'tgdprc_google_analytics_cookies_arr' => array(
        'title' => 'Google Analytics',
        'description' => 'Cookies to track how you interact with website content',
        'cookie_types' => 'analytics',
        'cookie_nature' => 'session',
        'cookie_expire_duration' => '',
        'custom_cookie_expiry_condition'=> 'on',
        'blockable' => 'on',
        'currently_active' => 'on',
        'cookie_used' => '__utma,__utmb,__utmc,__utmv,__utmz,_ga,_gat,_gid'
    ),
    'tgprc_google_advertisement_cookies_arr' => array(
        'title' => 'Google Advertisement',
        'description' => 'Cookies to store your preference for releavant ad ',
        'cookie_types' => 'advertisement',
        'cookie_nature' => 'repetitive',
        'cookie_expire_duration' => '',
        'custom_cookie_expiry_condition'=> 'on',
        'blockable' => 'on',
        'currently_active' => 'on',
        'cookie_used' => '__gads,DSID,IDE,SAPISID,HSID,test_cookie'
    ),
    'tgprc_woo_commerce_cookies_arr' => array(
        'title' => 'Woo Commerce',
        'description' => 'Cookies to store information about the cart',
        'cookie_types' => 'necessary',
        'cookie_nature' => 'repetitive',
        'cookie_expire_duration' => '',
        'custom_cookie_expiry_condition'=> 'on',
        'blockable' => 'on',
        'currently_active' => 'on',
        'cookie_used' => 'woocommerce_cart_*,woocommerce_items_in_cart,wp_woocommerce_session'
    ),
    'tgprc_youtube_cookies_arr' => array(
        'title' => 'Youtube',
        'description' => 'Cookies to store your preference and recommend relavant videos',
        'cookie_types' => 'analytics',
        'cookie_nature' => 'repetitive',
        'cookie_expire_duration' => '',
        'custom_cookie_expiry_condition'=> 'on',
        'blockable' => 'on',
        'currently_active' => 'on',
        'cookie_used' => 'visitor_info1_live,apisid,PREF,sapisid,sid,ssid,use_hitbox,YSC'
    ),
    'tgprc_facebook_pixel_cookies_arr' => array(
        'title' => 'Facebook Pixel',
        'description' => 'Cookies to store your preference and recomment relavant ad',
        'cookie_types' => 'advertisement',
        'cookie_nature' => 'repetitive',
        'cookie_expire_duration' => '',
        'custom_cookie_expiry_condition'=> 'on',
        'blockable' => 'on',
        'currently_active' => 'on',
        'cookie_used' => 'act,wd,xs,datr,csm,presence,c_user,fr,pl,sct,lu,reg_ext_ref,reg_fb_gate,reg_fb_ref'
    )
);

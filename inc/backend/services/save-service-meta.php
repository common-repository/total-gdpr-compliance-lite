<?php

$allowediframetags = array(
    'iframe' => array(
        'quotes' => array(),
        'br' => array(),
        'src' => array(),
        'width' => array(),
        'height' => array(),
        'frameborder' => array(),
        'style' => array(),
        'allowfullscreen' => array()
    ),
    'quotes' => array(),
);

$allowediframetags2 = array(
    'a' => array(
        'href' => array(),
        'title' => array()),
    'br' => array(),
    'p' => array(
        'style' => array()),
    'hr' => array(),
    'abbr' => array(
        'title' => array()),
    'b' => array(),
    'ul' => array(),
    'li' => array(),
    'ol' => array(),
    'h1' => array(
        'style' => array()),
    'h2' => array(
        'style' => array()),
    'h3' => array(
        'style' => array()),
    'h4' => array(
        'style' => array()),
    'h5' => array(
        'style' => array()),
    'h6' => array(
        'style' => array()),
    'span' => array(
        'style' => array()),
    'blockquote' => array(
        'cite' => array()),
    'cite' => array(),
    'code' => array(),
    'del' => array(
        'datetime' => array()),
    'em' => array(),
    'i' => array(),
    'q' => array(
        'cite' => array()),
    'strike' => array(),
    'strong' => array(),
);
if (isset($_POST['tgdpr_service_detail'])) {
    $tgdpr_service_detail_parameter_list = (array) $_POST['tgdpr_service_detail'];
    $tgdpr_service_detail_parameter_temp = array();
    if (!emptY($tgdpr_service_detail_parameter_list)) {
        foreach ($tgdpr_service_detail_parameter_list as $key => $val) {
            if (is_array($val)) {
                $tgdpr_service_detail_parameter_temp[$key] = array();
                foreach ($val as $k => $v) {
                    if (!is_array($v)) {
                        $tgdpr_service_detail_parameter_temp[$key][$k] = sanitize_text_field($v);
                    } else {
                        $tgdpr_service_detail_parameter_temp[$key][$k] = array_map('sanitize_text_field', $v);
                    }
                }
            } else {
                $tgdpr_service_detail_parameter_temp[$key] = sanitize_text_field($val);
            }
        }
    }
    $tgdpr_service_detail_temp_array = $tgdpr_service_detail_parameter_temp;
    update_post_meta($post_id, 'tgdpr_service_detail', $tgdpr_service_detail_temp_array);
}
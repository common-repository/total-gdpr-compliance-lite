<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<?php

$options = array(
    'display_type' => array('bar', 'popup', 'floating'),
    'more_info_action' => array('page redirect', 'slideout content'),
    'more_info_position' => array('left', 'right'),
    'bar_position' => array('top absolute', 'top fixed', 'bottom'),
    'floating_position' => array('top_left', 'top_right', 'bottom_left', 'bottom_right'),
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
        'Template-6' => array(
            'name' => 'Template-6',
            'alias' => 'Wine Berry',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template6.PNG'
        ),
        'Template-7' => array(
            'name' => 'Template-7',
            'alias' => 'Seashell',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template7.PNG'
        ),
        'Template-8' => array(
            'name' => 'Template-8',
            'alias' => 'Wisteria',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template8.PNG'
        ),
        'Template-9' => array(
            'name' => 'Template-9',
            'alias' => 'White',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template9.PNG'
        ),
        'Template-10' => array(
            'name' => 'Template-10',
            'alias' => 'Mountain Meadow',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template10.PNG'
        ),
        'Template-21' => array(
            'name' => 'Template-11',
            'alias' => 'Mako and Sunglo',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template11.PNG'
        ),
        'Template-22' => array(
            'name' => 'Template-12',
            'alias' => 'East Bay',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template12.PNG'
        ),
        'Template-23' => array(
            'name' => 'Template-13',
            'alias' => 'Blue Chill',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template13.PNG'
        ),
        'Template-24' => array(
            'name' => 'Template-14',
            'alias' => 'Punch',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template14.PNG'
        ),
        'Template-25' => array(
            'name' => 'Template-15',
            'alias' => 'Orange Peel',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template15.PNG'
        ),
        'Template-26' => array(
            'name' => 'Template-16',
            'alias' => 'Bright Red',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template16.PNG'
        ),
        'Template-27' => array(
            'name' => 'Template-17',
            'alias' => 'School Bus Yellow',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template17.PNG'
        ),
        'Template-28' => array(
            'name' => 'Template-18',
            'alias' => 'Cod Gray',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template18.PNG'
        ),
        'Template-29' => array(
            'name' => 'Template-19',
            'alias' => 'Governor Bay',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template19.PNG'
        ),
        'Template-30' => array(
            'name' => 'Template-20',
            'alias' => 'Caribbean Green',
            'img' => TGDPRCL_IMAGE . 'template_images/bar/template20.PNG'
        ),
    ),
    'popup_template_type' => array(
        'Template-11' => array(
            'name' => 'Template-1',
            'alias' => 'Paradiso and Fountain Blue',
            'img' => TGDPRCL_IMAGE . 'template_images/popup/template1.PNG'
        ),
        'Template-12' => array(
            'name' => 'Template-2',
            'alias' => 'Havelock Blue',
            'img' => TGDPRCL_IMAGE . 'template_images/popup/template2.PNG'
        ),
        'Template-13' => array(
            'name' => 'Template-3',
            'alias' => 'Shiraz',
            'img' => TGDPRCL_IMAGE . 'template_images/popup/template3.PNG'
        ),
        'Template-14' => array(
            'name' => 'Template-4',
            'alias' => 'Chicago',
            'img' => TGDPRCL_IMAGE . 'template_images/popup/template4.PNG'
        ),
        'Template-15' => array(
            'name' => 'Template-5',
            'alias' => 'White and Mountain Meadow',
            'img' => TGDPRCL_IMAGE . 'template_images/popup/template5.PNG'
        ),
    ),
    'floating_template_type' => array(
        'Template-16' => array(
            'name' => 'Template-1',
            'alias' => 'Governor Bay',
            'img' => TGDPRCL_IMAGE . 'template_images/floating/template1.PNG'
        ),
        'Template-17' => array(
            'name' => 'Template-2',
            'alias' => 'Mako',
            'img' => TGDPRCL_IMAGE . 'template_images/floating/template2.PNG'
        ),
        'Template-18' => array(
            'name' => 'Template-3',
            'alias' => 'East Bay',
            'img' => TGDPRCL_IMAGE . 'template_images/floating/template3.PNG'
        ),
        'Template-19' => array(
            'name' => 'Template-4',
            'alias' => 'Manatee',
            'img' => TGDPRCL_IMAGE . 'template_images/floating/template4.PNG'
        ),
        'Template-20' => array(
            'name' => 'Template-5',
            'alias' => 'Paradiso and Fountain Blue',
            'img' => TGDPRCL_IMAGE . 'template_images/floating/template5.PNG'
        ),
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


<?php

// Set defaults
$repeater_columns = '4';
// $repeater_type = 'slider';
$repeater_post_type = 'timeline';
$repeater_col_spacing = 'normal';

$repeater_post_cat = 'timeline_cat';
$default_text_align = 'center';

$options =  array(
// 'style_options' => array(
//     'type' => 'group',
//     'heading' => __( 'Style' ),
//     'options' => array(
//          'style' => array(
//             'type' => 'select',
//             'heading' => __( 'Style' ),
//             'default' => '',
//             'options' =>  array(
//             	'none'     => 'None',
//             	'bounce'   => 'Bounce',
//             )
//         )
//     ),
// ),
'post_options' => array(
    'type' => 'group',
    'heading' => __( 'Posts' ),
    'options' => array(

     'ids' => array(
        'type' => 'select',
        'heading' => 'Custom Posts',
        'param_name' => 'ids',
        'config' => array(
            'multiple' => true,
            'placeholder' => 'Select..',
            'postSelect' => array(
                'post_type' => array($repeater_post_type)
            ),
        )
    ),

    'cat' => array(
        'type' => 'select',
        'heading' => 'Category',
        'param_name' => 'cat',
        'conditions' => 'ids === ""',
        'default' => '',
        'config' => array(
            'placeholder' => 'Select...',
            'termSelect' => array(
                'post_type' => $repeater_post_cat,
                'taxonomies' => $repeater_post_cat
            ),
        )
    ),


    'total_posts' => array(
        'type' => 'textfield',
        'heading' => 'Offset',
        'conditions' => 'ids === ""',
        'default' => '',
    ),

    'offset' => array(
        'type' => 'textfield',
        'heading' => 'Offset',
        'conditions' => 'ids === ""',
        'default' => '',
    ),
    'order' => array(
        'type' => 'select',
        'heading' => 'Sort Order',
        'default' => 'DESC',
        'options' => array(
            'ASC'     => 'ASC',
            'DESC'   => 'DESC',
        )
    ),
  )
),
'post_title_options' => array(
    'type' => 'group',
    'heading' => __( 'Title' ),
        'options' => array(
            'title_size' => array(
                'type' => 'select',
                'heading' => 'Title Size',
                'default' => '',
                'options' => require( __DIR__ . '/values/sizes.php' )
            ),
            'title_style' => array(
                'type' => 'radio-buttons',
                'heading' => 'Title Style',
                'default' => '',
                'options' => array(
                    ''   => array( 'title' => 'Abc'),
                    'uppercase' => array( 'title' => 'ABC'),
                )
        ),
    )
),
'read_more_button' => array(
    'type' => 'group',
    'heading' => __( 'Read More' ),
        'options' => array(
            'readmore' => array(
                'type' => 'textfield',
                'heading' => 'Text',
                'default' => '',
            ),
            'readmore_color' => array(
            'type' => 'select',
            'heading' => 'Color',
            'conditions' => 'readmore',
            'default' => 'primary',
            'options' => array(
                '' => 'Blank',
                'primary' => 'Primary',
                'secondary' => 'Secondary',
                'alert' => 'Alert',
                'success' => 'Success',
                'white' => 'White',
            )
        ),
        'readmore_style' => array(
            'type' => 'select',
            'heading' => 'Style',
            'conditions' => 'readmore',
            'default' => 'outline',
            'options' => array(
                '' => 'Default',
                'outline' => 'Outline',
                'link' => 'Simple',
                'underline' => 'Underline',
                'shade' => 'Shade',
                'bevel' => 'Bevel',
                'gloss' => 'Gloss',
            )
        ),
        'readmore_size' => array(
            'type' => 'select',
            'conditions' => 'readmore',
            'heading' => 'Size',
            'default' => '',
            'options' => require( __DIR__ . '/values/sizes.php' ),
        ),
    )
),


'post_meta_options' => array(
    'type' => 'group',
    'heading' => __( 'Meta' ),
    'options' => array(

    'show_date' => array(
        'type' => 'select',
        'heading' => 'Date',
        'default' => 'badge',
        'options' => array(
            'badge' => 'Badge',
            'text' => 'Text',
            'false' => 'Hidden',
        )
    ),
    'badge_style' => array(
        'type' => 'select',
        'heading' => 'Badge Style',
        'default' => '',
        'conditions' => 'show_date == "badge"',
        'options' => array(
            '' => 'Default',
            'outline' => 'Outline',
            'square' => 'Square',
            'circle' => 'Circle',
            'circle-inside' => 'Circle Inside',
        )
    ),
    'excerpt' => array(
        'type' => 'select',
        'heading' => 'Excerpt',
        'default' => 'visible',
        'options' => array(
            'visible' => 'Visible',
            'fade' => 'Fade In On Hover',
            'slide' => 'Slide In On Hover',
            'reveal' => 'Reveal On Hover',
            'false' => 'Hidden',
        )
    ),
   'excerpt_length' => array(
        'type' => 'slider',
        'heading' => 'Excerpt Length',
        'default' => 15,
        'max' => 50,
        'min' => 5,
    ),
    'show_category' => array(
        'type' => 'select',
        'heading' => 'Category',
        'default' => 'false',
        'options' => array(
            'label' => 'Label',
            'text' => 'Text',
            'false' => 'Hidden',
        )
    ),
    'comments' => array(
        'type' => 'select',
        'heading' => 'Comments',
        'default' => 'visible',
        'options' => array(
            'visible' => 'Visible',
            'false' => 'Hidden',
        )
    ),
    ),
));

$box_styles = require( __DIR__ . '/commons/box-styles.php' );
$options = array_merge($options, $box_styles);

add_ux_builder_shortcode( 'wbc_timeline_posts', array(
    'name' => __( 'Timeline posts' ),
    'category' => __( 'Webico.vn' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'timeline_posts' ),
    'scripts' => array(
        'flatsome-masonry-js' => get_template_directory_uri() .'/assets/libs/packery.pkgd.min.js',
    ),
    'options' => $options
) );

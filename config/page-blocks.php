<?php

/*
|--------------------------------------------------------------------------
| Page Blocks
|--------------------------------------------------------------------------
|
| This configuration file is used to display page blocks and their content,
| where each key is a block and each property is specific to that block.
|
*/
$blocks = array();

// The field we use to add extra spacing
$spacesField = [
    'field' => 'spaces',
    'display_name' => 'Add Vertical Space',
    'partial' => 'voyager::formfields.select_dropdown',
    'required' => 0,
    'options' => [
        'Bottom',
        'Top',
        'Top & Bottom',
        'None',
    ],
    'placeholder' => 0,
];

/**
 * Callout Block
 * - Used for hero banners, CTA sections etc
 */
$blocks['callout'] = [
    'name' => 'Callout',
    'template' => 'callout',
    'fields' => [
        'size' => [
            'field' => 'size',
            'display_name' => 'Size (height) of section',
            'partial' => 'voyager::formfields.select_dropdown',
            'required' => 1,
            'options' => [
                'Small',
                'Medium',
                'Large',
                'Extra Large',
            ],
            'placeholder' => 0,
        ],
        'fade_background' => [
            'field' => 'fade_background',
            'display_name' => 'Fade out background',
            'partial' => 'voyager::formfields.checkbox',
            'required' => 0,
        ],
        'br_1' => [
            'field' => 'br_1',
            'display_name' => 'Line Break',
            'partial' => 'break',
        ],
        'background_image' => [
            'field' => 'background_image',
            'display_name' => 'Background image',
            'partial' => 'voyager::formfields.image',
            'required' => 1,
        ],
        'br_2' => [
            'field' => 'br_2',
            'display_name' => 'Line Break',
            'partial' => 'break',
        ],
        'title' => [
            'field' => 'title',
            'display_name' => 'Title',
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => 'Changing the World!',
        ],
        'content' => [
            'field' => 'content',
            'display_name' => 'Content',
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.',
        ],
        'br_3' => [
            'field' => 'br_3',
            'display_name' => 'Line Break',
            'partial' => 'break',
        ],
        'button_text' => [
            'field' => 'button_text',
            'display_name' => 'Button Text',
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => 'Learn More',
        ],
        'link' => [
            'field' => 'link',
            'display_name' => 'Link',
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => '#',
        ],
        'br_4' => [
            'field' => 'br_4',
            'display_name' => 'Line Break',
            'partial' => 'break',
        ],
        'spaces' => $spacesField,
    ],
];

/**
 * (Column'd) Content Block
 * - Can be used for standard WYSIWYG content
 */
$columns = array(
    'content_one_column',
    'content_two_columns',
    'content_three_columns',
    'content_four_columns',
);

foreach ($columns as $i => $block) {
    $numCols = $i + 1;

    $blocks[$block] = [
        'name' => "Content - {$numCols} Column/s",
        'template' => $block,
    ];
    for ($col = 1; $col <= $numCols; $col++) {
        $blocks[$block]['fields']["html_content_{$col}"] = [
            'field' => "html_content_{$col}",
            'display_name' => "Column {$col} content",
            'partial' => 'voyager::formfields.rich_text_box',
            'required' => 0,
            'placeholder' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>',
        ];
    }
    $blocks[$block]['fields']['spaces'] = $spacesField;
}

/**
 * (Column'd) Cards Block
 */
$columns = array(
    'cards_one_column',
    'cards_two_columns',
    'cards_three_columns',
);

foreach ($columns as $i => $block) {
    $numCols = $i + 1;

    $blocks[$block] = [
        'name' => "Cards - {$numCols} Column/s",
        'template' => $block,
    ];
    for ($col = 1; $col <= $numCols; $col++) {
        $blocks[$block]['fields']["image_{$col}"] = [
            'field' => "image_{$col}",
            'display_name' => "Column {$col}: Image",
            'partial' => 'voyager::formfields.image',
            'required' => 0,
        ];
        if ($numCols === 1) {
            $blocks[$block]['fields']["image_position_{$col}"] = [
                'field' => "image_position_{$col}",
                'display_name' => "Position of Column {$col}: Image",
                'partial' => 'voyager::formfields.select_dropdown',
                'required' => 0,
                'options' => [
                    'Left',
                    'Right',
                ],
                'placeholder' => 0,
            ];
        }
        $blocks[$block]['fields']["br_{$col}_1"] = [
            'field' => "br_{$col}_1",
            'display_name' => "Line break",
            'partial' => 'break',
        ];
        $blocks[$block]['fields']["title_{$col}"] = [
            'field' => "title_{$col}",
            'display_name' => "Column {$col}: Title",
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => 'Changing the World!',
        ];
        $blocks[$block]['fields']["content_{$col}"] = [
            'field' => "content_{$col}",
            'display_name' => "Column {$col}: Content",
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.',
        ];
        $blocks[$block]['fields']["br_{$col}_2"] = [
            'field' => "br_{$col}_2",
            'display_name' => "Line break",
            'partial' => 'break',
        ];
        $blocks[$block]['fields']["button_text_{$col}"] = [
            'field' => "button_text_{$col}",
            'display_name' => "Button Column {$col}: Text",
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => 'Learn More',
        ];
        $blocks[$block]['fields']["link_{$col}"] = [
            'field' => "link_{$col}",
            'display_name' => "Column {$col}: Link",
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => '#',
        ];
        $blocks[$block]['fields']["br_{$col}_3"] = [
            'field' => "br_{$col}_3",
            'display_name' => "Line break",
            'partial' => 'break',
        ];
    }
    $blocks[$block]['fields']['spaces'] = $spacesField;
}

/**
 * Row of Images Block
 */
$blocks['image_row'] = [
    'name' => 'Row of Images',
    'template' => 'image_row',
    'fields' => [
        'image1' => [
            'field' => 'image1',
            'display_name' => 'Image 1',
            'partial' => 'voyager::formfields.image',
            'required' => 0,
        ],
        'link1' => [
            'field' => 'link1',
            'display_name' => 'Link for Image 1',
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => '#',
        ],
        'br_1' => [
            'field' => 'br_1',
            'display_name' => 'Line Break',
            'partial' => 'break',
        ],
        'image2' => [
            'field' => 'image2',
            'display_name' => 'Image 2',
            'partial' => 'voyager::formfields.image',
            'required' => 0,
        ],
        'link2' => [
            'field' => 'link2',
            'display_name' => 'Link for Image 2',
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => '#',
        ],
        'br_2' => [
            'field' => 'br_2',
            'display_name' => 'Line Break',
            'partial' => 'break',
        ],
        'image3' => [
            'field' => 'image3',
            'display_name' => 'Image 3',
            'partial' => 'voyager::formfields.image',
            'required' => 0,
        ],
        'link3' => [
            'field' => 'link3',
            'display_name' => 'Link for Image 3',
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => '#',
        ],
        'br_3' => [
            'field' => 'br_3',
            'display_name' => 'Line Break',
            'partial' => 'break',
        ],
        'image4' => [
            'field' => 'image4',
            'display_name' => 'Image 4',
            'partial' => 'voyager::formfields.image',
            'required' => 0,
        ],
        'link4' => [
            'field' => 'link4',
            'display_name' => 'Link for Image 4',
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => '#',
        ],
        'br_4' => [
            'field' => 'br_4',
            'display_name' => 'Line Break',
            'partial' => 'break',
        ],
        'image5' => [
            'field' => 'image5',
            'display_name' => 'Image 5',
            'partial' => 'voyager::formfields.image',
            'required' => 0,
        ],
        'link5' => [
            'field' => 'link5',
            'display_name' => 'Link for Image 5',
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => '#',
        ],
        'br_5' => [
            'field' => 'br_5',
            'display_name' => 'Line Break',
            'partial' => 'break',
        ],
        'image6' => [
            'field' => 'image6',
            'display_name' => 'Image 6',
            'partial' => 'voyager::formfields.image',
            'required' => 0,
        ],
        'link6' => [
            'field' => 'link6',
            'display_name' => 'Link for Image 6',
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => '#',
        ],
        'br_6' => [
            'field' => 'br_6',
            'display_name' => 'Line Break',
            'partial' => 'break',
        ],
        'spaces' => $spacesField,
    ],
];

/**
 * Testimonial Block
 */
$blocks['testimonial'] = [
    'name' => 'Testimonial',
    'template' => 'testimonial',
    'fields' => [
        'content' => [
            'field' => 'content',
            'display_name' => 'Testimonial Content',
            'partial' => 'voyager::formfields.text_area',
            'required' => 1,
            'placeholder' => 'Company X is both attractive and highly adaptable. Company X has really helped our business thrive - I can\'t wait to see what comes next for us.',
        ],
        'title' => [
            'field' => 'title',
            'display_name' => 'Person',
            'partial' => 'voyager::formfields.text',
            'required' => 1,
            'placeholder' => 'John Smith',
        ],
        'sub_title' => [
            'field' => 'sub_title',
            'display_name' => 'Sub Text',
            'partial' => 'voyager::formfields.text',
            'required' => 0,
            'placeholder' => 'Founder &amp; CEO',
        ],
        'br_1' => [
            'field' => 'br_1',
            'display_name' => 'Line Break',
            'partial' => 'break',
        ],
        'image' => [
            'field' => 'image',
            'display_name' => 'Image',
            'partial' => 'voyager::formfields.image',
            'required' => 0,
        ],
        'br_2' => [
            'field' => 'br_2',
            'display_name' => 'Line Break',
            'partial' => 'break',
        ],
        'spaces' => $spacesField,
    ],
];

return $blocks;

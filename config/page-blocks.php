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
$blocks = [];

// The 'global' fields we'll use on multiple blocks
$spacesField = [
    'field' => 'spaces',
    'display_name' => 'Add Vertical Space',
    'type' => 'select_dropdown',
    'required' => 0,
    'details' => [
        'options' => [
            'Bottom',
            'Top',
            'Top & Bottom',
            'None',
        ],
    ],
    'placeholder' => 0,
];

$animationsField = [
    'field' => 'animate',
    'display_name' => 'Animate this block (in)?',
    'type' => 'checkbox',
    'placeholder' => 'on',
    'required' => 0,
];

/**
 * Callout Block
 * - Used for hero banners, CTA sections etc
 */
$blocks['callout'] = [
    'name' => 'Callout',
    'template' => 'voyager-page-blocks::blocks.callout',
    'fields' => [
        'size' => [
            'field' => 'size',
            'display_name' => 'Size (height) of section',
            'type' => 'select_dropdown',
            'required' => 1,
            'details' => [
                'options' => [
                    'Small',
                    'Medium',
                    'Large',
                    'Extra Large',
                ],
            ],
            'placeholder' => 0,
        ],
        'fade_background' => [
            'field' => 'fade_background',
            'display_name' => 'Fade out background',
            'type' => 'checkbox',
            'required' => 0,
        ],
        'br_1' => [
            'field' => 'br_1',
            'display_name' => 'Line Break',
            'partial' => 'break',
            'type' => 'break',
        ],
        'background_image' => [
            'field' => 'background_image',
            'display_name' => 'Background image',
            'type' => 'image',
            'required' => 1,
        ],
        'br_2' => [
            'field' => 'br_2',
            'display_name' => 'Line Break',
            'partial' => 'break',
            'type' => 'break',
        ],
        'title' => [
            'field' => 'title',
            'display_name' => 'Title',
            'type' => 'text',
            'required' => 0,
            'placeholder' => 'Changing the World!',
        ],
        'content' => [
            'field' => 'content',
            'display_name' => 'Content',
            'type' => 'text',
            'required' => 0,
            'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.',
        ],
        'br_3' => [
            'field' => 'br_3',
            'display_name' => 'Line Break',
            'partial' => 'break',
            'type' => 'break',
        ],
        'button_text' => [
            'field' => 'button_text',
            'display_name' => 'Button Text',
            'type' => 'text',
            'required' => 0,
            'placeholder' => '',
        ],
        'link' => [
            'field' => 'link',
            'display_name' => 'Link',
            'type' => 'text',
            'required' => 0,
            'placeholder' => '',
        ],
        'br_4' => [
            'field' => 'br_4',
            'display_name' => 'Line Break',
            'partial' => 'break',
            'type' => 'break',
        ],
        'spaces' => $spacesField,
        'animate' => $animationsField,
    ],
];

/**
 * (Column'd) Content Block
 * - Can be used for standard WYSIWYG content
 */
$columns = [
    'content_one_column',
    'content_two_columns',
    'content_three_columns',
    'content_four_columns',
];

foreach ($columns as $i => $block) {
    $numCols = $i + 1;

    $blocks[$block] = [
        'name' => "Content - {$numCols} Column/s",
        'template' => 'voyager-page-blocks::blocks.' . $block,
    ];
    for ($col = 1; $col <= $numCols; $col++) {
        $blocks[$block]['fields']["html_content_{$col}"] = [
            'field' => "html_content_{$col}",
            'display_name' => "Column {$col} content",
            'type' => 'rich_text_box',
            'required' => 0,
            'placeholder' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>',
        ];
    }
    $blocks[$block]['fields']['spaces'] = $spacesField;
    $blocks[$block]['fields']['animate'] = $animationsField;
}

/**
 * (Column'd) Cards Block
 */
$columns = [
    'cards_one_column',
    'cards_two_columns',
    'cards_three_columns',
];

foreach ($columns as $i => $block) {
    $numCols = $i + 1;

    $blocks[$block] = [
        'name' => "Cards - {$numCols} Column/s",
        'template' => 'voyager-page-blocks::blocks.' . $block,
    ];
    for ($col = 1; $col <= $numCols; $col++) {
        $blocks[$block]['fields']["image_{$col}"] = [
            'field' => "image_{$col}",
            'display_name' => "Column {$col}: Image",
            'type' => 'image',
            'required' => 0,
        ];
        if ($numCols === 1) {
            $blocks[$block]['fields']["image_position_{$col}"] = [
                'field' => "image_position_{$col}",
                'display_name' => "Position of Column {$col}: Image",
                'type' => 'select_dropdown',
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
            'type' => 'break',
        ];
        $blocks[$block]['fields']["title_{$col}"] = [
            'field' => "title_{$col}",
            'display_name' => "Column {$col}: Title",
            'type' => 'text',
            'required' => 0,
            'placeholder' => 'Changing the World!',
        ];
        $blocks[$block]['fields']["content_{$col}"] = [
            'field' => "content_{$col}",
            'display_name' => "Column {$col}: Content",
            'type' => 'text',
            'required' => 0,
            'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.',
        ];
        $blocks[$block]['fields']["br_{$col}_2"] = [
            'field' => "br_{$col}_2",
            'display_name' => "Line break",
            'partial' => 'break',
            'type' => 'break',
        ];
        $blocks[$block]['fields']["button_text_{$col}"] = [
            'field' => "button_text_{$col}",
            'display_name' => "Button Column {$col}: Text",
            'type' => 'text',
            'required' => 0,
            'placeholder' => '',
        ];
        $blocks[$block]['fields']["link_{$col}"] = [
            'field' => "link_{$col}",
            'display_name' => "Column {$col}: Link",
            'type' => 'text',
            'required' => 0,
            'placeholder' => '',
        ];
        $blocks[$block]['fields']["br_{$col}_3"] = [
            'field' => "br_{$col}_3",
            'display_name' => "Line break",
            'partial' => 'break',
            'type' => 'break',
        ];
    }
    $blocks[$block]['fields']['spaces'] = $spacesField;
    $blocks[$block]['fields']['animate'] = $animationsField;
}

/**
 * Row of Images Block
 */
$blocks['image_row'] = [
    'name' => 'Row of Images',
    'template' => 'voyager-page-blocks::blocks.image_row',
];
$blocks['image_row']['fields']['title'] = [
    'field' => 'title',
    'display_name' => 'Person',
    'type' => 'text',
    'required' => 0,
    'placeholder' => 'Our Partners',
];
$blocks['image_row']['fields']['sub_title'] = [
    'field' => 'sub_title',
    'display_name' => 'Sub Text',
    'type' => 'text',
    'required' => 0,
    'placeholder' => 'The glue that keeps our company thriving.',
];
for ($col = 1; $col <= 6; $col++) {
    $blocks['image_row']['fields']["image_{$col}"] = [
        'field' => "image_{$col}",
        'display_name' => "Image {$col}",
        'type' => 'image',
        'required' => 0,
    ];
    $blocks['image_row']['fields']["link_{$col}"] = [
        'field' => "link_{$col}",
        'display_name' => "Link for Image {$col}",
        'type' => 'text',
        'required' => 0,
        'placeholder' => '',
    ];
    $blocks['image_row']['fields']["br_{$col}"] = [
        'field' => "br_{$col}",
        'display_name' => 'Line Break',
        'partial' => 'break',
        'type' => 'break',
    ];
}
$blocks['image_row']['fields']['spaces'] = $spacesField;
$blocks['image_row']['fields']['animate'] = $animationsField;

/**
 * Testimonial Block
 */
$blocks['testimonial'] = [
    'name' => 'Testimonial',
    'template' => 'voyager-page-blocks::blocks.testimonial',
    'fields' => [
        'content' => [
            'field' => 'content',
            'display_name' => 'Testimonial Content',
            'type' => 'text_area',
            'required' => 1,
            'placeholder' => 'Company X is both attractive and highly adaptable. Company X has really helped our business thrive - I can\'t wait to see what comes next for us.',
        ],
        'title' => [
            'field' => 'title',
            'display_name' => 'Person',
            'type' => 'text',
            'required' => 1,
            'placeholder' => 'John Smith',
        ],
        'sub_title' => [
            'field' => 'sub_title',
            'display_name' => 'Sub Text',
            'type' => 'text',
            'required' => 0,
            'placeholder' => 'Founder &amp; CEO',
        ],
        'br_1' => [
            'field' => 'br_1',
            'display_name' => 'Line Break',
            'partial' => 'break',
            'type' => 'break',
        ],
        'image' => [
            'field' => 'image',
            'display_name' => 'Image',
            'type' => 'image',
            'required' => 0,
        ],
        'br_2' => [
            'field' => 'br_2',
            'display_name' => 'Line Break',
            'partial' => 'break',
            'type' => 'break',
        ],
        'spaces' => $spacesField,
        'animate' => $animationsField,
    ],
];

return $blocks;

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

return [
    'html_content' => [
        'name' => 'HTML Content',
        'fields' => [
            'html' => [
                'field' => 'content',
                'display_name' => 'A rich text area field to insert HTML and text',
                'partial' => 'voyager::formfields.rich_text_box',
                'required' => 1,
                'placeholder' => '<p>Hello World!</p>',
            ],
        ],
        'template' => 'html_content',
        'compatible' => '*',
    ],
    'mixed_content' => [
        'name' => 'Mixed Content (HTML/Text)',
        'fields' => [
            'html_content' => [
                'field' => 'html_content',
                'display_name' => 'HTML Content',
                'partial' => 'voyager::formfields.rich_text_box',
                'required' => 1,
                'placeholder' => '<p>Hello World!</p>',
            ],
            'text_content' => [
                'field' => 'text_content',
                'display_name' => 'Text Area',
                'partial' => 'voyager::formfields.text_area',
                'required' => 1,
                'placeholder' => 'Hello World!',
            ],
        ],
        'template' => 'mixed_content',
        'compatible' => '*',
    ],
    'text_area' => [
        'name' => 'Text Area',
        'fields' => [
            'text_content' => [
                'field' => 'text_content',
                'display_name' => 'A regular text area field to write words',
                'partial' => 'voyager::formfields.text_area',
                'required' => 1,
                'placeholder' => 'Hello World!',
            ],
        ],
        'template' => 'text_area',
        'compatible' => '*',
    ],
    'image' => [
        'name' => 'Image',
        'fields' => [
            'image_content' => [
                'field' => 'image_content',
                'display_name' => 'An image or piece of art to display to the world',
                'partial' => 'voyager::formfields.image',
                'required' => 1,
            ],
        ],
        'template' => 'image',
        'compatible' => '*',
    ],
    'select' => [
        'name' => 'Select Boxes',
        'fields' => [
            'select_content' => [
                'field' => 'select_content',
                'display_name' => 'A group of options that allow a single selection',
                'partial' => 'voyager::formfields.select_dropdown',
                'required' => 1,
                'options' => [
                    'Select Option 1',
                    'Select Option 2',
                ],
                'placeholder' => 0,
            ],
        ],
        'template' => 'select',
        'compatible' => '*',
    ],
    'checkbox' => [
        'name' => 'Checkboxes',
        'fields' => [
            'checkbox_content' => [
                'field' => 'checkbox_content',
                'display_name' => 'A group of checkboxes that allow multiple selections',
                'partial' => 'voyager::formfields.checkbox',
                'required' => 1,
                'options' => [
                    'Checkbox Option 1',
                    'Checkbox Option 2',
                ],
                'placeholder' => 1,
            ],
        ],
        'template' => 'checkbox',
        'compatible' => '*',
    ],
    'radio' => [
        'name' => 'Radio Buttons',
        'fields' => [
            'radio_content' => [
                'field' => 'radio_content',
                'display_name' => 'A group of radio buttons that allow a single selection',
                'partial' => 'voyager::formfields.radio_btn',
                'required' => 1,
                'options' => [
                    'Option 1',
                    'Option 2',
                ],
                'placeholder' => 0,
            ],
        ],
        'template' => 'radio',
        'compatible' => '*',
    ],
];

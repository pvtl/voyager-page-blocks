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
    'hero_banner' => [
        'name' => 'Hero Banner',
        'fields' => [
            'background_image' => [
                'field' => 'background_image',
                'display_name' => 'Background image',
                'partial' => 'voyager::formfields.image',
                'required' => 1,
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
                'placeholder' => '/posts',
            ],
        ],
        'template' => 'hero_banner',
        'compatible' => '*',
    ],
    'cards_one_column' => [
        'name' => 'Cards - 1 Column',
        'fields' => [
            'image' => [
                'field' => 'image',
                'display_name' => 'Image',
                'partial' => 'voyager::formfields.image',
                'required' => 1,
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
                'placeholder' => '/posts',
            ],
        ],
        'template' => 'cards_one_column',
        'compatible' => '*',
    ],
    'cards_two_columns' => [
        'name' => 'Cards - 2 Columns',
        'fields' => [
            'image1' => [
                'field' => 'image1',
                'display_name' => 'Column 1: Image',
                'partial' => 'voyager::formfields.image',
                'required' => 0,
            ],
            'title1' => [
                'field' => 'title1',
                'display_name' => 'Column 1: Title',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Changing the World!',
            ],
            'content1' => [
                'field' => 'content1',
                'display_name' => 'Column 1: Content',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.',
            ],
            'button_text1' => [
                'field' => 'button_text1',
                'display_name' => 'Column 1: Button Text',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Learn More',
            ],
            'link1' => [
                'field' => 'link1',
                'display_name' => 'Column 1: Link',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => '/posts',
            ],
            'image2' => [
                'field' => 'image2',
                'display_name' => 'Column 2: Image',
                'partial' => 'voyager::formfields.image',
                'required' => 0,
            ],
            'title2' => [
                'field' => 'title2',
                'display_name' => 'Column 2: Title',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Changing the World!',
            ],
            'content2' => [
                'field' => 'content2',
                'display_name' => 'Column 2: Content',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.',
            ],
            'button_text2' => [
                'field' => 'button_text2',
                'display_name' => 'Column 2: Button Text',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Learn More',
            ],
            'link2' => [
                'field' => 'link2',
                'display_name' => 'Column 2: Link',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => '/posts',
            ],
        ],
        'template' => 'cards_two_columns',
        'compatible' => '*',
    ],
    'cards_three_columns' => [
        'name' => 'Cards - 3 Columns',
        'fields' => [
            'image1' => [
                'field' => 'image1',
                'display_name' => 'Column 1: Image',
                'partial' => 'voyager::formfields.image',
                'required' => 0,
            ],
            'title1' => [
                'field' => 'title1',
                'display_name' => 'Column 1: Title',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Changing the World!',
            ],
            'content1' => [
                'field' => 'content1',
                'display_name' => 'Column 1: Content',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.',
            ],
            'button_text1' => [
                'field' => 'button_text1',
                'display_name' => 'Column 1: Button Text',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Learn More',
            ],
            'link1' => [
                'field' => 'link1',
                'display_name' => 'Column 1: Link',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => '/posts',
            ],
            'image2' => [
                'field' => 'image2',
                'display_name' => 'Column 2: Image',
                'partial' => 'voyager::formfields.image',
                'required' => 0,
            ],
            'title2' => [
                'field' => 'title2',
                'display_name' => 'Column 2: Title',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Changing the World!',
            ],
            'content2' => [
                'field' => 'content2',
                'display_name' => 'Column 2: Content',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.',
            ],
            'button_text2' => [
                'field' => 'button_text2',
                'display_name' => 'Column 2: Button Text',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Learn More',
            ],
            'link2' => [
                'field' => 'link2',
                'display_name' => 'Column 2: Link',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => '/posts',
            ],
            'image3' => [
                'field' => 'image3',
                'display_name' => 'Column 3: Image',
                'partial' => 'voyager::formfields.image',
                'required' => 0,
            ],
            'title3' => [
                'field' => 'title3',
                'display_name' => 'Column 3: Title',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Changing the World!',
            ],
            'content3' => [
                'field' => 'content3',
                'display_name' => 'Column 3: Content',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.',
            ],
            'button_text3' => [
                'field' => 'button_text3',
                'display_name' => 'Column 3: Button Text',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => 'Learn More',
            ],
            'link3' => [
                'field' => 'link3',
                'display_name' => 'Column 3: Link',
                'partial' => 'voyager::formfields.text',
                'required' => 0,
                'placeholder' => '/posts',
            ],
        ],
        'template' => 'cards_three_columns',
        'compatible' => '*',
    ],
    'html_content' => [
        'name' => 'HTML Content',
        'fields' => [
            'html_content' => [
                'field' => 'html_content',
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

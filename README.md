**This repository is no longer actively maintained**

# Voyager Page Blocks

![Voyager Frontend Screenshot](/readme-intro.jpg)

This [Laravel](https://laravel.com/)/[Voyager Frontend](https://github.com/pvtl/voyager-frontend) module is designed to give developers the ability to easily design page blocks, for Voyager admin users to build stunning frontend pages.

Built by [Pivotal Agency](https://pivotal.agency/).

---

## Prerequisites

- Composer Installed
- [Install Laravel](https://laravel.com/docs/installation)
- [Install Voyager](https://github.com/the-control-group/voyager)
- [Install Voyager Frontend](https://github.com/pvtl/voyager-frontend)

---

## Installation

```bash
# 1. Require this Package in your fresh Laravel/Voyager project
composer require pvtl/voyager-page-blocks

# 2. Run the Installer
php artisan voyager-page-blocks:install

# 3. (Optional) Seed the database with example page blocks.
php artisan voyager-page-blocks:seed
```

---

## Creating & Modifying Blocks

Page blocks are created & configured in 2 steps:

1. __Define__ the block - in `/config/page-blocks.php`
2. __Build__ the block's HTML layout - create the template in `/resources/views/vendor/voyager-page-blocks/blocks`

### 1. Define a Block

Familiarize yourself with `/config/page-blocks.php`. This is where you'll define each block - you'll tell it which fields the block should have (for the admin to manage) and which Blade template it should use on the frontend.

- Each array inside this configuration file is a page block
- Each block contains __fields__
- Each field contains a unique __field__ key
- Each field is based on a __Voyager Data Type__

The below table explains what each property does and how it is relevant to the block itself:

| Key                    | Purpose                                                                                |
| ---------------------- | -------------------------------------------------------------------------------------- |
| __Root key__           | This is the name of your page block, used to load the configuration                    |
| name                   | This is the display name of your page block, used in the block 'adder'                 |
| fields                 | This is where your page block fields live (text areas, images etc)                     |
| fields => field        | The content name of your field, used to store/load its content                         |
| fields => display_name | The display name of this field in the back-end                                         |
| fields => type         | The data row type that this field will use (check `TCG\Voyager\FormFields`)            |
| fields => required     | Self-explanatory, marks this field as required or not (not available for all partials) |
| fields => placeholder  | Self-explanatory, adds a placeholder to the field (not available for all partials)     |
| fields => details      | Used for selects/checkboxes/radios to supply options                                   |
| template               | This points to your blade file for your block template                                 |
| compatible             | TBA                                                                                    |

### 2. Build the HTML

When you're ready to start structuring the display of your block, you'll need to create (or override our defaults) your blade template (located at `/resources/views/vendor/voyager-page-blocks/blocks/your_block.blade.php`) and use the accessors you defined in your module's configuration file to fetch each fields data (`{!! $blockData->image_content !!}`).

---

## Example. Putting it all together

Let's say we want to create a new block with 1 WYSIWYG editor, called 'Company Overview'.

__Step 1. Define the new block__

In `/config/page-blocks.php`, we'll add:

```php
$blocks['company_overview'] = [
    'name' => 'Company Overview',
    'template' => 'voyager-page-blocks::blocks.company_overview',
    'fields' => [
        'content' => [
            'field' => 'content',
            'display_name' => 'Company Overview Content',
            'type' => 'rich_text_box',
            'required' => 1,
            'placeholder' => '<p>Lorem ipsum dolor sit amet. Nullam in dui mauris.</p>',
        ],
    ],
];
```

__Step 2. Build the HTML__

In `/resources/views/vendor/voyager-page-blocks/blocks`, we'll create a new file called `company_overview.blade.php` with:

```php
<div class="page-block">
    <div class="grid-container column text-center">
        {!! $blockData->content !!}
    </div>
</div>
```

__Step 3. Add the block to a page__

Next, jump into the Voyager Admin > Pages and click 'Content' next to a page. You'll now be able to select `Company Overview` from the 'Add Block' section. Add the block to the page, drag/drop it into place, edit the text etc.

---

## Developer Controller Blocks

You may also wish to include custom logic and functionality into your page blocks. This can be done with a __Developer Controller__ Block - simply specify your controller namespace'd path and the method you wish to call, which should return a [view](https://laravel.com/docs/views) and you'll be on your way.

For example, the [Voyager Frontend](https://github.com/pvtl/voyager-frontend) package comes with a _Recent Posts_ method/view that you can play with and review.

From the _Add Block_ section of the page in the admin, add the block type of _Developer Controller_, then input the following into the path field:

```
Pvtl\VoyagerFrontend\Http\Controllers\PostController::recentBlogPosts(2)
```

This will output `2` blog posts on the frontend. You could change the first paramter of the method to 6, to output 6 blog posts. Simples.

---

## Troubleshooting

__It is important to sanitise your field output, null values will cause errors__.

It is very important that you follow the naming scheme that is setup in the example page blocks as the keys reference other cogs in the system to stitch the blocks together. There are example blocks already set up in the `resources/views` directory and configuration file for you to get started.

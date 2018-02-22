# Voyager Page Blocks
This module is designed to give developers the ability to simply implement and customise page blocks as they see fit, allowing ease of use and access to content and structure.

## Installation
1. Run `composer require pvt/voyager-page-blocks` - that's it.

## Configuration / Block Setup
The installation step of the module will do most things for you automatically, creating the page block scaffold, migrations and seeds for your application however the module itself has some pretty important configuration values (located in `app/config/page-blocks.php`) in relation to blocks themselves, so to understand it we'll need to explain things in a bit of detail:
* Each array inside this configuration file is a page block
* Each block contains __fields__
* Each field contains a unique __field__ key
* Each field is based on a __Voyager Data Type__

The below table explains what each property does and how it is relevant to the block itself:

Key  | Purpose
------------- | -------------
Main Key  | This is the name of your page block, used to load the configuration
name  | This is the display name of your page block, used in the block 'adder'
fields  | This is where your page block fields live (text areas, images etc)
fields => field  | The content name of your field, used to store/load its content
fields => display_name  | The display name of this field in the back-end
fields => partial  | The partial that this field will use (check `TCG\Voyager\FormFields`)
fields => required  | Self-explanatory, marks this field as required or not (not available for all partials)
fields => placeholder  | Self-explanatory, adds a placeholder to the field (not available for all partials)
fields => options  | Used for selects/checkboxes/radios to supply options
template  | This points to your blade file for your block template
compatible  | TBA

When you're ready to start structuring the display of your block, you'll need to create your blade template (located at `resources/views/block_templates/your_block.blade.php`) and use the accessors you defined in your module's configuration to fetch each fields data (`{!! $blockData->image_content or '' !!}`).

__It is important to sanitise your field output, null values will cause errors__.

It is very important that you following the naming scheme that is setup in the example page blocks as the keys reference other cogs in the system to stitch the blocks together. There are example blocks already setup in the `resources/views` directory and configuration file for you to get started.
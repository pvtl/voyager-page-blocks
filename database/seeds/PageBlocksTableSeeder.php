<?php

use Pvtl\VoyagerPages\Page;
use Pvtl\VoyagerPageBlocks\PageBlock;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageBlocksTableSeeder extends Seeder
{
    protected $permissions = [
        'browse_page_blocks',
        'read_page_blocks',
        'edit_page_blocks',
        'add_page_blocks',
    ];

    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        // Seed example page blocks
        $homePage = Page::where('slug', 'home')->first();
        $aboutPage = Page::where('slug', 'about')->first();
        $contactPage = Page::where('slug', 'contact')->first();

        if ($homePage) {
            $block = $this->findBlock($homePage->id, 'testimonial');
            if (!$block->exists) {
                $block->page_id = $homePage->id;
                $block->type = 'template';

                $block->fill([
                    'path' => 'testimonial',
                    'data' => [
                        'content' => 'Company X is both attractive and highly adaptable. Company X has really helped our business thrive - I can\'t wait to see what comes next for us',
                        'title' => 'John Smith',
                        'sub_title' => 'Founder & CEO',
                        'br_1' => 'null',
                        'image' => '',
                        'br_2' => 'null',
                        'spaces' => '3',
                        'animate' => 'on',
                    ],
                    'is_hidden' => 0,
                    'is_minimized' => 0,
                    'is_delete_denied' => 0,
                    'cache_ttl' => 0,
                    'order' => '10000',
                ])->save();
            }

            $block = $this->findBlock($homePage->id, 'content_one_column');
            if (!$block->exists) {
                $block->page_id = $homePage->id;
                $block->type = 'template';

                $block->fill([
                    'path' => 'content_one_column',
                    'data' => [
                        'html_content_1' => '<h2 style=\"text-align: center;\">Welcome to Voyager Frontend</h2><p style=\"text-align: center;\">Matey yardarm topmast broadside nipper weigh anchor jack quarterdeck crow\'s nest rigging. Topgallant lateen sail line avast me gun Pirate Round strike colors bilge rat take a caulk. Jack six pounders spanker doubloon clipper spirits case shot hang the jib boatswain red ensign.</p><p style=\"text-align: center;\">Hornswaggle spanker spyglass Yellow Jack mutiny Arr lugger poop deck keel take a caulk. Quarter fire ship run a shot across the bow sheet log draft scallywag gally port skysail. Lugsail gangway draft pink piracy bilge Buccaneer heave to landlubber or just lubber Pieces of Eight.</p>',
                        'spaces' => '2',
                        'animate' => 'on',
                    ],
                    'is_hidden' => 0,
                    'is_minimized' => 0,
                    'is_delete_denied' => 0,
                    'cache_ttl' => 0,
                    'order' => '10000',
                ])->save();
            }

            $block = $this->findBlock($homePage->id, 'content_two_columns');
            if (!$block->exists) {
                $block->page_id = $homePage->id;
                $block->type = 'template';

                $block->fill([
                    'path' => 'content_two_columns',
                    'data' => [
                        'html_content_1' => '<p style=\"text-align: left;\">Matey yardarm topmast broadside nipper weigh anchor jack quarterdeck crow\'s nest rigging. Topgallant lateen sail line avast me gun Pirate Round strike colors bilge rat take a caulk. Jack six pounders spanker doubloon clipper spirits case shot hang the jib boatswain red ensign.</p><p style=\"text-align: left;\"></p>',
                        'html_content_2' => '<p><span style=\"text-align: center;\">Hornswaggle spanker spyglass Yellow Jack mutiny Arr lugger poop deck keel take a caulk. Quarter fire ship run a shot across the bow sheet log draft scallywag gally port skysail. Lugsail gangway draft pink piracy bilge Buccaneer heave to landlubber or just lubber Pieces of Eight.</span></p>',
                        'spaces' => '0',
                        'animate' => 'on',
                    ],
                    'is_hidden' => 0,
                    'is_minimized' => 0,
                    'is_delete_denied' => 0,
                    'cache_ttl' => 0,
                    'order' => '10000',
                ])->save();
            }
        }

        if ($aboutPage) {
            $block = $this->findBlock($aboutPage->id, 'content_one_column');
            if (!$block->exists) {
                $block->page_id = $aboutPage->id;
                $block->type = 'template';

                $block->fill([
                    'path' => 'content_one_column',
                    'data' => [
                        'html_content_1' => '<p style=\"text-align: center;\">Matey yardarm topmast broadside nipper weigh anchor jack quarterdeck crow\'s nest rigging. Topgallant lateen sail line avast me gun Pirate Round strike colors bilge rat take a caulk. Jack six pounders spanker doubloon clipper spirits case shot hang the jib boatswain red ensign.</p><p style=\"text-align: center;\">Hornswaggle spanker spyglass Yellow Jack mutiny Arr lugger poop deck keel take a caulk. Quarter fire ship run a shot across the bow sheet log draft scallywag gally port skysail. Lugsail gangway draft pink piracy bilge Buccaneer heave to landlubber or just lubber Pieces of Eight.</p>',
                        'spaces' => '2',
                        'animate' => 'on',
                    ],
                    'is_hidden' => 0,
                    'is_minimized' => 0,
                    'is_delete_denied' => 0,
                    'cache_ttl' => 0,
                    'order' => '10000',
                ])->save();
            }
        }

        if ($contactPage) {
            $block = $this->findBlock($contactPage->id, 'content_one_column');
            if (!$block->exists) {
                $block->page_id = $contactPage->id;
                $block->type = 'template';

                $block->fill([
                    'path' => 'content_one_column',
                    'data' => [
                        'html_content_1' => '<p>You can install the <a href="https://github.com/pvtl/voyager-forms">Voyager Forms</a> module and add the appropriate tag here.</p>',
                        'spaces' => '1',
                        'animate' => 'on',
                    ],
                    'is_hidden' => 0,
                    'is_minimized' => 0,
                    'is_delete_denied' => 0,
                    'cache_ttl' => 0,
                    'order' => '10000',
                ])->save();
            }
        }
    }

    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }

    protected function findBlock($pageId, $path)
    {
        return PageBlock::firstOrNew(['page_id' => $pageId, 'path' => $path]);
    }
}

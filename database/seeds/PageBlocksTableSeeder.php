<?php

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
        DataType::firstOrNew([
            'name' => 'page_blocks',
            'slug' => 'page-blocks',
            'display_name_singular' => 'Page Block',
            'display_name_plural' => 'Page Blocks',
            'icon' => 'voyager-file-text',
            'model_name' => 'Pvtl\VoyagerPageBlocks\PageBlock',
            'controller' => '\Pvtl\VoyagerPageBlocks\Http\Controllers\PageBlockController',
            'generate_permissions' => '1',
        ])->save();

        $dataType = $this->dataType('slug', 'pages');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'pages',
                'display_name_singular' => 'Page',
                'display_name_plural'   => 'Pages',
                'icon'                  => 'voyager-file-text',
                'model_name'            => 'Pvtl\\VoyagerPageBlocks\\Page',
                'controller'            => '\\Pvtl\\VoyagerPageBlocks\\Http\\Controllers\\PageController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        if ($dataType->exists) {
            $dataType->update([
                'model_name' => 'Pvtl\\VoyagerPageBlocks\\Page',
                'controller' => '\\Pvtl\\VoyagerPageBlocks\\Http\\Controllers\\PageController',
            ]);
        }
    }

    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}

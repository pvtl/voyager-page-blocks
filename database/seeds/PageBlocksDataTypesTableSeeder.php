<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class PageBlocksDataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
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

        // Let's hide the body from the page edit view
        if ($dataType->exists) {
            $body = \TCG\Voyager\Models\DataRow::where('data_type_id', $dataType->id)
                ->where('field', 'body')
                ->firstOrFail();

            $body->type = 'hidden';
            $body->save();
        }
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}

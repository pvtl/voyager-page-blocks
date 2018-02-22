<?php

namespace Pvtl\VoyagerPageBlocks\Database;

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
        $role = Role::where('name', 'admin')->firstOrFail();

        $dataType = DataType::firstOrNew([
            'name' => 'page_blocks',
            'slug' => 'page-blocks',
            'display_name_singular' => 'Page Block',
            'display_name_plural' => 'Page Blocks',
            'icon' => 'voyager-file-text',
            'model_name' => '\Pvtl\VoyagerPageBlocks\PageBlock',
            'controller' => '\Pvtl\VoyagerPageBlocks\Http\Controllers\PageBlockController',
            'generate_permissions' => '1',
        ]);

        $dataType->save();

        foreach ($this->permissions as $permissionName) {
            $permission = Permission::firstOrNew([
                'key' => $permissionName,
                'table_name' => 'page_blocks',
            ]);

            $permission->save();

            DB::table('permission_role')->insert([
                'permission_id' => $permission->id,
                'role_id' => $role->id,
            ]);
        }
    }
}

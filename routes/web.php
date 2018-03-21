<?php

use TCG\Voyager\Models\DataType;

/**
 * Admin Route/s
 */
Route::group([
    'as' => 'voyager.page-blocks.',
    'prefix' => 'admin/page-blocks/',
    'middleware' => ['web', 'admin.user'],
    'namespace' => '\Pvtl\VoyagerPageBlocks\Http\Controllers'
], function () {
    Route::post('layout/{id}', ['uses' => "PageBlockController@changeLayout", 'as' => 'layout']);
    Route::post('order', ['uses' => "PageBlockController@order", 'as' => 'order']);
    Route::post('minimize', ['uses' => "PageBlockController@minimize", 'as' => 'minimize']);
});

/**
 * Frontend Route/s
 */
$excludeRoutes = array();

try {
    $namespacePrefix = '\\'.config('voyager.controllers.namespace').'\\';
    foreach (DataType::all() as $dataType) {
        $breadController = $dataType->controller
                         ? $dataType->controller
                         : $namespacePrefix.'VoyagerBreadController';

        $excludeRoutes[] = $dataType->slug;
    }
} catch (\Exception $e) {
    // do nothing, might just be because table not yet migrated.
}

if (!Request::is($excludeRoutes)) {
    Route::get('/{slug?}', '\Pvtl\VoyagerPageBlocks\Http\Controllers\PageController@getPage')->middleware('web');
}

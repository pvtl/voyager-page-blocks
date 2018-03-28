<?php

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
 * - The following is a "catch-all" route, so we need to exclude any (DB) registered
 *   slugs to avoid overriding everything.
 */
$dataTypes = \TCG\Voyager\Models\DataType::all();
$excludedRoutes = array();
foreach ($dataTypes as $dataTypes) {
    array_push($excludedRoutes, $dataTypes->slug, $dataTypes->slug . '/*');
}

if (!Request::is($excludedRoutes)) {
    Route::get('/{slug?}', '\Pvtl\VoyagerPageBlocks\Http\Controllers\PageController@getPage')
        ->middleware('web')
        ->where('slug', '.+');
}

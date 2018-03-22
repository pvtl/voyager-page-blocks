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
 */
$excludedRoutes = \TCG\Voyager\Models\DataType::all()->map(function ($dataType) {
    return $dataType->slug;
})->toArray();

if (!Request::is($excludedRoutes)) {
    Route::get('/{slug?}', '\Pvtl\VoyagerPageBlocks\Http\Controllers\PageController@getPage')->middleware('web');
}

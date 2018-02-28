<?php

/**
 * Admin Route/s
 */
Route::group([
    'as' => 'voyager.page-blocks.',
    'prefix' => 'admin/page-blocks/',
    'middleware' => ['web', 'admin.user']
], function () {
    $controller = '\Pvtl\VoyagerPageBlocks\Http\Controllers\PageBlockController';

    Route::post('order', ['uses' => $controller . '@order', 'as' => 'order']);
    Route::post('minimize', ['uses' => $controller . '@minimize', 'as' => 'minimize']);
});

/**
 * Frontend Route/s
 */
Route::get('/{slug?}', '\Pvtl\VoyagerPageBlocks\Http\Controllers\PageController@getPage')->middleware('web');

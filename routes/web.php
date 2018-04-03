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

<?php

Route::get('/{slug?}', '\Pvtl\VoyagerPageBlocks\Http\Controllers\PageController@getPage');

Route::get('/admin/page-blocks', function () {
    return redirect('/admin/pages');
});

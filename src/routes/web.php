<?php

Route::group(['middleware' => ['web']], function () {


    if (config('lara-cms-lite.roles')) {
        Route::group(['middleware' => ['web', 'role:'.implode(config('lara-cms-lite.roles'), ',').'']], function () {
            Route::resource('contents', 'Fbollon\LaraCmsLite\Http\Controllers\ContentController');
          });
    } else {
        Route::resource('contents', 'Fbollon\LaraCmsLite\Http\Controllers\ContentController');
    }
});
    
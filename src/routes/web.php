<?php

// Route::get('contents', function(){
//     return view('lara-cms-lite::index');
// });


// use Illuminate\Support\Facades\Route;
// use Fbollon\LaraCmsLite\Http\Controllers\ContentController;

Route::group(['middleware' => ['web']], function () {


    if (config('lara-cms-lite.roles')) {
        Route::group(['middleware' => ['web', 'role:'.implode(config('lara-cms-lite.roles'), ',').'']], function () {
            Route::resource('contents', 'Fbollon\LaraCmsLite\Http\Controllers\ContentController');
          });
    } else {
        Route::resource('contents', 'Fbollon\LaraCmsLite\Http\Controllers\ContentController');
    }
});




    // Route::middleware(['role:administrator'])->group(function () {
        
    //     Route::resource('contents', 'Fbollon\LaraCmsLite\Http\Controllers\ContentController');
    // });


    // Route::group(['namespace' => 'Fbollon\LaraCmsLite\Http\Controllers'], function(){
    //     /*
    //     * Contents Routes
    //     */

    //     Route::resource('contents', 'ContentController');//->middleware('auth', 'role:administrator')

    //     // Route::resource('contents', 'ContentController')->middleware('auth', 'role:administrator');
    //     // // Route::post('contents/{content}/upload', 'ContentController@upload')->name('contents.upload');
    //     // // Route::post('contents/removeFile', 'ContentController@removeFile')->name('contents.removeFile');

    //     // Route::get('contents', 'ContentController@index')->name('contents');


        
    // });
    
    
    
    
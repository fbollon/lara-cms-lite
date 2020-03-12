<?php

// Route::get('contents', function(){
    //     return view('lara-cms-lite::index');
    // });
    


    


    Route::group(['namespace' => 'Fbollon\LaraCmsLite\Http\Controllers'], function(){
        /*
        * Contents Routes
        */

        Route::resource('contents', 'ContentController');

        // Route::resource('contents', 'ContentController')->middleware('auth', 'role:administrator');
        // // Route::post('contents/{content}/upload', 'ContentController@upload')->name('contents.upload');
        // // Route::post('contents/removeFile', 'ContentController@removeFile')->name('contents.removeFile');

        // Route::get('contents', 'ContentController@index')->name('contents');


        
    });
    
    
    
    
<?php

Route::group(['prefix' => 'pm', 'as' => 'pm.', 'middleware' => 'web'], function () {
    // Inbox
    Route::get('/inbox', ['as' => 'inbox', 'uses' => 'LaravelPM\Http\Controllers\PMController@inbox']);

    // Read conversation
    Route::get('/conversation/{conversation}', ['as' => 'conversation', 'uses' => 'LaravelPM\Http\Controllers\PMController@conversation']);

    // Compose new message
    Route::any('/compose', ['as' => 'compose', 'uses' => 'LaravelPM\Http\Controllers\PMController@compose']);
});
